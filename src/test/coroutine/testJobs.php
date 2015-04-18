<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-10 20:31:52
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-04-14 19:31:24
 */
require 'HttpTestClient.php';

$url = 'http://api.mp.qq.com';
$data = array('appid' => '1104445723',
			  'secret' => '99uel4Du6W7Yl3r6'
			  );
$hc = new HttpTestClient($url);
print_r($hc);
?>