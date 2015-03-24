<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 16:43:45
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-11 20:49:59
 */
class Jobs {
    protected $jobsId;
    protected $coroutine;
    protected $coroutineArr;
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
            //TODO 取的时候，会递归取
            return $this ->pop();
            //return $this->coroutine->current();
        } else {
            //TODO 发的时候，会递归发
            $retval = $this ->send($this->sendValue);
            //$retval = $this->coroutine->send($this->sendValue);
            return $retval;
         }
    }

    public function pop(){
        $coroutine = $this ->coroutine;
        while ($coroutine instanceof Generator) {
            $this ->coroutineArr[] = $coroutine;
            $coroutine = $coroutine ->current();
        }
        return $coroutine;
    }

    public function send($res){
        $num = count($this ->coroutineArr);
        echo "num = $num \n";
        while ($num) {
            $num --;
            $coroutine = $this ->coroutineArr[$num];
            $res = $coroutine ->send($res);
        }
        return $this ->coroutineArr[0];
    }
}
?>