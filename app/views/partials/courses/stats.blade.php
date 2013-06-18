<!-- <h2>{{ Lang::get('app.course_stats') }}</h2> -->


<div class="row">
	<div class="span2">
		{{ Lang::get('app.course_avgWorkload') }}
		<div class="progress">
			<div class="bar" style="width: {{ $workloadRate }}%"></div>
		</div>
	</div><!-- /.span3 -->
</div>

{{-- Only show grade distribution when there is at least one comment --}}
<div class="row">
	@foreach ($gradeDistribution as $grade => $count)
		<div class="span2">
			{{ $grade }} ({{ $count }})
			<div class="progress">
				@if ($totalComment > 0)
					<div class="bar bar-{{ Course::getGradeStyle($grade) }}" style="width: {{ $count / $totalComment * 100 }}%"></div>
				@endif
			</div>
		</div><!-- /.span3 -->
	@endforeach
</div>
