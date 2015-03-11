<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 19:47:33
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-11 20:41:45
 */
class Scheduler {
    protected $jobsId = 1000;
    protected $jobsQueue;

    public function __construct() {
        $this->jobsQueue = new SplQueue();
    }

    public function addJobs(Generator $coroutine) {
        $jid = ++$this->jobsId;
        $job = new Jobs($jid, $coroutine);
        $this->schedule($job);
        return $jid;
    }

    public function getJob($jobId){
    	return $this->jobsMap[$jid];
    }

    public function schedule(Jobs $job) {
        $this->jobsQueue->enqueue($job);
    }

    public function run() {
        while (!$this->jobsQueue->isEmpty()) {
            $job = $this->jobsQueue->dequeue();
            $res = $job ->run();
            //TODO 需要递归找到最后一个generator
	        if ($res instanceof Client) {
	            $res ->sendData(array($this,'callback'),$job);
	            continue;
	        }
            if ($job->isFinished() && empty($res)) {
            	echo "job_id ".$job->getJobsId() ." finish \n";
            } else {
            	echo "job_id : ".$job ->getJobsId() . " send a request : " .print_r($res,true).PHP_EOL;
                $this->schedule($job);
            }
        }
    }


    public function callback($data,$job){
	    $job->setSendValue($data);
	    $res = $job ->run();
	    if ($res instanceof Generator) {
	    	$this->addJobs($res);
	    }
	    if (!$this->jobsQueue->isEmpty()) {
	    	$this ->run();
	    }
    }

}
?>