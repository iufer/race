define(['jquery','race','helpers/race.utils','jqueryui'], function($, Race){

	$('#series_name').focus();
	
	//$('#course_url').disable();
	$('#series_name').bind('blur', function(){
		$('#series_url').val(Race.makeURLFriendly($(this).val()));
	});
	
	$('#series_date_start, #series_date_end').datepicker({ dateFormat: 'yy-mm-dd' });
	
});
