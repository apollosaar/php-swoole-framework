<?php
class testHttpServ extends Swoole\Network\Protocol\BaseServer{


    public   $env=array();
    private  $root_path;

    //为了协程，去除
    public function onRequest($request, $response) {
        echo 'on onRequest'.PHP_EOL;
        $response->end("<h1>Hello gggg Swoole. #".rand(1000, 9999).' and return is '."</h1>");
    }
}
