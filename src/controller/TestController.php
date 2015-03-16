<?php
/**
 * @Author: winterswang
 * @Date:   2015-02-28 11:11:33
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-16 17:42:56
 */

class TestController extends Controller{

	/**
	 * [testTask description]
	 * @return [type] [description]
	 */
	public function testTask(){

		$data = array('test for task');
		$task = new TestTask($data);
		//添加自定义的onFinish函数
		$ret = $task ->addFinishFun($this, 'testTaskFinish');
		if ($ret['r'] ==0) {
			$res = $this ->addTask($task);
			return array('task send successful task_id :'.$res);
		}
		return print_r($ret,true);
	}

	/**
	 * [testTaskFinish task任务完成后的处理函数]
	 * @return [type] [description]
	 */
	public function testTaskFinish($r,$data){
		error_log(__METHOD__.print_r($data,true),3,'/tmp/winters.log');
	}


	public function testTimer(){
		$this ->addTimer(2000, $this, 'testFun');
	}

	public function testFun(){
		error_log(__METHOD__." timer func test pid: ".posix_getpid() ." time : ". time() .PHP_EOL,3,'/tmp/winters.log');
		$count = rand(10,20);
		if (Timer::getCount(2000) > $count) {
			error_log(__METHOD__." timer func finish after count = ".$count ." pid : " . posix_getpid() ." time : ". time() .PHP_EOL,3,'/tmp/winters.log');
			$this ->delTimer(2000);
		}
	}

	public function test(){
		$host = '10.213.168.89';
		$port = 9905;
		$timeout = 5;
		$data = array('cmd' =>2,'seq' => 1);
		//echo " do some jobs need send data to server \n";
		$data = (yield $this ->test2());
		//print_r($data);
		$data = (yield $this ->test2());
		//print_r($data);
		$this->server->send($this ->fd, 'test');
		//var_dump($this);
	}

	public function test2(){
		yield new swoole_client(SWOOLE_SOCK_UDP, SWOOLE_SOCK_SYNC);
	}
}

?>