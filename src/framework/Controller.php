<?php
/**
 * @Author: winterswang
 * @Date:   2014-11-27 14:58:28
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-10 11:36:29
 */
class Controller
{
	protected $server; //启动controller的server实例
	protected $cmd;
	protected $seq;
	protected $headObj; //数据包的包头
	protected $bodyBuf; //数据包的包体
	/**
	 * [__construct 构造函数完成PB数据的解析]
	 * @param [type] $pbData [description]
	 */
	function __construct($server,$cmd,$seq,$headObj,$bodyBuf){

		$this ->server = $server;
		$this ->cmd = $cmd;
		$this ->seq = $seq;
		$this ->bodyBuf = $bodyBuf;
		$this ->headObj = $headObj;
	}

	public function getHeadObj(){
		return $this ->headObj;
	}


	public function setHeadObj($headObj){
		$this ->headObj = $headObj;
	}

	/**
	 * [addTask 讲实例加入到task进程内]
	 * @param [type] $task [task实例对象]
	 */
	public function addTask($task){
		return $this ->server ->task(serialize($task));
	}

	public function addTimer($interval, $userFlag, $obj, $func){
		// 注册到Timer静态类
        //$userFlag = md5(serialize($obj));
        //echo 'add ' . $userFlag . PHP_EOL;
		if(!Timer::addTimer($interval, $userFlag, array($obj,$func))) return false;
		return $this ->server ->addTimer($interval);
	}

	public function delTimer($interval, $userFlag, $obj){
		// 从Timer静态类中清楚该定时器
		//$this ->server ->delTimer($interval);
        //$userFlag = md5(serialize($obj));
        //echo 'delete ' . $userFlag . PHP_EOL;
		Timer::delTimer($interval, $userFlag);
        if(Timer::getCount($interval) === 0) {
            $this ->server ->delTimer($interval);
        }
	}
}
