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
				    <div class="weui-cell__ft">
				    </div>
				</a>
			</div>
		@endforeach
	@else
		@foreach($res as $value)
			<div class="weui-cell">
				<a class="{{$class}}" pid="{{$value->id}}">
                	<div class="weui-cell__bd">
                    	<p>{{$value->name}}</p>
                	</div>
                </a>
                <a>
               		<div class="weui-cell__ft">购买</div>
            	</a>
            </div>
        @endforeach		
	@endif

</div>
