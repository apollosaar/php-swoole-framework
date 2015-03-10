<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 19:47:33
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-10 21:54:25
 */
class Scheduler {
    protected $jobsId = 1000;
    protected $jobsMap = [];
    protected $jobsQueue;

    public function __construct() {
        $this->jobsQueue = new SplQueue();
    }

    public function addJobs(Generator $coroutine) {
        $jid = ++$this->jobsId;
        $job = new Jobs($jid, $coroutine);
        $this->jobsMap[$jid] = $job;
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
	        if ($res instanceof Client) {
	        	//jobs设定的回调函数执行于此
	            $res ->sendData(array($this,'callback'));
	            // $data = $res ->sendData();
	            // $job->setSendValue($data);
	            //$this ->schedule($job);
	            continue;
	        }
            if ($job->isFinished() && empty($res)) {
            	echo "job_id ".$job->getJobsId() ." finish \n";
                unset($this->jobsMap[$job->getJobsId()]);
            } else {
            	echo "job_id : ".$job ->getJobsId() . " send a request : " .$res.PHP_EOL;
                $this->schedule($job);
            }
        }
    }

    public function callback($data){
    	$job = $This ->getJob();
    }

}
?>