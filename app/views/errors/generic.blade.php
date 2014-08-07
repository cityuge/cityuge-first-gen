@extends('layouts.error')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6" lang="en">
            <h1>Something is technically wrong</h1>
            <p>If the problem continues, please {{ link_to('en/about', 'contact us') }}. We apologize for any inconvenience caused.</p>
            <p>You may:</p>
            <ol>
                <li>Visit the {{ link_to('en', 'home page') }}.</li>
                <li>Use our {{ link_to('en/search', 'search feature') }} to find a course.</li>
            </ol>
        </div>

        <div class="col-md-6" lang="zh-HK">
            <h1>出現了技術問題</h1>
            <p>如問題持續出現，請{{ link_to('about', '聯絡我們') }}。不便之處，敬請原諒！</p>
            <p>你可以：</p>
            <ol>
                <li>造訪{{ link_to('/', '首頁') }}。</li>
                <li>使用{{ link_to('search', '搜尋功能') }}查詢課程資料。</li>
            </ol>
        </div>
    </div>
</div>

@stop