<?php
/**
 * @Author: winterswang
 * @Date:   2015-02-28 15:29:13
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-02-28 16:33:07
 */
class TestTask extends Task {

	public $data;
	public function __construct($data){
		$this ->data = $data;
	}

	public function onTask(){
		if (is_array($this ->data)) {
			array_push($this ->data,__METHOD__);
		}
		error_log(__METHOD__.print_r($this ->data,true),3,'/tmp/winters.log');
	}

	public function onFinish(){
		error_log(__METHOD__.print_r($this ->data,true),3,'/tmp/winters.log');
		var_dump($this ->data);
	}
}
?>