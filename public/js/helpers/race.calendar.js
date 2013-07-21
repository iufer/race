define(['jquery','race','domready','plugins/jquery.tools.min'], function($, Race){
	
	var current = 0;
	
	Race.moveCalendar = function(e){
		e.preventDefault();
		if($(this).data('action') === 'next'){
			current += 1;						
		}	
		else {
			current -= 1;
		}
		Race.drawCalendar();
	};
	
	Race.drawCalendar = function(){
		$('.calendar-loading').show();
		$.get(Race.base +'race/calendar/'+ current, function(data){
			$('.calendar').html(data);
			if(current === 0){
				$('button[data-action="prev"]').addClass('disabled');
			}
			else {
				$('button[data-action="prev"]').removeClass('disabled');							
			}
			$('.calendar-loading').hide();
			$('a[rel=tooltip]').tooltip({placement:'right'});
		});					
	};
	
	Race.drawCalendar();
	
	$('.calbutton').live('click', Race.moveCalendar);
		
});