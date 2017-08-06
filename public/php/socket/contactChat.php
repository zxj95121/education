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
        $user_type = 'u';
        /*用户端*/
        if ($data['status'] == 'init') {
            $db->update('new_user')->cols(array('is_chat'=>'1','worker_id'=>$cid))->where('id='.$data['uid'])->query();
        } else if ($data['status'] == 'msg') {
            /*用户发送文字消息*/
            $data['content'] = emoji_encode($data['content']);
                /*看当前有没有管理员再跟用户聊天*/
            $count = $db->select('count(*) as count')->from('new_user')
                ->innerJoin('user_type','user_type.uid = new_user.id')
                ->where("user_type.type= '1'")
                ->where("new_user.is_chat= '1' and new_user.chat_user = '".$data['uid']."' ")->single();
            if ($count > 0) {
                $read = '1';
            } else {
                $read = '0';
            }

            $data['content'] = str_replace('\n', '<br />', $data['content']);

            $time = date('Y-m-d H:i:s');
            $insert_id = $db->insert('contact_chat')->cols(array(
            'uid' => $data['uid'],
            'admin_id' => '0',
            'content' => $data['content'],
            'read' => $read,
            'created_at' => $time,
            'updated_at' => $time))->query();

            /*存储用户的ID*/
            $user_id = $data['uid'];

        } else if ($data['status'] == 'image') {
            $time = date('Y-m-d H:i:s');
            $name = 'CU'.date('YmdHis').rand(1000,9999).'.';
            $address = '/var/www/html/data/chat/'.$name;

            $base64 = $data['content'];
            $base64_image = str_replace(' ', '+', $base64);
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)) {
                $img = base64_decode(str_replace($result[1], '', $base64_image));

                $str1 = explode(';', $result[0])[0];
                $str = explode('/', $str1)[1];
                
                $size = file_put_contents($address.$str, $img);//保存图片，返回的是字节数

            }


            $data['content'] = 'http://file.catchon-edu.cn/chat/'.$name.$str;

            resize($address.$str, $str);

            /*看当前有没有管理员再跟用户聊天*/
            $count = $db->select('count(*) as count')->from('new_user')
                ->innerJoin('user_type','user_type.uid = new_user.id')
                ->where("user_type.type= '1'")
                ->where("new_user.is_chat= '1' and new_user.chat_user = '".$data['uid']."' ")->single();
            if ($count > 0) {
                $read = '1';
            } else {
                $read = '0';
            }

            $insert_id = $db->insert('contact_chat')->cols(array(
            'uid' => $data['uid'],
            'admin_id' => '0',
            'content' => $data['content'],
            'read' => $read,
            'type' => '1',
            'created_at' => $time,
            'updated_at' => $time))->query();

            /*存储用户的ID*/
            $user_id = $data['uid'];
        }


    } elseif ($data['type'] == 'a') {
        $user_type = 'a';
        /*管理员端*/
        if ($data['status'] == 'init') {
            $db->update('new_user')->cols(array('is_chat'=>'1','worker_id'=>$cid,'chat_user'=>$data['uid']))->where('id='.$data['aid'])->query();
        } else if ($data['status'] == 'msg') {
            $data['content'] = emoji_encode($data['content']);

            $data['content'] = str_replace('\n', '<br />', $data['content']);
            
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


            $data['content'] = 'http://file.catchon-edu.cn/chat/'.$name.$str;

            resize($address.$str, $str);

            $insert_id = $db->insert('contact_chat')->cols(array(
            'uid' => $data['uid'],
            'admin_id' => $data['aid'],
            'content' => $data['content'],
            'read' => '1',
            'type' => '1',
            'created_at' => $time,
            'updated_at' => $time))->query();

            /*存储用户的ID*/
            $user_id = $data['uid'];
        }

    }

    /*向用户端和其他管理员发送消息*/  
            
    if (isset($user_id)) {/*如果有这个值，说明是传消息的*/
        $data['content'] = emoji_decode($data['content']);

        /*发送给用户，只有一个*/
        $worker_uid = $db->select('worker_id')->from('new_user')->where('id= :id')->bindValues(array('id'=>$data['uid']))->single();

        $sendArr[$worker_uid] = 1;

        /*发送给管理员，可能多个*/
        $worker_aid_Arr = $db->select('new_user.worker_id')->from('new_user')
            ->innerJoin('user_type','user_type.uid = new_user.id')
            ->where("user_type.type= '1'")
            ->where("new_user.is_chat= '1' and new_user.chat_user= '".$data['uid']."'")->query();

        foreach ($worker_aid_Arr as $value) {
            $sendArr[$value['worker_id']] = 1;
        }
        
        /*开始传送数据*/
        $msg = array();
        $msg['content'] = $data['content'];
        $msg['type'] = $user_type;
        $msg['status'] = $data['status'];
        /*根据$data['aid']查他的头像地址*/
        if (array_key_exists('aid', $data))
            $headimg = $db->select('headimg')->from('new_user')->where('id= :id')->bindValues(array('id'=>$data['aid']))->single();
        else
            $headimg = $db->select('headimg')->from('new_user')->where('id= :id')->bindValues(array('id'=>$data['uid']))->single();
        $msg['headimg'] = $headimg;
        /*根据$insert_id查时间*/
        $sendTime = substr($time, 5);
        $msg['time'] = $sendTime;

        $msg = json_encode($msg);

        foreach($connection->worker->connections as $con)
        {
            if (array_key_exists($con->id, $sendArr)) {

                $con->send($msg);
                unset($sendArr[$con->id]);
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
    $pid = $db->select('id')->from('new_user')->where('worker_id= :worker_id')->bindValues(array('worker_id'=>$connection->id))->single();
    if ($pid) {
        $row_count = $db->update('new_user')->cols(array('is_chat'=>'0', 'worker_id'=>'0'))->where('id='.$pid)->query();
    }
    $aid = $db->select('id')->from('new_user')->where('worker_id= :worker_id')->bindValues(array('worker_id'=>$connection->id))->single();
    if ($aid) {
        $row_count = $db->update('new_user')->cols(array('is_chat'=>'0', 'worker_id'=>'0'))->where('id='.$aid)->query();
    }
};
// 运行worker
Worker::runAll();

function emoji_encode($str){
    $strEncode = '';

    $length = mb_strlen($str,'utf-8');

    for ($i=0; $i < $length; $i++) {
        $_tmpStr = mb_substr($str,$i,1,'utf-8');    
        if(strlen($_tmpStr) >= 4){
            $strEncode .= '[[EMOJI:'.rawurlencode($_tmpStr).']]';
        }else{
            $strEncode .= $_tmpStr;
        }
    }

    return $strEncode;
}

function emoji_decode($str) {
    $strDecode = preg_replace_callback('|\[\[EMOJI:(.*?)\]\]|', function($matches){  
        return rawurldecode($matches[1]);
    }, $str);

    return $strDecode;
}

function resize($path, $type)
{
    if ($type == 'gif')
        return false;
    // header("Content-type: image/jpeg");  
    $file = $path;  
    $filesize = filesize($path);
    if ($filesize > 648576) {

        $percent = 0.4;  //图片压缩比  
        list($width, $height) = getimagesize($file); //获取原图尺寸  

        // $bi = 600/$width;
        // $newwidth = 600;
        // $newheight = $height*$bi;

        //缩放尺寸  
        $newwidth = $width * $percent;  
        $newheight = $height * $percent;  

        $function0 = 'imagecreatefrom'.$type;
        $function1 = 'image'.$type;
        
        $src_im = $function0($file);
        $dst_im = imagecreatetruecolor($newwidth, $newheight);  
        imagecopyresized($dst_im, $src_im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);  
        $function1($dst_im, $path); //输出压缩后的图片  
        imagedestroy($dst_im);  
        imagedestroy($src_im);
    }
}
