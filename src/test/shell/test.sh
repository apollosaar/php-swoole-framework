#!/bin/bash

function php_test(){
	ver=$(php -v | awk '/PHP .*[0-9]/' | awk '{print $2}')
	echo " your php version is $ver"
	php_ver=$(php -v | awk '/PHP .*[0-9]/' | awk '{print $2}' |awk -F '.' '{print$1$2}')
	echo $php_ver
	if [[ $php_ver <'55' ]]
	then
		echo "you need update your php version to PHP5.5"
	else
		echo "your php version is good"
	fi
}

test_grep
