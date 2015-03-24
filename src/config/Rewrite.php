<?php
/**
 * Created by PhpStorm.
 * User: markyuan
 * Date: 15-2-28
 * Time: 上午9:50
 */

return array(
//    array(
//    /**
//     * URL要匹配的正则表达式，这里字母是不区分大小写的
//     */
//    'regx' => '^/([a-z]+)/(\d+)\.html$',
//    /**
//     * 对应的控制器和视图
//     */
//    'mvc'  => array('controller' => 'page', 'action' => 'detail'),
//    /**
//     * 将regx中的正则子表达式的值填充到$_GET参数中
//     * 如/hello/134.html，那么就是 $_GET['app'] = hello, $_GET['id'] = 134
//     */
//    'get'  => 'app,id',
//    ),
//
//    //restcontroller 风格
//    array(     //restcontroller 风格
//        'regx' => '^/rest/([a-z]+)/(\d+)\.html$',
//        /**
//         * 对应的控制器和视图
//         */
//        'get'  => 'id',
//        /**
//         * 对应的控制器和视图
//         */
//        'mvc'  => array('controller' => '', 'action' => 'detail'),
//        /**
//         * ver ---->制定的http方法  包括 post get put delete等
//         */
//        'ver'  => 'GET',
//    ),

    //默认的话就是/controller/action?id=32131 直接定位过去  必须要有
    array(
        /**
         * 默认的==》controller/action
         */
        'regx' => '^/(<controller>\w+)/(<action>\w+)\.html$',  //这种是默认格式 其余都转到get里面
        'mvc' => 'controller/action',  //必须匹配
        'verb' => 'GET',  //必须匹配 方法
        'default' => array('id'=>3),  //添加默认参数
    ),

    );
