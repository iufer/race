define(['jquery'], function($){

	$('.result_delete a').live('click', function(event){
		event.preventDefault();
		var href = $(this).attr('href');
		$.getJSON(href, function(){
			$('#rider_results_block').load('../../../result/result_block/rider_admin/' + rider_id);
		});
		return false;
	});
	
});