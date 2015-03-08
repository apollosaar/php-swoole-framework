<?php
/**
 * @Author: winterswang
 * @Date:   2014-11-27 14:58:28
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-06 10:56:16
 */
class Controller
{
	protected $server; //启动controller的server实例
	protected $argv = array();
	protected $request;
	/**
	 * [__construct 构造函数完成PB数据的解析]
	 * @param [type] $pbData [description]
	 */
	function __construct($server,$argv = array()){

		$this ->server = $server;
		$this ->argv = $argv;
		$this ->init();
	}

	/**
	 * [addTask 讲实例加入到task进程内]
	 * @param [type] $task [task实例对象]
	 */
	public function addTask($task){
		return $this ->server ->task(serialize($task));
	}

	public function addTimer($interval,$obj,$func){
		// 注册到Timer静态类
		Timer::addTimer($interval,array($obj,$func));
		return $this ->server ->addTimer($interval);
	}

	public function delTimer($interval){
		// 从Timer静态类中清楚该定时器
		$this ->server ->delTimer($interval);
		return Timer::delTimer($interval);
	}

	/**
	 * [init 根据协议解析的数据和server类型，初始化全局变量数据]
	 * @return [type] [description]
	 */
	public function init(){
		if ($this ->argv['serverType'] == 'http') {
			$this ->request = $this ->argv['request'];
		}
	}
}
