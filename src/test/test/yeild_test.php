<?php
<<<<<<< HEAD
phpinfo();
=======
/**
 * @Author: winterswang
 * @Date:   2015-02-27 11:35:31
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-06 20:07:36
 */


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

function task1() {

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
>>>>>>> 3a0e2e7e680900a9771575db45ae930940c17392
?>