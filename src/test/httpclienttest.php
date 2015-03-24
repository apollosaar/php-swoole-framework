
<?php

//define("WEBPATH", realpath(__DIR__.'/../'));
//require dirname(__DIR__) . '/libs/lib_config.php';

//define("WEBPATH", dirname(dirname(__FILE__)));
//require dirname(dirname(dirname(__FILE__))) . '/lib/Swoole/Client/AsyncHttpClient.php';

require dirname(dirname(dirname(__FILE__))) . '/lib/Swoole/require.php';

//$this->root_path = dirname(dirname(__FILE__));
//$controller_file=$this->root_path.'/controller/'.$mvc['controller'].'.php';

function fff($fd,$response){

    echo "******************response----start**************\r\n";
    var_dump($fd);
    echo "******************response----start**************\r\n";
    var_dump($response);

    $s=json_decode($response['body'],true);
    echo 'get id is '.$s['id'];
    echo 'get name is '.$s['name'];


};
//$app= new \Swoole\Async\HttpClient('http://127.0.0.1:8000/index?id=ggggg','POST',array('name'=>1,'id'=>2));

$app= new \Swoole\Client\AsyncHttpClient('http://10.213.168.89:8091/First/index.html?gs=12323','GET',array('name'=>1,'id'=>2));

//$app= new \Swoole\Async\HttpClient('https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=e6jt2Llt6vUuuvkOG1PIjmttcpMIe9X4JZP3ueacdUIowyQLByYxgUxTaZJZf2pbMU0nNbS9cBiPbn6p6zTa6ilGllUIjyf5die5QYa4MOo','GET');

//$app= new \Swoole\Async\HttpClient('http://www.dwz.cn/xufnv');

//$app= new \Swoole\Async\HttpClient('http://example.com','GET');

//$app= new \Swoole\Async\HttpClient ('http://10.149.28.32:20051','GET');

$app->setCookie(array('skey'=>1123123,'pstky'=>31234));
//$app->setAuthorization('mark','123');
//$app->setHeader('Connection','keep-alive');
//$app->setUserProxy('10.149.19.29','8765');
$app->execute();
//$app->closeConnect();
$app->onReady('fff');


