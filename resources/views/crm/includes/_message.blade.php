@if (count($errors) > 0)
    <div class="message error">
        <ul class="no-bullet">
        @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
        @endforeach
        </ul>
    </div>
@elseif (Session::has('success'))
	<div class="alert alert-success" role="alert">
	{!! Session::get('success') !!}
	</div>
@elseif (Session::has('error'))
	<div class="alert alert-danger" role="alert">
	  {!! Session::get('error') !!}
	</div>
@endif
