<?php
/**
 * @Author: winterswang
 * @Date:   2015-02-28 11:11:33
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-23 18:25:14
 */
class TestController {
    public $server;
    public $fd;
    public $data;
    public $from_id;

    public function __construct($server,$fd,$from_id,$data){
        $this ->server = $server ;
        $this ->fd = $fd ;
        $this ->data = $data ;
        $this ->from_id = $from_id;
    }

	public function test(){
        $fdinfo = $this->server->connection_info($this ->fd,$this ->from_id);
        var_dump($fdinfo);

        $time = microtime(true);
        $log = __METHOD__." begin test function time = $time \n";
        error_log($log ,3, '/tmp/press.log');

        $data = (yield $this ->test2());
        $time = microtime(true);

        $fdinfo = $this->server->connection_info($this ->fd,$this ->from_id);
        var_dump($fdinfo);

		$this->server->send($this ->fd, $data);

        $time = microtime(true);
        $log =  __METHOD__."after send time = $time \n";
        error_log($log,3,'/tmp/press.log');
	}

	public function test2(){
        echo __METHOD__."\n";
		$dat1 = (yield $this ->test3());
        echo __METHOD__."\n";
        $dat2 = (yield $this ->test3());
        yield $dat1.$dat2;
	}

    public function test3(){
        echo __METHOD__."\n";
        $host = '10.213.168.89';
        $port = 9905;
        $timeout = 5;
        $data = 'test';
        //TODO,依赖数据返回
        $data = (yield UdpClient::send($host,$port,$data,$timeout));
        yield $data;
    }
}
?>