<div class="row">
	<div class="col-sm-12">
		{{ Lang::get('app.course_avgWorkload') }}
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="{{ $avgWorkload }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $avgWorkload }}%;"></div>
		</div>
	</div>
</div>

{{-- Only show grade distribution when there is at least one comment --}}
<div class="row">
	@foreach ($gradeDistribution as $grade => $count)
		<div class="col-sm-4">
			{{ CourseHelper::getGradeText($grade) }} ({{ $count }})
			<div class="progress">
				@if ($comments->getTotal() > 0)
					<div class="progress-bar {{ CourseHelper::getGradeStyle('progress-bar-', $grade) }}" role="progressbar" aria-valuenow="{{ $count / $comments->getTotal() * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $count / $comments->getTotal() * 100 }}%;"></div>
				@endif
			</div>
		</div>
	@endforeach
</div>
