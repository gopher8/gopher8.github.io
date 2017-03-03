var  name_changeRight = function(e) {
	document.getElementById("name").value = e.value;
};
var  name_changeTop = function(e) {
	document.getElementById("huge_it_gallery_name").value = e.value;
};

jQuery(document).ready(function () {
    var setTimeoutConst;
	jQuery(".close_free_banner").on("click",function(){
		jQuery(".free_version_banner").css("display","none");
		photoGalleryWPSetCookie( 'photoGalleryWPBannerShow', 'no', {expires:86400} );
	});
	jQuery('ul#ph-gallery-wp-images-list > li > .ph-gallery-wp-image-container img').on('mouseenter',function () {
		var onHoverPreview = jQuery('#img_hover_preview').prop('checked');
		if(onHoverPreview == true) {
			var imgSrc = jQuery(this).attr('src');
			jQuery('#ph-gallery-wp-gallery-image-zoom img').attr('src', imgSrc);
			setTimeoutConst = setTimeout(function () {
				jQuery('#ph-gallery-wp-gallery-image-zoom').fadeIn('3000');
			}, 500);
		}
	});
	jQuery('ul#ph-gallery-wp-images-list > li > .ph-gallery-wp-image-container img').on('mouseout',function () {
        clearTimeout(setTimeoutConst);
		jQuery('#ph-gallery-wp-gallery-image-zoom').fadeOut('3000');
	});
	setTimeout(function () {
		galleryImgResizeAdminImages();
	},200);
	galleryPopupSizes(jQuery('#light_box_size_fix'));
	jQuery('#light_box_size_fix').change(function(){
		galleryPopupSizes(jQuery(this));
	});
	jQuery('input[data-slider="true"]').bind("slider:changed", function (event, data) {
		jQuery(this).parent().find('span').html(parseInt(data.value)+"%");
		jQuery(this).val(parseInt(data.value));
	});
	jQuery('.ph-gallery-wp-insert-video-button').click(function (e) {
		e.preventDefault();
		var ID1 = jQuery('#photo_gallery_wp_add_video_input').val();
		if (ID1 == "") {
			alert("Please copy and past url form Youtube or Vimeo to insert into slider.");
			return false;
		}
		jQuery(this).parent('form').submit();
	});

	jQuery('#photo_gallery_wp_add_video_input').change(function () {
		if (jQuery(this).val().indexOf("youtube") >= 0) {
			jQuery('#ph-gallery-wp-add-video-popup-options > div').removeClass('active');
			jQuery('#ph-gallery-wp-add-video-popup-options  .youtube').addClass('active');
		} else if (jQuery(this).val().indexOf("vimeo") >= 0) {
			jQuery('#ph-gallery-wp-add-video-popup-options > div').removeClass('active');
			jQuery('#ph-gallery-wp-add-video-popup-options  .vimeo').addClass('active');
		} else {
			jQuery('#ph-gallery-wp-add-video-popup-options > div').removeClass('active');
			jQuery('#ph-gallery-wp-add-video-popup-options  .error-message').addClass('active');
		}
	});
	jQuery('.huge-it-editnewuploader .ph-gallery-wp-edit-image-icon').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = jQuery(this);
		var id = button.attr('id').replace('_button', '');
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				jQuery("#"+id).val(attachment.url);
				jQuery("#save-buttom").click();
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			}
		};

		wp.media.editor.open(button);
		return false;
	});
	jQuery(".huge-it-editnewuploader").click();
	jQuery('.remove-ph-gallery-wp-image-container a').on('click',function () {
		var galleryId = jQuery(this).data('gallery-id');
		var imageId = jQuery(this).data('image-id');
		var removeNonce = jQuery(this).data('nonce-value');
		jQuery('#adminForm').attr('action', 'admin.php?page=photo_gallery_wp_gallery&task=edit_cat&id='+galleryId+'&removeslide='+imageId+'&gallery_nonce_remove_image='+removeNonce);
		galleryImgSubmitButton('apply');
	});
	jQuery(".wp-media-buttons-icon").click(function() {
		jQuery(".attachment-filters").css("display","none");
	});
	var _custom_media = true,
		_orig_send_attachment = wp.media.editor.send.attachment;


	jQuery('.huge-it-newuploader .button').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;

		var button = jQuery(this);
		var id = button.attr('id').replace('_button', '');
		_custom_media = true;

		jQuery("#"+id).val('');
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				jQuery("#"+id).val(attachment.url+';;;'+jQuery("#"+id).val());
				jQuery("#save-buttom").click();
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		};

		wp.media.editor.open(button);

		return false;
	});

	jQuery('.add_media').on('click', function(){
		_custom_media = false;

	});
	jQuery(".wp-media-buttons-icon").click(function() {
		jQuery(".media-menu .media-menu-item").css("display","none");
		jQuery(".media-menu-item:first").css("display","block");
		jQuery(".separator").next().css("display","none");
		jQuery('.attachment-filters').val('image').trigger('change');
		jQuery(".attachment-filters").css("display","none");
	});
	if(jQuery('select[name="display_type"]').val() == 2){
		jQuery('li[id="content_per_page"]').hide();
	}else{
		jQuery('li[id="content_per_page"]').show();
	}
	jQuery('select[name="display_type"]').on('change' ,function(){
		if(jQuery(this).val() == 2){
			jQuery('li[id="content_per_page"]').hide();
		}else{
			jQuery('li[id="content_per_page"]').show();
		}
	});

	jQuery('#gallery-unique-options').on('change',function(){
		jQuery( 'div[id^="ph-gallery-wp-current-options"]').each(function(){
			if(!jQuery(this).hasClass( "active" )){
				jQuery(this).find('ul li input[name="content_per_page"]').attr('name', '');
				jQuery(this).find('ul li select[name="display_type"]').attr('name', '');
			}
			else{
				jQuery(this).find('ul li input#content_per_page').attr('name', 'content_per_page');
				jQuery(this).find('ul li select#display_type').attr('name', 'display_type');
			}
		});
	});

	jQuery('#gallery-unique-options').on('change',function(){
		jQuery( 'div[id^="ph-gallery-wp-current-options"]').each(function(){
			if(jQuery('#ph-gallery-wp-current-options-1').hasClass('active')  || jQuery('#ph-gallery-wp-current-options-3').hasClass('active'))
				jQuery('li.for_slider').show();
			else
				jQuery('li.for_slider').hide();
		});
	});
	jQuery('#gallery-unique-options').change();

	jQuery('#gallery-unique-options').on('change',function(){
		jQuery( 'div[id^="ph-gallery-wp-current-options"]').each(function(){
			if(!jQuery(this).hasClass( "active" )){
				jQuery(this).find('ul li input[name="sl_pausetime"]').attr('name', '');
			}
		});
	});

	jQuery('#gallery-unique-options').on('change',function(){
		jQuery( 'div[id^="ph-gallery-wp-current-options"]').each(function(){
			if(!jQuery(this).hasClass( "active" )){
				jQuery(this).find('ul li input[name="sl_changespeed"]').attr('name', '');
			}
		});
	});

	jQuery( "#ph-gallery-wp-images-list > li input" ).on('keyup',function(){
		jQuery(this).parents("#ph-gallery-wp-images-list > li").addClass('submit-post');
	});
	jQuery( "#ph-gallery-wp-images-list > li textarea" ).on('keyup',function(){
		jQuery(this).parents("#ph-gallery-wp-images-list > li").addClass('submit-post');
	});
	jQuery( "#ph-gallery-wp-images-list > li input" ).on('change',function(){
		jQuery(this).parents("#ph-gallery-wp-images-list > li").addClass('submit-post');
	});
	jQuery('.ph-gallery-wp-edit-image-icon').click(function(){
		jQuery(this).parents("#ph-gallery-wp-images-list > li").addClass('submit-post');
	})
	/*** </posted only submit classes> ***/

	jQuery( "#ph-gallery-wp-images-list" ).sortable({
		start: function(event, ui) {
			ui.item.data('start_pos', ui.item.index());
		},
		stop: function(event, ui) {
			jQuery("#ph-gallery-wp-images-list > li").removeClass('has-background');
			count=jQuery("#ph-gallery-wp-images-list > li").length;
			for(var i=0;i<=count;i+=2){
				jQuery("#ph-gallery-wp-images-list > li").eq(i).addClass("has-background");
			}
			jQuery("#ph-gallery-wp-images-list > li").each(function(){
				jQuery(this).find('.order_by').val(jQuery(this).index());
			});
			var start = Math.min(ui.item.data('start_pos'),ui.item.index());
			var end = Math.max(ui.item.data('start_pos'),ui.item.index());
			for(var i1=start; i1<=end; i1++){
				jQuery(document.querySelectorAll("#ph-gallery-wp-images-list > li")[i1]).addClass('highlights');
			}
		},
		change: function(event, ui) {

		},
		update: function(event, ui) {

		},
		revert: true
	});
	var strliID = jQuery(location).attr('hash');
	jQuery('#ph-gallery-wp-view-tabs li').removeClass('active');
	if (jQuery('#ph-gallery-wp-view-tabs li a[href="' + strliID + '"]').length > 0) {
		jQuery('#ph-gallery-wp-view-tabs li a[href="' + strliID + '"]').parent().addClass('active');
	} else {
		jQuery('a[href="#gallery-view-options-0"]').parent().addClass('active');
	}
	strliID = strliID.split('#').join('.');
	jQuery('#ph-gallery-wp-view-tabs-contents > li').removeClass('active');
	if (jQuery(strliID).length > 0) {
		jQuery(strliID).addClass('active');
	} else {
		jQuery('.gallery-view-options-0').addClass('active');
	}
	jQuery('input[data-slider="true"]').bind("slider:changed", function (event, data) {
		jQuery(this).parent().find('span').html(parseInt(data.value) + "%");
		jQuery(this).val(parseInt(data.value));
	});

	jQuery('#ph-gallery-wp-arrows-type input[name="params[slider_navigation_type]"]').change(function(){
		jQuery(this).parents('ul').find('li.active').removeClass('active');
		jQuery(this).parents('li').addClass('active');
	});
	jQuery('input[data-gallery="true"]').bind("gallery:changed", function (event, data) {
		jQuery(this).parent().find('span').html(parseInt(data.value)+"%");
		jQuery(this).val(parseInt(data.value));
	});

	jQuery('#ph-gallery-wp-view-tabs li a').click(function(){
		jQuery('#ph-gallery-wp-view-tabs > li').removeClass('active');
		jQuery(this).parent().addClass('active');
		jQuery('#ph-gallery-wp-view-tabs-contents > li').removeClass('active');
		var liID=jQuery(this).attr('href').split('#').join('.');
		jQuery(liID).addClass('active');
		liID=liID.replace('.','');
		var action = jQuery('#adminForm').attr('action');
		jQuery('#adminForm').attr('action',action+"#"+liID);
	});

	jQuery('#photo_gallery_wp_sl_effects').change(function(){

		jQuery('.ph-gallery-wp-current-options').removeClass('active');
		jQuery('#ph-gallery-wp-current-options-'+jQuery(this).val()).addClass('active');
		if(jQuery(this).val() == 3 || jQuery(this).val() == 8){
			jQuery('select#rating').parents('li.rating-li').hide();
		}
		else{
			jQuery('select#rating').parents('li.rating-li').show();
		}
	});
	jQuery('#photo_gallery_wp_sl_effects').change();
