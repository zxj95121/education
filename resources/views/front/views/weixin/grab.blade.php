<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>加辰教育定制</title>
		<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">
	</head>
	<body>
		<table>
			<tr>
				<th>活动名称</th>
				<th>开始时间</th>
			</tr>
			<tr>
				<td>{{$res->name}}</td>
				<td>{{$res->start_time}}</td>
			</tr>
		</table>
		@if($lucky != '')
			<table id="t2">
				<tr><th>中奖名单</th></tr>
				@foreach($lucky as $value)
				<tr><td>{{$value->nickname}}</td></tr>
				@endforeach
			</table>
		@endif
		<button id="join" val="{{$res->id}}">参加活动</button>
		<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
		<script>
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': '{{csrf_token()}}'
	            }
	        });
			$('#join').click(function(){
				$.ajax({
					url: '/front/grab/join',
					type: 'post',
					data:{
						'id':$('#join').attr('val')
						},
					datatype: 'json',
					success: function(data){
						if(data.code != -1){
							alert(data.msg);
						}else{
							alert('还没填写手机号');
						}						
					}
				})
			})
			$code = {{$code}};
			if($code == 233){
				var timer = setInterval(function(){
					$.ajax({
						url:'/front/grab/countdown',
						data:{
							id:{{$res->id}}
						},
						type:'post',
						datatype:'json',
						success:function(data){
							var text = '';
							text += '<tr><th>中奖名单</th></tr>';
							console.log(data.length);
							console.log(data[0].name);
							for(var i = 0; i < data.length; i++){
								text += "<tr><td>"+data[i].name+"</td></tr>";
							}
							$('#t2').html(text);
							console.log(data.lucky);
							if(data.code = 200){
								clearInterval(timer);
							}
						}
					})
				},1000)
			}
		</script>
	</body>
</html>