define(['jquery'], function($){
	
	$('.course_delete').click(function(event){
		event.preventDefault();
		var row = $(this).parents('tr');
	
		var course_name = $(row).find('.course_name').text();		
		var href = $(this).attr('href');
	
		if(confirm('Are you sure you want to delete\n' + course_name + '?')) {
			$.getJSON(href);
			row.remove();
		}
		else {
			return false;
		}
	});

});