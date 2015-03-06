<?php
/**
 * @Author: winterswang
 * @Date:   2015-02-28 10:58:35
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-03 16:12:50
 */

class Task {

	public $obj;
	public $func;

	/**
	 * [onTask task任务执行程序]
	 */
	public function onTask(){

	}

	/**
	 * [addFinishFun 自定义finish函数]
	 * @param array $data [description]
	 */
	public function addFinishFun($obj, $func){
		if (is_object($obj)) {
			if (method_exists($obj, $func)) {
				$this ->obj = $obj;
				$this ->func = $func;
			}else{
				return array('r' => 1,'error' => 'function not find');
			}
		}
		else{
			return array('r' => 1,'error' => 'the param is not an Object');
		}
		return array('r' => 0);
	}
}
?>