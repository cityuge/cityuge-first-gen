@extends('layouts.error')

@section('content')

<div class="container">
	<h1>{{ $heading }}</h1>
	{{ $body }}
</div>

@stop