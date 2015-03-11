<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jimmyszhou
 * Date: 15-3-5
 * Time: 上午11:15
 * To change this template use File | Settings | File Templates.
 */
class HttpHelper
{
    //解析成功
    const HTTP_OK = 0x00;
    //请求方式错误
    const HTTP_ERROR_METHOD = 0x01;
    //请求uri错误
    const HTTP_ERROR_URI = 0x02;
    /**
     * 处理request对象
     * @param req swoole http server 获得的request对象
     */
    public static function httpReqHandle($req){
        $ver = swoole_version();
        $method = $ver == '1.7.9' ? $req -> server['REQUEST_METHOD'] : $req -> server['request_method'];
        if($method != 'POST'){
            return array('r' => self::HTTP_ERROR_METHOD);
        }
        $uri = $ver == '1.7.9' ? $req -> server['REQUEST_URI'] : $req -> server['request_uri'];
        $appRoute = HttpRoute::getRoute($uri);
        if(!$appRoute){
            return array('r' => self::HTTP_ERROR_URI);
        }

        return array('r' => self::HTTP_OK,
                     'route' => $appRoute,
                     'request' => array('uri' => $uri,
                                        'get' => $req -> get,
                                        'post' => $req -> post ? $req -> post : $req -> rawContent(),
                                       ),
                     );
    }

    /**
     * @param $rsp swoole http server 获得的response对象
     */
    public static function httpRspHandle($rsp){
        return $rsp;
    }
}
