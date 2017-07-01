@foreach($res as $value)
<div class="weui-cells__title">双师class1</div>
<div class="weui-cells">
	<a class="weui-cell weui-cell_access" href="/twoClasstwo?fid={{$value->id}}">
	    <div class="weui-cell__bd">
	        <p>{{$value->name}}</p>
	    <iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe></div>
	    <div class="weui-cell__ft">
	    </div>
	</a>
</div>
@endforeach