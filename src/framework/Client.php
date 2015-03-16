<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 20:08:14
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-14 14:49:36
 */

class Client {

	public $client;
	public $ip;
	public $port;
	public $data;
	public $timeout;
	public $is_close = false;

	public function __construct($ip, $port, $data, $clientTpye = SWOOLE_SOCK_UDP, $timeout = 5){
		$this ->client = new swoole_client($clientTpye, SWOOLE_SOCK_ASYNC);
		$this ->ip = $ip;
		$this ->port = $port;
		$this ->data = ($data);
		$this ->timeout = $timeout;
	}

	public function sendData($callback){
        //闭包调用
        $this->client->on("connect", function($cli){
            $cli->send($this ->data);
        });

        $this->client->on('close', function($cli){
        	$this ->is_close = true;
        });

        $this->client->on('error', function($cli){
        });

        $this->client->on("receive", function($cli, $data) use ($callback){

            call_user_func_array($callback, array('data' => ($data)));
            $cli->close();
        });

        if($this->client->connect($this ->ip, $this ->port, $this ->timeout)){
        	//error_log("connect \n",3,'/tmp/connect.log');
        }
	}

}
?>