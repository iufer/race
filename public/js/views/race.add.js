define(['jquery','plugins/jquery.ui.timepicker','bootstrap'], function($){
	
	// on page load fire focus on the name
	$('#race_name').focus();

	$("#race_status_radio").buttonset();
	
	$('#race_start_time_field').timepicker({
	    showPeriod: true,
	    showLeadingZero: false,
		onSelect: function(){
			hour = new String($(this).timepicker('getHour'));
			min = new String($(this).timepicker('getMinute'));
			if(min.length == 1) min = '0'+ min;
			if(hour.length == 1) hour = '0' + hour;

			isotime = hour +':'+ min +':00';
			console.log(isotime);
			$('#race_start_time').val(isotime);

			d = Date.parseExact(isotime, 'HH:mm:ss');
			console.log(d);
			regtime = d.add({minutes:-15}).toString('HH:mm:ss');			
			console.log(regtime);
			$('#race_registration_time_field').timepicker('setTime', regtime);

			$.timepicker._hideTimepicker();
		}
	}).timepicker('setTime', $('#race_start_time').val());

	$('#race_registration_time_field').timepicker({
	    showPeriod: true,
	    showLeadingZero: false,
		onSelect: function(){
			hour = $(this).timepicker('getHour');
			min = $(this).timepicker('getMinute');
			isotime = hour +':'+ min +':00';
			console.log(isotime);
			$('#race_registration_time').val(isotime);
			$.timepicker._hideTimepicker();
		}
	}).timepicker('setTime', $('#race_registration_time').val());
		

	$('#race_point_bracket').bind('change', function(){
		if( $(this).val() == 0 ){
			$('#race_point_bracket_multiplier').prop('disabled',true);
		}
		else {
			$('#race_point_bracket_multiplier').prop('disabled',false);			
		}
	}).trigger('change');
	
	$('.race_delete').click(function(event){
		event.preventDefault();
		var row = $(this).parents('tr');
		
		var race_name = $('.race_name').eq(0).text();
		var href = $(this).attr('href');
		
		if(confirm('Are you sure you want to delete\n' + race_name +'?\n\nThis will also remove all results for this race.')) {
			$.getJSON(href);
			// go to index
			document.location = '../';
		}
		else {
			return false;
		}
	});

	$('.nav-tabs a.default, .nav-pills a.default').tab('show');
	$('a[href='+ window.location.hash +']').tab('show');	
	
	
});	
