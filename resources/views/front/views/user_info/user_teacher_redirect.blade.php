<!DOCTYPE html>
<html>
<head>
<title></title>
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
<link rel="stylesheet" href="/js/jquery-mobile/jquery.mobile-1.4.5.css">
<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
<script src="/js/jquery-mobile/jquery.mobile-1.4.5.js"></script>
</head>
<body>

	<div data-role="page" data-theme="b">
	 	<div data-role="content" data-theme="b">
	    	<form method="post" action="demoform.asp" data-theme="b">
	      		<fieldset data-role="fieldcontain" data-theme="b">
	        		<label for="day">选择身份</label data-theme="b">
	        		<select name="day" id="day" data-theme="b">
	         			<option value="sat" data-theme="b">大学生教师</option>
	         			<option value="sun" data-theme="b">职业教师</option>
	        		</select>
	      		</fieldset>
	      		<input type="submit" data-inline="true" value="提交" data-theme="b">
	    	</form>
	  	</div>
	</div>

</body>
</html>
