<style>
.justified-gallery {
    width: 100%;
    position: relative;
}
.justified-gallery a{
    border:none;
}
.justified-gallery > a,
.justified-gallery > div {
    position: absolute;
    display: inline-block;
    opacity: 0;
    overflow:hidden;
    filter: alpha(opacity=0);
    /* IE8 or Earlier */
}
.justified-gallery > a > img,
.justified-gallery > div > img {
    position: absolute;
    top: 50%;
    left: 50%;
    padding: 0;
}
.justified-gallery > a > .caption,
.justified-gallery > div > .caption {
    display: none;
    position: absolute;
    bottom: 0;
    padding: 5px;
    left: 0;
    right: 0;
    margin: 0;
    color: #<?php echo Photo_Gallery_WP()->settings->view8_element_title_font_color; ?>;
    font-size: <?php echo Photo_Gallery_WP()->settings->view8_element_title_font_size; ?>px;
    font-weight: 300;
    font-family: sans-serif;
//margin-left: <?php //echo Photo_Gallery_WP()->settings->view8_element_border_width"); ?>px;
    background:<?php 			
				list($r,$g,$b) = array_map('hexdec',str_split(Photo_Gallery_WP()->settings->view8_element_title_background_color,2));
				$titleopacity=Photo_Gallery_WP()->settings->view8_element_title_overlay_transparency/100;
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important';	
		?>;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space:nowrap;
}
.justified-gallery > a > .caption.caption-visible,
.justified-gallery > div > .caption.caption-visible {
    display: initial;
    filter: "alpha(opacity=70)";
    /* IE8 or Earlier */
    -webkit-animation: justified-gallery-show-caption-animation 500ms 0 ease;
    -moz-animation: justified-gallery-show-caption-animation 500ms 0 ease;
    -ms-animation: justified-gallery-show-caption-animation 500ms 0 ease;
}
.justified-gallery > .entry-visible {
    opacity: 1.0;
    filter: alpha(opacity=100);
    /* IE8 or Earlier */
    -webkit-animation: justified-gallery-show-entry-animation 300ms 0 ease;
    -moz-animation: justified-gallery-show-entry-animation 300ms 0 ease;
    -ms-animation: justified-gallery-show-entry-animation 300ms 0 ease;
}
.justified-gallery > .spinner {
    position: absolute;
    bottom: 0;
    margin-left: -24px;
    padding: 10px 0 10px 0;
    left: 50%;
    opacity: initial;
    filter: initial;
    overflow: initial;
}
.justified-gallery > .spinner > span {
    display: inline-block;
    opacity: 0;
    filter: alpha(opacity=0);
    /* IE8 or Earlier */
    width: 8px;
    height: 8px;
    margin: 0 4px 0 4px;
    background-color: #000;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
    border-bottom-left-radius: 6px;
}
.play-icon {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
}
.load_more2 {
    margin: 10px 0;
    position:relative;
    text-align:<?php if(Photo_Gallery_WP()->settings->video_view8_loadmore_position == 'left') {echo 'left';}
			elseif (Photo_Gallery_WP()->settings->video_view8_loadmore_position == 'center') { echo 'center'; }
			elseif(Photo_Gallery_WP()->settings->video_view8_loadmore_position == 'right') { echo 'right'; }?>;
    width:100%;
}
.load_more_button2 {
    border-radius: 10px;
    display:inline-block;
    padding:5px 15px;
    font-size:<?php echo Photo_Gallery_WP()->settings->video_view8_loadmore_fontsize; ?>px !important;;
    color:<?php echo '#'.Photo_Gallery_WP()->settings->video_view8_loadmore_font_color; ?> !important;;
    background:<?php echo '#'.Photo_Gallery_WP()->settings->video_view8_button_color; ?> !important;
    cursor:pointer;
}
.load_more_button2:hover{
    color:<?php echo '#'.Photo_Gallery_WP()->settings->video_view8_loadmore_font_color_hover; ?> !important;
    background:<?php echo '#'.Photo_Gallery_WP()->settings->video_view8_button_color_hover; ?> !important;
}
.loading2 {
    display:none;
}
.paginate2{
    font-size:<?php echo Photo_Gallery_WP()->settings->video_view8_paginator_fontsize; ?>px !important;
    color:<?php echo '#'.Photo_Gallery_WP()->settings->video_view8_paginator_color; ?> !important;
    text-align: <?php echo Photo_Gallery_WP()->settings->video_view8_paginator_position; ?>;
    margin-top: 25px;
}
.paginate2 a{
    border-bottom: none !important;
}
.icon-style2{
    font-size: <?php echo Photo_Gallery_WP()->settings->video_view8_paginator_icon_size; ?>px !important;
    color:<?php echo '#'.Photo_Gallery_WP()->settings->video_view8_paginator_icon_color; ?> !important;
}
.clear{
    clear:both;
}
.play-icon.youtube-icon {background:url(<?php echo PHOTO_GALLERY_WP_IMAGES_URL.'/admin_images/play.youtube.png'; ?>) center center no-repeat;}
.play-icon.vimeo-icon {background:url(<?php echo PHOTO_GALLERY_WP_IMAGES_URL.'/admin_images/play.vimeo.png'; ?>) center center no-repeat;}
<?php	switch ($like_dislike) {
    case "dislike":
        ?>
/*/////Like/Dislike Styles BEGIN/////like/dislike///////*/
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?>{
    position: absolute;
    top: 0;
    left: 0;
    z-index: 999;
    cursor: pointer;
    display: none;
    color: #<?php echo Photo_Gallery_WP()->settings->just_likedislike_font_color; ?>;
}
.justified-gallery > a:hover .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?>{
    display: table;
}
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper ,
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_gallery_dislike_wrapper {
    position:relative;
    background:<?php
			list($r,$g,$b) = array_map('hexdec',str_split(Photo_Gallery_WP()->settings->just_likedislike_bg,2));
				$titleopacity=Photo_Gallery_WP()->settings->just_likedislike_bg_trans/100;
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important'; 		
	?>;
    display: inline-block;
    border-radius: 3px;
    font-size:0;
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
    color:#<?php echo Photo_Gallery_WP()->settings->just_likedislike_thumb_color; ?>;
}
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .dislike_thumb_down{
    font-size: 17px;
    position:absolute;
    top: 4px;
    left: 4px;
    color:#<?php echo Photo_Gallery_WP()->settings->just_likedislike_thumb_color; ?>;
}
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_hide{
    display: none !important;
}
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .like_thumb_active{
    color: #<?php echo Photo_Gallery_WP()->settings->just_likedislike_thumb_active_color; ?> !important;
}
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .like_font_active{
    color: #<?php echo Photo_Gallery_WP()->settings->just_active_font_color; ?> !important;
}
@media screen and (min-width: 768px){
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper:hover .huge_it_like {
        color: #<?php echo Photo_Gallery_WP()->settings->just_active_font_color; ?> !important;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper:hover .like_thumb_up {
        color: #<?php echo Photo_Gallery_WP()->settings->just_likedislike_thumb_active_color; ?> !important;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_gallery_dislike_wrapper:hover .huge_it_dislike {
        color: #<?php echo Photo_Gallery_WP()->settings->just_active_font_color; ?> !important;
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_gallery_dislike_wrapper:hover .dislike_thumb_down {
        color: #<?php echo Photo_Gallery_WP()->settings->just_likedislike_thumb_active_color; ?> !important;
    }
}
/*/////Like/Dislike Styles END////like/dislike////////*/
<?php break;
      case 'heart':
?>
/*/////Like/Dislike Styles BEGIN//////Heart//////*/
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?>{
    position: absolute;
    top: 0;
    left: 0;
    z-index: 99;
    display: none;
}
.justified-gallery > a:hover .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?>{
    display: block;
}
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper  {
    position:relative;
    background:<?php
			list($r,$g,$b) = array_map('hexdec',str_split(Photo_Gallery_WP()->settings->just_likedislike_bg,2));
				$titleopacity=Photo_Gallery_WP()->settings->just_likedislike_bg_trans/100;						
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important'; 		
	?>;
    display: inline-block;
    border-radius: 8px;
    font-size:0;
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
if(Photo_Gallery_WP()->settings->just_rating_count =='no'){
    $heartCount="transparent";
}else{
    $heartCount='#'.Photo_Gallery_WP()->settings->just_likedislike_font_color;
}
?>;
    color:<?php echo $heartCount; ?>;
    width: 38px;
    height: 38px;
    padding:8px 0 !important;
    font-size: 12px;
    text-align: center;
    font-weight: 700;
    position: relative;
    cursor: pointer;
}
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_like_count{
    display:none;
}
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .huge_it_like  .likeheart{
    font-size: 32px;
    color:#<?php echo Photo_Gallery_WP()->settings->just_heart_likedislike_thumb_color; ?>;
    position: absolute;
    top: 4px;
    left: 3px;
    transition:0.3s ease;
}
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .like_thumb_active{
    color: #<?php echo Photo_Gallery_WP()->settings->just_heart_likedislike_thumb_active_color; ?> !important;
}
.ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .like_font_active{
<?php if(Photo_Gallery_WP()->settings->just_rating_count !='no'):?>
    color: #<?php echo Photo_Gallery_WP()->settings->just_active_font_color; ?> !important;
<?php endif; ?>
}
@media screen and (min-width: 768px){
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper:hover .huge_it_like_thumb {
    <?php if(Photo_Gallery_WP()->settings->just_rating_count !='no'):?>
        color: #<?php echo Photo_Gallery_WP()->settings->just_active_font_color; ?> !important;
    <?php endif; ?>
    }
    .ph-g-wp_gallery_like_cont_<?php echo $galleryID.$pID; ?> .ph-g-wp_gallery_like_wrapper:hover .likeheart {
        color: #<?php echo Photo_Gallery_WP()->settings->just_heart_likedislike_thumb_active_color; ?> !important;
    }
}
/*/////Like/Dislike Styles END//////Heart//////*/
<?php 
      break;
      }
      ?>
#ph-gallery-wp-loading-icon {
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: 1;
    background:  url(<?php echo PHOTO_GALLERY_WP_IMAGES_URL.'/loading/loading-'.$loading_type.'.svg'; ?>) center top ;
    background-repeat: no-repeat;
    background-size: 60px auto;
}
</style>