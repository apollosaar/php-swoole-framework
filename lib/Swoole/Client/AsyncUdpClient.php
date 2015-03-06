<?php
namespace Swoole\Client;

class AsyncUdpClient
//extends \Swoole\Client\AsyncClient
{
    public $requests;
    public $client;
    function __construct()
    {
        $this->client = new \swoole_client(SWOOLE_SOCK_UDP, SWOOLE_SOCK_ASYNC);
    }

    public function send($host, $port, $data, $callback, $timeout = 2)
    {
        //闭包调用
        $this->client->on("connect", function($cli) use ($data) {
            echo "connected\n";
            $cli->send($data);
        });

        $this->client->on('close', function($cli){
            echo "closed\n";
        });

        $this->client->on('error', function($cli){
            echo "error\n";
        });

        $this->client->on("receive", function($cli, $data) use ($callback){
            echo "receiving data \n";
            call_user_func_array($callback, array('r' => 0, 'data' => $data));
            $cli->close();
        });

        if($this->client->connect($host, $port, $timeout)){
        }
    }
}