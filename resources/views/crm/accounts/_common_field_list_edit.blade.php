<option value="">None</option>
@if(!empty($columns))
	@php
	    $val=_arefy(\App\Models\FilterViewDetail::where(['filter_view_id'=>$filter['id'],'meta_key'=>$column_name])->first());
	@endphp
	@foreach($columns as $col)
	  <option @if($val['meta_value']==$col['meta_key']) selected="" @endif value="{{$col['meta_key']}},{{$col['meta_value']}}">{{$col['meta_value']}}</option>
	@endforeach
@endif