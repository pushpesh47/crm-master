@extends('crm.layouts.app')
@section('content')
	
	@includeIf('crm.includes.sidebar')
	@includeIf('crm.includes.header')
		@includeIf($view)
	@includeIf('crm.includes.footer')
@endsection