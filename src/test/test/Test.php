<?php
//调试专用
require_once "../../auto_load.php";
	class Test{
		public function test_fun(){
			$ser = new Controller();
			var_dump($ser);
			echo "test".PHP_EOL;
		}
	}
	$t = new Test();
	$t ->test_fun();
?>