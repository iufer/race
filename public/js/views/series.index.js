define(['jquery'], function($){

	$('.series_delete').click(function(event){
		event.preventDefault();
		var row = $(this).parents('tr');
		
		var series_name = $(row).find('.series_name').text();		
		var href = $(this).attr('href');
		
		if(confirm('Are you sure you want to delete\n' + series_name +'?\n\nThis will not remove the races in this series.')) {
			$.getJSON(href);
			row.remove();
		}
		else {
			return false;
		}
	});

	
});