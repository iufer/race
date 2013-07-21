define(['jquery','jqueryui'], function($){
	
	// Hijack the default form and hide the submit button
	// we'll be auto submitting the sort results
	
	$('input[name=race_types_order]').hide();
	
	$('#race_types_sortable')
		.sortable()
		// .disableSelection()
		.bind('sortupdate', function(event, ui){
			// build a list of id => order
			// console.log(
			// 				$('#race_types_sortable').sortable('serialize')
			// 			);
			// $('input[name=race_types_order]').text('Save').show();		
			$('#race_types_edit').trigger('submit');
		});
	
	$('#race_types_edit').bind('submit', function(event){
		event.preventDefault();
		var action = $(this).attr('action');
		var data = $('#race_types_sortable').sortable('serialize');
		$.getJSON(action, data, function(data){			
			// console.log('data');
			// $('input[name=race_types_order]').val('Saved!').fadeOut('slow');
		});
	})

	$('.race_type_description').bind('keyup', function(event){
		event.preventDefault();
		// console.log('update description for '+ $(this).data('race-type-id'));
		$(this).siblings('.race_type_save').show();
	});
	
	$('.race_type_save').click(function(event){
		event.preventDefault();
		// get the new desc
		var desc = $(this).siblings('.race_type_description').val();		
		$.getJSON( $(this).attr('href'), {'race_type_description': desc}, $.proxy(function(data){
			$(this).hide(); //save button
			// console.log(data);
		}, this));
	}).hide();
	
});