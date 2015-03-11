<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-11 17:03:35
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-11 17:08:27
 */

class Coroutine {

	public $coroutine;
	public $sendValue;

	public function __construct(Generator $coroutine) {
		$this ->coroutine = $coroutine;
	}

	public function isFinished() {
		return !$this->coroutine->valid();
	}

    public function setSendValue($sendValue) {
        $this->sendValue = $sendValue;
    }

    public function getCurrent(){
    	return $this ->coroutine ->current();
    }

    public function send(){
    	return $this ->coroutine ->send($this ->sendValue);
    }
}
?>