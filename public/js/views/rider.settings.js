define(['jquery'], function($){
	$('#new_rider_category').wl_Form({
		onSuccess: function(data, t, jqxhr){
			// console.log(data, data.id, data.name);
			var l = $('<li />').attr('id', 'ridercategoryid_'+ data.id).addClass('rider_category');
			var i = $('<input type="text" />').addClass('rider_category_name').attr('name', 'rider_category_name').attr('value', data.name).css('width','50%');
			var a = $('<a />').attr('href', "<?= site_url("admin/rider_category/save/") ?>"+ data.id).addClass('rider_category_save').html('save').hide();
			var d = $('<button />').attr('type',"button").addClass("rider_category_delete").data('rider-category-id', data.id).html('Delete');
			
			$(l).append(i,a,d).appendTo('#rider_categories');
			$('#new_rider_category_input').val('');
		}
	});

	$('.rider_category_name').live('keyup', function(e){
		// find the save button
		$(this).siblings('.rider_category_save').show();
	});

	$('.rider_category_save').live('click', function(event){
		event.preventDefault();
		// get the new desc
		var newname = $(this).siblings('.rider_category_name').val();		
		$.getJSON( $(this).attr('href'), {'name': newname}, $.proxy(function(data){
			$(this).hide(); //save button
			// console.log(data);
		}, this));
	}).hide();

	$('.rider_category_delete').click(function(e){
		e.preventDefault();
		
		var delete_id = $(this).data('rider-category-id');
		var category = $(this).siblings('input').val();
		$dialog.html('<p>This will delete the rider category: '+ category +'</p><p>Replace races in this group with:</p>');
		//list = $('<p>Replace races in this group with: <select><option value="2">B Group</option><option value="3">C Group</option></select><p>');						
		$.getJSON('<?= site_url("admin/rider_category/listing") ?>', {omit: delete_id}, function(data){
			var s = $('<select />');
			//console.log(data);
			$(data).each(function(){
				//console.log(key, name);
				$('<option />').html(this.name).attr('value', this.id).appendTo(s);
			});
			$dialog.append(s);
		});
		
		$dialog.data('delete_id', delete_id);
		// $dialog.append(list);
		$dialog.dialog('open');
	});

	var $dialog = $("<div />").dialog({
				title: "Are you sure?",
				autoOpen: false,
				resizable: false,
				height:240,
				modal: true,
				buttons: {
					"Yes Delete": function() {
						var replace_id = $(this).find('select').eq(0).val();
						var delete_id = $(this).data('delete_id');
						var delete_url = '<?php echo site_url("admin/rider_category/del") ?>/' + delete_id + '/' + replace_id;
							//console.log(delete_url);
						$.getJSON(delete_url, function(data){
							//remove the list element
							// console.log(data, 'remove #ridercategoryid_'+ data.id);
							$('#ridercategoryid_'+ data.id).remove();
						});
						
						$( this ).dialog( "close" );
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
});