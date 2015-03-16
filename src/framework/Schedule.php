<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-12 14:54:00
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-16 14:16:05
 */
class Schedule {

	protected $corStack;
	protected $corQueue;
	protected $coroutine;

    public function __construct() {
    	$this->corStack = new SplStack();
	}

	public function add(Generator $coroutine){
		$this ->initStack($coroutine);
	}

	public function run(){
		while (! $this ->corStack ->isEmpty()) {
			$this ->coroutine = $this ->corStack ->pop();
			$res = $this ->coroutine ->current();
			if ($res instanceof Client) {
	            $res ->sendData(array($this,'callback'));
				swoole_timer_after(intval($res ->timeout) * 1000, function() use($res){
					if ($res ->is_close) {
						return;
					}
			    	$log = "after 5 seconds timeout \n";
			    	error_log($log,3,'/tmp/timeout.log');
			    	$res ->client ->close();
				});
			}
			else{
				$this ->callback($res);
			}
		}
	}

    public function callback($data){
	    $res = $this->send($data);
	    if ($res instanceof Generator) {
	    	$this->add($res);
	    	$this ->run();
	    }
    }

    public function initStack($coroutine){
        while ($coroutine instanceof Generator) {
            $this->corStack->push($coroutine);
            $coroutine = $coroutine ->current();
        }
    }

    public function initQueue(){
    	while (! $this ->corStack ->isEmpty()) {
    		$coroutine = $this ->corStack ->pop();
    		$this ->corQueue ->enqueue($coroutine);
    	}
    }

    public function send($res){
        while (!$this ->corStack ->isEmpty()) {
        	$coroutine = $this ->corStack ->pop();
            $res = $coroutine ->send($res);
            if (empty($res)) {
            	return ;
            }
        }
        if (isset($coroutine)) {
        	return $coroutine;
        }else{
        	return $this ->coroutine ->send($res);
        }
    }

}
?>