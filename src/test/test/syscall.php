<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-06 20:45:44
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-11 20:22:16
 */

class SystemCall {

    protected $callback;

    public function __construct(callable $callback) {
        $this->callback = $callback;
    }

    public function __invoke(Task $task, Scheduler $scheduler) {
        $callback = $this->callback;
        return $callback($task, $scheduler);
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
	        if ($res instanceof SystemCall) {
	        	//task设定的回调函数执行于此
	            $res($task, $this);
	            continue;
	        }
            if ($task->isFinished() && empty($res)) {
            	echo "task_id ".$task->getTaskId() ." finish \n";
                unset($this->taskMap[$task->getTaskId()]);
            } else {
            	 echo "task_id : ".$task ->getTaskId() . " send a request : " .$res.PHP_EOL;
                $this->schedule($task);
            }
        }
    }
}

//TODO 在这里可以模拟为一个网络请求，用串行思路封装

function test_func($data){
	$func = function (Task $task, Scheduler $scheduler) use ($data){
	    $data = $data . " test/";
	    $task->setSendValue($data);
	    $scheduler->schedule($task);
	};
	return $func;
}

function task() {
	echo "do some local jobs \n";
    sleep(1);
    $data = "task";
    echo "do IO jobs need send data to server\n";
    $res = (yield new SystemCall(test_func(yield new SystemCall(test_func($data)))));

    sleep(1);
    // echo "get server response ".print_r($res,true) . "\n";
    // sleep(1);
    // $res = (yield new SystemCall(test_func($res)));
    echo "get server response ".print_r($res,true) . "\n";
}

$scheduler = new Scheduler;

$scheduler->newTask(task());
//$scheduler->newTask(task_test());

$scheduler->run();


?>