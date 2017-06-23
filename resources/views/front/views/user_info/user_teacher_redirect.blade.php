<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="/js/jquery-mobile/jquery.mobile-1.4.5.css">
<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
<script src="/js/jquery-mobile/jquery.mobile-1.4.5.js"></script>
</head>
<body>

	<div data-role="page">
  		<div data-role="header">
  			<h1>选择菜单</h1>
  		</div>

	 	<div data-role="content" data-theme="b">
	    	<form method="post" action="demoform.asp">
	      		<fieldset data-role="fieldcontain">
	        		<label for="day">选择身份</label>
	        		<select name="day" id="day">
	         			<option value="sat">大学生教师</option>
	         			<option value="sun">职业教师</option>
	        		</select>
	      		</fieldset>
	      		<input type="submit" data-inline="true" value="提交">
	    	</form>
	  	</div>
	</div>

</body>
</html>
