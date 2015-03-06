<?php
/**
 * @Author: winterswang
 * @Date:   2015-01-14 19:13:26
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-06 10:55:47
 */
class ConGenerator {

	protected $fun;
	protected $controller;

	public function init($server,$argv){

		$arr = Config::getCmdCon($argv['cmd']);
		if (is_array($arr) && count($arr) >1)
		{
			$this ->controller = new $arr[0]($server,$argv);
			$this ->fun = $arr[1];
			return true;
		}
		else{
			//TODO 日志
			error_log(__METHOD__.' get config failed '.print_r($arr,true),3,'/tmp/winters.log');
			return false;
		}
	}

	public function getResult(){
		//TODO 日志
		//error_log(__METHOD__.' controller : '.print_r($this ->controller,true),3,'/tmp/winters.log');
		return  $this ->controller ->{$this ->fun}();
	}
}
?>