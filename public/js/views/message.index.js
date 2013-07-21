define(['jquery'], function($){
	$('.message_expire').bind('click', function(event){
		event.preventDefault();
		var status = $(this).siblings('.message_status').eq(0);
		$.getJSON( $(this).attr('href'), {}, function(){
			// get the date
			$(status).html('-expired-');
			$('#content').prepend('<div class="info alert">Expired</div>');
		});
	});
});