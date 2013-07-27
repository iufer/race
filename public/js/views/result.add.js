define(['jquery','race','jqueryui','bootstrap'], function($, Race){

	var rider_category_locked = false;


	$('#tab-special').bind('tabshown', function(){
		// hide the data entry form
		$('#result_data_entry, #result_data_submit').hide();
	}).bind('tabhidden', function(){
		$('#result_data_entry, #result_data_submit').show();
	});
	
	
	$('#add_data_row').click(function(){	
		// clone the default 
		var new_data_entry = $('#result_data_entry_row').clone(true, true);
		$(new_data_entry).attr('id', null);

		var b = $('<a />')
				.addClass('result_data_new')
				.addClass('btn')
				.addClass('btn-small')
				.html('<i class="icon-minus"></i>')
				.click(function(){
					$(this).parents('.result_data_entry').remove();
				});
		// reset the fields
		$('.result_data_field', new_data_entry).val('');
		$('.result_note_field', new_data_entry).val('');		
		$('.actions', new_data_entry).html('').append(b);
		
		$('#result_data_entries').prepend(new_data_entry);
		
	});
	
	// $('#rider_id').prop('disabled',true);
	
	$('#rider_category_lock').click(function(){
		var locked = $(this).find('.ui-icon').hasClass('ui-icon-locked');
		if(locked){
			rider_category_locked = false;
			$(this).find('.ui-icon').addClass('ui-icon-unlocked').removeClass('ui-icon-locked');
		}
		else {
			rider_category_locked = true;
			$(this).find('.ui-icon').removeClass('ui-icon-unlocked').addClass('ui-icon-locked');			
		}
	});
	

	//$('#result_scope_switch').toggle(
	$('#tab-global').click(function(){			
		$('#result_scope_global').val(1);
	});

	$('#tab-single').click(function(){
		$('#result_scope_global').val(0);
	});
	
	
	//hijack the results add form

	var formlocked = false;
	
	$('#form_result_add').bind('submit', function(event){		
		event.preventDefault();
		if(formlocked) {
			alert('Please wait until the results are finished posting');
			return false;
		}
		
		// check if there are valid data inputs
		var pass = false;
		
		$('.result_data_field').each(function(){
			if($(this).val() != '') pass = true;
		});
		if(pass == false){
			$('#form_error').show().addClass('alert-warning').find('.alert-content').html('Please enter data before submitting');
			return false;
		}
		
		$.ajax({
				type: 'POST',
				url: $(this).attr('action'), 
				data: $(this).serialize(),
				beforeSend: function(){
					lockForm();
				}, 
				success: function(data){
					unlockForm();
					//console.log(data);
					if(data.error){
						// plant the error
						$('#form_error').show().addClass('alert-warning').find('.alert-content').html(data.error);
					}
					else {
						// clear the rider name
						$('#rider_name').val('').focus();
						$('#rider_id').val('');
						$('.result_data_field').val('');
						$('.result_note').val('');
						$('#form_error').show().removeClass('alert-warning').find('.alert-content').html("Saved result for " + data.rider_name);
						
						// refresh the results table
						$('#race_results_block').load('../../result/race/' + race_id);
					}						
				}
		});
	});
	

	function lockForm(){
		formlocked = true;
		$('#submit_result_loading').show();
	}
	
	function unlockForm(){
		formlocked = false;
		$('#submit_result_loading').hide();
	}
	
	$('.result_delete').live('click', function(event){
		event.preventDefault();
		href = $(this).attr('href');
		$.getJSON(href, function(){
			$('#race_results_block').load('../../result/race/' + race_id);
		});
		return false;
	});

	$('#rider_name').autocomplete({
		source:"../../../rider/search/",
		minLength: 2,
		select: function(event, ui){
			event.preventDefault();
			// console.log(ui.item);
			$('#rider_name').val(ui.item.label);
			$('#rider_id').val(ui.item.value);

			// auto focus on the first data item
			$('.result_data_field').eq(0).focus();

			if(rider_category_locked == false){
				$('#rider_category_id').val(ui.item.rider_category_id);		
			}
		},
		autoFocus: true
	});
	
	$('#create_placings').click(function(e){
		e.preventDefault();
		
		href = $(this).attr('href');
		$.getJSON(href, function(){
			$('#race_results_block').load('../../result/race/' + race_id);
		});
		
		return false;
	});
	
	var editModal = $('#result_edit_modal').modal({show: false});

	$('.result_edit').live('click', function(event){
		event.preventDefault();
		href = $(this).attr('href');
		// open a modal window
		$('#result_edit_modal .modal-body').load(href, function(){
			console.log('loaded', href);
			// $('#result_edit').dialog('open');
			$('#result_edit_modal').modal('show');
		});
	});
	
	// $('#result_edit').dialog({
	// 		autoOpen: false,
	// 		height: 480,
	// 		width: 640,
	// 		modal: true,
	// 		buttons: {
	$('#result_edit_modal').on('hidden', function(){
		// find the form inside here
		$.ajax({type:'POST', 
				url: $('#result_edit_modal form').attr('action'), 
				data: $('#result_edit_modal form').serialize(), 
				success: function(response){ 
					console.log('sent form', response);
					// $('#result_edit_modal').dialog( "close" );
					// force reload of the results
					$('#race_results_block').load('../../result/race/' + race_id);
				}
			});					
	});
	

	$('a[data-toggle="tab"]').on('shown', function (e) {
	  $(e.target).trigger('tabshown'); // activated tab
	  $(e.relatedTarget).trigger('tabhidden'); // previous tab
	});


});




