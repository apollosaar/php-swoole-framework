<?php
namespace Swoole\Server;

interface Protocol
{
    function onStart($server, $workerId);
    function onConnect($server, $client_id, $from_id);
    function onReceive($server,$client_id, $from_id, $data);
    function onClose($server, $client_id, $from_id);
    function onShutdown($server, $worker_id);
    function onTask($serv, $task_id, $from_id, $data);
    function onFinish($serv, $task_id, $data);
<<<<<<< HEAD
    function onTimer($serv, $interval);
=======
>>>>>>> 8964ab60c5a38870a8babcb47897ff5bcd2f23e1
}