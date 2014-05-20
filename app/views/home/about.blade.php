@extends('layouts.home')

@section('content')
<div id="content" class="container">
	

<article>
	<div class="page-header">
		<h1>{{ $title }}</h1>
	</div>


	<p>「CityU GE 指南」於 2013 年 5 月建立，旨在為香港城市大學的同學提供一個平台，對各精進教育課程（即 Gateway Education，簡稱 GE）及中英文補底班（俗稱「E 仔班」或「三仔班」）發表意見。以往同學選科時，僅與朋輩交流，或於討論區上參考他人對有關課程的感想，這種有欠系統性分析的途徑，令同學需自行加以整理，稍添不便。有見及此，本網站之建立，實為同學提供一個交流的平台及機會，讓大家可以提供各項課程資料（如修讀學期、工作量、所得成績）及感想，供其他同學在選科時參考。</p>

	<h2>聯絡我們</h2>
	<p>如欲聯絡我們，請電郵至 <a href="mailto:cityuge@swiftzer.net">cityuge@swiftzer.net</a>。若在操作上遇上任何困難（如誤填資料、網站故障等）或資料錯誤，亦歡迎來函，我們將儘快跟進。此外，我們亦開設了 <a href="http://www.facebook.com/cityuge">Facebook 專頁</a>，歡迎「讚好」並關注本網站的最新動向。</p>
	
	<p>為防冒認，凡在電郵中聲稱自己是香港城市大學之職員，寄件人電郵地址必須使用 <i>@staff.cityu.edu.hk</i> 或 <i>@my.cityu.edu.hk</i> 並必須使用其電郵伺服器寄出，否則恕不受理。我們會在收到電郵後仔細檢查 Header。CityU GE 指南及 Swiftzer.net 所發出的電郵均能通過 SPF 及 DKIM 驗證。如未能通過驗證，則很大機會是偽冒電郵。</p>
</article>

</div>

@stop