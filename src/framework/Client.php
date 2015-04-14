<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 20:08:14
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-04-14 15:48:58
 */

class Client {

    public $ip;
    public $port;
    public $data;
    public $timeout = 5;

    public function __construct($ip,$port,$data,$timeout){
        $this ->ip = $ip;
        $this ->port = $port;
        $this ->data = $data;
        $this ->timeout = $timeout;
    }

    public function sendData(callable $callback){

    }
}
?>