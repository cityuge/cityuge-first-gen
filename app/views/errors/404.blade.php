@extends('layouts.error')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6" lang="en">
			<h1>{{ trans('app.error_404', array(), null, 'en') }}</h1>
			{{ trans('app.error_404_detail', array(), null, 'en') }}
		</div>

		<div class="col-md-6" lang="zh-HK">
			<h1>{{ trans('app.error_404', array(), null, 'zh-hk') }}</h1>
			{{ trans('app.error_404_detail', array(), null, 'zh-hk') }}
		</div>
	</div>
</div>

@stop