$(document).ready(function () {
	function resize() {
		if ($(window).width() < 768) {
			var activeTab = $('#mobile-tab .active a').attr('href');
			$('#info, #stats, #comments').hide();
			$(activeTab).show();
		} else {
			$('#info, #stats, #comments').show();
		}
	}

	// Masonry
	$('#comment-container').masonry({
		transitionDuration: 0,
		itemSelector: '.comment'
	});

	// run the resize function when the page is loaded as it can be a mobile device
	resize();

	$(window).resize(function(){
		resize();
	});

	// handle the click event of the pills shown in mobile device
	$('#mobile-tab a').click(function (e) {
		e.preventDefault();
		$('#mobile-tab .active a').parent().removeClass('active');
		$(e.target).parent().addClass('active');
		var clickedTab = $(e.target).attr('href');
		$('#info, #stats, #comments').hide();
		$(clickedTab).show();
	});
});