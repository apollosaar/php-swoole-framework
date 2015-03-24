<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jimmyszhou
 * Date: 15-3-5
 * Time: 下午1:37
 * To change this template use File | Settings | File Templates.
 */
abstract class Route
{
    protected static $route;

    public function initRoute(){

    }
    public function setRoute($key, $val){
        self::$route[$key] = $val;
    }
}
