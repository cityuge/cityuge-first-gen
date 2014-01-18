/**
 * Script for view all comments page.
 */
require([
	'jquery',
	'modules/headerQuickSearch',
	'modules/comment',
	'bootstrap'
], function ($, headerQuickSearch, comment) {
	$(document).ready(function() {
		headerQuickSearch.init();
		comment.init();
	});
});