<?php $galleryID.$pID = esc_html($galleryID.$pID); ?>
<style>
    .grid {
        background: #ffffff;
        max-width: 1200px;
        margin: 0 auto;
    }

    #ph-gallery-wp-loading-icon {
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 1;
        background: url(<?php echo PHOTO_GALLERY_WP_IMAGES_URL.'/loading/loading-'.$loading_type.'.svg'; ?>) center top ;
        background-repeat: no-repeat;
        background-size: 60px auto;
    }

    /* clearfix */
    .grid:after {
        content: '';
        display: block;
        clear: both;
    }

    /* ---- grid-item ---- */

    .grid-item {
        width: <?php echo absint( Photo_Gallery_WP()->settings->masonry_image_width_in_px ); ?>px;
        height: auto;
        float: left;
        background: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_image_border_color); ?>;
        border: <?php echo absint(Photo_Gallery_WP()->settings->masonry_image_border_width_in_px); ?>px solid #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_image_border_color); ?>;
        border-color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_image_border_color); ?>;
        border-radius: <?php echo absint( Photo_Gallery_WP()->settings->masonry_image_border_radius ); ?>px;
        position: relative;
        overflow: hidden;
        box-sizing: border-box;
        margin-bottom: <?php echo absint( Photo_Gallery_WP()->settings->masonry_image_margin_in_px ); ?>px !important;
    }

    .grid-item img {
        width: 100% !important;
        padding-bottom: 0px !important;
        display: block !important;
    }

    .grid-item a {
        padding-bottom: 0px !important;
        display: block !important;
    }

    .grid-item .play-icon {
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
    }

    .grid-item .play-icon.youtube-icon {background:url(<?php echo PHOTO_GALLERY_WP_IMAGES_URL.'/admin_images/play.youtube.png'; ?>) center center no-repeat;}
    .grid-item .play-icon.vimeo-icon {background:url(<?php echo PHOTO_GALLERY_WP_IMAGES_URL.'/admin_images/play.vimeo.png'; ?>) center center no-repeat;}

    .title-masonry-image {
        position: absolute;
        width: 100%;
        height: 36px;
        overflow: hidden;
        opacity: <?php echo floatval(Photo_Gallery_WP()->settings->masonry_title_background_opacity/100); ?>;
        bottom: -36px;
        background-color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_title_background_color); ?>;
        transition: all 0.3s linear;
    }
    .grid-item:hover .title-masonry-image{
        bottom: 0;
    }
    .title-masonry-image a {
        font-size: <?php echo absint( Photo_Gallery_WP()->settings->masonry_title_font_size_in_px ); ?>px;
        color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_title_font_color); ?>;
        text-decoration: none;
        top: 7px;
        position: absolute;
        padding-left: 5px;
    }

    .title-masonry-image a:hover {
        color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_title_font_hover_color); ?>;
        text-decoration: none;
    }

    .paginate8 {
        font-size: <?php echo floatval(Photo_Gallery_WP()->settings->masonry_pagination_font_size_in_px); ?>px;
        color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_pagination_font_color); ?>;
    }

    .pagination_align {
        <?php
switch (Photo_Gallery_WP()->settings->masonry_pagination_position) {
    case 'left':
       ?>text-align: left;<?php
        break;
    case 'right':
       ?>text-align: right;<?php
        break;
    case 'center':
        ?>text-align: center;<?php
        break;
}
 ?>

    }

    .paginate8 i {
        font-size: <?php echo floatval(Photo_Gallery_WP()->settings->masonry_pagination_icons_size_in_px); ?>px;
        color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_pagination_icons_color); ?>;
    }

    .load_more8 {
        margin: 10px 0;
        position:relative;
        text-align:<?php if(Photo_Gallery_WP()->settings->masonry_load_more_position == 'left') {echo 'left';}
			elseif (Photo_Gallery_WP()->settings->masonry_load_more_position == 'center') { echo 'center'; }
			elseif(Photo_Gallery_WP()->settings->masonry_load_more_position == 'right') { echo 'right'; }?>;
        width:100%;
    }

    .load_more_button8 {
        border-radius: 10px;
        display:inline-block;
        padding:5px 15px;
        font-size:<?php echo floatval(Photo_Gallery_WP()->settings->masonry_load_more_font_size_in_px); ?>px !important;;
        color:<?php echo '#'.sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_load_more_font_color); ?> !important;;
        background:<?php echo '#'.sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_load_more_button_color); ?> !important;
        cursor:pointer;
    }

    .load_more_button8:hover{
        color:<?php echo '#'.sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_load_more_font_font_hover_color); ?> !important;
        background:<?php echo '#'.sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_load_more_background_hover_color); ?> !important;
    }

    .loading8 {
        display:none;
    }

    .clear{
        clear:both;
    }

    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?>{
        opacity: <?php echo floatval(Photo_Gallery_WP()->settings->masonry_ratings_background_color_opacity/100); ?> ;
    }
    <?php
