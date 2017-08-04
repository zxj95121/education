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

    <style type="text/css">
    	.bigBtn{
    		margin-top: 18px;
    		border-radius: 3px;
    	}
    </style>

  </head>
  <body>
    <div class="page-group" style="background:#fff">
        <div class="page page-current">
		    <header class="bar bar-nav">
		    	<a class="button button-link button-nav pull-left" onclick="window.location.href='/front/share';" data-transition="slide-out" style="color:#fff">
	      			<span class="icon icon-left"></span>返回
	    		</a>
			 	<h1 class='title' style="background: #22AAE8;color: #fff;">半价购课订单</h1>
			</header>
			<div class="content" style="background: #D6D6D6;">
				<div class="list-block">
                    <ul>
                        <!-- Text inputs -->
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-name"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label" style="font-size: 1em;color: #000;font-weight: normal;">课程名称</div>
                                    <div class="item-input">
                                        <input type="text" readonly placeholder="" value="{{$halfClassObj->name}}">
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-name"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label" style="font-size: 1em;color: #000;font-weight: normal;">购买次数</div>
                                    <div class="item-input">
                                        <input id="kcNumber" type="number" placeholder="请输入购买次数" max="{{$halfObj->ticket_num}}">
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-name"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label" style="font-size: 1em;color: #000;font-weight: normal;">课程单价</div>
                                    <div class="item-input">
                                        <input type="text" readonly value="¥ {{number_format(0.5*$price->price, 2)}}">
                                    </div>
                                </div>
                            </div>
                        </li>


                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-name"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label" style="font-size: 1em;color: #000;font-weight: normal;">课程总价</div>
                                    <div class="item-input">
                                        <input id="totalPrice" type="text" style="font-weight: bold;" value="" readonly>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
			</div>
			<nav class="bar bar-tab">
		      	<a class="tab-item external active" id="makeOrder" href="#" style="background: #3879D9;color: #FFF;">
		  		生成订单
				</a>
		  </nav>
        </div>
    </div>

    <script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>


    <script type="text/javascript">
    	Zepto(function($){
            $(document).on('change', '#kcNumber', function(){
                var number = parseInt($(this).val());
                var price = parseInt('{{number_format(0.5*$price->price, 2)}}');

                var max = parseInt('{{$halfObj->ticket_num}}');
                if (number > max) {
                    number = max;
                    $(this).val(number);
                }

                var totalPrice = '¥ '+(number*price);
                $('#totalPrice').val(totalPrice);
            })


            $(document).on('click', '#makeOrder', function(){
                $.ajax({
                    url: '/front/share/makeOrder',
                    dataType: 'json',
                    type: 'post',
                    headers:{
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    data: {
                        num: $('#kcNumber').val()
                    },
                    success: function(data) {
                        if (data.errcode == 0) {
                            window.location.href = '/front/share/payOrder';
                        }
                    }
                })
            })
		})
    </script>
  </body>
</html>