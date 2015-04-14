<?php
/**
 * @Author: winterswang
 * @Date:   2015-04-10 14:21:27
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-04-14 15:52:50
 */

class MultiCall extends Client {

	public $callList = array();	//IO请求列表
	public $callRsp = array();	//回报结果
	public $client_key;	//client的key
	public $key;	//multicall自己的key
	public $callback; //回调函数

	/**
	 * [__construct 构造函数，初始化CLIENT_KEY]
	 */
	public function __construct(){
		$this ->client_key = 0;
	}

	/**
	 * [setKey 设置自己的 key值]
	 * @param [type] $key [description]
	 */
	public function setKey($key){
		$this ->key = $key;
	}

	/**
	 * [addCall 添加IO CLIENT]
	 * @param TestClient $client [description]
	 */
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

	/**
	 * [sendData 循环异步网络发包]
	 * @param  callable $callback [description]
	 * @return [type]             [description]
	 */
	public function sendData(callable $callback)
	{
		//$this ->log(__METHOD__. " callList = ".print_r($this ->callList,true));
		$this ->callback = $callback;
		for ($i=0; $i < count($this ->callList); $i++) { 
			$this ->callList[$i] ->sendData(array($this ,'packRsp'));

		}
	}

	/**
	 * [packRsp 回调函数，收包，合包，回调]
	 * @param  [type] $r          [description]
	 * @param  [type] $client_key [description]
	 * @param  [type] $data       [description]
	 * @return [type]             [description]
	 */
	public function packRsp($r,$client_key,$data)
	{
		//$this ->log(__METHOD__." r = $r client_key = $client_key callList = " . count($this ->callList));
		$this ->callRsp[$client_key] = array('r' =>$r, 'data' => $data);
		//收包完成
		if (count($this ->callList) == count($this ->callRsp)) 
		{
			//$this ->log(__METHOD__ . " get all the rsp ==== ".print_r($this ->callRsp,true));
			call_user_func_array($this ->callback, array('r' => $r, 'key' => '', 'data' =>$this ->callRsp));
		}
	}

	/**
	 * [log 简单的LOG]
	 * @param  [type] $log [description]
	 * @return [type]      [description]
	 */
	public function log($log){
        $time = date('Y-m-d H:i:s');
        error_log($time . $log . PHP_EOL, 3, '/tmp/'.__CLASS__.'.log');
	}
}

?>