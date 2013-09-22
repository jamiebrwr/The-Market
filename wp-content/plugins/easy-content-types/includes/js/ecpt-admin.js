jQuery(document).ready(function($) {
	// show tool tips on click
	$('a.ecpt-help').click(function(e) {
		e.preventDefault();
		var showToolTip = {
			'text-decoration' : 'none',
			'visibility' : 'visible',
			'opacity' : '1',
			'-moz-transition' : 'all 0.2s linear',
			'-webkit-transition' : 'all 0.2s linear',
			'-o-transition' : 'all 0.2s linear',
			'transition' : 'all 0.2s linear'
		}
		var hideToolTip = {
			'visibility' : 'hidden',
			'opacity' : '0',
			'-moz-transition' : 'all 0.4s linear',
			'-webkit-transition' : 'all 0.4s linear',
			'-o-transition' : 'all 0.4s linear',
			'transition' : 'all 0.4s linear'
		}
		$(this).children().css(showToolTip);
		$(this).mouseout(function(){
			$(this).children().css(hideToolTip);
		});
	});

	// hide/show advanced label options
	$('.ecpt-advanced-labels').on('click', function() {
		$('#ecpt-advanced-labels').slideToggle();
		$('.ecpt-advanced-labels').toggle();
		return false;
	});

	// delete post type function
	$('#ecpt-wrap .ecpt-post-type-delete').click(function(){
		if(confirm(ecpt_vars.delete_post_type)) {
			return true;
		}
		return false;
	});

	// delete taxonomy function
	$('#ecpt-wrap .ecpt-delete-taxonomy').click(function(){
		if(confirm(ecpt_vars.delete_taxonomy)){
			return true
		}
		return false;
	});
	// delete metabox function
	$('#ecpt-wrap .ecpt-delete-metabox').click(function(){
		if(confirm(ecpt_vars.delete_metabox))
		{
			return true;
		}
		return false;
	});
	// delete field function
	$('#ecpt-wrap .ecpt-delete-field').click(function(){
		if(confirm(ecpt_vars.delete_field))
		{
			return true;
		}
		return false;
	})

	// check for posttype name on submit
	$('#ecpt-add-posttype #ecpt-submit').click(function() {
		if($('#ecpt-post-type-name').val() == '') {
			alert(ecpt_vars.enter_post_type_name);
			return false;
		}
	});

	$('#ecpt-wrap .posttype-update').click(function(){
		$(this).attr('disable', true).addClass('disabled');
	});

	// check for metabox name on submit
	$('#ecpt-add-metabox #ecpt-submit').click(function() {
		if($('#ecpt-metabox-name').val() == '') {
			alert(ecpt_vars.enter_metabox_name);
			return false;
		}
	});


	// check for taxonomy name on submit
	$('#ecpt-add-taxonomy #ecpt-submit').click(function() {

		if($('#ecpt-taxonomy-name').val() == '') {
			alert(ecpt_vars.enter_taxonomy_name);
			return false;
		}
		if(!$('#ecpt-taxonomy-object option:selected').length) {
			alert(ecpt_vars.select_taxonomy_object);
			return false;
		}
	});



	// make fields sortable via drag and drop
	$(function() {
		$("#ecpt-wrap .wp-list-table tbody").sortable({
			handle: '.dragHandle', items: '.ecpt-field', opacity: 0.6, cursor: 'move', axis: 'y', update: function() {
				var order = $(this).sortable("serialize") + '&action=ecpt_update_field_listing';
				$.post(ajaxurl, order, function(theResponse){
				});
			}
		});
	});

	// check for field name on submit
	$('#ecpt-add-new-field #ecpt-submit').click(function() {
		if($('#ecpt-field-name').val() == '') {
			alert(ecpt_vars.enter_field_name);
			return false;
		}
	});

	// disable options field unless SELECT or RADIO type is chosen
	$('#ecpt-field-type').change(function(){
		var id = $('option:selected', this).prop("id");
		var hiddenFields = '.ecpt-disabled';
		var richEditor = '.ecpt-rich-editor-disabled';
		var max = '.ecpt-max-disabled';
		if(id == 'select' || id == 'radio' || id == 'multicheck') {
			$(hiddenFields).fadeIn();
			$(richEditor).fadeOut();
			$(max).fadeOut();
		} else if(id == 'textarea') {
			$(richEditor).fadeIn();
			$(hiddenFields).fadeOut();
			$(max).fadeOut();
		} else if(id == 'slider') {
			$(max).fadeIn();
			$(hiddenFields).fadeOut();
			$(richEditor).fadeOut();
		} else {
			$(hiddenFields).fadeOut();
			$(richEditor).fadeOut();
			$(max).fadeOut();
		}
	});

	// disable options field unless SELECT or RADIO type is chosen
	$('#field-type').change(function(){
		var field_id = $('option:selected', this).prop("id");
		if(field_id == 'select' || field_id == 'radio' || field_id == 'multicheck') {
			$('#field-options').fadeTo('fast', 100);
			$('#field-options').prop('disabled', '');
		} else {
			$('#field-options').fadeTo('slow', 0.5);
			$('#field-options').prop('disabled', 'true');
		}
	});


	if($('.ecpt_upload_image_button').length > 0 ) {
		// Media Uploader
		var formfield = '';

        $('.ecpt_upload_image_button').on('click', function(e) {
            e.preventDefault();
            window.formfield = $(this).prev();
            if (ecpt_vars.post_id != null ) {
                var post_id = 'post_id=' + ecpt_vars.post_id + '&';
            }
            tb_show('', 'media-upload.php?' + post_id +'TB_iframe=true');
        });

        window.original_send_to_editor = window.send_to_editor;
        window.send_to_editor = function (html) {
            if (window.formfield) {
                imgurl = $('a', '<div>' + html + '</div>').attr('href');
                window.formfield.val(imgurl);
                window.clearInterval(window.tbframe_interval);
                tb_remove();
            } else {
                window.original_send_to_editor(html);
            }
            window.formfield = '';
            window.imagefield = false;
        }

	}

	if($('.form-table .ecpt-slider').length > 0 ) {
		$('.ecpt-slider').each(function(){
			var $this = $(this);
			var id = $this.attr('rel');
			var val = $('#' + id).val();
			var max = $('#' + id).attr('rel');
			max = parseInt(max);
			//var step = $('#' + id).closest('input').attr('rel');
			$this.slider({
				value: val,
				max: max,
				step: 1,
				slide: function(event, ui) {
					$('#' + id).val(ui.value);
				}
			});
		});
	}

	if($('.form-table .ecpt_datepicker').length > 0 ) {
		var dateFormat = 'mm/dd/yy';
		$('.ecpt_datepicker').datepicker({dateFormat: dateFormat});
	}

	// add new repeatable field
	$(".ecpt_add_new_field").on('click', function() {
		var $this = $(this);
		var field = $this.closest('td').find("div.ecpt_repeatable_wrapper:last").clone(true);
		var fieldLocation = $this.closest('td').find('div.ecpt_repeatable_wrapper:last');
		// set the new field val to blank
		$('input', field).val("");
		field.insertAfter(fieldLocation, $this.closest('td'));
		return false;
	});

	// add new repeatable upload field
	$(".ecpt_add_new_upload_field").on('click', function() {
		var $this = $(this);
		var container = $this.closest('tr');
		var field = $this.closest('td').find("div.ecpt_repeatable_upload_wrapper:last").clone(true);
		var fieldLocation = $this.closest('td').find('div.ecpt_repeatable_upload_wrapper:last');
		$('input[type="text"]', field).val("");
		field.insertAfter(fieldLocation, $this.closest('td'));
		return false;
	});

	// remove repeatable field
	$('.ecpt_remove_repeatable').on('click', function(e) {
		e.preventDefault();
		var field = $(this).parent();
		$('input', field).val("");
		field.remove();
		return false;
	});

	$(function() {
		if( $(".ecpt_field_type_repeatable").length ) {
			$(".ecpt_field_type_repeatable").sortable({
				handle: '.dragHandle', items: '.ecpt_repeatable', opacity: 0.6, cursor: 'move', axis: 'y', update: function() {
					var $this = $(this);
					var field = $this.closest('tr');
					var meta_id = $('input.ecpt_repeatable_field_name', field).attr('id');
					var inputs = '';
					$('.ecpt_repeatable input', field).each(function() {
						var $this =  $(this);
						inputs = inputs + $this.attr('name') + '=' + $this.val() + '&';
					});
					var order = inputs + 'action=ecpt_update_repeatable_order&post_id=' + ecpt_vars.post_id + '&meta_id=' + meta_id;
					$.post(ajaxurl, order, function(theResponse){
						// show response here, if needed
						//alert(theResponse);
					});
				}
			});
		}
	});

	$(function() {
		if( $(".ecpt_field_type_repeatable_upload").length ) {
			$(".ecpt_field_type_repeatable_upload").sortable({
				handle: '.dragHandle', items: '.ecpt_repeatable', opacity: 0.6, cursor: 'move', axis: 'y', update: function() {
					var $this = $(this);
					var field = $this.closest('tr');
					var meta_id = $('input.ecpt_repeatable_upload_field_name', field).attr('id');
					var inputs = '';
					$('.ecpt_repeatable input', field).each(function() {
						var $this =  $(this);
						inputs = inputs + $this.attr('name') + '=' + $this.val() + '&';
					});
					var order = inputs + 'action=ecpt_update_repeatable_order&post_id=' + ecpt_vars.post_id + '&meta_id=' + meta_id;
					$.post(ajaxurl, order, function(theResponse){
						// show response here, if needed
						//alert(theResponse);
					});
				}
			});
		}
	});

});