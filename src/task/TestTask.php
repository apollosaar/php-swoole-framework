<?php
/**
 * @Author: winterswang
 * @Date:   2015-02-28 15:29:13
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-03 15:55:42
 */
class TestTask extends Task {

	public $data;
	public function __construct($data){
		$this ->data = $data;
	}

	/**
	 * [onTask description]
	 * @return [type] [description]
	 */
	public function onTask(){
		if (is_array($this ->data)) {
			array_push($this ->data,__METHOD__);
		}
		error_log(__METHOD__.print_r($this ->data,true),3,'/tmp/winters.log');
	}

	/**
	 * [onFinish description]
	 * @return [type] [description]
	 */
	public function onFinish(){

	}
}
?>