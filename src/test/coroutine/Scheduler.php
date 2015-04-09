<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 19:47:33
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-04-09 15:33:08
 */
class Scheduler {

    protected $corStack;

    /**
     * [__construct 初始化栈]
     */
    public function __construct(){

        $this ->corStack = new SplStack();
    }

    /**
     * [add 添加G到调度器内]
     * @param Generator $g [description]
     */
    public function add(Generator $g){

        $res = $this ->initStack($g);
        $this ->run($res);
    }

    /**
     * [initStack 初始化栈]
     * @param  Generator $g [description]
     * @return [type]       [description]
     */
    private function initStack(Generator $g){
        while ($g instanceof Generator) {
            $this ->corStack ->push($g);
            $g = $g ->current();
        }
        return $g;
    }

    /**
     * [run 执行调度，判断IO类型，执行IO操作]
     * @param  $c           [description]
     * @return [type]       [description]
     */
    public function run($c){

        //$this ->log(__METHOD__. " c ==== " .print_r($c,true));
        if ($c instanceof TestClient) 
        {
            $this ->sendData($c);       
        }else
        {
            $this ->callback($c);
        }
    }

    /**
     * [callback 回吐数据到协程中，并判断是否还有中断，有中断，调用run函数]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function callback($res){

        if (empty($res)) {
            return;
        }
        $res = $this ->send($res);  
        if ($res) {
            $this ->add($res);
        } 
        
    }

    public function send($data){

        while (!$this ->corStack ->isEmpty()) {
            $g = $this ->corStack ->pop();
            $data = $g ->send($data);
            //$this ->log(__METHOD__ . " send data ====" . print_r($data,true));

            if ($data instanceof Generator) {
                //$this ->log(__METHOD__." in while");
                return $g;
            }

            if (empty($data)) {
                return false;
            }
        }

        return $g;        
    }

    /**
     * [sendData 异步IO操作]
     * @param  TestClient $tc [description]
     * @return [type]         [description]
     */
    public function sendData(TestClient $tc){
        $client = new  swoole_client(SWOOLE_SOCK_UDP, SWOOLE_SOCK_ASYNC);
        $client->on("connect", function($cli) use($tc){
            $cli->send($tc ->data);
        });

        $client->on('close', function($cli){
        });

        $client->on('error', function($cli){
            $cli ->close();
            $this ->callback(array('r' => 1, 'error_msg' => 'conncet error'));
        });

        $client->on("receive", function($cli, $data){
            $cli->close();
            $this ->callback(array('r' => 0, 'data' =>$data));
        });

        if($client->connect($tc ->ip, $tc ->port, $tc ->timeout)){
            // if (intval($tc ->timeout) >0) {
            //     swoole_timer_after(intval($tc ->timeout) * 1000, function() use($client){
            //         if ($client ->isConnected()) {
            //             $client ->close();
            //             $this ->callback(array('r' => 2 , 'error_msg' => 'timeout'));
            //         }
            //     });
            // }
        }
    }

    public function log($log){
        $time = date('Y-m-d H:i:s');
        error_log($time . $log . PHP_EOL, 3, '/tmp/'.__CLASS__.'.log');
    }
}
?>






