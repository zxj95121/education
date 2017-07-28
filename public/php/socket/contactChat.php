<?php
use Workerman\Worker;
use Workerman\Lib\Timer;
require_once __DIR__ . '/workerman/Autoloader.php';
require_once __DIR__ . '/mysql-master/src/Connection.php';
require_once __DIR__ . '/mysql-master/vendor/autoload.php';

// $worker = new Worker("websocket://127.0.0.1:2346");
$worker = new Worker("websocket://122.152.200.103:2346");

// 每个进程最多执行1000个请求
define('MAX_REQUEST', 4);

/*程序刚启动*/
$worker->onWorkerStart = function($worker)
{
	/*程序初始化*/
    global $db;
    $db = new Workerman\MySQL\Connection('122.152.200.103', '3306', 'jian', '026006', 'education');
};

$worker->onConnect = function($connection)
{
    // echo "new connection from ip " . $connection->getRemoteIp() . "\n";
    // echo $connection->id;

    // 已经处理请求数
    static $request_count = 0;

    // 如果请求数达到1000
    if(++$request_count >= MAX_REQUEST)
    {
        /*
         * 退出当前进程，主进程会立刻重新启动一个全新进程补充上来
         * 从而完成进程重启
         */
        Worker::stopAll();

    }
};

/*用户发送消息到服务器*/
$worker->onMessage = function($connection, $data)
{
    global $db;
    $cid = $connection->id;
    $firstWord = substr($data, 0, 1);
    if ($firstWord === 'u') {
        $uid = explode('-', $data)[1];
    }

    $db->update('parent_info')->cols(array('ischat'=>'1','worker_id'=>$cid))->where('id='.$uid)->query();

	// foreach($connection->worker->connections as $con)
 //    { 
    	
 // 	   $con->send('&-#-&'.$data);
	// }

 //    $connection->send('hello http');

};
/*用户断开连接触发*/
$worker->onClose = function($connection)
{
    echo "connection closed\n".$connection->id;
};
// 运行worker
Worker::runAll();