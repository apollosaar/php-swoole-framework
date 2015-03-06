<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-06 20:45:44
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-06 21:26:32
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
            	 //echo "task_id : ".$task ->getTaskId() . " send a request : " .$res.PHP_EOL;
                $this->schedule($task);
            }
        }
    }
}

//TODO 在这里可以模拟为一个网络请求，用串行思路封装

function test_func(){
	$func = function (Task $task, Scheduler $scheduler){
	   	echo "get a request from task_id :" .$task ->getTaskId().PHP_EOL;
	    $task->setSendValue($task->getTaskId());
	    $scheduler->schedule($task);
	};
	return $func;
}

function task($max) {
    $tid = (yield new SystemCall(test_func()));
    for ($i = 1; $i <= $max; ++$i) {
    	sleep(1);
        echo "This is task $tid iteration $i.\n";
        yield;
    }
}

//TODO 模拟非网络调用回调函数
function task_test(){
	sleep(1);
	echo "do my bussiness \n";
	sleep(1);
	echo "need IO to get data \n";
	$result = (yield 'fd_1001 once');
	sleep(1);
	echo "get my data : $result \n";
	sleep(1);
	echo "do my bussiness again ^_^ \n";
	$result = (yield 'fd_1001 twice');
	sleep(1);
	echo "get my data : $result \n";
	sleep(1);
	echo "do my bussiness again ^_^ \n";
}

$scheduler = new Scheduler;

$scheduler->newTask(task(10));
$scheduler->newTask(task_test());

$scheduler->run();
?>