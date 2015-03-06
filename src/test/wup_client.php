<?php
/**
 * @Author: winterswang
 * @Date:   2015-02-04 16:51:59
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-02-04 17:28:37
 */
require_once "../require.php";
require "../data/PhoneAttriInterface_wup.php";

$path = TestAutoLoad::getFatherPath(dirname(__FILE__),2).'/lib'; //win \lib linux /lib
TestAutoLoad::addRoot($path);
TestAutoLoad::addRoot(dirname(dirname(__FILE__)));

$client = new Swoole\Client\AsyncUdpClient();
$test = new TestCall();
$data = $test ->initReqData();
$client ->send('10.231.138.154',12652,$data,array($test,'call_back'));

class TestCall {

	/**
	 * [call_back description]
	 * @param  [type] $r    [description]
	 * @param  [type] $data [respBuffer]
	 * @return [type]       [description]
	 */
	public function call_back($r,$data){

		$wupResp = new wup_unipacket();
		$wupResp->setVersion(3);
	    $wupResp->_decode($data);

		if($wupResp->getResultCode() == 0)
		{
			$phoneAttriResp = new PhoneAttriResp;
			$wupResp ->get('resp',$phoneAttriResp);
			print_r($phoneAttriResp ->phoneListRet);
		}
		else
		{
			echo "error: " . ($wupResp->getResultDesc());
		}
	}

	/**
	 * [initReqData description]
	 * @return [type] [description]
	 */
	public function initReqData(){

		$wup = new wup_unipacket;
		$name = 'QQPIM.PhoneAttriServer.PAServantObj';
		$funcName = 'PhoneAttri';

		$wup->setRequestId(0);
		$wup->setServantName($name);
		$wup->setFuncName($funcName);

		//主结构
		$phoneAttriReq = new PhoneAttriReq;

		$phoneReq = new PhoneReqItem;	//phoneReqItem
		$phoneReq ->type->val = 1;
		$phoneReq ->phone->val = '13166226879';

		$phoneAttriReq ->comm ->product->val = 4;
		$phoneAttriReq ->phoneList ->push_back($phoneReq);//phonelist

		$wup->put('req',$phoneAttriReq);
		$wup->_encode($Buffer);
		return $Buffer;
	}
}
?>