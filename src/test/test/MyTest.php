<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jimmyszhou
 * Date: 14-11-11
 * Time: 下午4:32
 * To change this template use File | Settings | File Templates.
 */
class MyTest
{
    private $swServer;
    private $testFunc;
    private $table;
    public function __construct(){
        $this -> testFunc = 'myTest';
        $this -> swServer = new swoole_server('127.0.0.1', 12345, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
        $this -> table = new swoole_table(1024);
    }
    public function run(){
        $this -> swServer -> set(array('worker_num' => 4,
                                       'dispatch_mode' => 3,
                                       'daemonize' => false));
        //启动时调用
        $this -> swServer -> on('workerStart', array($this, 'myStart'));
        // $this -> swServer -> on('workerStop', array($this , 'myStop'));
        //收包
        $this -> swServer -> on('receive', array($this, 'myReceive'));

        if($this -> swServer -> on('timer', array($this, 'myTimer'))){
            echo "on timer successful".PHP_EOL;
        }
        $this -> swServer -> start();

    }
    public function myStart($serv, $worker_id){
        if($worker_id == 0){
            //echo "start timer".PHP_EOL;
            //swoole_timer_after(1000, array($this, 'myTest'));
            //设置定时器,1秒钟之后开始调用相应程序发包
            $serv -> after(1000, array($this, 'myTest'), true);
            //设置定时器,每2秒钟执行一次,最后收包时间超过设定的阀值,输出报告
            $serv -> addTimer(1000);
            //$serv -> addTimer(3000);
        }
        echo $worker_id . 'start' . PHP_EOL;

    }

    public function myStop($serv, $worker_id){
        echo $worker_id . " stoped ".PHP_EOL;
    }

    public function myReceive($serv, $fd, $from_id, $data){
        echo 'receive';
    }
    //检测超时的计时器
    public function myTimer($serv, $interval){
        echo __METHOD__.PHP_EOL;
        switch($interval){
            //每2秒钟检测一次最后收到时间，超过10秒认为不再收包
            case 2000:{
                echo $interval . ' 2 second timer, now time: '.time().PHP_EOL;
                break;
            }
            case 3000:{
                echo $interval . ' 3 second timer, now time: '.time().PHP_EOL;
                break;
            }
            default:{
            break;
            }
        }
    }
    //同步tcp
    public function myTest(){
        echo 'send test buffer' . PHP_EOL;
        $url = 'http://127.0.0.1:9501';
        $ret = $this ->sendAndReceive($url);
        if ($ret) {
            echo 'test successful' . PHP_EOL;
            //TODO 记录一次成功
        }
    }

    public function sendAndReceive($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:23.0) Gecko/20100101 Firefox/23.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $result = curl_exec($ch);//赋值内容
        if(curl_errno($ch)){
          echo 'Curl error: ' . curl_error($ch)."curl error num".curl_errno($ch)."\r\n";return null;
          return false;
        }
        curl_close($ch);//关闭资源
        return $true;
    }
}
$myTest = new MyTest();
$myTest -> run();

