<?php 
function emoji_decode($str){
    $strDecode = preg_replace_callback('|\[\[EMOJI:(.*?)\]\]|', function($matches){  
        return rawurldecode($matches[1]);
    }, $str);

    return $strDecode;
} 
?>
@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/front/lib/chat/css/normalize.css">
<link rel="stylesheet" type="text/css" href="/front/lib/chat/css/default.css">
<link rel="stylesheet" type="text/css" href="/front/lib/chat/css/styles.css">
<meta name="csrf-token" content="{{csrf_token()}}">
<style type="text/css">
	.contentW{
		max-width: 800px;
		margin: 0 auto;
		position: relative;
	}
	#content{
		background: #FFF;
		position: absolute;
		z-index: 33;
		width: 100%;
		margin: 0 auto;
	}
	.sendError{
		border-color: #a94442;
	    -webkit-box-shadow: inset 2 2px 2px rgba(245,188,18,0.9);
	    box-shadow: inset 2px 2px 2px rgba(245,188,18,0.9);
	}
	.chatImg{
		max-width: 450px;
	}
	.chatData{
		font-weight: normal;
	}
	.bubble span:last-child{
		font-weight: normal;
	}
	.content{
		background: #F1F4F5;
		height: 1080px;
	}
</style>
@endsection

@section('content')
<div class="wraper container-fluid">

    <div id="portlet2" class="panel-collapse collapse in"  style="position: relative;width: 100%;">
    	<div class="contentW">

    		<!-- 弹框 -->
    		<div id="showSweetAlert" class="sweet-alert showSweetAlert visible" tabindex="-1" data-custom-class="" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-ouside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="/*display: block;*/z-index: 322; margin-top: 200px;position: absolute;background: #E3E3E3;">
    			<!-- <div class="sa-icon sa-error" style="">
    				<span class="sa-x-mark">
    					<span class="sa-line sa-left"></span>
    					<span class="sa-line sa-right"></span>
    				</span>
    			</div> -->
    			<!-- <div class="sa-icon sa-warning" style="display: none;"> 
    				<span class="sa-body"></span> 
    				<span class="sa-dot"></span>
    			</div> 
    			<div class="sa-icon sa-info" style="display: none;">
    				
    			</div> 
    			<div class="sa-icon sa-success" style="display: none;"> 
	    			<span class="sa-line sa-tip"></span> 
	    			<span class="sa-line sa-long"></span> 
	    			<div class="sa-placeholder"></div> 
	    			<div class="sa-fix"></div> 
    			</div>  -->
    			<div class="" style="width: 100%; display: block;margin: 0 auto;text-align: center;">
    				<img id="imageUpload" src="" style="max-width: 444px;">
    			</div> 
    			<!-- <h2>Here's a message!</h2> -->
    			<!-- <p style="display: block;"></p> -->
    			<button class="cancel" tabindex="2" style="display: inline-block; box-shadow: none;" onclick="hideAlert();">取消</button>
    			<button class="cancel" tabindex="2" style="display: inline-block; background-color: rgb(49, 85, 188); box-shadow: none;" onclick="fileClick();">更换图片</button>
    			<button class="confirm" tabindex="1" id="sendPhoto" style="display: inline-block; background-color: rgb(174, 222, 244); box-shadow: rgba(174, 222, 244, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">发送图片</button>
    		</div>



	        <div class="portlet-body" id="content">

	        	<img src="" id="img0" style="display: none;">
	        	<img src="" id="img1" style="display: none;">
	        	<img src="" id="img2" style="display: none;">
	        	<img src="" id="img3" style="display: none;">
	        	<img src="" id="img4" style="display: none;">
	        	<!-- 复制开始 -->
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
			            <div class="usertype" style="position: absolute;top:15px;left:10px;height:30px;line-height: 30px;color:#FFF;font-size: 25px;">
			            	@if($userInfo->type) 系统用户 @else 未注册 @endif
			            </div>
			            <div id="headimg">
			            	<img src="{{$userInfo->headimg}}" style="width: 100%;height: 100%;">
			            </div>
			            <p>{{$userInfo->nickname}}</p>
			            <!-- <span>miro@badev@gmail.com</span> -->
			        </div>
			        
			        <div id="chat-messages" style="position: relative;padding-top: 12px;">
			        	
			          	@foreach ($content as $value)
			          		@if ($value['type'] == 0)
					            <div @if($value['admin_id']) class="message right" @else class="message" @endif time="{{$value['created_at']}}">
					              <img @if($value['admin_id']) src="{{$value['aheadimg']}}" @else src="{{$value['uheadimg']}}" @endif" />
					                <div class="bubble">
					                  	<span class="chatData">{{emoji_decode($value['content'])}}</span>
					                    <div class="corner"></div>
					                    <span>{{date('m-d H:i:s', strtotime($value['created_at']))}}</span>
					                </div>
					            </div>
					        @elseif($value['type'] == 1)
						        <div @if($value['admin_id']) class="message right" @else class="message" @endif time="{{$value['created_at']}}">
					            	<img @if($value['admin_id']) src="{{$value['aheadimg']}}" @else src="{{$value['uheadimg']}}" @endif" />
					                <div class="bubble">
					                	<img class="chatImg" src="{{$value['content']}}" style="margin-left: 0px;margin-right: 0px;border-radius: 0px;width: 100%;min-width: 80px;">
					                    <div class="corner"></div>
					                    <span style="position: absolute;">{{date('m-d H:i:s', strtotime($value['created_at']))}}</span>
					                </div>
					            </div>
					        @else
					        @endif
			            @endforeach

			        </div>
			       
			        <div id="sendmessage" class="">
			          	<input type="text" id="textInput" value="" placeholder="" />
			          	<input type="file" id="fileInput" style="display: none;" name="file" accept="image/jpg,image/jpeg,image/png,image/gif">
			            <button id="sendBtn" style="display: none;"><img src="/images/square-send.png" style="width: 100%;height: 100%;"></button>
			            <button id="imageBtn" onclick="fileClick();"><img src="/images/square-image.png" style="width: 100%;height: 100%;"></button>
			        </div>  
			    </div>
			    <!-- 复制结束 -->

	        </div>
	    </div>
    </div>

