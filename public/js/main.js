requirejs([
	'jquery',
	'underscore',
	'bootstrap',
	'race',
	'helpers/race.fonts',
	'helpers/race.utils'
], function($, _, Bootstrap, Race){
	
	$(function(){
		$('[rel=tooltip]').tooltip({animation:true, placement:'top',trigger:'hover'});
		$('[rel=popover]').popover({animation:true, placement:'top'});
	});
	
});