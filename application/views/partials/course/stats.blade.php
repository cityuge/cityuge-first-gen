<?php
$grade_style = array(
	'A+' => 'ap',
	'A' => 'a',
	'A-' => 'am',
	'B+' => 'bp',
	'B' => 'b',
	'B-' => 'bm',
	'C+' => 'cp',
	'C' => 'c',
	'C-' => 'cm',
	'D' => 'd',
	'Fail' => 'f',
	'Dropped' => 'dropped',
	'Pass' => 'ap',
);
?>

<!-- <h2>{{ __('app.course_stats') }}</h2> -->


<div class="row">
	<div class="span2">
		{{ __('app.course_avg_workload') }}
		<div class="progress">
			<div class="bar" style="width: {{ $workload_rate }}%"></div>
		</div>
	</div><!-- /.span3 -->
</div>

{{-- Only show grade distribution when there is at least one comment --}}
<div class="row">
	@foreach ($grade_distribution as $grade => $count)
		<div class="span2">
			{{ $grade }} ({{ $count }})
			<div class="progress">
				@if ($total_comment > 0)
					<div class="bar bar-{{ $grade_style[$grade] }}" style="width: {{ $count / $total_comment * 100 }}%"></div>
				@endif
			</div>
		</div><!-- /.span3 -->
	@endforeach
</div>
