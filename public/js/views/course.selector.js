define(['jquery','bootstrap'], function($){
		
	$.expr[":"].contains = $.expr.createPseudo(function(arg) {
	    return function( elem ) {
	        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
	    };
	});

	$('#course_selector').modal({show:false});

	$('.course_name a').click(function(event){
		event.preventDefault();
		$('.course_clear').show();
		var id = $(this).data('course-id');
		$('#course_id').val(id);
		$( '#course_selector' ).modal('hide');
		$('#course_name').html( $(this).text() );
	});

	list = '.course_selector_data';

	$('input.course_search').bind('keyup', function() {
		var filter = $(this).val();

		console.log(filter);

		if (filter) {
			$(list).find("td.course_name a:not(:contains(" + filter + "))").parents('tr').hide();
			$(list).find("td.course_name a:contains(" + filter + ")").parents('tr').show();
		} else {
			$(list).find("tr").show();
		}
	});	

	$('.course_clear').click(function(event){
		event.preventDefault();
		$('#course_id').val('');
		$('#course_name').html('No course selected');
		$(this).hide();
	});

	$('.course_search_clear').click(function(event){
		event.preventDefault();
		$('.course_search').val('');
		$(list).find("tr").slideDown();
	});
	
});