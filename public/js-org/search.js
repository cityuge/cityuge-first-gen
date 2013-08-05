$(document).ready(function () {
	var timeoutId;
	var typeahead;
	function doneResizing() {
		if ($(window).width() < 980) {
			$('.search-course-field').typeahead('destroy');
		} else {
			$('.search-course-field').typeahead('destroy');
			typeahead = $('.search-course-field').typeahead({
				name: 'courses',
				prefetch: '/courses.json',
				template: [
					'<div class="clearfix"><h4 class="pull-left search-course-code">{{value}}</h4>',
					'<span class="pull-right label">{{category}}</span></div>',
					'<p class="search-course-title">{{title}}</p>'
				].join(''),
				engine: Hogan
			});

			// Navigate to the course info page directly when user selected an item in typeahead
			typeahead.on('typeahead:selected',function(event, data){
				var courseCode = data.value.toLowerCase();
				window.location = window.location.protocol + '//' + window.location.host + '/courses/' + courseCode;
			});
		}
	}

	// run the resize function when the page is loaded as it can be a mobile device
	doneResizing();

	$(window).resize(function() {
		clearTimeout(timeoutId);
		timeoutId = setTimeout(doneResizing, 500);
	});

});