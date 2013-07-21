define(['jquery'], function($){

	$('.sponsor_delete').click(function(event){
		event.preventDefault();
		var row = $(this).parents('tr');
	
		var name = $(row).find('.sponsor_name').text();		
		var href = $(this).attr('href');
	
		if(confirm('Are you sure you want to delete\n' + name +'?')) {
			$.getJSON(href);
			row.remove();
		}
		else {
			return false;
		}
	});
	
});