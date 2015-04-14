<?php

class testTcpServ extends Swoole\Network\Protocol\BaseServer{

    public function onReceive($server, $fd, $fromId, $data) {
        //echo "receive \n";
        
        $tttt = new Schedule();
        $test = new TestController($server, $fd, $fromId, array());
        $tttt->add($test ->test());
    }

    public function onClose($server, $fd, $fromId)
    {
        //echo 'client close : ' . microtime(true);
    }


    public function onTask($serv, $task_id, $from_id, $data)
    {

    }

    public function onFinish($serv, $task_id, $data)
    {

    }

    public function test($fd){
        $data = (yield $this ->backSend());
        $data = (yield $this ->backSend());
        $data = (yield $this ->backSend());
        $data = (yield $this ->backSend());
        $this->server->send($fd, $data);
    }

    public function backSend(){
        $host = '10.213.168.89';
        $port = 9501;
        $timeout = 5;
        $data = 'test';
        return new TestClient($host, $port, $data, SWOOLE_SOCK_UDP,$timeout);
        // $client = new swoole_client(SWOOLE_SOCK_UDP, SWOOLE_SOCK_SYNC);
        // $client->connect($host ,$port);
        // $client->send($data);
        // $data = $client -> recv();
        // return $data;
    }

    public function sendData($tc,$c){
        $client = new  swoole_client(SWOOLE_SOCK_UDP, SWOOLE_SOCK_ASYNC);
        $client->on("connect", function($cli) use($tc){
            $cli->send($tc ->data);
        });

        $client->on('close', function($cli){
        });

        $client->on('error', function($cli){
        });

        $client->on("receive", function($cli, $data) use($c){
            $cli->close();
            $tc = $c ->send($data);
            if ($tc instanceof TestClient) {
                $this ->sendData($tc,$c);
            }else{
                unset($c);
            }
        });

        if($client->connect($tc ->ip, $tc ->port, $tc ->timeout)){
            // if (intval($tc ->timeout) >0) {
            //     swoole_timer_after(intval($tc ->timeout) * 1000, function() use($client){
            //         if ($client ->isConnected()) {
            //             $log = "timeout \n";
            //             error_log($log,3,'/tmp/timeout.log');
            //             $client ->close();
            //             $this ->callback('timeout');
            //         }
            //     });
            // }
        }
    }
}
