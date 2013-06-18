@extends('layouts.home')

@section('content')

{{--
	<div class="hero-unit">
	<h1>推己及人</h1>
	<p>如欲放棄修讀課程，請盡快釋出名額（包括在 Waitlist 的登記），讓其他在 Waitlist 的同學補上。</p>
</div>
--}}

<div class="row">
	<div class="span6">
		<h2>{{ Lang::get('app.home_hotCourse') }}</h2>
		<ul class="nav nav-tabs" id="hot-course">
			<li class="active"><a href="#hot-course-area1">{{ Lang::get('app.category_area1') }}</a></li>
			<li><a href="#hot-course-area2">{{ Lang::get('app.category_area2') }}</a></li>
			<li><a href="#hot-course-area3">{{ Lang::get('app.category_area3') }}</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="hot-course-area1">
				<ol>
					@foreach($hotCoursesArea1 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="hot-course-area2">
				<ol>
					@foreach($hotCoursesArea2 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="hot-course-area3">
				<ol>
					@foreach($hotCoursesArea3 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>
	
	<div class="span6">
		<div class="well well-small">
			<h2>提提你</h2>
			<p>由於目前網站的留言分佈不均，故本頁面所提供的各項排名僅供參考。同時，本網站建議同學於報讀各精進教育課程前，除參考本頁面排名外，亦應細閱各相關留言內容及課程資料，再作判斷。</p>
			<p>為使本網站的統計資料更為廣泛及準確，望同學可到曾修讀的相關課程頁面留下意見，並向朋友推薦本網站，謝謝！</p>
			<hr>
			{{--  Social media share buttons --}}
			<div id="social-network-btn">
				<button id="facebook" class="btn btn-facebook" data-url="{{ URL::to('') }}" data-text="{{ Lang::get('app.meta_homeDesc') }}"></button>
				<button id="twitter" class="btn btn-twitter" data-url="{{ URL::to('') }}" data-text="{{ Lang::get('app.meta_homeDesc') }}"></button>
				<button id="google-plus" class="btn btn-google-plus" data-url="{{ URL::to('') }}" data-text="{{ Lang::get('app.meta_homeDesc') }}"></button>
			</div>
		</div>
	</div>
</div><!-- /.row -->

<div class="row">
	<div class="span6">
		<h2>{{ Lang::get('app.home_goodGradeCourse') }}</h2>
		<p class="muted">{{ Lang::get('app.home_goodGradeCourseNote', array('limit' => Config::get('cityuge.home_statsMaxItem'))) }}</p>
		<ul class="nav nav-tabs" id="hot-course">
			<li class="active"><a href="#goode-grade-course-area1">{{ Lang::get('app.category_area1') }}</a></li>
			<li><a href="#goode-grade-course-area2">{{ Lang::get('app.category_area2') }}</a></li>
			<li><a href="#goode-grade-course-area3">{{ Lang::get('app.category_area3') }}</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="goode-grade-course-area1">
				<ol>
					@foreach($goodGradeCoursesArea1 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="goode-grade-course-area2">
				<ol>
					@foreach($goodGradeCoursesArea2 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="goode-grade-course-area3">
				<ol>
					@foreach($goodGradeCoursesArea3 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>

	<div class="span6">
		<h2>{{ Lang::get('app.home_badGradeCourse') }}</h2>
		<p class="muted">{{ Lang::get('app.home_badGradeCourseNote', array('limit' => Config::get('cityuge.home_statsMaxItem'))) }}</p>
		<ul class="nav nav-tabs" id="hot-course">
			<li class="active"><a href="#bade-grade-course-area1">{{ Lang::get('app.category_area1') }}</a></li>
			<li><a href="#bade-grade-course-area2">{{ Lang::get('app.category_area2') }}</a></li>
			<li><a href="#bade-grade-course-area3">{{ Lang::get('app.category_area3') }}</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="bade-grade-course-area1">
				<ol>
					@foreach($badGradeCoursesArea1 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="bade-grade-course-area2">
				<ol>
					@foreach($badGradeCoursesArea2 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="bade-grade-course-area3">
				<ol>
					@foreach($badGradeCoursesArea3 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>
</div><!-- /.row -->

<div class="row">
	<div class="span6">
		<h2>{{ Lang::get('app.home_lightWorkloadCourse') }}</h2>
		<ul class="nav nav-tabs" id="light-workload-course">
			<li class="active"><a href="#light-workload-course-area1">{{ Lang::get('app.category_area1') }}</a></li>
			<li><a href="#light-workload-course-area2">{{ Lang::get('app.category_area2') }}</a></li>
			<li><a href="#light-workload-course-area3">{{ Lang::get('app.category_area3') }}</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="light-workload-course-area1">
				<ol>
					@foreach($lightWorkloadCoursesArea1 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="light-workload-course-area2">
				<ol>
					@foreach($lightWorkloadCoursesArea2 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="light-workload-course-area3">
				<ol>
					@foreach($lightWorkloadCoursesArea3 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>

	<div class="span6">
		<h2>{{ Lang::get('app.home_heavyWorkloadCourse') }}</h2>
		<ul class="nav nav-tabs" id="heavy-workload-course">
			<li class="active"><a href="#heavy-workload-course-area1">{{ Lang::get('app.category_area1') }}</a></li>
			<li><a href="#heavy-workload-course-area2">{{ Lang::get('app.category_area2') }}</a></li>
			<li><a href="#heavy-workload-course-area3">{{ Lang::get('app.category_area3') }}</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="heavy-workload-course-area1">
				<ol>
					@foreach($heavyWorkloadCoursesArea1 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="heavy-workload-course-area2">
				<ol>
					@foreach($heavyWorkloadCoursesArea2 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
			<div class="tab-pane" id="heavy-workload-course-area3">
				<ol>
					@foreach($heavyWorkloadCoursesArea3 as $row)
						<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>
</div><!-- /.row -->

@stop

@section('footerScript')
{{ HTML::script('js/jquery.sharrre.js') }}
<script>
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

// Social media share buttons
$('#twitter').sharrre({
	share: {
		twitter: true
	},
	template: '<i class="icon-twitter"></i> Tweet <span class="badge">{total}</span>',
	enableHover: false,
	enableTracking: true,
	buttons: { twitter: {via: 'swiftzer'}},
	click: function(api, options){
		api.simulateClick();
		api.openPopup('twitter');
	}
});
$('#facebook').sharrre({
	share: {
		facebook: true
	},
	template: '<i class="icon-facebook"></i> Share <span class="badge">{total}</span>',
	enableHover: false,
	enableTracking: true,
	click: function(api, options){
		api.simulateClick();
		api.openPopup('facebook');
	}
});
$('#google-plus').sharrre({
	share: {
		googlePlus: true
	},
	urlCurl: '{{ route('sharrre') }}',
	template: '<i class="icon-google-plus"></i> Share <span class="badge">{total}</span>',
	enableHover: false,
	enableTracking: true,
	click: function(api, options){
		api.simulateClick();
		api.openPopup('googlePlus');
	}
});
</script>
@stop