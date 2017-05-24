<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class ImageBuilderController extends Controller
{
	/*获取数字验证码*/
    public function getNumberImage(Request $request)
    {

        $text='1234';//得到的成语字符串
        header('content-type:image/jpeg');
        //1、创建画布
        $img = imagecreatefrompng('write/imagebuilder/backgrounds/'.rand(1,12).'.png');

        //2-2、写字
         
        $str = '';

        for($j = 1 ; $j <= 4 ; $j++){
            //字体大小随机从15像素～20像素
            $fontSize = 22;
            //x的位置
            $fontX = 30 * ($j-1)+15;//25 50 75 100
            //Y的位置
            $fontY = 35;
            //字体颜色
            $fontColor = imagecolorallocate($img,rand(0,125),rand(0,125),rand(0,125));
            //每次随机出来的字
 
            // $fontText = mb_substr($text,$j-1,1,'UTF-8');//读取一个汉字
            $fontText = rand(0,9);
            $str.= $fontText;
            $angle = rand(0,20)-10;
            //echo $fontText;
            imagettftext($img,$fontSize,$angle,$fontX,$fontY,$fontColor,$_SERVER['DOCUMENT_ROOT'].'/write/imagebuilder/fonts/Ubuntu_regular.ttf',$fontText);
        }

        Session::put('number_image', $str);
        //3、输出或保存
        imagepng($img);
        //4、解析模板
        // view('front.register.showvcode',['dd'=> imagejpeg($img)]);<br>　　
    }
}
