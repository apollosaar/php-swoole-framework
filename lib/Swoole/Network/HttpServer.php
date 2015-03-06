<<<<<<< HEAD
<?php
/**
 * Created by PhpStorm.
 * User: chalesi
 * Date: 14-11-12
 * Time: 下午4:27
 */
namespace Swoole\Network;

class HttpServer extends \Swoole\Network\TcpServer
{
    public function init() {
        $this->enableHttp = true;
    }
=======
<?php
/**
 * Created by PhpStorm.
 * User: chalesi
 * Date: 14-11-12
 * Time: 下午4:27
 */
namespace Swoole\Network;

class HttpServer extends \Swoole\Network\TcpServer
{
    public function init() {
        $this->enableHttp = true;
    }
>>>>>>> 8964ab60c5a38870a8babcb47897ff5bcd2f23e1
}