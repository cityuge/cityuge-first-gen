define([
	'jquery',
	'underscore',
	'masonry',
	'config/socialMedia'
], function ($, _, Masonry, socialMediaConfig) {
	var comment = {
		init: function() {
			this.masonryLayout();
			this.socialMediaLink();
		},
		masonryLayout: function() {
			new Masonry('#comment-container', {
				transitionDuration: 0,
				itemSelector: '.comment-wrapper',
				columnWidth: '.comment-wrapper-dummy'
			});
		},
		socialMediaLink: function() {
			var that = this;
			$('ul[data-share-list] a').click(function(e) {
				e.preventDefault();
				$el = $(this);
				window.open($el.attr('href'), '', that.socialMediaPopUpSpec($el.attr('data-share')));
			});
		},
		socialMediaPopUpSpec: function(mediaKey) {
			var socialMedia = socialMediaConfig[mediaKey];
			return 'scrollbars=yes,resizable=yes,toolbar=no,location=yes,width=' + socialMedia.width
					+ ',height=' + socialMedia.height
					+ ',left=' + ((screen.width - socialMedia.width) / 2)
					+ ',top=' + ((screen.height - socialMedia.height) / 2);
		}
	};

	return comment;
});
