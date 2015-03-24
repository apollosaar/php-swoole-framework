<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-12 14:54:00
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-19 10:05:35
 */
class Schedule {

    protected $corStack;
    protected $corQueue;
    protected $beforeFirstYield = true;

    public function __construct() {
        $this->corStack = new SplStack();
        $this->corQueue = new SplQueue();
    }

    public function add(Generator $coroutine){
        $this ->corQueue ->enqueue($coroutine);
    }

    public function run(){
        while (!$this->corQueue->isEmpty()) {
            $coroutine = $this->corQueue->dequeue();
            $res =  $this ->pop($coroutine);
            if ($res instanceof Client) {
                $res ->sendData(array($this,'callback'));
                if (intval($res ->timeout) >0) {
                    swoole_timer_after(intval($res ->timeout) * 1000, function() use($res){
                        if ($res ->is_close) {
                            return;
                        }
                        $log = "after 5 seconds timeout \n";
                        error_log($log,3,'/tmp/timeout.log');
                        $res ->client ->close();
                        $this ->callback('timeout');
                    });
                }
            }
            else{
                $this ->callback($res);
            }
        }
    }

    public function callback($data){

        if (!empty($data)) {
            $res = $this->send($data);
            $log = __METHOD__.'xxxxxx'.print_r($data,true).PHP_EOL;
            error_log($log,3,'/tmp/schedule.log');
            if ($res && ($res instanceof Generator)) {
                $this->add($res);
                $this ->run();
            }
        }
    }

    public function pop($coroutine){
        while ($coroutine instanceof Generator) {
            $this->corStack->push($coroutine);
            $coroutine = $coroutine ->current();
        }
        return $coroutine;
    }

    public function send($res){
        while (!$this ->corStack ->isEmpty()) {
            $coroutine = $this ->corStack ->pop();
            $res = $coroutine ->send($res);
            //$log =  __METHOD__.print_r($res,true).PHP_EOL;
            //error_log($log,3,'/tmp/schedule.log');
            if (empty($res)) {
                return ;
            }
            if($res instanceof Generator){
               return $coroutine;
            }
        }
        return $coroutine;
    }
}
?>
