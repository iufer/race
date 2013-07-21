define(['jquery'], function($){

	$('.flickr_badge_image').each(function(){
		var li =$('<li />').addClass('span1').html( $(this).html() ).appendTo('#flickr');
		li.find('a').addClass('thumbnail');
	});
	
});