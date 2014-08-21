@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Cache</h1>
    </div>

    {{ Form::open(array('route' => 'admin.cache.purge')) }}
    <button type="submit" class="btn btn-danger">Purge cache</button>
    {{ Form::close() }}
</div>


@stop
