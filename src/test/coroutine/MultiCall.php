<?php
/**
 * @Author: winterswang
 * @Date:   2015-04-10 14:21:27
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-04-11 13:31:50
 */

class MultiCall extends TestClient {

	public $callList = array();
	public $callRsp = array();
	public $client_key;
	public $key;
	public $callback;

	public function __construct(){
		$this ->client_key = 0;
	}

	public function setKey($key){
		$this ->key = $key;
	}

	public function addCall(TestClient $client)
	{
		/**
		 * 判断用户是否设置了key，如果没有，代为设置，按照添加顺序来设置KEY
		 */
		if (empty($client ->getKey())) {
			$client ->setKey($this ->client_key);
			$this ->client_key ++;
		}

		$this ->callList[] = $client;
		
	}

	public function sendData(callable $callback)
	{
		$this ->log(__METHOD__. " callList = ".print_r($this ->callList,true));
		$this ->callback = $callback;
		for ($i=0; $i < count($this ->callList); $i++) { 
			$this ->callList[$i] ->sendData(array($this ,'packRsp'));

		}
	}

	public function packRsp($r,$client_key,$data)
	{
		$this ->log(__METHOD__." r = $r client_key = $client_key data = ".print_r($data,true));
		$this ->callRsp[$client_key] = array('r' =>$r, 'data' => $data);
		//收包完成
		if (count($this ->callRsp) > $client_key) 
		{
			$this ->log(__METHOD__ . " get all the rsp ==== ".print_r($this ->callRsp,true));
			call_user_func_array($this ->callback, array('r' => $r, 'key' => '', 'data' =>$this ->callRsp));
		}
	}

	public function log($log){
        $time = date('Y-m-d H:i:s');
        error_log($time . $log . PHP_EOL, 3, '/tmp/'.__CLASS__.'.log');
	}
}

?>