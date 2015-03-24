<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-09 16:51:46
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-10 20:16:49
 */

class Client{

	public $client;
	public $ip;
	public $port;
	public $data;

	public function __construct($ip,$port,$data){
		//$this ->client = new swoole_client(SWOOLE_SOCK_UDP, SWOOLE_SOCK_SYNC);
		$this ->ip = $ip;
		$this ->port = $port;
		$this ->data = $data;
	}

	public function send(){
		// $client->connect($ip,$port);
		// $client->send($this ->data);
		echo "send {$this ->data} to {$this ->ip} :{$this ->port} server \n";
	}
}

class Task {
    protected $taskId;
    protected $coroutine;
    protected $sendValue = 111;
    protected $beforeFirstYield = true;

    public function __construct($taskId, Generator $coroutine) {
        $this->taskId = $taskId;
        $this->coroutine = $coroutine;
    }

    public function getTaskId() {
        return $this->taskId;
    }

    public function setSendValue($sendValue) {
        $this->sendValue = $sendValue;
    }

    public function run() {
        if ($this->beforeFirstYield) {
            $this->beforeFirstYield = false;
            return $this->coroutine->current();
        } else {
            $retval = $this->coroutine->send($this->sendValue);
            $this->sendValue ++;
            return $retval;
        }
    }

    public function isFinished() {
        return !$this->coroutine->valid();
    }
}

class Scheduler {
    protected $maxTaskId = 1000;
    protected $taskMap = []; // taskId => task
    protected $taskQueue;

    public function __construct() {
        $this->taskQueue = new SplQueue();
    }

    public function newTask(Generator $coroutine) {
        $tid = ++$this->maxTaskId;
        $task = new Task($tid, $coroutine);
        $this->taskMap[$tid] = $task;
        $this->schedule($task);
        return $tid;
    }

    //其实只是负责加入到队列里
    public function schedule(Task $task) {
        $this->taskQueue->enqueue($task);
    }

    public function run() {
        while (!$this->taskQueue->isEmpty()) {
            $task = $this->taskQueue->dequeue();
            $res = $task ->run();
            if ($res instanceof Client) {
            	$res ->send();
            }
            if ($task->isFinished() && empty($res)) {
            	echo "task_id ".$task->getTaskId() ." finish \n";
                unset($this->taskMap[$task->getTaskId()]);
            } else {
            	 echo "task_id : ".$task ->getTaskId() . " send a request : " .print_r($res,true).PHP_EOL;
                $this->schedule($task);
            }
        }
    }
}

function task1() {
	$data = array('cmd' =>2,'seq' => 1);
	sleep(1);
	echo " do some jobs need send data to server \n";
	$tid = (yield new Client('10.213.168.89',9501,serialize($data)));
	sleep(1);
	echo "get data from server ".print_r($tid);
	sleep(1);
	echo "jobs done \n";
}

function task2() {

	sleep(1);
	echo "do my bussiness \n";
	sleep(1);
	echo "need IO to get data \n";
	$result = (yield 'fd_1002');
	sleep(1);
	echo "get my data : $result \n";
	sleep(1);
	echo "do my bussiness again ^_^ \n";
}


$scheduler = new Scheduler;

$scheduler->newTask(task1());
//$scheduler->newTask(task2());

$scheduler->run();
?>
?>