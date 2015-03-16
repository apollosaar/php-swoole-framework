<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-14 15:27:39
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-16 16:43:11
 */

class UdpClient {
	public static $test = 0;

	/**
	 * [send description]
	 * @param  [type]  $host    [description]
	 * @param  [type]  $port    [description]
	 * @param  [type]  $data    [description]
	 * @param  integer $timeOut [description]
	 * @return [type]           [description]
	 */
	public static function send($host,$port,$data,$timeOut = 0){
		$client = new Client($host, $port, $data, SWOOLE_SOCK_UDP,$timeOut);
        return  $client;
	}
}
?>