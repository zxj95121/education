<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>加辰教育</title>
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
		    	<a class="button button-link button-nav pull-left" href="/front/home" data-transition="slide-out" style="color:#fff">
	      			<span class="icon icon-left"></span>返回
	    		</a>
	    		<a id="delete" class="button button-link button-nav pull-right" href="#" data-transition="slide-out" style="color:#fff">
	      			删除
	    		</a>
			 	<h1 class='title' style="background: #22AAE8;color: #fff;">修改我的孩子</h1>
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
			              				<input type="text" name="name" placeholder="名称" value="{{$res->name}}">
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
			              					<option value="1" @if($res->sex == 1) selected="selected" @endif>男</option>
			              					<option value="0" @if($res->sex == 0) selected="selected" @endif>女</option>
			              				</select>
			            			</div>
			       				</div>
			        		</div>
			    		</li>
			    	</ul>
				</div>
				<div class="content-block" style="margin-top:20px">
					<div class="row">
						<input type="hidden" name="childid" value="{{$res->id}}">
						<div class="col-100"><a href="#" class="button button-big button-fill button-success">修改</a></div>
					</div>
				</div>
			</div>
        </div>
    </div>
    <script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
  	<script>
  		var ajax =false;

	    $(document).on('click','.button-success',function(){
			var name = $('input[name=name]').val();
			var sex = $('select[name=sex]').val();
			if(name.length > 4){
				$.toast("名字最长输入4字符");
				return false;
			}else if(name.length <= 1){
				$.toast('名字长度输入不正确');
				return false;
			}
			var reg = /^[\u4E00-\u9FA5]+$/; 
			if(!reg.test(name)){
				$.toast('名字格式输入不正确');
				return false;
			}
			if (!ajax) {
				ajax = true;
				$.ajax({
					headers:{
						'X-CSRF-TOKEN': '{{csrf_token()}}'
					},	
					type:'post',
					url:'/front/child/editPost',
					data:{
						id:$('input[name="childid"]').val(),
						name:name,
						sex:sex
					},
					success:function(date){
						if(date.code == 200){
							$.toast('修改成功');
							$('.button-success').replaceWith('<a href="#" class="button button-big button-fill button-danger">已完成</a>')
							setTimeout(function(){
								window.location.href="/front/home";
							},500);

							ajax = false;
						} else {
							ajax = false;
						}
					},
					error: function(data) {
						ajax = false;
					}
				})
			}
		})
		$('#delete').click(function(){
			$.ajax({
				headers:{
					'X-CSRF-TOKEN': '{{csrf_token()}}'
				},	
				type:'post',
				url:'/front/child/delete',
				data:{
					id:$('input[name="childid"]').val(),
				},
				success:function(date){
					if(date.code == 200){
						$.toast('删除成功');
						setTimeout(function(){
							window.location.href="/front/home";
						},500);
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