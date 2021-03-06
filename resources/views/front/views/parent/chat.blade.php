<?php 
function emoji_decode($str){
    $strDecode = preg_replace_callback('|\[\[EMOJI:(.*?)\]\]|', function($matches){  
        return rawurldecode($matches[1]);
    }, $str);

    return $strDecode;
} 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>加辰教育</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!--     <link rel="shortcut icon" href="/favicon.ico"> -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">

    <link href="/admin/assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css"> -->

    <!-- <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css"> -->
    <link rel="stylesheet" type="text/css" href="/front/lib/chat/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/front/lib/chat/css/default.css">
    <link rel="stylesheet" type="text/css" href="/front/lib/chat/css/styles.css">

    <style type="text/css">
	    .chatImg{
			max-width: 210px;
		}
		.chatDataUser{
			word-break: break-all;
			color: #FFF;
		}
		.chatData{
			word-break: break-all;
			color: #1a1A1a;
		}
		.dateSpan{
			color: #1a1A1a;
		}
    </style>

  </head>
  <body>
    <div class="page-group" style="background:#fff">
        <div class="page page-current">
        
        	<img src="" id="img0" style="display: none;">
        	<img src="" id="img1" style="display: none;">
        	<img src="" id="img2" style="display: none;">
        	<img src="" id="img3" style="display: none;">
        	<img src="" id="img4" style="display: none;">

			<div class="content" style="background: #D6D6D6;">

				<!-- 弹框 -->
	    		<div id="showSweetAlert" class="sweet-alert showSweetAlert visible" tabindex="-1" data-custom-class="" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-ouside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="/*display: block;*/z-index: 32200; margin-top: 0px;top: 100px;position: absolute;background: #E3E3E3;">

	    			<div class="" id="imageSee" style="width: 100%; display: block;margin: 0 auto;text-align: center;max-height: 320px;overflow: scroll;">
	    				<img id="imageUpload" src="" style="max-width: 280px;">
	    			</div> 
	    			<!-- <h2>Here's a message!</h2> -->
	    			<!-- <p style="display: block;"></p> -->
	    			<button class="cancel" tabindex="2" style="display: inline-block; box-shadow: none;" onclick="hideAlert();">取消</button>
	    			<!-- <button class="cancel" tabindex="2" style="display: inline-block; background-color: rgb(49, 85, 188); box-shadow: none;" onclick="fileClick();">更换图片</button> -->
	    			<button class="confirm" tabindex="1" id="sendPhoto" style="display: inline-block; background-color: rgb(52,199,59); box-shadow: rgba(174, 222, 244, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">发送图片</button>
	    		</div>


			    <div id="chatview" class="p1" style="width:100%;height:100%;position: relative;">
			    	<div id="refresh" style="position: absolute;width: 100%;height:40px;top:83px;">
		        		<div class="img" style="margin: 0 auto;width: 40px;height: 100%;">
		        			<img src="/images/loading.gif" style="width: 25px;height: 25px;">
		        		</div>
		        	</div>   
			        <div id="profile" style="background: #22AAE8;position: relative;z-index: 9999;">
			 
			            <!-- <div id="close" onclick="window.location.href='/front/home/oauth';">
			                <div class="cy"></div>
			                <div class="cx"></div>
			                <img src="/images/arrow-left.png" style="width: 100%;height: 100%;">
			            </div> -->
			             <div id="headimg">
			             	<img src="/images/kefu.jpg" style="width: 100%;height: 100%;">
			             </div>
			            <p>加辰客服</p>
			            <!-- <span>miro@badev@gmail.com</span> -->
			        </div>
			        
			        <div id="chat-messages" style="position: relative;padding-top: 8px;">
			        	
			        @foreach ($content as $value)
		          		@if ($value['type'] == 0)
				            <div @if($value['admin_id']) class="message" @else class="message right" @endif time="{{$value['created_at']}}">
				              <img @if($value['admin_id']) src="{{$value['aheadimg']}}" @else src="{{$value['uheadimg']}}" @endif" />
				                <div class="bubble"  @if($value['admin_id']) @else style="background: #22AAE8;border-radius: 5px 0px 0px 5px;" @endif>
				                  	<span @if($value['admin_id']) class="chatData chatDataC" @else class="chatDataUser chatDataC" @endif >{{emoji_decode($value['content'])}}</span>
				                    <div class="corner" @if($value['admin_id']) @else style="background: url('/front/lib/chat/img/bubble-cornerR2.png') 0 0 no-repeat;" @endif></div>
				                    <span class="dateSpan">{{date('m-d H:i:s', strtotime($value['created_at']))}}</span>
				                </div>
				            </div>
				        @elseif($value['type'] == 1)
					        <div @if($value['admin_id']) class="message" @else class="message right" @endif time="{{$value['created_at']}}">
				            	<img @if($value['admin_id']) src="{{$value['aheadimg']}}" @else src="{{$value['uheadimg']}}" @endif" />
				                <div class="bubble" @if($value['admin_id']) @else style="background: #22AAE8;border-radius: 5px 0px 0px 5px;" @endif>
				                	<img class="chatImg" src="{{$value['content']}}" style="margin-left: 0px;margin-right: 0px;border-radius: 0px;width: 100%;min-width: 80px;">
				                    <div class="corner" @if($value['admin_id']) @else style="background: url('/front/lib/chat/img/bubble-cornerR2.png') 0 0 no-repeat;" @endif></div>
				                    <span class="dateSpan" style="position: absolute;">{{date('m-d H:i:s', strtotime($value['created_at']))}}</span>
				                </div>
				            </div>
				        @else
				        @endif
		            @endforeach

			        </div>
			       
			        <div id="sendmessage">
			        	<!-- <input type="text" id="textInput" style="line-height: 25px;margin-top: 12px;color: #000;" value="" placeholder="" /> -->
			        	<textarea id="textInput" wrap="soft" style="height: 41px;padding-top:3px;margin-top: 4px;padding-left: 8px;color: #000;line-height: 19px;resize: none;border: 0px solid transparent;font-size: 19px;"></textarea>
			          	<input type="file" id="fileInput" style="display: none;" name="file" accept="image/*">
			            <button id="sendBtn" style="display: none;cursor: pointer;"><img src="/images/square-send.png" style="width: 100%;height: 100%;cursor: pointer;"></button>
			            <button id="imageBtn" onclick="fileClick();" style="cursor: pointer;"><img src="/images/square-image.png" style="width: 100%;height: 100%;cursor: pointer;"></button>
			        </div>  
			    </div>

			</div>

			<span id="textInputSpan" style="opacity: 0;font-size: 19px;padding-left: 8px;"></span>
        </div>
    </div>


    <!-- <script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script> -->
    <!-- <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script> -->
    <!-- <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script> -->
    <script src="/admin/assets/sweet-alert/sweet-alert.min.js"></script>
    <script type="text/javascript" src="/js/layui/layer_only/mobile/layer.js"></script>
    <!-- <script src="/admin/assets/sweet-alert/sweet-alert.init.js"></script> -->

    <script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/json2.js"></script>


    <script type="text/javascript">

		$(window).load(function(){

			$.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

			var height = $('#chatview').height();
			var h1 = $('#profile').height();
			var h2 = $('#sendmessage').height();
			$('#chat-messages').css('height', height-h1-h2+'px');

			/*input*/
			var sendmessageHeight = $('#sendmessage').width();
			$('#textInput').css('width', sendmessageHeight-70+'px');


			$('#chat-messages .message').each(function(){
				// var height = $(this).child()
				// console.log(index);
				if ($(this).find('.chatDataC').length == 1) {
					var height = $(this).find('.chatDataC')[0].offsetHeight;
					// console.log(height);
					if (height > 20) {
						$(this).css('padding-bottom', (height+18) +'px');
					}
					$(this).css('height', height+'px');
				} else if ($(this).find('.chatImg').length == 1) {
					var height = $(this).find('.chatImg').height();
					if (height > 20) {
						$(this).css('padding-bottom', (height+18) +'px');
					}
					$(this).css('height', height+'px');
				}
			})

			var scrollHeight = $('#chat-messages')[0].scrollHeight;
			$('#chat-messages')[0].scrollTop = scrollHeight;
		})
    </script>

    <script type="text/javascript">
    	$(function(){
    		user_id = '{{$uid}}';
    		request = 0;
    		interval = 0;

    		// $('#textInput').keyup(function(){
    		// 	var val  = $(this).val();
    		// 	if (val == '') {
    		// 		$('#imageBtn').show();
    		// 		$('#sendBtn').hide();
    		// 	} else {
    		// 		$('#imageBtn').hide();
    		// 		$('#sendBtn').show();
    		// 	}
    		// });

    		// $('#textInput').change(function(){
    		// 	var val  = $(this).val();
    		// 	if (val == '') {
    		// 		$('#imageBtn').show();
    		// 		$('#sendBtn').hide();
    		// 	} else {
    		// 		$('#imageBtn').hide();
    		// 		$('#sendBtn').show();
    		// 	}
    		// });


    		var u = navigator.userAgent;
		    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
		    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

    		$('#textInput').focus(function(){
    			if (isiOS) {
    				interval = setInterval(function(){$('#textInput')[0].scrollIntoView(true);},50);
    				var val  = $('#textInput').val();
	    			if (val == '') {
	    				$('#imageBtn').show();
	    				$('#sendBtn').hide();
	    			} else {
	    				$('#imageBtn').hide();
	    				$('#sendBtn').show();
	    			}
    			}
    		})
    		$('#textInput').blur(function(){
    			if (isiOS) {
    				var val  = $('#textInput').val();
	    			if (val == '') {
	    				$('#imageBtn').show();
	    				$('#sendBtn').hide();
	    			} else {
	    				$('#imageBtn').hide();
	    				$('#sendBtn').show();
	    			}
    			}
    			clearInterval(interval);
    		})


    		// websocket

    		var ws = new WebSocket("ws://122.152.200.103:23465");
		    ws.onopen = function() {
		        // alert("连接成功");
		        var msg = new Object();
		        msg.type = 'u';
		        msg.uid = user_id;
		        msg.status = 'init';
		        ws.send(JSON.stringify(msg));
		    };
		    var sendBtn = document.getElementById('sendBtn');  
		    sendBtn.addEventListener('click', function() { 
		    	var val = $('#textInput').val().trim();
		    	if (val == '')
		    		return false;

		        var msg = new Object();
		        msg.type = 'u';
		        msg.uid = user_id;
		        msg.status = 'msg';
		        msg.content = val;
		        ws.send(JSON.stringify(msg));
		        // alert('发送'); 
		      
		    });  


		    /*发送图片*/
		    $('#sendPhoto').click(function(){
		    	var image = $('#imageUpload').attr('src');
		    	if (image == '') {
		    		return false;
		    	}

		    	var msg = new Object();
		        msg.type = 'u';
		        msg.uid = user_id;
		        msg.status = 'image';
		        msg.content = image;

		        ws.send(JSON.stringify(msg));

		        $('#showSweetAlert').slideUp(250);
		    })


		    ws.onmessage = function(e) {
		        // console.log("收到服务端的消息：" + e.data);
		        var data = e.data;
		        data = eval('('+data+')');
		        
		        if (data.type == 'a') {
		        	var right = '';
		        	var str1 = '';
		        	var str2 = 'chatData chatDataC';
		        	var strImage = '';
		        	
		        } else if (data.type == 'u') {
		        	var right = ' right';
					var str1 = ' style="background: #22AAE8;border-radius: 5px 0px 0px 5px;" ';
					var str2 = 'chatDataUser chatDataC';
					var strImage = "background: url(/front/lib/chat/img/bubble-cornerR2.png) 0 0 no-repeat;"
		        }

		        if (data.status == 'msg') {
	        		var str = '<div  class="message'+right+'" > <img  src="'+data.headimg+'" /> <div class="bubble" '+str1+'> <span class="'+str2+'">'+data.content+'</span> <div class="corner" style="'+strImage+'"></div> <span class="dateSpan">'+data.time+'</span> </div> </div>';
	        		$('#chat-messages').append(str);

	        		dealMessageHeight();
	        	} else if (data.status == 'image') {
	        		var str = '<div  class="message'+right+'" > <img  src="'+data.headimg+'" /> <div class="bubble" '+str1+'> <img class="chatImg" src="'+data.content+'" style="margin-left: 0px;margin-right: 0px;border-radius: 0px;width: 100%;min-width: 80px;"> <div class="corner" style="'+strImage+'"></div> <span class="dateSpan" style="position: absolute;">'+data.time+'</span> </div> </div>';
	        		$('#chat-messages').append(str);

	        		var img = new Image();
	        		img.src = data.content; 
					img.onload = function () { //图片下载完毕时异步调用callback函数。 
						dealMessageHeight();
					}; 
	        	}
	        	$('#textInput').val('');
	        	changeTextArea();
	        	$('#imageBtn').show();
    			$('#sendBtn').hide();
		    };
		    ws.onclose = function (event) {
			    console.log('已关闭');
			}

			$('#fileInput').change(function(){				
				showPreview();
			});
    	})

    	function dealMessageHeight() {
			var cdom = $('#chat-messages .message:last');
			if (cdom.find('.chatDataC').length == 1) {
				var height = cdom.find('.chatDataC')[0].offsetHeight;
				// console.log(height);
				if (height > 20) {
					cdom.css('padding-bottom', (height+18) +'px');
				}
				cdom.css('height', height+'px');
			} else if (cdom.find('.chatImg').length == 1) {
				var height = cdom.find('.chatImg').height();
				if (height > 20) {
					cdom.css('padding-bottom', (height+18) +'px');
				}
				cdom.css('height', height+'px');
			}

			var scrollHeight = $('#chat-messages')[0].scrollHeight;
			$('#chat-messages')[0].scrollTop = scrollHeight;
		}

		function dealMessageHeightTop() {
			$('#chat-messages .message:lt(5)').each(function(){
				if ($(this).find('.chatDataC').length == 1) {
					var height = $(this).find('.chatDataC')[0].offsetHeight;
					// console.log(height);
					if (height > 20) {
						$(this).css('padding-bottom', (height+18) +'px');
					}
					$(this).css('height', height+'px');
				} else if ($(this).find('.chatImg').length == 1) {
					var height = $(this).find('.chatImg').height();
					if (height > 20) {
						$(this).css('padding-bottom', (height+18) +'px');
					}
					$(this).css('height', height+'px');
				}
			})

			var scrollHeight = $('#chat-messages')[0].scrollHeight;
			$('#chat-messages')[0].scrollTop = scrollHeight;
		}

		function sendMessage() {
    		$('#textInput').val('');
    		changeTextArea();
    	}

    	function hideAlert() {
    		$('#showSweetAlert').slideUp(200);
    		$('#textInput')[0].focus();
    	}

    	function fileClick() {
			return $('#fileInput').click();
		}

		function showPreview(source) {  
            var file = document.getElementById('fileInput').files[0];
            var size = file.size;
            // if (size > 2097152) {
            if (size > 5242880) {
            	layer.open({
					content:'图片大于5M',
					skin:'msg',
					time:2
				});
            	return false;
            }

            if(window.FileReader) {  
                var fr = new FileReader();  
                fr.onloadend = function(e) {  
                	var src = e.target.result; 
                	if (src.substr(5,5) != 'image') {
                		layer.open({
							content:'您选择的不是图片...',
							skin:'msg',
							time:2
						});
                		return false;
                	} else {
                		$('#showSweetAlert').show();
                    	document.getElementById("imageUpload").src = e.target.result; 
                    }
                };  
                fr.readAsDataURL(file);
            }  
        }  
    </script>

    <script type="text/javascript">
		
	    var state = {};
	    // var temp = 0;

	    $(document).on('touchstart', '#chatview', function(e){
	    	state.dragable = true;
	        state.mouseX = e.originalEvent.changedTouches[0].pageX;
	        state.mouseY = e.originalEvent.changedTouches[0].pageY;
	    });


    	$('#chatview').bind('touchmove', function(e){
	    	// e.preventDefault();

	        if (state.dragable)
	        {
	            var x = e.originalEvent.changedTouches[0].pageX - state.mouseX;
	            var y = e.originalEvent.changedTouches[0].pageY - state.mouseY;


	            state.mouseX = e.originalEvent.changedTouches[0].pageX;
	            state.mouseY = e.originalEvent.changedTouches[0].pageY;

	            var scrollTop = $('#chat-messages')[0].scrollTop;
	            var top = parseInt($('#chat-messages').css('marginTop'));
	            if (scrollTop <= 0) {
	            	// e.preventDefault();
	            	if ((top+y) > 0) {
	            		e.preventDefault();
	            		$('#chat-messages').css('marginTop', top+y+'px');
	            		var refreshTop = parseInt($('#refresh').css('top'));
		            	if (refreshTop < 140)
		            		$('#refresh').css('top', refreshTop+(0.7*y)+'px');
		            	else
		            		request = 1;
	            	}
	            }
	        }
	    });

	    $('#imageSee').bind('touchmove', function(e) {
	    	e.preventDefault();
	    })


	    $(document).on('touchend', '#chatview', function(e){
    		state.dragable = false;
    		// $('#chat-messages').css('marginTop', '0px');
    		$('#refresh').css('top', '83px');
			var top = parseInt($('#chat-messages').css('marginTop'));
			if (top > 0) {
			 	// $('#chat-messages')[0].scrollTop = 0;
			 	$('#chat-messages').css('marginTop', '0px');
			}

			if (request == 1) {
				var time = $('#chat-messages .message:first').attr('time');
        		$.ajax({
        			url: '/front/chatting/getPrevMessage',
        			dataType: 'json',
        			type: 'post',
        			data: {
        				time: time,
        				uid: '{{$uid}}'
        			},
        			success: function(data) {
        				if (data.errcode == 0) {
        					var imageArr = new Array();
        					var obj = data.content;

        					var imageArr = new Array();

        					if (obj.length == 0) {
        						layer.open({
									content:'没有更多消息',
									skin:'msg',
									time:2
								});
        					}

        					for (var i in obj) {
        						var content = obj[i];
        						// console.log(content);

            					if (content.admin_id != '0') {
						        	var right = '';
						        	var headimg = content.aheadimg;
						        	
						        	var str1 = '';
						        	var str2 = 'chatData chatDataC';
						        	var strImage = '';
						        } else {
						        	var right = ' right';
									var headimg = content.uheadimg;

									var str1 = ' style="background: #22AAE8;border-radius: 5px 0px 0px 5px;" ';
									var str2 = 'chatDataUser chatDataC';
									var strImage = "background: url(/front/lib/chat/img/bubble-cornerR2.png) 0 0 no-repeat;"
						        }

						       	// var timeStr = content.time;

						        if (content.type == '0') {
					        		var str = '<div  class="message'+right+'" time="'+content.created_at+'" > <img  src="'+headimg+'" /> <div class="bubble" '+str1+'> <span class="'+str2+'">'+content.content+'</span> <div class="corner" style="'+strImage+'"></div> <span>'+content.created_at.slice(11)+'</span> </div> </div>';
					        		$('#chat-messages').prepend(str);

					        	} else if (content.type == 1) {
					        		var str = '<div  class="message'+right+'"  time="'+content.created_at+'" > <img  src="'+headimg+'" /> <div class="bubble '+str1+'"> <img class="chatImg" src="'+content.content+'" style="margin-left: 0px;margin-right: 0px;border-radius: 0px;width: 100%;min-width: 80px;"> <div class="corner" style="'+strImage+'"></div> <span style="position: absolute;">'+content.created_at.slice(11)+'</span> </div> </div>';
					        		$('#chat-messages').prepend(str);

					        		imageArr[i] = 1;
					        		// var img = new Image();
					        		// img.src = data.content;
					        		var img = document.getElementById('img'+i);   
								    img.setAttribute('src', content.content); 
									img.onload = function () { //图片下载完毕时异步调用callback函数。
										imageArr[i] = 1;
										
										// console.log(imageArr.length);
										if (imageArr.length >= 5) {
											dealMessageHeightTop();
											var height = 0;
			            					$('#chat-messages .message:lt(5)').each(function(){
			            						height += parseInt($(this).css('height'))+45;
			            					})

			            					request = 0;
			            					console.log(height);
			            					$('#chat-messages').scrollTop(height);
			            					// imageArr = [];
										}


									}; 
					        	}
					        }

					        if (imageArr.length < 1) {
					        	request = 0;
					        }

					        dealMessageHeightTop();
					        var height = 0;
        					$('#chat-messages .message:lt(5)').each(function(){
        						height += parseInt($(this).css('height'))+45;
        					})
					        $('#chat-messages').scrollTop(height);
        					
        				}
        			}
        		})
			}
    	})

	    $('#textInput').focus(function(){
	    	inter2 = setInterval(function(){
	    		changeTextArea();
	    	}, 30);
	    })

	    $('#textInput').blur(function(){
	    	clearInterval(inter2);
	    })

	    var state2 = {};


	    $(document).on('touchstart', '#textInput', function(e){
	    	state2.dragable = true;
	        state2.mouseX = e.originalEvent.changedTouches[0].pageX;
	        state2.mouseY = e.originalEvent.changedTouches[0].pageY;
	    });

	    $('#textInput').bind('touchmove', function(e){
	    	if (state2.dragable) {
	    		var x = e.originalEvent.changedTouches[0].pageX - state2.mouseX;
	            var y = e.originalEvent.changedTouches[0].pageY - state2.mouseY;


	            state2.mouseX = e.originalEvent.changedTouches[0].pageX;
	            state2.mouseY = e.originalEvent.changedTouches[0].pageY;

		    	var top = $('#textInput')[0].scrollTop;
		    	// console.log(top);
		    	if (top <= 0 && y > 0) {
		    		e.preventDefault();
		    	}
		    }
	    })

    	function changeTextArea() {
    		// var height = $('#textInput')[0].scrollHeight;
    		var width = $('#textInput').width();
    		// console.log(width);
    		// var row = (height-3)/19;
    		
    		// console.log(document.getElementById("textInput").value.indexOf("\n"));
    		var value = document.getElementById("textInput").value;
    		var hang = 0;

    		if (value.length <= 0) {
    			$('#imageBtn').show();
    			$('#sendBtn').hide();
    		} else {
    			$('#imageBtn').hide();
    			$('#sendBtn').show();
    		}

    		for (var i = 0,j = 0; i < value.length+1; i++) {
    			var str = value.substring(j, i);
    			$('#textInputSpan').html(str);
    			var ww = $('#textInputSpan').width();
    			
    			if (ww > width) {
    				j = i-1;
    				hang ++;
    			}

    			if (value[i] == '\n') {
    				j = i+1;
    				hang++;
    			}
    		}

    		hang++;

    		height = hang*19+3;
    		if (hang >6) {
	    		height = 19*6+3;
	    	} else if (hang <= 2){
				height = 19*2+3;
	    	}
	    	var outHeight = height+9;
    		$('#sendmessage').css('height', outHeight+'px');
    		$('#textInput').css('height', height+'px');
    	}
    </script>
  </body>
</html>