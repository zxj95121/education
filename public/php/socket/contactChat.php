<?php
use Workerman\Worker;
use Workerman\Lib\Timer;
require_once __DIR__ . '/workerman/Autoloader.php';
require_once __DIR__ . '/mysql-master/src/Connection.php';
require_once __DIR__ . '/mysql-master/vendor/autoload.php';

// $worker = new Worker("websocket://127.0.0.1:2346");
$worker = new Worker("websocket://0.0.0.0:23465");

// 每个进程最多执行1000个请求
define('MAX_REQUEST', 400);

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
    $data = json_decode($data, true);

    if ($data['type'] == 'u') {
        /*用户端*/
        if ($data['status'] == 'init') {
            $db->update('parent_info')->cols(array('is_chat'=>'1','worker_id'=>$cid))->where('id='.$data['id'])->query();
        } else if ($data['status'] == 'msg') {
            $time = date('Y-m-d H:i:s');
            $insert_id = $db->insert('contact_chat')->cols(array(
            'uid' => $data['id'],
            'admin_id' => '0',
            'content' => $data['content'],
            'read' => '0',
            'created_at' => $time,
            'updated_at' => $time))->query();
        }
    } elseif ($data['type'] == 'a') {
        /*管理员端*/
        if ($data['status'] == 'init') {
            $db->update('admin_info')->cols(array('is_chat'=>'1','worker_id'=>$cid))->where('id='.$data['aid'])->query();
        } else if ($data['status'] == 'msg') {
            $time = date('Y-m-d H:i:s');
            $insert_id = $db->insert('contact_chat')->cols(array(
            'uid' => $data['uid'],
            'admin_id' => $data['aid'],
            'content' => $data['content'],
            'read' => '1',
            'created_at' => $time,
            'updated_at' => $time))->query();

            $user_id = $data['uid'];
        } else if ($data['status'] == 'image') {
            $time = date('Y-m-d H:i:s');
            $name = 'CC'.date('YmdHis').rand(1000,9999).'.';
            $address = '/var/www/html/data/chat/'.$name;

            $base64 = $data['content'];
            $base64_image = str_replace(' ', '+', $base64);
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)) {
                $img = base64_decode(str_replace($result[1], '', $base64_image));

                $str1 = explode(';', $result[0])[0];
                $str = explode('/', $str1)[1];
                
                $size = file_put_contents($address.$str, $img);//保存图片，返回的是字节数

                
            }

            $insert_id = $db->insert('contact_chat')->cols(array(
            'uid' => $data['uid'],
            'admin_id' => $data['aid'],
            'content' => 'http://file.catchon-edu.cn/chat/'.$name.$str,
            'read' => '1',
            'type' => '1',
            'created_at' => $time,
            'updated_at' => $time))->query();

            /*存储用户的ID*/
            $user_id = $data['uid'];
        }

        /*向用户端和其他管理员发送消息*/  
            /*用户*/
        if (isset($user_id)) {/*如果有这个值，说明是传消息的*/
            $worker_uid = $db->select('worker_id')->from('parent_info')->where('id= :id')->bindValues(array('id'=>$data['uid']))->single();

            foreach($connection->worker->connections as $con)
            {
                if ($con->id == $worker_uid)
                    $con->send('哈哈哈');
            }
        }
    }

    

	// foreach($connection->worker->connections as $con)
 //    { 
    	
 // 	   $con->send('&-#-&'.$data);
	// }

 //    $connection->send('hello http');

};
/*用户断开连接触发*/
$worker->onClose = function($connection)
{
    global $db;

    echo "connection closed\n".$connection->id;
    $pid = $db->select('id')->from('parent_info')->where('worker_id= :worker_id')->bindValues(array('worker_id'=>$connection->id))->single();
    if ($pid) {
        $row_count = $db->update('parent_info')->cols(array('is_chat'=>'0', 'worker_id'=>'0'))->where('id='.$pid)->query();
    }
    $aid = $db->select('id')->from('admin_info')->where('worker_id= :worker_id')->bindValues(array('worker_id'=>$connection->id))->single();
    if ($aid) {
        $row_count = $db->update('admin_info')->cols(array('is_chat'=>'0', 'worker_id'=>'0'))->where('id='.$aid)->query();
    }
};
// 运行worker
Worker::runAll();