</div>


@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript">
    $(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#computer_footer').hide();

        var height = $('#leftAside').height();
        var nh = height-100;
        $('#content').css('height', nh+'px');

    })
</script>


    <script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/json2.js"></script>


    <script type="text/javascript">

		$(window).load(function(){

			$('.content').css('height', $('#leftAside').css('height'));

			var height = $('#chatview').height();
			var h1 = $('#profile').height();
			var h2 = $('#sendmessage').height();
			$('#chat-messages').css('height', height-h1-h2+'px');

			/*input*/
			var sendmessageHeight = $('#sendmessage').width();
			$('#textInput').css('width', sendmessageHeight-75+'px');


			$('#chat-messages .message').each(function(){
				// var height = $(this).child()
				// console.log(index);
				if ($(this).find('.chatData').length == 1) {
					var height = $(this).find('.chatData')[0].offsetHeight;
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

		function dealMessageHeight() {
			var cdom = $('#chat-messages .message:last');
			if (cdom.find('.chatData').length == 1) {
				var height = cdom.find('.chatData')[0].offsetHeight;
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
				if ($(this).find('.chatData').length == 1) {
					var height = $(this).find('.chatData')[0].offsetHeight;
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
    </script>

    <script type="text/javascript">
    	$(function(){
    		$('#textInput').keyup(function(){
    			var val  = $(this).val();
    			if (val == '') {
    				$('#imageBtn').show();
    				$('#sendBtn').hide();
    			} else {
    				$('#imageBtn').hide();
    				$('#sendBtn').show();
    			}
    		});

    		admin_id = '{{$admin_id}}';
    		user_id = '{{$user_id}}';

    		// websocket

    		var ws = new WebSocket("ws://122.152.200.103:23465");
		    ws.onopen = function() {
		        // alert("连接成功");
		        var msg = new Object();
		        msg.type = 'a';
		        msg.aid = admin_id;
		        msg.uid = user_id;
		        msg.status = 'init';
		        ws.send(JSON.stringify(msg));
		        // alert("给服务端发送一个字符串：tom");
		    };
		    var sendBtn = document.getElementById('sendBtn');  
		    sendBtn.addEventListener('click', function() { 
		    	var val = $('#textInput').val();
		        // var dd = new Date();
		        // var val = document.getElementById('chat').value;
		        // var content = dd.getHours()+':'+dd.getMinutes()+':'+dd.getSeconds();
		        var msg = new Object();
		        msg.type = 'a';
		        msg.uid = user_id;
    			msg.aid = admin_id;
		        msg.status = 'msg';
		        msg.content = val;

		       	ws.send(JSON.stringify(msg));

		       	sendMessage();
		    }); 

		    /*发送图片*/
		    $('#sendPhoto').click(function(){
		    	var image = $('#imageUpload').attr('src');
		    	if (image == '') {
		    		return false;
		    	}

		    	var msg = new Object();
		        msg.type = 'a';
		        msg.uid = user_id;
		        msg.aid = admin_id;
		        msg.status = 'image';
		        msg.content = image;

		        ws.send(JSON.stringify(msg));

		        $('#showSweetAlert').hide(300);
		    })

		    /*enter发送消息*/ 
		    document.onkeydown = function(e){ 
			    var ev = document.all ? window.event : e;
			    if(ev.keyCode==13) {
			    	if (document.activeElement == document.getElementById('textInput')) {
			    		var content = $('#textInput').val();
			    		if (content == '') {
			    			$('#sendmessage').addClass('sendError');
			    			setTimeout(function(){$('#sendmessage').removeClass('sendError');}, 800);
			    		} else {
			    			var msg = new Object();
					        msg.type = 'a';
					        msg.uid = user_id;
		        			msg.aid = admin_id;
					        msg.status = 'msg';
					        msg.content = content;

					       	ws.send(JSON.stringify(msg));

					       	sendMessage();
			    		}
			    	}
			    }
			}
		    ws.onmessage = function(e) {
		        // console.log("收到服务端的消息：" + e.data);
		        var data = e.data;
		        data = eval('('+data+')');
		        
		        if (data.type == 'a') {
		        	var right = ' right';
		        	
		        } else if (data.type == 'u') {
		        	var right = '';
		
		        }

		        if (data.status == 'msg') {
	        		var str = '<div  class="message'+right+'" > <img  src="'+data.headimg+'" /> <div class="bubble"> <span class="chatData">'+data.content+'</span> <div class="corner"></div> <span>'+data.time+'</span> </div> </div>';
	        		$('#chat-messages').append(str);

	        		dealMessageHeight();
	        	} else if (data.status == 'image') {
	        		var str = '<div  class="message'+right+'" > <img  src="'+data.headimg+'" /> <div class="bubble"> <img class="chatImg" src="'+data.content+'" style="margin-left: 0px;margin-right: 0px;border-radius: 0px;width: 100%;min-width: 80px;"> <div class="corner"></div> <span style="position: absolute;">'+data.time+'</span> </div> </div>';
	        		$('#chat-messages').append(str);

	        		var img = new Image();
	        		img.src = data.content; 
					img.onload = function () { //图片下载完毕时异步调用callback函数。 
						dealMessageHeight();
					}; 
	        	}
		    };
		    ws.onclose = function (event) {
			    window.location.reload();
			}


			$('#fileInput').change(function(){				
				showPreview();
			});


    	})

    	function sendMessage() {
    		$('#textInput').val('');
    	}

    	function hideAlert() {
    		$('#showSweetAlert').hide(250);
    	}

    	function fileClick() {
			return $('#fileInput').click();
		}

		function showPreview(source) {  
            var file = document.getElementById('fileInput').files[0];
            var size = file.size;
            // if (size > 2097152) {
            if (size > 8291456) {
            	window.layer.msg('您选择的图片过大！');
            	return false;
            }

            if(window.FileReader) {  
                var fr = new FileReader();  
                fr.onloadend = function(e) {  
                	var src = e.target.result; 
                	if (src.substr(5,5) != 'image') {
                		window.layer.msg('您选择的不是图片');
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
     	var request = 0;/*0表示不在请求，1表示正在请求*/

        state.scrollY = $('#chat-messages')[0].scrollTop;

    	var scrollFunc = function (e) {  
	        e = e || window.event;  
	        if (e.wheelDelta) {  //判断浏览器IE，谷歌滑轮事件               
	            if (e.wheelDelta > 0) { //当滑轮向上滚动时  
	                doCheckPosition(e);
	            }  
	            if (e.wheelDelta < 0) { //当滑轮向下滚动时  
	                // alert("滑轮向下滚动");  
	                $('#refresh').css('top', '83px');
	            	$('#chat-messages').css('marginTop', '0px');
	            }  
	        } else if (e.detail) {  //Firefox滑轮事件  
	            if (e.detail> 0) { //当滑轮向上滚动时  
	                doCheckPosition(e);
	            }  
	            if (e.detail< 0) { //当滑轮向下滚动时  
	                // alert("滑轮向下滚动");  
	                $('#refresh').css('top', '83px');
	            	$('#chat-messages').css('marginTop', '0px');
	            }  
	        }  
	    }  
	    //给页面绑定滑轮滚动事件  
	    if (document.addEventListener) {//firefox  
	        document.addEventListener('DOMMouseScroll', scrollFunc, false);  
	    }  
	    //滚动滑轮触发scrollFunc方法  //ie 谷歌  
	    window.onmousewheel = document.onmousewheel = scrollFunc; 



	    function doCheckPosition(e){
	    	var scrollTop = $('#chat-messages')[0].scrollTop;
            var top = parseInt($('#chat-messages').css('marginTop'));
            if (scrollTop <= 0) {
            	// e.preventDefault();
            	y = 6;
            	if ((top+y) > 0) {
            		e.preventDefault();
            		
            		var refreshTop = parseInt($('#refresh').css('top'));
	            	if (refreshTop < 135) {
	            		$('#refresh').css('top', refreshTop+y+'px');
	            		$('#chat-messages').css('marginTop', top+(1.6*y)+'px');
	            	}
	            	else {
	            		if (request == 0) {
		            		request = 1;/*将request变成正在请求*/

		            		var time = $('#chat-messages .message:first').attr('time');
		            		$.ajax({
		            			url: '/admin/chatting/getPrevMessage',
		            			dataType: 'json',
		            			type: 'post',
		            			data: {
		            				time: time,
		            				uid: '{{$user_id}}'
		            			},
		            			success: function(data) {
		            				if (data.errcode == 0) {
		            					var imageArr = new Array();
		            					var obj = data.content;

		            					var imageArr = new Array();

		            					if (obj.length == 0) {
		            						window.layer.msg('没有更多消息');
		            					}

		            					for (var i in obj) {
		            						var content = obj[i];
		            						// console.log(content);

			            					if (content.admin_id != '0') {
									        	var right = ' right';
									        	var headimg = content.aheadimg;
									        	
									        } else {
									        	var right = '';
												var headimg = content.uheadimg;
									        }

									       	// var timeStr = content.time;

									        if (content.type == '0') {
								        		var str = '<div  class="message'+right+'" time="'+content.created_at+'" > <img  src="'+headimg+'" /> <div class="bubble"> <span class="chatData">'+content.content+'</span> <div class="corner"></div> <span>'+content.created_at.slice(5)+'</span> </div> </div>';
								        		$('#chat-messages').prepend(str);

								        	} else if (content.type == 1) {
								        		var str = '<div  class="message'+right+'"  time="'+content.created_at+'" > <img  src="'+headimg+'" /> <div class="bubble"> <img class="chatImg" src="'+content.content+'" style="margin-left: 0px;margin-right: 0px;border-radius: 0px;width: 100%;min-width: 80px;"> <div class="corner"></div> <span style="position: absolute;">'+content.created_at.slice(5)+'</span> </div> </div>';
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
						            					$('#chat-messages')[0].scrollTop = height;
						            					// imageArr = [];
													}


												}; 
								        	}
								        }

								        if (imageArr.length < 1) {
								        	request = 0;
								        }
								        $('#refresh').css('top', '83px');
	            						$('#chat-messages').css('marginTop', '0px');
		            					
		            				}
		            			}
		            		})
		            	}
	            		
            		}
	            }
            }
	    }

    </script>
@endsection