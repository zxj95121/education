<style>
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
</div>
