<div class="col-sm-4">
	<div class="form-group row">
	    <ul>
	        <li><a href="{{url('crm/filter/create')}}">Create |</a></li>
	        <li><a href="{{url('crm/filter/'.___encrypt($filter).'/edit')}}">Edit |</a></li>
	        <li><a href="{{url('crm/filter/'.___encrypt($filter).'/delete')}}">Delete</a></li>
	    </ul>
	</div>
</div>