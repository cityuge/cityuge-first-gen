@extends('layouts.error')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6" lang="en">
			<h1>Page Not Found</h1>
			<p>The page may be removed. Please check the URL to see if there is any mistake.</p>
			<p>You may:</p>
			<ol>
				<li>Visit the {{ link_to('en', 'home page') }}.</li>
				<li>Use our {{ link_to('en/search', 'search feature') }} to find a course.</li>
			</ol>
		</div>

		<div class="col-md-6" lang="zh-HK">
			<h1>找不到網頁</h1>
			<p>網頁可能已被移除，請檢查網址是否輸入正確。</p>
			<p>你可以：</p>
			<ol>
				<li>造訪{{ link_to('/', '首頁') }}。</li>
				<li>使用{{ link_to('search', '搜尋功能') }}查詢課程資料。</li>
			</ol>
		</div>
	</div>
</div>

@stop