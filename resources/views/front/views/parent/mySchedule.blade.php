<!DOCTYPE html>
<html>
<head>
	<title>加辰教育</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link rel="stylesheet" type="text/css" href="/css/weui.css"/>
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
		  	<div class="content-block-title">课程表说明</div>
		  	<div class="card">
			    <div class="card-content">
			      	<div class="card-content-inner" style="color:#676A6F;font-size: 13px;padding-left:2em;">
			      		<ol>
			      			<li>课程表只显示最近的课程表安排，管理员定期更新</li>
			      			<li>绿色日期表示该日有课程安排</li>
			      			<li>点击绿色可查看课程具体时间以及上课班级</li>
			      		</ol>
			      	</div>
			    </div>
			</div>
		</div>
	</div>	

	<div class="weui-skin_android" id="androidActionsheet" style="opacity: 1;display: none;">
        <div class="weui-mask" style="z-index: 4999;"></div>
        <div class="weui-actionsheet">
            <div class="weui-actionsheet__menu">
                <div class="weui-actionsheet__cell">示例菜单</div>
            </div>
        </div>
    </div>

	
	<!-- <script type="text/javascript" src="/js/zepto.min.js"></script> -->
	<!-- <script type="text/javascript" src="/js/sm.min.js"></script> -->
	<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
	<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>

	<script type="text/javascript">
		$.init();

		$.ajax({
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/front/parent/mySchedule/getSchedule',
            dataType: 'json',
            type: 'post',
            data: {
            	id: '{{$id}}'
            },
            success: function(data) {
            	if (data.errcode == 0) {
            		console.log(data.errcode);
            		window.schedule = data.data;
            		setStatus();
            	}
            }
		})
	</script>

	<script type="text/javascript">

		$(document).on('click', '.picker-calendar-day', function(){
			if ($(this).attr('state') == '1') {
				var year = $(this).attr('data-year');
		    	var month = parseInt($(this).attr('data-month'));
		    	var day = parseInt($(this).attr('data-day'));
		    	month++;
		    	month = (month < 10) ? ('0'+month):month;
		    	day = (day < 10) ? ('0'+day):day;
		    	var date = year+'-'+month+'-'+day;
				$('#androidActionsheet').css('display', 'block');
				$('.weui-actionsheet__menu').html('');
				console.log(date);
				var obj = window.schedule[date]['detail'];
				for (var i in obj) {
					$('.weui-actionsheet__menu').append('<div class="weui-actionsheet__cell">'+obj[i].low+'-'+obj[i].high+' （'+obj[i].name+'）</div>');
				}
			}
		})

		$(document).on('click', '.weui-mask', function(){
			$('#androidActionsheet').css('display', 'none');
		})

		var MutationObserver = window.MutationObserver ||
		    window.WebKitMutationObserver ||
		    window.MozMutationObserver;

		var callback = function(records) {
		    // records.forEach(function(record) {
		    //     console.log('Mutation type: ' + record.type);
		    //     console.log('Mutation target: ' + record.target);
		    // });
		    setStatus();
		};
		var observer = new MutationObserver(callback);

		var article = document.querySelector('.picker-calendar-months-wrapper');

		var options = {
		    'childList': true
		};

		observer.observe(article, options);

		function setStatus() {
			var schedule = window.schedule;
		    for (var i in schedule) {
		    	if (schedule[i].state == 1) {
			    	var date = i;
			    	var arr = date.split('-');
			    	var year = arr[0];
			    	var month = parseInt(arr[1]);
			    	month--;
			    	var day = parseInt(arr[2]);

			    	/*找对应的日期变色*/
			    	var cdom = $('.picker-calendar-day[data-year="'+year+'"][data-month="'+month+'"][data-day="'+day+'"]');
			    	cdom.attr('state', '1');
			    	cdom.find('span').css({'background': '#058B12','color':'#FFF'});
			    }
		    }
		}
	</script>
</body>
</html>