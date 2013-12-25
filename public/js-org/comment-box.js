// Show tooltip on grade
$(document).ready(function () {
	$('span[data-toggle=tooltip]').tooltip({ placement: 'left' });
});

// Social media share buttons shown in individual comment
$('.social-media-dropdown').sharrre({
	share: {
		facebook: true,
		twitter: true,
		googlePlus: true
	},
	urlCurl: '',
	template: '<li><a href="#" class="facebook"><i class="icon-facebook-sign"></i> Facebook</a></li>'
			+ '<li><a href="#" class="twitter"><i class="icon-twitter-sign"></i> Twitter</a></li>'
			+ '<li><a href="#" class="google-plus"><i class="icon-google-plus-sign"></i> Google+</a></li>',
	enableHover: false,
	enableTracking: false,
	buttons: { twitter: { via: 'swiftzer' }},
	render: function(api, options) {
		$(api.element).on('click', '.facebook', function() {
			api.openPopup('facebook');
			$('[data-toggle="dropdown"]').parent().removeClass('open');
		});
		$(api.element).on('click', '.twitter', function() {
			api.openPopup('twitter');
			$('[data-toggle="dropdown"]').parent().removeClass('open');
		});
		$(api.element).on('click', '.google-plus', function() {
			api.openPopup('googlePlus');
			$('[data-toggle="dropdown"]').parent().removeClass('open');
		});
	}
});