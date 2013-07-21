define(['jquery','race','helpers/race.utils'], function($, Race){

	$('#course_name').focus();
	$('#course_name').bind('blur', function(){
		$('#course_url').val(Race.makeURLFriendly($(this).val()));
	});
	
});
