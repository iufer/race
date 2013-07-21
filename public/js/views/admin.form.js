define(['jquery','bootstrap','helpers/wl_Editor','helpers/wl_Color','helpers/wl_Number'], function($){

	var $content = $('.container-main');
	
	// Integers and decimals
	$content.find('input[type=number].integer').wl_Number();
	$content.find('input[type=number].decimal').wl_Number({decimals:2,step:0.5});
	
	// Color Pickers
	$content.find('input.color').wl_Color({mousewheel:false});
		
	//WYSIWYG Editor
	$content.find('textarea.html').wl_Editor();
		

	/*----------------------------------------------------------------------*/
	/* Helpers
	/*----------------------------------------------------------------------*/
	
	//placholder in inputs is not implemented well in all browsers, so we need to trick this		
	$("[placeholder]").bind('focus.placeholder',function() {
		var el = $(this);
		if (el.val() == el.attr("placeholder") && !el.data('uservalue')) {
			el.val("");
			el.removeClass("placeholder");
		}
	}).bind('blur.placeholder',function() {
		var el = $(this);
		if (el.val() == "" || el.val() == el.attr("placeholder") && !el.data('uservalue')) {
			el.addClass("placeholder");
			el.val(el.attr("placeholder"));
			el.data("uservalue",false);
		}else{
		
		}
	}).bind('keyup.placeholder',function() {
		var el = $(this);
		if (el.val() == "") {
			el.data("uservalue",false);
		}else{
			el.data("uservalue",true);
		}
	}).trigger('blur.placeholder');
	
});