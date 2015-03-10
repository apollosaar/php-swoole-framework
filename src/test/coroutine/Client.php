<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 20:08:14
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-10 21:24:42
 */

class Client {

	public $client;
	public $ip;
	public $port;
	public $data;
	public $timeout = 2;

	public function __construct($ip,$port,$data){
		$this ->client = new swoole_client(SWOOLE_SOCK_UDP, SWOOLE_SOCK_ASYNC);
		$this ->ip = $ip;
		$this ->port = $port;
		$this ->data = $data;
	}

	public function sendData($callback){
        //闭包调用
        $this->client->on("connect", function($cli){
            echo "connected\n";
            $cli->send($this ->data);
        });

        $this->client->on('close', function($cli){
            echo "closed\n";
        });

        $this->client->on('error', function($cli){
            echo "error\n";
        });

        $this->client->on("receive", function($cli, $data) use ($callback){
        	echo "receiving data \n";
            call_user_func_array($callback, array('data' => $data));
            $cli->close();
        });

        if($this->client->connect($this ->ip, $this ->port, $this ->timeout)){
        }
	}

	// public function sendData(){
	// 	$this ->client->connect($this ->ip ,$this ->port);
	// 	$this ->client->send($this ->data);
	// 	return $this ->client -> recv();
	// 	//return 'test for swoole_client';
	// }
}
?>