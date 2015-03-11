<?php

/**
 * @Author: winterswang
 * @Date:   2015-02-28 12:18:52
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-11 21:13:50
 */

	require_once "../require.php";
	//引入lib
	$path = TestAutoLoad::getFatherPath(dirname(__FILE__),2).'/lib'; //win \lib linux /lib
	TestAutoLoad::addRoot($path);
	TestAutoLoad::addRoot(dirname(dirname(__FILE__)));

	//异步使用client
	$client = new Swoole\Client\AsyncUdpClient();
	$test = new TestCall();
	$data = array('cmd' =>4,'seq' => 1);
	$client ->send('10.130.73.229',9501,serialize($data),array($test,'call_back'));
	// $client ->send('127.0.0.1',9905,'async',array($test,'call_back'));
	class TestCall {
		/**
		 * [test 异步回包处理函数]
		 * @param  [type] $r    [返回状态]
		 * @param  [type] $data [返回pb包数据]
		 * @return [type]       [description]
		 */
		public function call_back($r,$data){
			var_dump(unserialize($data));
		}
	}
?>