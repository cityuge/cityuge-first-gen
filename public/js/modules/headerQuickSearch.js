define([
	'jquery',
	'underscore',
	'config/responsive',
	'typeahead',
	'text!templates/quickSearchTypeaheadItem.html'
], function ($, _, responsiveConfig, typeahead, typeaheadItemTmpl) {
	var headerQuickSearch = {
		typeahead: null,
		$input: null,

		init: function() {
			$input = $('#header-quick-search input[type="text"]');

			if ($(window).width() >= responsiveConfig.smMin) {
				this.enableTypeahead();
			}

			// Disable the typeahead if the navbar is collapsed, reenable it when the navbar does not collasped
			var that = this;
			$(window).resize(_.throttle(function() {
				if ($(window).width() >= responsiveConfig.smMin) {
					if (that.typeahead === null) {
						that.enableTypeahead();
					}
				} else {
					if (that.typeahead !== null) {
						that.disableTypeahead();
					}
				}
			}, 800));
		},
		enableTypeahead: function() {
			this.typeahead = $input.typeahead({
				name: 'quick-search-courses',
				prefetch: '/web-api/courses/typeahead',
				template: _.template(typeaheadItemTmpl),
				limit: 5
			});

			// Navigate to the course info page directly when user selected an item in typeahead
			this.typeahead.on('typeahead:selected',function(event, data){
				var courseCode = data.value.toLowerCase();
				window.location = window.location.protocol + '//' + window.location.host + '/courses/' + courseCode;
			});
		},
		disableTypeahead: function() {
			$input.typeahead('destroy');
			this.typeahead = null;
		}
	};

	return headerQuickSearch;
});