switch ($like_dislike) {
case "dislike":
    ?>
    /*/////Like/Dislike Styles END//////like/dislike//////*/
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?>{
        position: absolute;
        top: 0;
        right:0;
        z-index: 3;
        color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_rating_font_color); ?>;
        display: none;
    }
    div.grid-item:hover  .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?>{
        display: table;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper ,
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_gallery_dislike_wrapper {
        position:relative;
        background: <?php
			list($r,$g,$b) = array_map('hexdec',str_split(Photo_Gallery_WP()->settings->masonry_rating_background_color,2));
				$titleopacity=Photo_Gallery_WP()->settings->masonry_rating_background_color/100;
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important';
	?>;
        display: inline-block;
        border-radius: 3px;
        font-size:0;
        cursor: pointer;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper{
        margin: 3px;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_gallery_dislike_wrapper{
        margin: 3px 3px 3px 0;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_like{
        font-size:0;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_like .huge_it_like_thumb {
        display:block;
        float:left;
        padding:4px 4px 4px 18px;
        font-size: 12px;
        font-weight: 700;
        position:relative;
        height: 28px;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_like_count,
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_dislike_count{
        display:block;
        float:left;
        padding:4px 4px 4px 4px;
        font-size: 12px;
        font-weight: 700;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_dislike{
        font-size:0;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_dislike .huge_it_dislike_thumb {
        display:block;
        float:left;
        padding:4px 4px 4px 18px;
        font-size: 12px;
        font-weight: 700;
        position:relative;
        height: 28px;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .like_thumb_up{
        font-size: 17px;
        position:absolute;
        top: 5px;
        left: 4px;
        color:#<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_like_dislike_icon_color)?>;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .dislike_thumb_down{
        font-size: 17px;
        position:absolute;
        top: 4px;
        left: 4px;
        color:#<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_like_dislike_icon_color)?>;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_hide{
        display: none !important;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .like_thumb_active{
        color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_like_dislike_rated_icon_color)?> !important;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .like_font_active{
        color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_rating_rated_font_color)?> !important;
    }
    @media screen and (min-width: 768px){
        .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper:hover .huge_it_like {
            color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_rating_rated_font_color)?> !important;
        }
        .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper:hover .like_thumb_up {
            color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_like_dislike_rated_icon_color)?> !important;
        }
        .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_gallery_dislike_wrapper:hover .huge_it_dislike {
            color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_rating_rated_font_color)?> !important;
        }
        .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_gallery_dislike_wrapper:hover .dislike_thumb_down {
            color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_like_dislike_rated_icon_color)?> !important;
        }
    }
    /*/////Like/Dislike Styles END//////like/dislike//////*/
    <?php break;
        case 'heart':
    ?>
    /*/////Like/Dislike Styles BEGIN//////Heart//////*/
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?>{
        position: absolute;
        top: 0;
        right: 0;
        z-index: 99;
        display: none;
    }
    div.grid-item:hover  .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?>{
        display: block;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper  {
        position:relative;
        background:<?php
			list($r,$g,$b) = array_map('hexdec',str_split(Photo_Gallery_WP()->settings->masonry_rating_background_color,2));
				$titleopacity=Photo_Gallery_WP()->settings->masonry_rating_background_color/100;
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important';
	?>;
        display: inline-block;
        border-radius: 8px;
        font-size:0;
        cursor: pointer;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper:hover{
        background: #D6D4D4;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper{
        margin: 3px;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_like{
        font-size:0;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_like .huge_it_like_thumb {
        display: block;
        float: left;
    <?php $heartCount='';
    if(Photo_Gallery_WP()->settings->masonry_rating_icons_color =='no'){
        $heartCount="transparent";
    }else{
        $heartCount='#'.sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_rating_font_color);
    }
    ?>
        color:<?php echo $heartCount.';'; ?>
        width: 38px;
        height: 38px;
        padding:8px 0;
        font-size: 12px;
        text-align: center;
        font-weight: 700;
        position: relative;
        cursor: pointer;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_like .huge_it_like_thumb:after {
        color:#fff;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_like_count{
        display:none;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_like  .likeheart{
        font-size: 32px;
        color:#<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_heart_icon_color)?>;
        position: absolute;
        top: 4px;
        left: 3px;
        transition:0.3s ease;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .like_thumb_active{
        color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_heart_rated_icon_color)?> !important;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .like_font_active{
    <?php if(Photo_Gallery_WP()->settings->masonry_rating_icons_color !='no'):?>
        color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_rating_rated_font_color)?> !important;
    <?php endif; ?>
    }
    @media screen and (min-width: 768px){
        .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper:hover .huge_it_like_thumb {
        <?php if(Photo_Gallery_WP()->settings->masonry_rating_icons_color !='no'):?>
            color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_rating_rated_font_color); ?> !important;
        <?php endif; ?>
        }
        .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper:hover .likeheart {
            color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->masonry_heart_rated_icon_color); ?> !important;
        }
    }

    /*/////Like/Dislike Styles END//////Heart//////*/
    <?php
        break;
        }?>
   </style>