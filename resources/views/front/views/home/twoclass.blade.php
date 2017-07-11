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
		@if(isset($parentDetail))
			<div class="alert alert-success" role="alert"><a href="/front/setClassTime#eclass" style="text-decoration: underline;">您还没有设置上课时间，立即点我去设置。</a></div>
		@else
		@endif
	@else
		@foreach($res as $value)
			<div  class="weui-cells buyCell" style="margin:0">
				<a class="weui-cell weui-cell_access {{$class}}" pid="{{$value->id}}">
				    <div class="weui-cell__bd" style="position: relative;">
				        <p style="margin-bottom:0px">{{$value->name}}</p>
				    	<iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe>
				    	<span class="label label-success"> 购买 </span>
				    </div>
				    <div class="weui-cell__ft">
				    </div>
				</a>
			</div>
        @endforeach		
	@endif

</div>