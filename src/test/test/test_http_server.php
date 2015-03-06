<?php
/**
 * @Author: winterswang
 * @Date:   2015-02-10 10:52:16
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-02-10 10:52:44
 */

$http = new swoole_http_server("127.0.0.1", 9501);
$http->set([
    'worker_num' => 8,
    //'open_tcp_nodelay' => true,
]);
$http->on('request', function ($request, swoole_http_response $response) {
    $response->end("<h1>Hello Swoole.</h1>");
});
$http->start();
?>