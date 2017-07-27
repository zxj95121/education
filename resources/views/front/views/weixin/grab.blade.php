<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>加辰教育定制</title>
		<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">
	</head>
	<body>
		<button id="join">参加活动</button>
		<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
		<script>
			$('#join').click(function(){
				$.ajax({
					url: '/front/grab/join',
					type: 'post',
					datype: 'json',
					success: function(data){
						alert(data.msg);
					}
				})
			})
		</script>
	</body>
</html>