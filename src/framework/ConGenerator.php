<?php
/**
 * @Author: winterswang
 * @Date:   2015-01-14 19:13:26
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-11 20:59:33
 */
class ConGenerator {

	protected $fun;
	protected $controller;

	public function init($server,$cmd,$seq,$headObj,$bodyBuf){

		error_log(__METHOD__.'cmd : '.$cmd,3,'/tmp/winters.log');
		$arr = Config::getCmdCon($cmd);
		if (is_array($arr) && count($arr) >1)
		{
			$this ->controller = new $arr[0]($server,$cmd,$seq,$headObj,$bodyBuf);
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