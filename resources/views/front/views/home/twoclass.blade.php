<style>
	#twoclass a:link{
		text-decoration:none;
	}
	#twoclass a:visited{
		text-decoration:none;
	}
	#twoclass a:hover{
		text-decoration:none;
	}
	#twoclass a:active{
		text-decoration:none;
	}
	.buyCell .label-success{
		position: absolute;
		top: 0px;
		right: 2px;
		height: 100%;
    	line-height: inherit;
	}
	.class1,.class2,.class3{
		cursor: pointer;
	}
	#houtui{
		cursor: pointer;
	}
	.weui-cells{
		font-size: 16px;
	}
</style>
<div id="twoclass">
	<div class="weui-cell weui-cell_access twoclassHead" style="height:40px;background:#22AAE8;color:#FFF;">
	    @if($class != 'class1')
	     	<div><div class="glyphicon glyphicon-menu-left" id="houtui" fenlei="{{$class}}"></div></div>
	    @endif
	    <div class="weui-flex__item"><div class="placeholder" style="text-align:center; font-size:16px">请选择课程</div></div>
	</div>
	@if($class != "class3")
		@foreach($res as $value)
			<div  class="weui-cells" style="margin:0">
				<a class="weui-cell weui-cell_access {{$class}}" pid="{{$value->id}}">
				    <div class="weui-cell__bd">
				        <p style="margin-bottom:0px">{{$value->name}}</p>
				    <iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe></div>
				    @if($class != "class4")
					    <div class="weui-cell__ft">
					    </div>
				    @endif
				</a>
			</div>
		@endforeach
		<div id="zhicheng"></div>
		@if(isset($parentDetail) && !$parentDetail->classTimes)
			<!-- <div class="alert alert-success" role="alert"><a href="/front/setClassTime#eclass" style="text-decoration: underline;">您还没有设置上课时间，立即点我去设置。</a></div> -->
		@else
		@endif
	@else
		@foreach($res as $key => $value)
			<div  class="weui-cells buyCell" style="margin:0">
				<a class="weui-cell weui-cell_access {{$class}}" pid="{{$value->id}}" kcNum="{{$kcNum[$key]}}">
				    <div class="weui-cell__bd" style="position: relative;">
				        <p style="margin-bottom:0px">{{$value->name}}</p>
				    	<iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe>
				    	
				    </div>
				    <div class="weui-cell__ft">
				    	<span class="btn btn-success" style="background-image:url('/images/home/cart.png');background-size:100% 100%;width:32px;height:27px;"> </span>
				    </div>
				</a>
			</div>
        @endforeach	
        	<div id="hideThree" pid="{{$pid}}" style="display: none;">{{$name}}</div>
        	<div id="zhicheng"></div>
        	<div id="myCart" style="height: 40px;background: #52525A;width: 100%;z-index: 999;">
                <div style="width:70%;height:100%;text-align: center;float: left;z-index: 999;cursor:pointer;" id="myCartLeft">
                    <span style="vertical-align: middle;line-height: 40px;color:#FFF;">我的购物车</span>
                    <span class="weui-badge" style="margin-left: 5px;background: #FFF;color:#52525A;" id="cartNum">0</span>
                </div>
                <div style="width:30%;height: 100%;text-align: center;background: #F90000;z-index: 999;line-height: 40px;float: right;color:#FFF;font-size:18px;cursor:pointer;" id="myCartRight">
                	生成订单
                </div>
            </div>

            <div id="orderdetail" style="position: fixed;z-index: 99;width: 100%;overflow: scroll;display: none;font-family: arial, helvetica, sans-serif;background: #FFF;">
            	<div class="cartTop" style="position: relative;text-align: center;line-height: 39px;height:39px;background: #E50F12;color:#FFF;z-index: 100;cursor: pointer;">
            		我的购物车
            		<div class="cartTopRight" id="orderdetailClose" style="height: 39px;cursor: pointer;line-height: 39px;position: absolute;right: 10px;top: 0px;">关闭</div>
            	</div>
            	<div class="weui-loadmore weui-loadmore_line" style="position: absolute;top:39px;left:0px;z-index: -1;width: 100%;">
	            	<span class="weui-loadmore__tips">购物车为空</span>
	        	</div>
            	<!-- <div class="cartblock" pid="">
            		<div class="cartheader" style="width:100%;background: #EA6969;color: #FFF;padding:6px 10px;">
            			<p style="font-size:1.1em;margin: 0px 0px;">英语自然拼读</p>
            		</div>
            		<div class="cartcontent" style="width: 100%;background: #FFF;">
						<div  class="weui-cells" style="margin:0;">
							<a class="weui-cell weui-cell_title">
							    <div class="weui-cell__bd" style="position: relative;color:#333;">
							        <p style="font-size:15px;">大幅度工人房</p>
							    	<iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe>
							    	
							    </div>
							    <div class="weui-cell__ft">
							    	<span>16课时</span>
							    	<span class="btn btn-danger" style="background-color:#FFF;border-color:#FFF;background-image:url('/images/home/cart_delete.png');background-size:100% 100%;width:28px;height:28px;"> </span>
							    </div>
							</a>
						</div>
            		</div>
            		<div class="cartcontent" style="width: 100%;background: #FFF;">
						<div  class="weui-cells" style="margin:0;">
							<a class="weui-cell weui-cell_title">
							    <div class="weui-cell__bd" style="position: relative;color:#333;">
							        <p style="margin-bottom:0px">大幅度工人房</p>
							    	<iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe>
							    	
							    </div>
							    <div class="weui-cell__ft">
							    	<span>16课时</span>
							    	<span class="btn btn-danger" style="background-color:#FFF;border-color:#FFF;background-image:url('/images/home/cart_delete.png');background-size:100% 100%;width:28px;height:28px;"> </span>
							    </div>
							</a>
						</div>
            		</div>
            		<div class="cartcontent" style="width: 100%;background: #FFF;">
						<div  class="weui-cells" style="margin:0;">
							<a class="weui-cell weui-cell_title">
							    <div class="weui-cell__bd" style="position: relative;color:#333;">
							        <p style="margin-bottom:0px">大幅度工人房</p>
							    	<iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe>
							    	
							    </div>
							    <div class="weui-cell__ft">
							    	<span>16课时</span>
							    	<span class="btn btn-danger" style="background-color:#FFF;border-color:#FFF;background-image:url('/images/home/cart_delete.png');background-size:100% 100%;width:28px;height:28px;"> </span>
							    </div>
							</a>
						</div>
            		</div>
            		<div class="cartfooter" style="width:100%;height: 8px;background: #FFFFFF;">
            		</div>
            	</div> -->
            </div>

            <form id="cartOrderForm" action="/front/parent/newEclassOrder" method="post" style="display: none;">
            	<textarea name="cartOrder"></textarea>
            	{{csrf_field()}}
            </form>
            <!-- <div class="js_dialog" id="cartConfirm" style="opacity: 1;display: none;">
	            <div class="weui-mask"></div>
	            <div class="weui-dialog weui-skin_android">
	                <div class="weui-dialog__hd"><strong class="weui-dialog__title">结算提示</strong></div>
	                <div class="weui-dialog__bd">
	                    请确保您的购物车内容无误！
	                </div>
	                <div class="weui-dialog__ft">
	                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default">取消</a>
	                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">我已确认</a>
	                </div>
	            </div>
	        </div> -->
	@endif

</div>