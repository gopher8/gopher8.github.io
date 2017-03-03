<div id="ph-g-wp-mosaic_<?php echo $galleryID; ?>" class="ph-g-wp_gallery_container view-<?php echo esc_html($view_slug); ?> gallery-img-content"
     data-pages-count="<?php echo absint($total); ?>"
     data-content-per-page="<?php echo absint($num); ?>"
     data-current-page="2"
	 data-show-center="<?php echo esc_html(Photo_Gallery_WP()->settings->masonry_show_content_in_the_center); ?>"
	 data-element-width="<?php echo esc_html(Photo_Gallery_WP()->settings->masonry_image_width_in_px); ?>"
	 data-rating-type="<?php echo esc_html($like_dislike); ?>"
     data-ph-gallery-id="<?php echo absint($galleryID); ?>">
	<div id="ph-gallery-wp-loading-icon"></div>
	<div class="grid ph-gallery-wp-loading-class" style="visibility: hidden">
		<?php
		global $wpdb;
		foreach ( $page_images as $key => $row ) {
		    $row->id = absint($row->id);
			$row->like = absint($row->like);
			$row->dislike = absint($row->dislike);
			$imagerowstype = $row->sl_type;
			if ( $row->sl_type == '' ) {
				$imagerowstype = 'image';
			}
			?>
			<section id="ph_mosaic_photos">
			</section>
			<?php
		}
		?>
	</div>

