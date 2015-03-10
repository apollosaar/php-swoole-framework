<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 16:43:45
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-10 21:50:28
 */
class Jobs {
    protected $jobsId;
    protected $coroutine;
    protected $sendValue = '';
    protected $beforeFirstYield = true;

    public function __construct($jobsId, Generator $coroutine) {
        $this->jobsId = $jobsId;
        $this->coroutine = $coroutine;
    }

    public function isFinished() {
        return !$this->coroutine->valid();
    }

    public function getJobsId() {
        return $this->jobsId;
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
            return $retval;
         }
    }

    public function callback($data){
    	error_log(__METHOD__.PHP_EOL,3,'/tmp/winters.log');
	    $this->setSendValue($data);
	    //$this->coroutine->send('test for client');
    }
}
?>