jQuery('a[href*="remove_photo_gallery_wp"]').click(function(){
		if(!confirm('Are you sure you want to delete this item?'))
			return false;
	});

});
jQuery(window).resize(function () {
	galleryImgResizeAdminImages();
});

function photoGalleryWPSetCookie(name, value, options) {
	options = options || {};

	var expires = options.expires;

	if (typeof expires == "number" && expires) {
		var d = new Date();
		d.setTime(d.getTime() + expires * 1000);
		expires = options.expires = d;
	}
	if (expires && expires.toUTCString) {
		options.expires = expires.toUTCString();
	}


	if(typeof value == "object"){
		value = JSON.stringify(value);
	}
	value = encodeURIComponent(value);
	var updatedCookie = name + "=" + value;

	for (var propName in options) {
		updatedCookie += "; " + propName;
		var propValue = options[propName];
		if (propValue !== true) {
			updatedCookie += "=" + propValue;
		}
	}

	document.cookie = updatedCookie;
}

function photoGalleryWPGetCookie (name) {
	var cookie, allcookie = document.cookie.split(';');
	for (var i = 0; i < allcookie.length; i++) {
		cookie = allcookie[i].split('=');
		cookie[0] = cookie[0].replace(/ +/g,'');
		if (cookie[0] == name) {
			return decodeURIComponent(cookie[1]);
		}
	}
	return false;
}

