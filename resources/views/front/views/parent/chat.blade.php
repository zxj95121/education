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

    <link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" type="text/css" href="/front/lib/chat/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/front/lib/chat/css/default.css">
    <link rel="stylesheet" type="text/css" href="/front/lib/chat/css/styles.css">

    <style type="text/css">
    </style>

  </head>
  <body>
    <div class="page-group" style="background:#fff">
        <div class="page page-current">
		    <!-- <header class="bar bar-nav">
		    	<a class="button button-link button-nav pull-left" onclick="window.location.href='/front/home/oauth';" data-transition="slide-out" style="color:#fff">
	      			<span class="icon icon-left"></span>返回
	    		</a>
			 	<h1 class='title' style="background: #22AAE8;color: #fff;">客服沟通</h1>
			</header> -->
			<div class="content" style="background: #D6D6D6;">
				    <div id="chatview" class="p1" style="width:100%;height:100%;">      
				        <div id="profile" style="background: #22AAE8;">
				 
				            <div id="close">
				                <!-- <div class="cy"></div>
				                <div class="cx"></div> -->
				                <img src="/images/arrow-left.png" style="width: 100%;height: 100%;">
				            </div>
				             <div id="headimg">
				             	<img src="/front/lib/chat/img/1_copy.jpg" style="width: 100%;height: 100%;">
				             </div>
				            <p>Miro Badev</p>
				            <!-- <span>miro@badev@gmail.com</span> -->
				        </div>
				        
				        <div id="chat-messages">
				          	<label>Thursday 02</label>

				            <div class="message">
				              <img src="/front/lib/chat/img/1_copy.jpg" />
				                <div class="bubble">
				                  	<span>Really cool stuff!</span>
				                    <div class="corner"></div>
				                    <span>3 min</span>
				                </div>
				            </div>

				            <div class="message right">
				            	<img src="/front/lib/chat/img/2_copy.jpg">
				                <div class="bubble">
				                	<span>Can you share a link for the tutorial?</span>
				                    <div class="corner"></div>
				                    <span>1 min</span>
				                </div>
				            </div>

				            <div class="message right">
				            	<img src="/front/lib/chat/img/2_copy.jpg">
				                <div class="bubble">
				                	<span>Can you share a link for the tutorial?</span>
				                    <div class="corner"></div>
				                    <span>1 min</span>
				                </div>
				            </div>
				            <div class="message right">
				            	<img src="/front/lib/chat/img/2_copy.jpg">
				                <div class="bubble">
				                	<span>Can you share a link for the tutorial?</span>
				                    <div class="corner"></div>
				                    <span>1 min</span>
				                </div>
				            </div>
				            <div class="message right">
				            	<img src="/front/lib/chat/img/2_copy.jpg">
				                <div class="bubble">
				                	<span>Can you share a link for the tutorial?</span>
				                    <div class="corner"></div>
				                    <span>1 min</span>
				                </div>
				            </div>
				            <div class="message right">
				            	<img src="/front/lib/chat/img/2_copy.jpg">
				                <div class="bubble">
				                	<span>Can you share a link for the tutorial?</span>
				                    <div class="corner"></div>
				                    <span>1 min</span>
				                </div>
				            </div>
				            <div class="message right">
				            	<img src="/front/lib/chat/img/2_copy.jpg">
				                <div class="bubble">
				                	<span>Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?Can you share a link for the tutorial?</span>
				                    <div class="corner"></div>
				                    <span>1 min</span>
				                </div>
				            </div>

				        </div>
				       
				        <div id="sendmessage">
				          <input type="text" value="Send message..." />
				            <button id="send"><img src="/images/square-send.png" style="width: 100%;height: 100%;"></button>
				        </div>  
				    </div>
			</div>
        </div>
    </div>

    <script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>


    <script type="text/javascript">
    	Zepto(function($){
			var height = $('#chatview').height();
			var h1 = $('#profile').height();
			var h2 = $('#sendmessage').height();
			$('#chat-messages').css('height', height-h1-h2+'px');

			$('#chat-messages .message').each(function(){
				this.css('height', this.find('.corner').height()+'px')
			})
		})

		function autoHeight(){
			$('#chat-messages .message').last().css('height', $('#chat-messages .message').last().find('.corner').height()+'px');
		}
    </script>
  </body>
</html>