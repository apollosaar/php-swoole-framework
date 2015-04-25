<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 19:47:33
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-04-25 16:32:55
 */
class Schedule {

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

        while ($g instanceof Generator) {
            $this ->corStack ->push($g);
            $g = $g ->current();
        }
        $this ->run($g);
    }

    /**
     * [run 执行调度，判断IO类型，执行IO操作]
     * @param  $c           [description]
     * @return [type]       [description]
     */
    public function run($c){

        //$this ->log(__METHOD__. " c ==== " .print_r($c,true));
        if (is_subclass_of($c,'Client')) 
        {
            //$this ->log(__METHOD__. " send DATA ");
            $c ->sendData(array($this,'callback'));       
        }else
       {
            //$this ->log(__METHOD__. " callback");
            $this ->callback(0,'',$c);
        }
    }

    /**
     * [callback 回吐数据到协程中，并判断是否还有中断，有中断，调用run函数]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function callback($r, $key, $res){
        
        //$this ->log(__METHOD__ . "key == $key res====" . print_r($res,true));
        if (empty($res)) {
            return;
        }
        // xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
        $res = $this ->send(array('r' => $r, 'data' => $res));  
        
        if ($res) {
            $this ->add($res);
        } 
        //$xhprof_data = xhprof_disable(); 
        //$this ->log(__METHOD__.print_r($xhprof_data,true));
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

    public function log($log){
        $time = date('Y-m-d H:i:s');
        error_log($time . $log . PHP_EOL, 3, '/tmp/'.__CLASS__.'.log');
    }
}
?>