<div style="clear:both;"></div>
<?php
$a = $disp_type;
if ( $a == 1 ) {
	$protocol                        = stripos( $_SERVER['SERVER_PROTOCOL'], 'https' ) === true ? 'https://' : 'http://';
	$actual_link                     = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$pattern                         = "/\?p=/";
	$pattern2                        = "/&page-img[0-9]+=[0-9]+/";
	$pattern3                        = "/\?page-img[0-9]+=[0-9]+/";
	$gallery_img_lightbox_load_nonce = wp_create_nonce( 'gallery_img_lightbox_load_nonce' );
	if ( preg_match( $pattern, $actual_link ) ) {
		if ( preg_match( $pattern2, $actual_link ) ) {
			$actual_link = preg_replace( $pattern2, '', $actual_link );
			header( "Location:" . $actual_link );
			exit;
		}
	} elseif ( preg_match( $pattern3, $actual_link ) ) {
		$actual_link = preg_replace( $pattern3, '', $actual_link );
		header( "Location:" . $actual_link . "" );
		exit;
	}
	?>
	<div class="load_more8">
		<div class="load_more_button8"
		     data-lightbox-nonce-value="<?php echo esc_attr($gallery_img_lightbox_load_nonce); ?>"><?php echo wp_kses_post( Photo_Gallery_WP()->settings->masonry_load_more_text ); ?></div>
		<div class="loading8"><img
				src="<?php if ( Photo_Gallery_WP()->settings->masonry_load_more_loading_animation == '1' ) {
					echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading1.gif';
				} elseif ( Photo_Gallery_WP()->settings->masonry_load_more_loading_animation == '2' ) {
					echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading4.gif';
				} elseif ( Photo_Gallery_WP()->settings->masonry_load_more_loading_animation == '3' ) {
					echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading36.gif';
				} elseif ( Photo_Gallery_WP()->settings->masonry_load_more_loading_animation == '4' ) {
					echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading51.gif';
				} ?>"></div>
	</div>
	<?php
} elseif ( $a == 0 ) {
	?>
<div class="pagination_align">
	<div class="paginate8">
		<?php
		$protocol    = stripos( $_SERVER['SERVER_PROTOCOL'], 'https' ) === true ? 'https://' : 'http://';
		$actual_link = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "";
		$checkREQ    = '';
		$pattern     = "/\?p=/";
		$pattern2    = "/&page-img[0-9]+=[0-9]+/";
		if ( preg_match( $pattern, $actual_link ) ) {
			if ( preg_match( $pattern2, $actual_link ) ) {
				$actual_link = preg_replace( $pattern2, '', $actual_link );
			}
			$checkREQ = $actual_link . '&page-img' . $galleryID . $pID;
		} else {
			$checkREQ = '?page-img' . $galleryID . $pID;
		}
		$pervpage = '';
		if ( $page != 1 ) {
			$pervpage = '<a href= ' . $checkREQ . '=1><i class="icon-style8 hugeiticons-fast-backward" ></i></a>  
            <a href= ' . $checkREQ . '=' . ( $page - 1 ) . '><i class="icon-style8 hugeiticons-chevron-left"></i></a> ';
		}
		$nextpage = '';
		if ( $page != $total ) {
			$nextpage = ' <a href= ' . $checkREQ . '=' . ( $page + 1 ) . '><i class="icon-style8 hugeiticons-chevron-right"></i></a>  
            <a href= ' . $checkREQ . '=' . $total . '><i class="icon-style8 hugeiticons-fast-forward" ></i></a>';
		}
		echo $pervpage . $page . '/' . $total . $nextpage;
		?>
	</div>
</div>
	<?php
}
?>
</div>
<script>
	function getRandomSize(min, max) {
		return Math.round(Math.random() * (max - min) + min);
	}

	var allImages = "";

		<?php foreach ( $page_images as $key => $row ) {
		$imagerowstype = $row->sl_type;
		if ($row->sl_type == '') {
			$imagerowstype = 'image';
		}
		switch ( $imagerowstype ) {
		case 'image': ?>

	allImages += '<div class="ph_mosaic_div"><a href="<?php echo esc_url($row->image_url); ?>" class="ph-lightbox"><img src="<?php echo esc_url($row->image_url); ?>" alt="<?php echo sanitize_text_field($row->name); ?>"></a><?php if ( Photo_Gallery_WP()->settings->mosaic_title_show_title == 'yes' ) { ?><div class="title-mosaic-image"><?php if($row->sl_url != ''){ ?><a title="<?php echo sanitize_text_field($row->name); ?>" href="<?php if ($row->sl_url != '') {
		echo esc_url($row->sl_url);
	} ?>" <?php if($row->link_target != ''){ ?> target="_blank"<?php } ?>><?php echo esc_html($row->name); ?></a><?php } else { ?><a><?php echo sanitize_text_field($row->name); ?></a><?php } ?></div><?php } ?></div>';

	<?php
	break;

	case 'video':
	$videourl = photo_gallery_wp_get_video_id_from_url( $row->image_url );
	if ( $videourl[1] == 'youtube' ) {
	?>

	allImages += '<div class="ph_mosaic_div"><a href="<?php echo esc_url($row->image_url); ?>" class="ph-lightbox"><img src="http://img.youtube.com/vi/<?php echo esc_html($videourl[0]); ?>/mqdefault.jpg" alt="<?php echo esc_html(str_replace( '__5_5_5__', '%', $row->name )); ?>"></a><?php if ( Photo_Gallery_WP()->settings->mosaic_title_show_title == 'yes' ) { ?><div class="title-mosaic-image"><?php if($row->sl_url != ''){ ?><a title="<?php echo sanitize_text_field($row->name); ?>" href="<?php if ($row->sl_url != '') {
		echo esc_url($row->sl_url);
	} ?>" <?php if($row->link_target != ''){ ?> target="_blank"<?php } ?>><?php echo esc_html($row->name); ?></a><?php } else { ?><a><?php echo sanitize_text_field($row->name); ?></a><?php } ?></div><?php } ?></div>';

		<?php
		} else {
		$hash   = unserialize( wp_remote_fopen( "http://vimeo.com/api/v2/video/" . $videourl[0] . ".php" ) );
		$imgsrc = $hash[0]['thumbnail_large'];
		?>

	allImages += '<div class="ph_mosaic_div"><a href="<?php echo esc_url($row->image_url); ?>" class="ph-lightbox"><img src="<?php echo esc_attr( $imgsrc ); ?>" alt="<?php echo esc_attr(str_replace( '__5_5_5__', '%', $row->name )); ?>"></a><?php if ( Photo_Gallery_WP()->settings->mosaic_title_show_title == 'yes' ) { ?><div class="title-mosaic-image"><?php if($row->sl_url != ''){ ?><a title="<?php echo sanitize_text_field($row->name); ?>" href="<?php if ($row->sl_url != '') {
		echo esc_url($row->sl_url);
	} ?>" <?php if($row->link_target != ''){ ?> target="_blank"<?php } ?>><?php echo esc_html($row->name); ?></a><?php } else { ?><a><?php echo sanitize_text_field($row->name); ?></a><?php } ?></div><?php } ?></div>';

		<?php
		}
		break;
	}

 } ?>

	jQuery('#ph_mosaic_photos').append(allImages);
	<?php if(Photo_Gallery_WP()->settings->mosaic_show_content_by == 'width'){ ?>
	var width_container = jQuery( ".entry-content" ).width();
	max_count = width_container / <?php echo absint( Photo_Gallery_WP()->settings->mosaic_image_max_width_in_px ); ?>;
	max_count = Math.floor(max_count);
	jQuery( document ).ready(function() {
		jQuery("#ph_mosaic_photos").css("column-count", max_count);
	});
	jQuery( window ).resize(function() {
		var width_container = jQuery( ".entry-content" ).width();
		max_count = width_container / <?php echo absint( Photo_Gallery_WP()->settings->mosaic_image_max_width_in_px ); ?>;
		max_count = Math.floor(max_count);
		jQuery("#ph_mosaic_photos").css("column-count", max_count);
	});
	<?php } ?>
</script>