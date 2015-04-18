<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 20:08:14
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-04-18 10:41:20
 */
require_once 'TestClient.php';
class UdpTestClient extends TestClient {

	public $ip;
	public $port;
	public $data;
	public $key;
	public $timeout = 5;
    public $isConnect = false;

	public function __construct($ip,$port,$data,$timeout){
		$this ->ip = $ip;
		$this ->port = $port;
		$this ->data = $data;
        $this ->timeout = $timeout;
	}

	public function setKey($key){
		$this ->key = $key;
	}

	public function getKey(){
		return $this ->key;
	}

	public function sendData(callable $callback){

        $client = new  swoole_client(SWOOLE_SOCK_UDP, SWOOLE_SOCK_ASYNC);

        $client->on("connect", function($cli){
            $this ->isConnect = true;
            $cli->send($this ->data);
        });

        $client->on('close', function($cli){
            $this ->isConnect = false;
        });

        $client->on('error', function($cli) use($callback){
            $this ->isConnect = false;    
            $cli ->close();
            call_user_func_array($callback, array('r' => 1, 'key' => $this ->key,  'error_msg' => 'conncet error'));
        });

        $client->on("receive", function($cli, $data) use($callback){
            $this ->isConnect = false;   
            $cli->close();        
            call_user_func_array($callback, array('r' => 0, 'key' => $this ->key, 'data' =>$data));
        });

        if($client->connect($this ->ip, $this ->port, $this ->timeout)){
            if (intval($this ->timeout) >0) {
                swoole_timer_after(intval($this ->timeout) * 1000, function() use($client,$callback){
                    if ($this ->isConnect) {
                        //error_log(__METHOD__." client ===== ".print_r($client,true),3,'/tmp/client.log');
                        $client ->close();
                        call_user_func_array($callback, array('r' => 2 ,'key' => '', 'error_msg' => 'timeout'));
                    }
                });
            }
        }
	}
}
?>