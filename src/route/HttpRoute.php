<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jimmyszhou
 * Date: 15-3-5
 * Time: 下午1:29
 * To change this template use File | Settings | File Templates.
 * uri => cmd =>
 */
class HttpRoute extends Route{
    protected static $route = array('/upproxy' => array(
                                                'controller' => 'UpProxy',
                                                'action' => 'index',
                                              ),);
    public static function getRoute($uri){

        return array_key_exists($uri, self::$route) ? self::$route[$uri] : false;
    }
}