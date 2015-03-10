<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 20:31:52
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-10 21:42:32
 */
require "Jobs.php";
require "Scheduler.php";
require 'Client.php';

function test(){

		$data = array('cmd' =>2,'seq' => 1);
		sleep(1);
		echo " do some jobs need send data to server \n";
		$res = (yield new Client('10.213.168.89',9501,serialize($data)));
		sleep(1);
		echo "get data from server ".print_r($res) . "\n";
		sleep(1);
		echo "jobs done \n";
}

$scheduler = new Scheduler();
for ($i=0; $i < 10; $i++) {
	$scheduler ->addJobs(test());
}

$scheduler ->run();
?>