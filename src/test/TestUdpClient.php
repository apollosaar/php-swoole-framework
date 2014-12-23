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
	$client ->send($cmlbInfo['host'],$cmlbInfo['port'],$data,array($test,'call_back'));


	class TestCall {
		/**
		 * [test 异步回包处理函数]
		 * @param  [type] $r    [返回状态]
		 * @param  [type] $data [返回数据]
		 * @return [type]       [description]
		 */
		public function call_back($r,$data){
			$spk_ResBody = new Tencent\Crm\Spkey\RspBody();
			$spk_ResBody ->parseFromString($data);
			var_dump($spk_ResBody);
		}
		/**
		 * [initReqData 初始化发包信息]
		 * @return [type] [description]
		 */
		public function initReqData(){
			$spkey_Reqbody = new Tencent\Crm\Spkey\ReqBody();
			$spkey_Reqbody ->setStrUname('123456789');
			$spkey_Reqbody ->setUint64Time(111111111);
			$spkey_Reqbody ->setStrToken('xxxxxxxxx');
			$data = $spkey_Reqbody ->serializeToString();
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