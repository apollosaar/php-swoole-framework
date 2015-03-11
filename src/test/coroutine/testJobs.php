<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 20:31:52
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-11 20:47:04
 */
require 'Scheduler.php';
require 'Jobs.php';
require 'Client.php';

function send($data){

	$client = new Client('127.0.0.1',9905,serialize($data));
	$res = (yield $client);
	echo "recive1 $res \n";
	yield $res;
}

function getTest($data){
	$res = (yield send($data));
	echo "recive2 $res \n";
	yield $res;
}

function test(){

		$data = array('cmd' =>2,'seq' => 1);
		sleep(1);
		echo " do some jobs need send data to server \n";
		$data = (yield send($data));
		//TODO 这种结构不适用
		//$data = (yield send(yield send($data)));
		sleep(1);
		var_dump(unserialize($data));
		$data = (yield send($data));
		sleep(1);
		var_dump(unserialize($data));
		sleep(1);
		echo "jobs done \n";
}

$scheduler = new Scheduler;

$scheduler->addJobs(test());
$scheduler->run();

// $corArr = array();
// $c = test();
// while ($c instanceof Generator) {
// 	//echo "Generator \n";
// 	$corArr[] = $c;
// 	$c = $c ->current();
// }
// // print_r($corArr);
// $num = count($corArr);
// $res = 'test';
// while ($num) {
// 	$num --;
// 	echo "send \n";
// 	$c = $corArr[$num];
// 	if ($c instanceof Client) {
// 		$c ->sendData($callback);
// 	}
// 	$res = $c->send($res);
// }

?>