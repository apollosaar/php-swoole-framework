<<<<<<< HEAD
#!/usr/local/php/bin/php -q
<?php

// 定义根目录
define('BASEPATH', dirname(dirname(__FILE__)));

// 载入Swoole 框架
require_once BASEPATH . '/lib/Swoole/require.php';

// 定义网络层 UDP、TCP
$server = new \Swoole\Network\TcpServer();

// 加载配置文件
$server->loadConfig(__DIR__.'/testTcpServ.ini');

// 源码加载器
$server->setRequire(BASEPATH . '/src/require.php');

// 启动
=======
#!/usr/local/php/bin/php -q
<?php

// 定义根目录
define('BASEPATH', dirname(dirname(__FILE__)));

// 载入Swoole 框架
require_once BASEPATH . '/lib/Swoole/require.php';

// 定义网络层 UDP、TCP
$server = new \Swoole\Network\TcpServer();

// 加载配置文件
$server->loadConfig(__DIR__.'/testTcpServ.ini');

// 源码加载器
$server->setRequire(BASEPATH . '/src/require.php');

// 启动
>>>>>>> 8964ab60c5a38870a8babcb47897ff5bcd2f23e1
$server->run();