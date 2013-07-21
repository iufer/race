define(['jquery','bootstrap'], function($){
	
	$('#race_selector').modal({show:false});

	// race selector
	$('.race_item').each(function(){
		// preset the ones that we already have on the page
		var url = $(this).data('race-url');
		// console.log(url);
		$('#'+ url).addClass('selected');
	});	

	$('.race_name a').click(function(event){
		event.preventDefault();

		var id = $(this).data('race-id');
		var name = $(this).text();
		var date = $(this).parent().siblings('.race_date').text();
		var d = $(this).parents('tr').data('race-date');
		var url = $(this).parents('tr').data('race-url');

		//look for this race if its already selected
		if($('#race_id_'+id).length > 0) { 
			//$.fancybox.close();			
			return false; 
		}

		// create a new entry 
		var race_item = $('<li />')
						.attr('id','race_id_'+id)
						.addClass('race_item')
						.data('race-url', url)
						.data('race-date', d);
		$('<span />')
			.addClass('race_name')
			.html(name +' ('+ date +')')
			.appendTo(race_item);

		$('<input />')
			.attr('type','hidden')
			.attr('name','races[]')
			.addClass('race_id')
			.val(id)
			.appendTo(race_item);

		$('<a />')
			.addClass('race_clear')
			.addClass('btn')
			.addClass('btn-mini')
			.text('Remove')
			.appendTo(race_item);

		race_item.appendTo('#race_list');
		raceListSort();
		//$.fancybox.close();
		$(this).parents('tr').addClass('selected');
	});

	var list = '.race_selector_data';

	$('input.race_search').bind('keyup', function() {
		var filter = $(this).val();

		// console.log(filter);

		if (filter) {
			$(list).find("td.race_name a:not(:contains(" + filter + "))").parents('tr').hide();
			$(list).find("td.race_name a:contains(" + filter + ")").parents('tr').show();
		} else {
			$(list).find("tr").show();
		}
	});	

	$('.race_clear').live('click', function(event){
		event.preventDefault();
		url = $(this).parents('.race_item').data('race-url');
		$('#'+ url).removeClass('selected');
		$(this).parent().remove();
	});

	$('.race_search_clear').click(function(event){
		event.preventDefault();
		$('.race_search').val('');
		$(list).find("tr").show();
	});

	$.expr[":"].contains = $.expr.createPseudo(function(arg) {
	    return function( elem ) {
	        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
	    };
	});

	function raceListSort(){
		// sorts the race_list race_items based on their data-race-date property
		var mylist = $('#race_list');
		var listitems = mylist.children('.race_item').get();
		listitems.sort(function(a, b) {
		   var compA = $(a).data('race-date');
		   var compB = $(b).data('race-date');
		   return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
		})
		$.each(listitems, function(idx, itm) { mylist.append(itm); });
	}
	
});