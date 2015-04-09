<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 20:08:14
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-31 14:41:12
 */

class TestClient {

	public $ip;
	public $port;
	public $data;
    public $clientType;
	public $timeout = 5;

	public function __construct($ip,$port,$data,$clientType,$timeout){
		$this ->ip = $ip;
		$this ->port = $port;
		$this ->data = $data;
        $this ->clientType = $clientType;
        $this ->timeout = $timeout;
	}
}
?>