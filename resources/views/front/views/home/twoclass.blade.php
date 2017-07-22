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
</style>
<div id="twoclass">
	<div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#FFF;">
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
		@if(isset($parentDetail) && !$parentDetail->classTimes)
			<!-- <div class="alert alert-success" role="alert"><a href="/front/setClassTime#eclass" style="text-decoration: underline;">您还没有设置上课时间，立即点我去设置。</a></div> -->
		@else
		@endif
	@else
		@foreach($res as $value)
			<div  class="weui-cells buyCell" style="margin:0">
				<a class="weui-cell weui-cell_access {{$class}}" pid="{{$value->id}}">
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
        	<div id="zhicheng"></div>
        	<div id="myCart" style="height: 40px;background: #52525A;width: 100%;">
                <div style="width:70%;height:100%;text-align: center;float: left;">
                    <span style="vertical-align: middle;line-height: 40px;color:#FFF;">我的购物车</span>
                    <span class="weui-badge" style="margin-left: 5px;background: #FFF;color:#52525A;" id="cartNum">0</span>
                </div>
                <div style="width:30%;height: 100%;text-align: center;background: #F90000;line-height: 40px;float: right;color:#FFF;font-size:18px;">
                	去结算
                </div>
            </div>	
	@endif

</div>