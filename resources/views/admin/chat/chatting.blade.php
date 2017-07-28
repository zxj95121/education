@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/front/lib/chat/css/normalize.css">
<link rel="stylesheet" type="text/css" href="/front/lib/chat/css/default.css">
<link rel="stylesheet" type="text/css" href="/front/lib/chat/css/styles.css">
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
</style>
@endsection

@section('content')
<div class="wraper container-fluid">

    <div id="portlet2" class="panel-collapse collapse in"  style="position: relative;width: 100%;">
    	<div class="contentW">
	        <div class="portlet-body" id="content">

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
			             <div id="headimg">
			             	<img src="/front/lib/chat/img/1_copy.jpg" style="width: 100%;height: 100%;">
			             </div>
			            <p>Miro Badev</p>
			            <!-- <span>miro@badev@gmail.com</span> -->
			        </div>
			        
			        <div id="chat-messages" style="position: relative;">
			        	
			          	<label>Thursday 02</label>
			          	@foreach ($content as $value)
			          		@if ($value['type'] == 0)
					            <div @if($value['admin_id']) class="message right" @else class="message" @endif>
					              <img @if($value['admin_id']) src="{{$value['aheadimg']}}" @else src="{{$value['uheadimg']}}" @endif" />
					                <div class="bubble">
					                  	<span class="chatData">{{$value['content']}}</span>
					                    <div class="corner"></div>
					                    <span>{{date('H:i:s', strtotime($value['created_at']))}}</span>
					                </div>
					            </div>
					        @elseif($value['type'] == 1)
						        <div @if($value['admin_id']) class="message right" @else class="message" @endif>
					            	<img @if($value['admin_id']) src="{{$value['aheadimg']}}" @else src="{{$value['uheadimg']}}" @endif" />
					                <div class="bubble">
					                	<img class="chatImg" src="{{$value['content']}}" style="margin-left: 0px;margin-right: 0px;border-radius: 0px;width: 100%;min-width: 80px;">
					                    <div class="corner"></div>
					                    <span style="position: absolute;">{{date('H:i:s', strtotime($value['created_at']))}}</span>
					                </div>
					            </div>
					        @else
					        @endif
			            @endforeach

			        </div>
			       
			        <div id="sendmessage" class="">
			          <input type="text" id="textInput" value="" placeholder="" />
			            <button id="sendBtn" style="display: none;"><img src="/images/square-send.png" style="width: 100%;height: 100%;"></button>
			            <button id="imageBtn"><img src="/images/square-image.png" style="width: 100%;height: 100%;"></button>
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
		})
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
		        msg.type = 'u';
		        msg.uid = user_id;
		        msg.aid = admin_id;
		        msg.status = 'msg';
		        msg.content = val;
		        // ws.send(JSON.stringify(msg));
		        // alert('发送');  
		      
		    }); 
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
			    		}
			    	}
			    }
			}
		    ws.onmessage = function(e) {
		        console.log("收到服务端的消息：" + e.data);
		    };
		    ws.onclose = function (event) {
			    console.log('已关闭');
			}
    	})
    </script>

    <script type="text/javascript">

     	var state = {};

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
	            		// $('#refresh').css('top', '83px');
	            		// $('#chat-messages').css('marginTop', '0px');
            		}
	            }
            }
	    }


    	// $('#chatview').bind('touchmove', function(e){
	    // 	// e.preventDefault();

	    //     if (state.dragable)
	    //     {
	    //         var x = e.originalEvent.changedTouches[0].pageX - state.mouseX;
	    //         var y = e.originalEvent.changedTouches[0].pageY - state.mouseY;


	    //         state.mouseX = e.originalEvent.changedTouches[0].pageX;
	    //         state.mouseY = e.originalEvent.changedTouches[0].pageY;

	    //         var scrollTop = $('#chat-messages')[0].scrollTop;
	    //         var top = parseInt($('#chat-messages').css('marginTop'));
	    //         if (scrollTop <= 0) {
	    //         	// e.preventDefault();
	    //         	if ((top+y) > 0) {
	    //         		e.preventDefault();
	    //         		$('#chat-messages').css('marginTop', top+y+'px');
	    //         		var refreshTop = parseInt($('#refresh').css('top'));
		   //          	if (refreshTop < 140)
		   //          		$('#refresh').css('top', refreshTop+(0.7*y)+'px');
	    //         	}
	    //         }
	    //     }
	    // });


	    // $(document).on('touchend', '#chatview', function(e){
    	// 	state.dragable = false;
    	// 	// $('#chat-messages').css('marginTop', '0px');
    	// 	$('#refresh').css('top', '83px');
    	// 	 var top = parseInt($('#chat-messages').css('marginTop'));
    	// 	 if (top > 0) {
    	// 	 	// $('#chat-messages')[0].scrollTop = 0;
    	// 	 	$('#chat-messages').css('marginTop', '0px');
    	// 	 	$('#refresh').css('top', '83px');
    	// 	 }
    	// })
    </script>
@endsection