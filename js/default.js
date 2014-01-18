/**
 * Default script for pages without special requirements.
 */
require([
	'jquery',
	'modules/headerQuickSearch',
	'bootstrap'
], function ($, headerQuickSearch) {
	$(document).ready(function() {
		headerQuickSearch.init();
	});
});