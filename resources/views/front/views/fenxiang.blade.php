<?php
require_once $_SERVER['DOCUMENT_ROOT']."/php/jssdk/jssdk.php";
$jssdk = new JSSDK(getenv('APPID'), getenv('APPSECRET'));
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
<head>
	<title>加辰教育</title>
</head>
<body>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script>
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'checkJsApi',
            'openLocation',
            'getLocation',
            'onMenuShareTimeline',
            'onMenuShareAppMessage'
          ]
    });
    wx.ready(function () {
        wx.checkJsApi({
            jsApiList: [
                'getLocation',
                'onMenuShareTimeline',
                'onMenuShareAppMessage'
            ],
            success: function (res) {
                alert(JSON.stringify(res));
            }
        });
        wx.onMenuShareAppMessage({
            title: '<?php echo $news['Title'];?>',
            desc: '<?php echo $news['Description'];?>',
            link: '<?php echo $news['Url'];?>',
            imgUrl: '<?php echo $news['PicUrl'];?>',
            trigger: function (res) {
              // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
              // alert('用户点击发送给朋友');
            },
            success: function (res) {
              // alert('已分享');
            },
            cancel: function (res) {
              // alert('已取消');
            },
            fail: function (res) {
              // alert(JSON.stringify(res));
            }
        });
        wx.onMenuShareTimeline({
            title: '<?php echo $news['Title'];?>',
            link: '<?php echo $news['Url'];?>',
            imgUrl: '<?php echo $news['PicUrl'];?>',
            trigger: function (res) {
              // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
              // alert('用户点击分享到朋友圈');
            },
            success: function (res) {
              // alert('已分享');
            },
            cancel: function (res) {
              // alert('已取消');
            },
            fail: function (res) {
              // alert(JSON.stringify(res));
            }
          });
		});
</script>
</body>