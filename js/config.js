/**
 * Require.JS config
 */
require.config({
	// The shim config allows us to configure dependencies for
	// scripts that do not call define() to register a module
	shim: {
		jquery: {
			exports: 'jQuery'
		},
		underscore: {
			exports: '_'
		},
		bootstrap: ['jquery'],
		typeahead: ['jquery']
	},
	paths: {
		jquery: 'vendor/jquery/jquery',
		text: 'vendor/requirejs/text',
		underscore: 'vendor/underscore/underscore',
		bootstrap: 'vendor/bootstrap/bootstrap',
		typeahead: 'vendor/typeahead/typeahead',
		masonry: 'vendor/masonry/masonry.pkgd'
	}
});