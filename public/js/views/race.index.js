define(['jquery'], function($){

	$('.race_delete').click(function(event){
		event.preventDefault();
		var row = $(this).parents('tr');
		
		var race_name = $(row).find('.race_name').text();		
		var href = $(this).attr('href');
		
		if(confirm('Are you sure you want to delete\n' + race_name +'?\n\nThis will also remove all results for this race.')) {
			$.getJSON(href);
			row.remove();
		}
		else {
			return false;
		}
	});
	
	$('.race_status').bind('change', function(){
		var race_id = $(this).attr('name');
		var status_id = $(this).val();
		if(!race_id || !status_id) return false;
		
		$.getJSON('race/setstatus', {'race_id': race_id, 'status_id':status_id});
	})
	
});