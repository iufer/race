requirejs([
	'jquery',
	'underscore',
	'bootstrap',
	'race',
	'helpers/race.fonts'
], function($, _, Bootstrap, Race){
		
	$('#nav').delegate('li','click.wl', function(event){
		var _this = $(this),
			_parent = _this.parent(),
			a = _parent.find('a');
		_parent.find('ul').slideUp('fast');
		a.removeClass('active');
		_this.find('ul:hidden').slideDown('fast');
		_this.find('a').eq(0).addClass('active');
		event.stopPropagation();
	});	
		
});