function galleryImgFilterInputs() {
	var mainInputs = "";
	jQuery("#ph-gallery-wp-images-list > li.highlights").each(function(){
		jQuery(this).next().addClass('submit-post');
		jQuery(this).prev().addClass('submit-post');
		jQuery(this).addClass('submit-post');
		jQuery(this).removeClass('highlights');
	});
	if(jQuery("#ph-gallery-wp-images-list > li.submit-post").length) {
		jQuery("#ph-gallery-wp-images-list > li.submit-post").each(function(){
			var inputs = jQuery(this).find('.order_by').attr("name");
			var n = inputs.lastIndexOf('_');
			var res = inputs.substring(n+1, inputs.length);
			res +=',';
			mainInputs += res;
		});
		mainInputs = mainInputs.substring(0,mainInputs.length-1);
		jQuery(".changedvalues").val(mainInputs);
		jQuery("#ph-gallery-wp-images-list > li").not('.submit-post').each(function(){
			jQuery(this).find('input').removeAttr('name');
			jQuery(this).find('textarea').removeAttr('name');
		});
		return mainInputs;

	};
	jQuery("#ph-gallery-wp-images-list > li").each(function(){
		jQuery(this).find('input').removeAttr('name');
		jQuery(this).find('textarea').removeAttr('name');
		jQuery(this).find('select').removeAttr('name');
	});
};
function galleryImgSubmitButton(pressbutton){
	if(!document.getElementById('name').value){
		alert("Name is required.");
		return;
	}
	galleryImgFilterInputs();
	document.getElementById("adminForm").action=document.getElementById("adminForm").action+"&task="+pressbutton;
	document.getElementById("adminForm").submit();
}
function galleryImgListItemTask(this_id, replace_id) {
	document.getElementById('oreder_move').value = this_id + "," + replace_id;
	document.getElementById('admin_form').submit();
}
function galleryImgDoNothing() {
	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
	if( keyCode == 13 ) {
		if(!e) var e = window.event;
		e.cancelBubble = true;
		e.returnValue = false;
		if (e.stopPropagation) {
			e.stopPropagation();
			e.preventDefault();
		}
	}
}
function galleryPopupSizes(checkbox){
	if(checkbox.is(':checked')){
		jQuery('.ph-gallery-wp-lightbox-options-block .not-fixed-size').css({'display':'none'});
		jQuery('.ph-gallery-wp-lightbox-options-block .fixed-size').css({'display':'block'});
	}else {
		jQuery('.ph-gallery-wp-lightbox-options-block .fixed-size').css({'display':'none'});
		jQuery('.ph-gallery-wp-lightbox-options-block .not-fixed-size').css({'display':'block'});
	}
}
function galleryImgResizeAdminImages(){
	jQuery('ul#ph-gallery-wp-images-list > li > .ph-gallery-wp-image-container .ph-gallery-wp-list-img-wrapper img').each(function () {
		var imhHeight = jQuery(this).prop('naturalHeight');
		var imhWidth = jQuery(this).prop('naturalWidth');
		var parentWidth = jQuery(this).parent().width();
		var parentHeight = jQuery(this).parent().height();
		var imgRatio = imhWidth/imhHeight;
		var parentRatio = parentWidth/parentHeight;
		if (imgRatio <= parentRatio) {
			jQuery(this).css({
				position: "relative",
				width: '100%',
				top: '50%',
				transform: 'translateY(-50%)',
				height: 'auto',
				left: '0'
			});
		} else {
			jQuery(this).css({
				position: "relative",
				height: '100%',
				left: '50%',
				transform: 'translateX(-50%)',
				width: 'auto',
				top: '0'
			});
		}
	});
}

// Created By Karen


