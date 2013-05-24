@layout('layouts.home')

@section('content')

<div class="page-header">
	<h1>{{ $title }}</h1>
</div>
<dl class="dl-horizontal">
	@foreach($departments as $dep)
		<dt>{{ HTML::link_to_route('department.course', $dep->initial, strtolower($dep->initial)) }}</dt>
		<dd>{{ e($dep->title_en) }}<br />{{ e($dep->title_zh) }}</dd>
	@endforeach
</dl>
@endsection