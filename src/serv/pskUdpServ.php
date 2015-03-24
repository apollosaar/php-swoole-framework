<?php
/**
 * @Author: winterswang
 * @Date:   2014-11-27 14:58:28
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-02-28 11:17:23
 */
class pskUdpServ extends Swoole\Network\Protocol\BaseServer{

    /**
     * [onReceive 收包函数，应该有判断PB数据是否正确，是否需要拼包等常规处理]
     * @param  [type] $server [description]
     * @param  [type] $fd     [description]
     * @param  [type] $fromId [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
    public function onReceive($server, $fd, $fromId, $data) {

        $pbArr = PBAssistant::unpackPbData($data);
        error_log(__METHOD__." pbArr =".print_r($pbArr,true),3,'/tmp/winters.log');

        $cg = new ConGenerator();
        if($cg ->init($server,$pbArr['cmd'],$pbArr['seq'],$pbArr['headObj'],$pbArr['bodyBuf'])){
            $data = $cg ->getResult();
            $this->server->send($fd, $data);
        }
        else{
            error_log('ConGenerator init failed'.PHP_EOL,3,'/tmp/winters.log');
        }
    }

    /**
     * [onTask 分支串行任务执行体]
     * @param  [type] $server [description]
     * @param  [type] $taskId [description]
     * @param  [type] $fromId [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
    public function onTask($server, $taskId, $fromId, $data){
        //传递过来的数据里，夹带了需要task执行的对象和方法，还有数据
        $res =array('r' => 1, 'data' => $data['data']);
        if ((! isset($data['callback']['object'])) || (! is_object($data['callback']['object']))) {
            $res = array('r' => 1, 'data' =>'miss object or object not found');
        }

        if (!method_exists($data['callback']['object'], $data['callback']['method'])) {
            $res = array('r' => 1, 'data'=>'miss method or method not exists');
        }

        return call_user_func_array($data['callback'], $res);
    }

    /**
     * [onFinish task任务执行完后的返回结果]
     * @param  [type] $server [description]
     * @param  [type] $taskId [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
    public function onFinish($server, $taskId, $data){

    }
}
