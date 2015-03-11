<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-11 16:53:23
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-11 16:54:13
 */
function getMoney() {
    $rmb = 1;
    $dollar = 6;
    $func = function() use ( $rmb,$dollar ) {
        echo $rmb."\n";
        echo $dollar."\n";
    };
    $func();
}

getMoney();
?>