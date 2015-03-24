<?php
	require_once "../require.php";
	//引入lib
	$path = TestAutoLoad::getFatherPath(dirname(__FILE__),2).'/lib'; //win \lib linux /lib
	TestAutoLoad::addRoot($path);
	TestAutoLoad::addRoot(dirname(dirname(__FILE__)));

	//异步使用client
	$client = new Swoole\Client\AsyncUdpClient();
	$test = new TestCall();
	$data = $test ->initReqData();
	$cmlbInfo = $test ->getCmlbInfo(5910);
	if(!$cmlbInfo || !is_array($cmlbInfo)){
		exit() ;
	}
	//回调函数
	var_dump(" start time: ".microtime(true));
	$client ->send($cmlbInfo['host'],$cmlbInfo['port'],$data,array($test,'call_back'));

	class TestCall {
		/**
		 * [test 异步回包处理函数]
		 * @param  [type] $r    [返回状态]
		 * @param  [type] $data [返回pb包数据]
		 * @return [type]       [description]
		 */
		public function call_back($r,$data){
			var_dump(" finish time: ".microtime(true));
			$spk_rspBody = new \Tencent\Crm\Spkey\RspBody();
			$spk_rspBody_buf = PBAssistant::getBodyBuf($data);
			$spk_rspBody ->parseFromString($spk_rspBody_buf);
			var_dump($spk_rspBody);
		}
		/**
		 * [initReqData 初始化发包信息]
		 * @return [type] [description]
		 */
		public function initReqData(){
			$cmd = 0x01;
			$seq = 0;
			$reqhead = new \Tencent\Crm\Test\Com\Head\WebReqHead();
			//设置command对象
			$command = new \Tencent\Crm\Test\Com\Head\Command();
			//设置主命令
			$command ->setUint32Cmd($cmd);
			//设置子命令
			$command ->setUint32SubCmd($cmd);
			$reqhead ->setCommand($command);
			$reqhead ->setTimestamp(time());
			$reqhead ->setUint32Seq($seq);
			var_dump(__MEHTOD__.print_r($reqhead,true));
			//转buf
			$reqhead_buf = $reqhead ->serializeToString();
			//设置body
			$pskey_reqbody = new \Tencent\Crm\Spkey\ReqBody();
			$pskey_reqbody ->setStrUname('938060809');
			var_dump(__MEHTOD__.print_r($pskey_reqbody,true));
			//转Buf
			$pskey_reqbody_buf = $pskey_reqbody ->serializeToString();

			$data = PBAssistant::packPbData($cmd,$seq,$reqhead_buf,$pskey_reqbody_buf);
			return $data;
		}

		/**
		 * [getCmlbInfo 获取CMLB信息]
		 * @return [type] [description]
		 */
		public function getCmlbInfo($cmlbNum){
			$cmlb = new Cmlb();
	        try{
	        	//spkey server cmlb num
	            $cmlb -> init($cmlbNum);
	        } catch(Exception $e) {
	            echo "get cmlb error and cmlb num is $cmlbNum \r\n";
	            return false;
	        }
	        $conf = $cmlb -> getOneIntf();
	        if(is_long($conf)) {
	            echo "cmlb error \r\n";
	            return false;
	        }
	        return $conf;
		}
	}
?>