<<<<<<< HEAD
<?php
define("SWOOLEPATH", str_replace("\\","/", __DIR__));
define("LIBPATH", SWOOLEPATH . '/../');
if(PHP_OS=='WINNT') define("NL","\r\n");
else define("NL","\n");
define("BL","<br />".NL);
require_once SWOOLEPATH . '/Loader.php';
/**
 * 注册顶层命名空间到自动载入器
 */
Swoole\Loader::setRootNS('Swoole', SWOOLEPATH);
spl_autoload_register('\\Swoole\\Loader::autoload');

=======
<?php
define("SWOOLEPATH", str_replace("\\","/", __DIR__));
define("LIBPATH", SWOOLEPATH . '/../');
if(PHP_OS=='WINNT') define("NL","\r\n");
else define("NL","\n");
define("BL","<br />".NL);
require_once SWOOLEPATH . '/Loader.php';
/**
 * 注册顶层命名空间到自动载入器
 */
Swoole\Loader::setRootNS('Swoole', SWOOLEPATH);
spl_autoload_register('\\Swoole\\Loader::autoload');
>>>>>>> 8964ab60c5a38870a8babcb47897ff5bcd2f23e1
