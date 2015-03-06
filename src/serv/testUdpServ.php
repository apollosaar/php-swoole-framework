<?
/**
 * @Author: winterswang
 * @Date:   2015-02-28 11:16:58
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-06 10:59:25
 */

class testUdpServ extends Swoole\Network\Protocol\BaseServer{

    public function onReceive($server, $fd, $fromId, $data){
	$data = unserialize($data);
	if (isset($data['seq'])) {
            $data['seq'] ++;
	}

        $cg = new ConGenerator();
        if($cg ->init($this->server,array('cmd' => '3','seq' => $data['seq'],'serverType' => 'udp'))){
            $data = $cg ->getResult();
            $this->server->send($fd, serialize($data));
        }
        else{
            error_log('ConGenerator init failed'.PHP_EOL,3,'/tmp/winters.log');
        }
    }

    public function onTask($server, $taskId, $fromId, $data){
    	$task = unserialize($data);
        $task ->onTask();
        $server ->finish(serialize($task));
        return ;
    }

    public function onFinish($server, $taskId, $data){
    	$task = unserialize($data);
        //自己预设了回调函数，则调用预设的，没有则走默认的task对象的onFinish函数
        if (is_object($task ->obj) && isset($task ->func))
        {
            //TODO 判断task任务是否正确处理结果，执行预定onFinish函数时，携带上执行状态和执行结果
            $task ->obj ->{$task ->func}(0,$data);
        }else
        {
            $task ->onFinish();
        }

    }

    public function onTimer($serv, $interval){
        //TODO 基于静态类，完成时间点和执行实例的映射关系
        $ret = Timer::getFun($interval);
        //执行定时程序
        if ($ret) {
            $ret[0] ->{$ret[1]}();
        }
    }
}

?>

