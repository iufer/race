define(['jquery','race','raphael', 'plugins/raphael.makeBubble'], function($, Race, Raphael){
	
	var txt_attending = "&#9786; You are attending";

	$('.will_attend').click(function(e){
		e.preventDefault();
		var href = $(this).attr('href');
		// send ajax to server to say +1
		$.getJSON(href, function(data){
			// increment the number
			if(!data.error ){		
				$('.race_will_attend').html( data.race_will_attend_count );
				$('.will_attend').addClass('disabled').html(txt_attending);
			}
		});
	});	

});