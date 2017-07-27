<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>加辰教育定制</title>
		<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">
	</head>
	<body>
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
						'id':$('#join').attr('val');
						},
					datype: 'json',
					success: function(data){
						if(data.code != -1){
							alert(data.msg);
						}else{
							alert('还没填写手机号');
						}						
					}
				})
			})
		</script>
	</body>
</html>