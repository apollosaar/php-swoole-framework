<?php
/**
 * @Author: winterswang
 * @Date:   2015-02-28 11:11:33
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-04-11 17:24:54
 */

class TestController {
    public $server;
    public $fd;
    public $data;
    public $from_id;

    public function __construct($server,$fd,$from_id,$data){
        $this ->server = $server ;
        $this ->fd = $fd ;
        $this ->data = $data ;
        $this ->from_id = $from_id;
    }

	public function test(){
        // $fdinfo = $this->server->connection_info($this ->fd,$this ->from_id);
        // var_dump($fdinfo);

        //$time = microtime(true);
        //$log = __METHOD__." begin test function time = $time \n";
        //error_log($log ,3, '/tmp/press.log');

        //multicall test
        $data = (yield $this ->callTest());
        //udp test
        //$data = (yield $this ->test2());
        //tcp test
        //$data = (yield $this ->tcpTest());


        // $fdinfo = $this->server->connection_info($this ->fd,$this ->from_id);
        // var_dump($fdinfo);
        // if ($data['r'] == 0) {
        //     $this->server->send($this ->fd, $data['data'],$this ->from_id);
        // }

		$this->server->send($this ->fd, 'test',$this ->from_id);

        //$time = microtime(true);
        //$log =  __METHOD__."after send time = $time data = " . print_r($data,true);
        //$this ->log($log);
	}

	public function udpTest(){
        $data = '';
		$res = (yield $this ->udp());
        if ($res['r'] == 0) {
            $data .= $res['data'];
        }
        $res = (yield $this ->udp());
        if ($res['r'] == 0) {
            $data .= $res['data'];
        }
        $res = (yield $this ->udp());
        if ($res['r'] == 0) {
            $data .= $res['data'];
        }
        $res = (yield $this ->udp());
        if ($res['r'] == 0) {
            $data .= $res['data'];
        }
        //$this ->log(__METHOD__.print_r($data,true));
        yield $data;
	}

    public function udp(){
        //echo __METHOD__."\n";
        $host = '10.213.168.89';
        $port = 9905;
        $timeout = 5;
        $data = 'test';
        //$data = (yield UdpClient::testSend($host,$port,$data,$timeout));
        $data = (yield new UdpTestClient($host, $port, $data,$timeout));
        yield $data;
    }

    public function tcpTest(){
        $data = '';
        $res = (yield $this ->tcp());
        if ($res['r'] == 0) {
            $data .= $res['data'];
        }
        $res = (yield $this ->tcp());
        if ($res['r'] == 0) {
            $data .= $res['data'];
        }
        $res = (yield $this ->tcp());
        if ($res['r'] == 0) {
            $data .= $res['data'];
        }
        $res = (yield $this ->tcp());
        if ($res['r'] == 0) {
            $data .= $res['data'];
        }
        //$this ->log(__METHOD__.print_r($data,true));
        yield $data;
    }

    public function tcp(){
        $host = '10.213.168.89';
        $port = 9000;
        $timeout = 5;
        $data = 'test';
        //$data = (yield UdpClient::testSend($host,$port,$data,$timeout));
        $data = (yield new TcpTestClient($host, $port, $data,$timeout));
        yield $data;        
    }

    public function mulitcall(){
        $host = '10.213.168.89';
        $port = 9905;
        $timeout = 5;
        $data = 'test';
        $c1 =  new UdpTestClient($host, $port, 'test1', $timeout);
        $c1 ->setKey('udptest1');
        $c2 =  new TcpTestClient($host, 9000, 'test2', $timeout);
        $c2 ->setKey('tcptest1');
        $c3 =  new TcpTestClient($host, 9000, 'test3', $timeout);
        $c3 ->setKey('tcptest2');
        $c4 =  new UdpTestClient($host, $port, 'test4', $timeout);
        $c4 ->setKey('udptest2');
        $mc = new MultiCall();
        $mc ->addCall($c1);
        $mc ->addCall($c2);
        $mc ->addCall($c3);
        $mc ->addCall($c4);
        $data = (yield $mc);
        $this ->log(__METHOD__. " res ==== ".print_r($data,true));
        yield $data;        
    }

    /**
     * [callTest 调用multicall形式的IO操作，验证数据是否可以按照顺序获取IO结果]
     * @return [type] [description]
     */
    public function callTest(){
        $res = (yield $this ->mulitcall());
        if ($res['r'] == 0) {
            $data = $res['data'];
        }
        yield $data;
    }

    public function log($log){
        error_log($log . PHP_EOL, 3, '/tmp/'.__CLASS__.'.log');
    }
}

?>