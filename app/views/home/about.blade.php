@extends('layouts.home')

@section('content')
<div id="content" class="container">
	

<article>
	<div class="page-header">
		<h1>{{ $title }}</h1>
	</div>

    @if (Config::get('app.locale') == 'zh-hk')

    <p>「CityU GE 指南」於 2013 年 5 月建立，旨在為香港城市大學的同學提供一個平台，對各精進教育課程（即 Gateway Education，簡稱 GE）及中英文補底班（俗稱「E 仔班」或「三仔班」）發表意見。以往同學選科時，僅與朋輩交流，或於討論區上參考他人對有關課程的感想，這種有欠系統性分析的途徑，令同學需自行加以整理，稍添不便。有見及此，本網站之建立，實為同學提供一個交流的平台及機會，讓大家可以提供各項課程資料（如修讀學期、工作量、所得成績）及感想，供其他同學在選科時參考。</p>

	<h2>聯絡我們</h2>
	<p>如欲聯絡我們，請電郵至 <a href="mailto:cityuge@swiftzer.net">cityuge@swiftzer.net</a>。若在操作上遇上任何困難（如誤填資料、網站故障等）或資料錯誤，亦歡迎來函，我們將儘快跟進。此外，我們亦開設了 <a href="http://www.facebook.com/cityuge">Facebook 專頁</a>，歡迎「讚好」並關注本網站的最新動向。</p>

    @elseif (Config::get('app.locale') == 'zh-cn')

    <p>「CityU GE 指南」于 2013 年 5 月建立，旨在为香港城市大学的同学提供一个平台，对各精进教育课程（即 Gateway Education，简称 GE）及中英文补底班（俗称「E 仔班」或「三仔班」）发表意见。以往同学选科时，仅与朋辈交流，或于讨论区上参考他人对有关课程的感想，这种有欠系统性分析的途径，令同学需自行加以整理，稍添不便。有见及此，本网站之建立，实为同学提供一个交流的平台及机会，让大家可以提供各项课程资料（如修读学期、工作量、所得成绩）及感想，供其他同学在选科时参考。</p>

    <h2>联络我们</h2>
    <p>如欲联络我们，请电邮至 <a href="mailto:cityuge@swiftzer.net">cityuge@swiftzer.net</a>。若在操作上遇上任何困难（如误填数据、网站故障等）或数据错误，亦欢迎来函，我们将尽快跟进。此外，我们亦开设了 <a href="http://www.facebook.com/cityuge">Facebook 专页</a>，欢迎「赞好」并关注本网站的最新动向。</p>


    @else

	<p>Founded in May 2013, CityU GE Guide provides a platform for students in CityU to share their feedbacks on Gateway Education (GE) courses and fundamental language courses they have taken in previous semesters. It organize the comments for different courses and provide statistics to students when they take a new course. Before the website is created, students take courses by sharing feedbacks with their friends and referencing others' reviews posted on Internet forums. These methods are not systematic and require students to organize the data before analysing them.</p>

	<h2>Contact Us</h2>
	<p>For enquires or difficulties (such as submitting incorrect data or out of order), email us at <a href="mailto:cityuge@swiftzer.net">cityuge@swiftzer.net</a> and we will follow up ASAP. In addition, we set up a <a href="http://www.facebook.com/cityuge">Facebook Page</a> which provides the latest news of us.</p>

    @endif
</article>

</div>

@stop