<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>添加我的孩子</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">

  </head>
  <body>
    <div class="page-group" style="background:#fff">
        <div class="page page-current">
		    <header class="bar bar-nav">
			 	<h1 class='title' style="background: #22AAE8;color: #fff;">添加我的孩子</h1>
			</header>
			<div class="content">
			  	<div class="list-block" style="margin-top: 0px;margin-bottom: 20px;">
			    	<ul>
			     		<li class="align-top">
			        		<div class="item-content">
			          			<div class="item-media"><i class="icon icon-form-name"></i></div>
			          			<div class="item-inner">
			            			<div class="item-title label">姓名</div>
			            			<div class="item-input">
			              				<input type="text" name="name" placeholder="名称">
			            			</div>
			       				</div>
			        		</div>
			    		</li>
			    		<li class="align-top">
			        		<div class="item-content">
			          			<div class="item-media"><i class="icon icon-form-gender"></i></div>
			          			<div class="item-inner">
			            			<div class="item-title label">性别</div>
			            			<div class="item-input">
			              				<select name="sex">
			              					<option value="1">男</option>
			              					<option value="0">女</option>
			              				</select>
			            			</div>
			       				</div>
			        		</div>
			    		</li>
			    	</ul>
				</div>
				<div class="content-block" style="margin-top:20px">
					<div class="row">
						<div class="col-50"><a href="#" class="button button-big button-fill button-danger">取消</a></div>
						<div class="col-50"><a href="#" class="button button-big button-fill button-success">提交</a></div>
					</div>
				</div>
			</div>
        </div>
    </div>
    <script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
  	<script>
	    $(document).on('click','.button-success',function(){
			var name = $('input[name=name]').val();
			var sex = $('select[name=sex]').val();
			if(name.length > 4){
				$.toast("名字最长输入4字符");
				return false;
			}else if(name.length < 1){
				$.toast('还没输入名字呢');
				return false;
			}
			$.ajax({
				headers:{
					'X-CSRF-TOKEN': '{{csrf_token()}}'
				},	
				type:'post',
				url:'/front/child/post',
				data:{
					name:name,
					sex:sex
				},
				success:function(date){
					if(date.code == 200){
						$.toast('添加成功');
						setTimeout(function(){
							window.location.href="/front/home";
						},2000);
					}
				}
			})		
		})
		$(document).on('click','.button-danger',function(){
			window.location.href = '/front/home	';
		})
  	</script>
  </body>
</html>