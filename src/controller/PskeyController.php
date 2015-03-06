<?php
/**
 * @Author: winterswang
 * @Date:   2014-12-23 21:27:54
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-02-27 11:05:16
 */


class PskeyController extends Controller {
	private $privatekey = 'b242f35f90d8046e5cb13544646d7f8b'; //私钥
    private $oidb_ips =array('10.133.43.11', '10.133.4.219');
    //TODO 自己设计错误表
    /**
     * [actionIndex Pskey server 业务逻辑实现]
     * @param  [type] $pbData [pb数据]
     * @return [type]         [返回处理结果]
     */
    public function index(){
    	//TODO 上报
    	//初始化PB 对象
    	$spk_ReqBody = new Tencent\Crm\Spkey\ReqBody();
    	$spk_ReqBody -> parseFromString($this ->bodyBuf);
    	//值传递
        $trd_uname = $spk_ReqBody ->getStrUname();
        $trd_time = $this ->headObj->getTimestamp();
        $trd_token = $this ->headObj ->getToken();

        if (!isset($trd_uname)) {
        	//TODO 上报
        	//TODO 日志
            return $this->response(
                array(
                    'retcode' => '1006',
                    'retinfo' => 'miss trd_uname'
                    ));
        }
        if ($trd_time < (time() - 300)) {
        	//TODO 上报
        	//TODO 日志
            return $this->response(
                array(
                    'retcode' => '1007',
                    'retinfo' => 'time error'
                    ));
        }

        //TODO 验证TOKEN
        // $pToken = md5($trd_uname.$trd_time.$this->privatekey);
        // if ($pToken != $trd_token) {
        // 	//TODO 上报
        // 	//TODO 日志
        //     return $this->response(
        //         array(
        //             'retcode' => '1005',
        //             'retinfo' =>'check token failed'
        //             ));
        // }

        //判断字符串是否有@字符串
        if (strpos($trd_uname,'@')) {
            //oidb访问
            $ip = $this ->oidb_ips[array_rand($this ->oidb_ips)];
            //TODO 日志
            $uin = $this ->oidbConnect($ip,$trd_uname);

            if ($uin) {
                //ptype ===>下发登录态  ptype =4 发p_skey
                return $this ->response(array('nameAccount' => $uin,'ptype' => 4));
            }else{
            //TODO 上报
            //TODO 日志
                return $this ->response(
                        array(
                            'retcode' => '1008',
                            'retinfo' => 'get oidb failed',
                            ));
            }
        }

        //判断号码区间 1495 or 2355 号段
        $ret = preg_grep('~^(1495\d{6}|2355\d{6})$~', array($trd_uname));
        if(!empty($ret)){
            //TODO 日志
            //TODO 上报
            error_log(__METHOD__." ret : ".print_r($ret,true),3,'/tmp/winters.log');
            return $this ->response(array('nameAccount' => $trd_uname, 'ptype' => 4));
        }

        // 主靓号转换
        $envInfo = $this ->numberConvertAndGetEnvId($trd_uname, '1001', $trd_uname);
        if ($envInfo['r'] != 0) {
        	//TODO 上报
            //TODO 日志
            return $this ->response(
                array(
                    'retcode' => '1007',
                    'retinfo' => 'get envInfo failed',
                    ));
        }

        //通过环境ID 判断是否是营销QQ3.0号码
        if (in_array(intval($envInfo['envId']), array(3001, 3101, 3201))) {
        	//TODO 上报
            //TODO 日志
            error_log(__METHOD__." $trd_uname is 3.0 number".PHP_EOL,3,'/tmp/winters.log');
        	return $this ->response(
                array(
                    'nameAccount' => $envInfo['kfuin'],
                    'ptype' => 4,
                    ));
        }
        else{
            $ip = $this ->oidb_ips[array_rand($this ->oidb_ips)];
            $uin = $this ->oidbConnect($ip,'1001@'.$trd_uname);
            if ($uin) {
                return $this ->response(
                        array(
                            'nameAccount' => $uin,
                            'ptype' => 4,
                            ));
            }
            else{
                return  $this ->response(
                        array(
                            'retcode' => '1008',
                            'retinfo' => 'get oidb failed',
                            ));
            }
        }

        //号码未被识别，返回错误
        //TODO 日志
        //TODO 上报
        return $this ->response(
            array(
                'retcode' => '1009',
                 'retinfo' => 'nameAccount unidentified'
                 ));
    }

