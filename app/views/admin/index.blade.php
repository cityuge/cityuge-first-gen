@extends('layouts.admin')

@section('content')

{{-- Clear all cache --}}
{{ Form::open(array('route' => 'admin.cache.purge')) }}
	{{ Form::token() }}
	{{ Form::submit(trans('app.cache_purge'), array('class' => 'btn')) }}
{{ Form::close() }}

@stop