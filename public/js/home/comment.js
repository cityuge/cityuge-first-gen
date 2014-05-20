var comment = (function() {
	var socialMediaLink = function() {
		$('ul[data-share-list] a').click(function(e) {
			e.preventDefault();
			$el = $(this);
			window.open($el.attr('href'), '', socialMediaPopUpSpec($el.attr('data-share')));
		});
	}
	var socialMediaPopUpSpec = function(mediaKey) {
		var socialMedia = config.socialMedia[mediaKey];
		return 'scrollbars=yes,resizable=yes,toolbar=no,location=yes,width=' + socialMedia.width
				+ ',height=' + socialMedia.height
				+ ',left=' + ((screen.width - socialMedia.width) / 2)
				+ ',top=' + ((screen.height - socialMedia.height) / 2);
	}

	return {
		initMasonry: function() {
            if ($('#comment-container').length !== 0) {
                new Masonry('#comment-container', {
                    transitionDuration: 0,
                    itemSelector: '.comment-wrapper',
                    columnWidth: '.comment-wrapper-dummy'
                });
            }
		},
		initComment: function() {
			socialMediaLink();
			$('[data-toggle="tooltip"]').tooltip();
		}
	}
})();