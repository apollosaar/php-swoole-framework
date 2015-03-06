<?php
/**
 * @Author: winterswang
 * @Date:   2014-11-27 14:58:28
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-01-21 21:03:29
 */
class testUdpServ extends Swoole\Network\Protocol\BaseServer{

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
        if($cg ->init($pbArr['cmd'],$pbArr['seq'],$pbArr['headObj'],$pbArr['bodyBuf'])){
            $data = $cg ->getResult();
            $this->server->send($fd, $data);
        }
        else{
            error_log('ConGenerator init failed'.PHP_EOL,3,'/tmp/winters.log');
        }
    }
}
