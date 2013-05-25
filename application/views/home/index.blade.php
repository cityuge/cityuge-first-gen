@layout('layouts.home')

@section('content')

<div class="hero-unit">
	<h1>推己及人</h1>
	<p>如欲放棄修讀課程，請盡快釋出名額（包括在 Waitlist 的登記），讓其他在 Waitlist 的同學補上。</p>
</div>

<div class="row">
	<div class="span6">
		<h2>{{ __('app.home_hot_course') }}</h2>
		<ul class="nav nav-tabs" id="hot-course">
			<li class="active"><a href="#hot-course-area1">{{ __('app.category_area1') }}</a></li>
			<li><a href="#hot-course-area2">{{ __('app.category_area2') }}</a></li>
			<li><a href="#hot-course-area3">{{ __('app.category_area3') }}</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="hot-course-area1">
				<ol>
					@foreach($hot_courses_area1 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="hot-course-area2">
				<ol>
					@foreach($hot_courses_area2 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="hot-course-area3">
				<ol>
					@foreach($hot_courses_area3 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>

	<div class="span6">
		<div class="well well-small">
			<h2>提提你</h2>
			<p>目前本網站共收到 200 多篇留言，但由於留言分佈不均，故本頁面所提供的各項排名僅供參考。同時，本網站建議同學於報讀各精進教育課程前，除參考本頁面排名外，亦應細閱各相關留言內容及課程資料，再作判斷。</p>
			<p>為使本網站的統計資料更為廣泛及準確，望同學可到曾修讀的相關課程頁面留下意見，並向朋友推薦本網站，謝謝！</p>
		</div>
	</div>
</div><!-- /.row -->

<div class="row">
	<div class="span6">
		<h2>{{ __('app.home_good_grade_course') }}</h2>
		<p class="muted">{{ __('app.home_good_grade_course_note', array('limit' => Config::get('app.home_stats_max_item'))) }}</p>
		<ul class="nav nav-tabs" id="hot-course">
			<li class="active"><a href="#goode-grade-course-area1">{{ __('app.category_area1') }}</a></li>
			<li><a href="#goode-grade-course-area2">{{ __('app.category_area2') }}</a></li>
			<li><a href="#goode-grade-course-area3">{{ __('app.category_area3') }}</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="goode-grade-course-area1">
				<ol>
					@foreach($good_grade_courses_area1 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="goode-grade-course-area2">
				<ol>
					@foreach($good_grade_courses_area2 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="goode-grade-course-area3">
				<ol>
					@foreach($good_grade_courses_area3 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>

	<div class="span6">
		<h2>{{ __('app.home_bad_grade_course') }}</h2>
		<p class="muted">{{ __('app.home_bad_grade_course_note', array('limit' => Config::get('app.home_stats_max_item'))) }}</p>
		<ul class="nav nav-tabs" id="hot-course">
			<li class="active"><a href="#bade-grade-course-area1">{{ __('app.category_area1') }}</a></li>
			<li><a href="#bade-grade-course-area2">{{ __('app.category_area2') }}</a></li>
			<li><a href="#bade-grade-course-area3">{{ __('app.category_area3') }}</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="bade-grade-course-area1">
				<ol>
					@foreach($bad_grade_courses_area1 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="bade-grade-course-area2">
				<ol>
					@foreach($bad_grade_courses_area2 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="bade-grade-course-area3">
				<ol>
					@foreach($bad_grade_courses_area3 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>
</div><!-- /.row -->

<div class="row">
	<div class="span6">
		<h2>{{ __('app.home_light_workload_course') }}</h2>
		<ul class="nav nav-tabs" id="light-workload-course">
			<li class="active"><a href="#light-workload-course-area1">{{ __('app.category_area1') }}</a></li>
			<li><a href="#light-workload-course-area2">{{ __('app.category_area2') }}</a></li>
			<li><a href="#light-workload-course-area3">{{ __('app.category_area3') }}</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="light-workload-course-area1">
				<ol>
					@foreach($light_workload_courses_area1 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="light-workload-course-area2">
				<ol>
					@foreach($light_workload_courses_area2 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="light-workload-course-area3">
				<ol>
					@foreach($light_workload_courses_area3 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>

	<div class="span6">
		<h2>{{ __('app.home_heavy_workload_course') }}</h2>
		<ul class="nav nav-tabs" id="heavy-workload-course">
			<li class="active"><a href="#heavy-workload-course-area1">{{ __('app.category_area1') }}</a></li>
			<li><a href="#heavy-workload-course-area2">{{ __('app.category_area2') }}</a></li>
			<li><a href="#heavy-workload-course-area3">{{ __('app.category_area3') }}</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="heavy-workload-course-area1">
				<ol>
					@foreach($heavy_workload_courses_area1 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="heavy-workload-course-area2">
				<ol>
					@foreach($heavy_workload_courses_area2 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="heavy-workload-course-area3">
				<ol>
					@foreach($heavy_workload_courses_area3 as $row)
						<li>{{ HTML::link_to_route('course.detail', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>
</div><!-- /.row -->

@endsection

@section('scripts_footer')
$('#hot-course a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
});
$('#goode-grade-course a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
});
$('#light-workload-course a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
});
$('#heavy-workload-course a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
});
@endsection