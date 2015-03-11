<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jimmyszhou
 * Date: 15-3-5
 * Time: 下午1:51
 * To change this template use File | Settings | File Templates.
 */
class appRun
{
    private $controller;
    private $action;
    public function __construct($route){
        $this -> controller = $route['controller'];
        $this -> action = $route['action'];
    }
    public function getController(){
        return $this -> controller;
    }
    public function getAction(){
        return $this -> action;
    }
    public function getPwd(){
        return $this -> controller . '/' . $this -> action;
    }
    public function run($type, $serv, $argv){
        $class = $this -> controller . 'Controller';
        $obj = new $class($serv,$argv);
        $fun = $type . $this -> action;
        return  $obj -> $fun();
    }
}
