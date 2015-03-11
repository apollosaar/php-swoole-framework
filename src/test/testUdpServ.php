<?php
/**
 * @Author: winterswang
 * @Date:   2015-02-28 14:48:14
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-11 17:36:08
 */
$serv = new swoole_server("127.0.0.1", 9905,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);
$serv->set(array(
		//'tcp_defer_accept' => 5,
		//'ipc_mode' => 2,
		'worker_num' => 4,
		'task_worker_num' => 4,
		//'max_request' => 1000,
		//'daemonize' => true,
		'log_file' => '/tmp/swoole.log'
));
$serv->on('timer', function($serv, $interval) {
	echo "onTimer: $interval\n";
});
$serv->on('start', function($serv) {
	//$serv->addtimer(1000);
});
$serv->on('workerStart', function($serv, $worker_id) {
	echo "server start\n";
	//if($worker_id == 0) $serv->addtimer(1000);
});
$serv->on('connect', function ($serv, $fd, $from_id){
	//echo "[#".posix_getpid()."]\tClient@[$fd:$from_id]: Connect.\n";
});
$serv->on('task', function ($serv, $task_id, $from_id, $data){
    echo "onTask: [PID=".posix_getpid()."]: task_id=$task_id, data_len=".strlen($data).".".PHP_EOL;
    $serv->finish($data);
    return;
});
$serv->on('finish', function (swoole_server $serv, $task_id, $data) {
    echo "Task#$task_id finished, data_len=".strlen($data).PHP_EOL;
});

$serv->on('receive', function (swoole_server $serv, $fd, $from_id, $data) {

	 $data = trim($data);
     //$data = str_repeat('A', 8192*100);
	 //    if ($data == 'async')
	 //    //if (false)
	 //    {
	 //        $task_id = $serv->task($data);
	 //        echo "Dispath AsyncTask: id=$task_id\n";
	 //    }
	 //    //Sync Task
		// else
	 //    {
	 //        $res = $serv->taskwait($data);
	 //        echo "Dispath SyncTask: result=".$res.PHP_EOL;
	 //    }

	$serv->send($fd, serialize(array("hello" => '1213', "bat" => "ab")).PHP_EOL);
});



$serv->on('close', function ($serv, $fd, $from_id) {
	echo "[#".posix_getpid()."]\tClient@[$fd:$from_id]: Close.\n";
});
$serv->start();
?>