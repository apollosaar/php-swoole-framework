<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-2-28
 * Time: 上午9:57
 */
class FirstController extends HttpController {
    public function index(){
        return 'this is firstcontroller and function is index and get is'.print_r($_GET,true).' and post is'.print_r($_POST,true);
    }

    public function ix(){
        return 'this is firstcontroller and function is IX and get is'.print_r($_GET,true).' and post is'.print_r($_POST,true);
    }
}