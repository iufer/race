define(['jquery','helpers/date','plugins/jquery.ui.timepicker'], function($){
	
	// on page load fire focus on the name
	$('#message_title').focus();

	$('#message_time_expires_field').timepicker({
	    showPeriod: true,
	    showLeadingZero: false,
		onSelect: function(){
			hour = $(this).timepicker('getHour');
			min = $(this).timepicker('getMinute');
			isotime = hour +':'+ min +':00';
			//console.log(isotime);
			$('#message_time_expires').val(isotime);
			$.timepicker._hideTimepicker();
		}
	}).timepicker('setTime', $('#message_time_expires').val());
		
});	