    /**
     * [oidbConnect oidb连接函数]
     * @param  [type] $ip [ip地址]
     * @return [type]     [description]
     */
    public function oidbConnect($ip,$qq_email){
        //TODO 日志
        error_log(__METHOD__." ip : $ip and qq_email : $qq_email".PHP_EOL,3,'/tmp/winters.log');
        $oidb = new WebOidbTransEx($ip);
        $oidb->setHeader(5, 0x4aa, 0, 0, 0, '', '', 0, '', 0, 0);
        $oidb->setHeaderWithSkey();
        $buf = pack('c', 1) . pack('c', strlen($qq_email)) . pack('a*', $qq_email);
        $oidb->setBodyWithBuf($buf);
        $ret = $oidb->sendToOidb();
        if(0 === $ret){
            $header = $oidb->getResultHeader();
            if(0 === $header['cResult']){
                $formats = 'c2int/Nuin';
                $ret_bogy = $oidb->getResultBodyWithFormatStr($formats);
                return $ret_bogy['uin'];
            }else{
                error_log(__METHOD__."oidb result header : ".print_r($header,true),3,'/tmp/winters.log');
            }
        }
        //TODO 上报
        //TODO 日志
        error_log(__METHOD__." oidb ret : ".print_r($ret,true),3,'/tmp/winters.log');
        return false;

    }

    // 临时方法，验证主靓号转换通路
    private function numberConvertAndGetEnvId($kfuin, $kfext, $number, $cv = 0){

        define('IP_WEB_INTERFACE', '172.23.11.168'); // web interface ip
        define('PORT_WEB_INTERFACE', 2200); // web interface port

        $log = __METHOD__ ."(CMD=10099) request params: kfuin=$kfuin kfext=$kfext number=$number cv=$cv";
        error_log($log.PHP_EOL,3,'/tmp/winters.log');

        $tlv = new WebTLVAssistant(); // tlv对象

        $tlv->set_header_array(10099, $kfuin, $kfext, $cv); // 设置包头
        $tlv->add_null_padded_string(131, $number); // 企业主号或靓号

        $ret = $tlv->send_and_recieve(IP_WEB_INTERFACE, PORT_WEB_INTERFACE, 2); // 发包和收包
        if(0 != $ret){
            $log = __METHOD__ ."(CMD=10099) send error r=$ret IP:".IP_WEB_INTERFACE." PORT:".PORT_WEB_INTERFACE;
            error_log($log.PHP_EOL,3,'/tmp/winters.log');
            return array('r' => $ret);
        }

        $body = $tlv->get_receive_body(); // 获得包体

        $r['r'] = $body['130']; // server返回的错误码
        $r['kfuin'] = $body['31']; // 主号
        $r['envId'] = $body['32']; // 号码环境id
        $r['virturalKfuin'] = $body['131']; // 靓号

        if(0 != $r['r']){
            $log = __METHOD__ ."(CMD=10099) server error r={$r['r']}";
            error_log($log.PHP_EOL,3,'/tmp/winters.log');
            return array('r' => 1);
        }

        $log = __METHOD__ ."(CMD=10099) response params:" . print_r($r, true);
        error_log($log.PHP_EOL,3,'/tmp/winters.log');

        return $r;
    }


    //测试方法
    public function test(){
        return $this ->response(array('ptype' =>4,'nameAccount' =>'987654321'));
    }

    /**
     * [response description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function response($data =array()){
        //head do sth
        if (isset($data['retcode']) && isset($data['retinfo'])) {
            $retinfo = new Tencent\Crm\Test\Com\Head\RetInfo();
            $retinfo ->setRetCode($data['retcode']);
            $retinfo ->setErrInfo($data['retinfo']);
            $this ->headObj ->setRetinfoErr($retinfo);
        }
        //get body obj
        $spk_RspBody = new Tencent\Crm\Spkey\RspBody();
        if (isset($data['ptype']) && isset($data['nameAccount'])) {
            $spk_RspBody ->setUint32Type($data['ptype']);
            $spk_RspBody ->setUint32NameAccount($data['nameAccount']);
        }
        error_log(__METHOD__.' headObj = '.print_r($this ->headObj,true),3,'/tmp/winters.log');
        error_log(__METHOD__.' spk_RspBody = '.print_r($spk_RspBody,true),3,'/tmp/winters.log');
        //字符串序列化
        $headBuf = $this ->headObj ->serializeToString();
        $bodyBuf = $spk_RspBody->serializeToString();
        return  PBAssistant::packPbData($this ->cmd,intval($this ->seq + 1),$headBuf,$bodyBuf);
    }
}

?>