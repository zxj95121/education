<!DOCTYPE html>
<html>
<head>
	<title>加辰教育</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link rel="stylesheet" type="text/css" href="/css/sm.min.css">
</head>
<body>
	<div class="page">
	  	<header class="bar bar-nav">
	    	<a class="button button-link button-nav pull-left" href="/front/parent/mySchedule" data-transition='slide-out'>
	      		<span class="icon icon-left"></span>
	      		返回
	    	</a>
	    	<h1 class="title">{{$childName}}的课程表</h1>
	  	</header>
	  	<div class="content">
		  	<div data-toggle='date'></div>
		</div>
	</div>	

	
	<!-- <script type="text/javascript" src="/js/zepto.min.js"></script> -->
	<!-- <script type="text/javascript" src="/js/sm.min.js"></script> -->
	<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
	<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>

	<script type="text/javascript">
		$.init();

		var MutationObserver = window.MutationObserver ||
		    window.WebKitMutationObserver ||
		    window.MozMutationObserver;

		var callback = function(records) {
		    records.map(function(record) {
		        console.log('Mutation type: ' + record.type);
		        console.log('Mutation target: ' + record.target);
		    });
		};
		var observer = new MutationObserver(callback);

		var article = document.querySelector('.picker-calendar-month-current');

		var options = {
		    'childList': true,
		    'arrtibutes': true,
		    'characterData': true
		};

		observer.observe(article, options);
	</script>
</body>
</html>