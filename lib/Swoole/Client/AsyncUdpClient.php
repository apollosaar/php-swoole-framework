<<<<<<< HEAD
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
=======
<?php
namespace Swoole\Client;

class AsyncUdpClient extends \Swoole\Client\AsyncClient
{
    public $requests;
    function __construct()
    {
        $this->client = new swoole_client(SWOOLE_SOCK_UDP, SWOOLE_SOCK_ASYNC);
    }

    public function send($host, $port, $data, $callback, $timeout = 2)
    {
        $this->client->on("connect", function($cli) {
            echo "connected\n";
            $cli->send("hello world\n");
        });

        $this->client->on('close', function($cli){
            echo "closed\n";
        });

        $this->client->on('error', function($cli){
            echo "error\n";
        });

        $tmpFd = $this->client->sock . microtime(true) . rand(); // 伪fd
        $this->requests[$this->client->sock]['buffer'] = $data;
        $this->requests[$this->client->sock]['parse'] = $callback;
        $this->requests[$this->client->sock]['tmpFd'] = $tmpFd;

        $this->client->on("receive", function($cli, $data){
            //$tmpFd = $this->requests[$cli->sock]['tmpFd'];
            call_user_func_array($this->requests[$cli->sock]['parse'], array('r' => 0, 'data' => $data));
            unset($this->requests[$cli->sock]);
            $cli->close();
        });

        $this->client->connect($host, $port, $timeout);
    }
>>>>>>> 8964ab60c5a38870a8babcb47897ff5bcd2f23e1
}