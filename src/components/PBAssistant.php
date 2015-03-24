<?
/**
 * @Author: winterswang
 * @Date:   2014-12-23 21:29:50
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-02-27 10:57:40
 */

class PBAssistant {
	//stx3+cmd(4)+seq(4)+headlen(4)+bodylen(4)+head(pb)+body(pb)+etx3
    const WEB_STX = 0x5b;
    const WEB_ETX = 0x5d;
	/**
	 * [packHeader description]
	 * @param  [type] $headerArr [description]
	 * @return [type]            [description]
	 */
	public static function packHeader($headerArr){
		//TODO 根据数组信息，拼接header
	}

	/**
	 * [unpackHeader description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public static function unpackHeader($data){
		$head = new Tencent\Crm\Test\Com\Head();
		$head ->parseFromString(self::getHeadBuf($data));
		return $head;
	}

	/**
	 * [packPbData 封装PB包]
	 * @param  [type] $cmd       [命令号]
	 * @param  [type] $seq       [序列号]
	 * @param  [type] $headerBuf [包头buf]
	 * @param  [type] $bodyBuf   [包体buf]
	 * @return [type]            [description]
	 */
	public static function packPbData($cmd,$seq,$headerBuf,$bodyBuf){
		$headLen = strlen($headerBuf);
        $bodyLen = strlen($bodyBuf);
        $buffer = pack('C', self::WEB_STX) . pack('N', $cmd) . pack('N', $seq) . pack('N', $headLen) .pack('N', $bodyLen) . $headerBuf . $bodyBuf . pack('C', self::WEB_ETX);
		return $buffer;
	}

	/**
	 * [getCmd 获取命令号]
	 * @param  [type] $pbdata [description]
	 * @return [type]         [description]
	 */
	public static function getCmd($pbData){
		$cmdArr = substr($pbData, 1, 4);
        $cmd = unpack('N', $cmdArr);
        if (is_array($cmd)) {
        	return $cmd[1];
        }
        else{
        	error_log(__METHOD__.' function process failed'.print_r($cmd,true),3,'/tmp/winters.log');
        	return -1;
        }
	}

	/**
	 * [getHeadBuf 获取pb包的head buf]
	 * @param  [type] $pbData [description]
	 * @return [type]         [description]
	 */
	public static function getHeadBuf($pbData){
        $headLen = substr($pbData, 9 ,4);
        $head = unpack('Nlen', $headLen);
        $headBuf = substr($pbData, 17, $head['len']);
        return $headBuf;
	}

	/**
	 * [getBodyBuf 获取pb包里的body buf]
	 * @param  [type] $pbData [description]
	 * @return [type]         [description]
	 */
	public static function getBodyBuf($pbData){
        $headLen = substr($pbData, 9 ,4);
        $headLen = unpack('Nlen', $headLen);
        $bodyLen = substr($pbData, 13, 4);
        $bodyLen = unpack('Nlen', $bodyLen);
        $bodyBuf = substr($pbData, 17+$headLen['len'], $bodyLen['len']);
        return $bodyBuf;
	}

	/**
	 * [getHeadObj pb head Buf转pb head obj]
	 * @param  [type] $headBuf [description]
	 * @return [type]          [description]
	 */
	public static function getHeadObj($headBuf){
		$head = new Tencent\Crm\Test\Com\Head\WebReqHead();
		$head ->parseFromString($headBuf);
		return $head;
	}

	/**
	 * [unpackPbData 解析pb,验证pb完整性]
	 * @param  [type] $requestBuf [description]
	 * @return [type]         [description]
	 */
	public static function unpackPbData($requestBuf){
		//
        $webStx = substr($requestBuf, 0 ,1);
        $cmdArr = unpack('N', substr($requestBuf, 1, 4));
        error_log(__METHOD__.' cmdArr : '.print_r($cmdArr,true).PHP_EOL,3,'/tmp/winters.log');
        $cmd = $cmdArr[1];
        $seqArr = unpack('N', substr($requestBuf, 5, 4));
        error_log(__METHOD__.' seqArr : '.print_r($seqArr,true).PHP_EOL,3,'/tmp/winters.log');
        $seq = $seqArr[1];
        $headLen = substr($requestBuf, 9, 4);
        $headLen = unpack('Nlen', $headLen);
        $headLen = $headLen['len'];
        $bodyLen = substr($requestBuf, 13, 4);
        $bodyLen = unpack('Nlen', $bodyLen);
        $bodyLen = $bodyLen['len'];
        $headBuf = substr($requestBuf, 17, $headLen);
        $bodyBuf = substr($requestBuf, 17+$headLen, $bodyLen);
        $webEtx = substr($requestBuf, -1);

        //验证包头是否是pb数据
        if ($webStx != pack('C', self::WEB_STX)) { //pb数据
            return array('r' => 1001);
        }
        //验证包尾是不是Pb数据
        if ($webEtx != pack('C', self::WEB_ETX)) { //pb数据
            return array('r' => 1002);
        }
        $webReqHead = new \Tencent\Crm\Test\Com\Head\WebReqHead();
        try{
            $webReqHead -> parseFromString($headBuf);
        }  catch (Exception $e){
            //解包头失败
            error_log(__METHOD__.' get headObj failed '.PHP_EOL,3,'/tmp/winters.log');
            return array('r' =>1003);
        }
        //验证cmd失败
        if($webReqHead ->getCommand()->getUint32Cmd() !== $cmd){
        	error_log(__METHOD__.' check cmd failed '.PHP_EOL,3,'/tmp/winters.log');
            return array('r' => 1004);
        }
        return array(
        	'r' => 0,
        	'cmd' => $cmd,
        	'seq' => $seq,
            'headObj' => $webReqHead,
            'bodyBuf' => $bodyBuf,
        );
	}
}
?>
