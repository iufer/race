require.config({
	// The shim config allows us to configure dependencies for
	// scripts that do not call define() to register a module
	shim: {
		'underscore': {
			exports: '_'
		},
		'bootstrap': {
			deps: ['jquery'],
			exports: 'Bootstrap'
		},
		'raphael': {
			deps: ['jquery'],
			exports: 'Raphael'
		},
		'plugins/jquery.tools.min': ['jquery'],
		'plugins/jquery.ui.timepicker': ['jquery','jqueryui'],
		'plugins/jquery.miniColors': ['jquery','jqueryui'],
		'editor': ['jquery']
	},
	paths: {
		jquery: 'libs/jquery',
		jqueryui: 'libs/jquery-ui',
		underscore: 'libs/underscore',
		bootstrap: 'libs/bootstrap',
		raphael: 'libs/raphael',
		text: 'plugins/require/text',
		domready: 'plugins/require/domReady'
	}
});