<style>

    /* jssor slider arrow navigator skin 05 css */
    /*
    .jssora05l                  (normal)
    .jssora05r                  (normal)
    .jssora05l:hover            (normal mouseover)
    .jssora05r:hover            (normal mouseover)
    .jssora05l.jssora05ldn      (mousedown)
    .jssora05r.jssora05rdn      (mousedown)
    .jssora05l.jssora05lds      (disabled)
    .jssora05r.jssora05rds      (disabled)
    */
.jssorb01 {
    position: absolute;
}
.grid-item .play-icon {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
}

#jssor_1 {
    left: 0 !important;
    <?php switch ($gallery[0]->sl_position) {
    default:
    ?>float: left;<?php
    break;
    case center:
    ?>margin: auto;<?php
    break;
    case right:
    ?>float: right;<?php
    break;
    }
    ?>
}

.slides-div .play-icon.youtube_play_icon {background:url(<?php echo PHOTO_GALLERY_WP_IMAGES_URL.'/admin_images/play.youtube.png'; ?>) center center no-repeat;}
.slides-div .play-icon.vimeo_play_icon {background:url(<?php echo PHOTO_GALLERY_WP_IMAGES_URL.'/admin_images/play.vimeo.png'; ?>) center center no-repeat;}

.slides-div .play-icon {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
}

.slides-div {
    position: relative;
}

div[class*=videoCover], div[id*=videoCover] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    cursor: pointer;
}

img[class*=video_cover] {
    position: absolute;
    width: 100%;
    height: 100%;
}

.youtube_play_icon {
    background: url() center center no-repeat;
    background-size: 9% 10%;
}
.vimeo_play_icon {
    background: url() center center no-repeat;
    background-size: 9% 10%;
}

.ph_slidetitle {
    background: <?php
			list($r,$g,$b) = array_map('hexdec',str_split(Photo_Gallery_WP()->settings->slider_description_color,2));
				$titleopacity=floatval(Photo_Gallery_WP()->settings->slider_title_opacity/100);
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important';
	      ?>;
    width: 185px;
    height: 50px;
    position: absolute;
    top: 14px;
    left: <?php echo $gallery[0]->sl_width-200; ?>px;
    border: <?php echo floatval(Photo_Gallery_WP()->settings->slider_title_border) ?>px solid #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->slider_title_border_color) ?>;
    border-radius: <?php echo floatval(Photo_Gallery_WP()->settings->slider_title_border_raduis); ?>px;
    text-align: center;
}

.ph_slidetitle span {
    color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->slider_title_font_color); ?>;
    font-size: <?php echo floatval(Photo_Gallery_WP()->settings->slider_title_font_size); ?>px;
}

.ph_slidetitle:hover span {
    color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->slider_title_hover_color) ?>;
}

.ph_slide_description {
    background: <?php
			list($r,$g,$b) = array_map('hexdec',str_split(Photo_Gallery_WP()->settings->slider_description_font_color,2));
				$titleopacity=floatval(Photo_Gallery_WP()->settings->slider_description_opacity/100);
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important';
	      ?>;
    width: <?php echo $gallery[0]->sl_width-30; ?>px;
    height: 92px;
    position: absolute;
    top: <?php echo $gallery[0]->sl_height-100; ?>px;
    left: 16.5px;
    border: <?php echo floatval(Photo_Gallery_WP()->settings->slider_description_border); ?>px solid #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->slider_description_border_color) ?>;
    border-radius: <?php echo floatval(Photo_Gallery_WP()->settings->slider_description_border_radius); ?>px;
    overflow: hidden;
    padding-left: 3px;
    padding-right: 3px;
    text-align: center;
}

.ph_slide_description span {
    color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->slider_description_text_color) ?>;
    font-size: <?php echo floatval(Photo_Gallery_WP()->settings->slider_description_font_size); ?>px;
}

.ph_slide_description:hover span {
    color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->slider_description_hover_color) ?>;
}

.jssorb01 div, .jssorb01 div:hover, .jssorb01 .av {
    position: absolute;
    /* size of bullet elment */
    width: 12px;
    height: 12px;
    filter: alpha(opacity=70);
    opacity: .7;
    overflow: hidden;
    cursor: pointer;
    border: #000 1px solid;
}
.jssorb01 div { background-color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->slider_bullets_background); ?> !important; >; }
.jssorb01 div:hover { background-color: #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->slider_bullets_background_hover); ?> !important; >; }
.jssorb01 .av:hover { background-color: #d3d3d3; }
.jssorb01 .av { background-color: #fff; }
.jssorb01 .dn, .jssorb01 .dn:hover { background-color: #555555; }

.jssorb01 div {
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
}


.jssorb01 {
    <?php switch (Photo_Gallery_WP()->settings->slider_bullets_position) {
        case 1:
        ?>
        top: 10px !important;
        left: 10px !important;
        <?php
        break;
        case 2:
        ?>
        top: 10px !important;
        <?php
        break;
        case 3:
        ?>
        top: 10px !important;
        right: 10px !important;
        left: initial !important;
        <?php
        break;
        case 4:
        ?>
        top: <?php echo floatval($gallery[0]->sl_height/2); ?>px !important;
        left: 10px !important;
        <?php
        break;
        case 5:
        ?>
        top: <?php echo floatval($gallery[0]->sl_height/2); ?>px !important;
        <?php
        break;
        case 6:
        ?>
        top: <?php echo floatval($gallery[0]->sl_height/2); ?>px !important;
        right: 10px !important;
        left: initial !important;
        <?php
        break;
        case 7:
        ?>
        top: initial !important;
        bottom: 110px !important;
        left: 10px !important;
        <?php
        break;
        case 8:
        ?>
        top: initial !important;
        bottom: 110px !important;
        <?php
        break;
        case 9:
        ?>
        top: initial !important;
        bottom: 110px !important;
        left: initial !important;
        right: 10px !important;
        <?php
        break;
}
?>
}

.jssora05l, .jssora05r {
    display: block;
    position: absolute;
    cursor: pointer;
    background: url(<?php echo PHOTO_GALLERY_WP_IMAGES_URL.'/slider/arrows/'.esc_html(Photo_Gallery_WP()->settings->slider_arrows_buttons) ?>) no-repeat;
    overflow: hidden;
}

<?php
switch(esc_html(Photo_Gallery_WP()->settings->slider_arrows_buttons)){
    case 'arrows-0.png':
        ?>
        .jssora05l, .jssora05r {
            width: 45px;
            height: 40px;
        }
        .jssora05l {
            background-position: 0 -5px;
        }
        .jssora05l:hover {
            background-position: 0 -46px;
        }
        .jssora05r {
            background-position: -45px -5px;
        }
        .jssora05r:hover {
            background-position: -45px -46px;
        }
        <?php
        break;
    case 'arrows-1.png':
    case 'arrows-2.png':
    case 'arrows-3.png':
    case 'arrows-4.png':
    case 'arrows-5.png':
        ?>
        .jssora05l, .jssora05r {
            width: 45px;
            height: 42px;
        }
        .jssora05l {
            background-position: 0 -3px;
        }
        .jssora05l:hover {
            background-position: 0 -45px;
        }
        .jssora05r {
            background-position: -45px -3px;
        }
        .jssora05r:hover {
            background-position: -45px -45px;
        }
        <?php
        break;
    case 'arrows-6.png':
        ?>
        .jssora05l, .jssora05r {
            width: 45px;
            height: 42px;
        }
        .jssora05l {
            background-position: 0 -1px;
        }
        .jssora05l:hover {
            background-position: 0 -44px;
        }
        .jssora05r {
            background-position: -45px -1px;
        }
        .jssora05r:hover {
            background-position: -45px -44px;
        }
        <?php
        break;
    case 'arrows-7.png':
    case 'arrows-19.png':
        ?>
        .jssora05l, .jssora05r {
            width: 45px;
            height: 42px;
        }
        .jssora05l {
            background-position: 0 -1px;
        }
        .jssora05l:hover {
            background-position: 0 -43px;
        }
        .jssora05r {
            background-position: -45px -1px;
        }
        .jssora05r:hover {
            background-position: -45px -43px;
        }
        <?php
        break;
    case 'arrows-8.png':
    case 'arrows-9.png':
    case 'arrows-10.png':
    case 'arrows-11.png':
    case 'arrows-12.png':
    case 'arrows-13.png':
    case 'arrows-14.png':
        ?>
        .jssora05l, .jssora05r {
            width: 45px;
            height: 42px;
        }
        .jssora05l {
            background-position: 0 -2px;
        }
        .jssora05l:hover {
            background-position: 0 -44px;
        }
        .jssora05r {
            background-position: -45px -2px;
        }
        .jssora05r:hover {
            background-position: -45px -44px;
        }
        <?php
        break;
    case 'arrows-15.png':
    case 'arrows-16.png':
    case 'arrows-17.png':
        ?>
        .jssora05l, .jssora05r {
            width: 45px;
            height: 42px;
        }
        .jssora05l {
            background-position: 0 -2px;
        }
        .jssora05l:hover {
            background-position: 0 -41px;
        }
        .jssora05r {
            background-position: -45px -2px;
        }
        .jssora05r:hover {
            background-position: -45px -41px;
        }
        <?php
        break;
    case 'arrows-18.png':
        ?>
        .jssora05l, .jssora05r {
            width: 25px;
            height: 45px;
        }
        .jssora05l {
            background-position: 0 0;
        }
        .jssora05l:hover {
            background-position: 0 -40px;
        }
        .jssora05r {
            background-position: -30px 0;
        }
        .jssora05r:hover {
            background-position: -30px -40px;
        }
        <?php
        break;
}
?>

.jssort01 .p {
    position: absolute;
    top: 0;
    left: 0;
    width: 72px;
    height: 72px;
}

.jssort01 .t {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

.jssort01 .w {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.jssort01 .c {
    position: absolute;
    top: 0;
    left: 0;
    width: 68px;
    height: 68px;
    border: #000 2px solid;
    box-sizing: content-box;
    background: url('img/t01.png') -800px -800px no-repeat;
}

.jssort01 .pav .c {
    top: 2px;
    left: 2px;
    width: 68px;
    height: 68px;
    border: #000 0 solid;
    background-position: 50% 50%;
}

.jssort01 .p:hover .c {
    top: 0;
    left: 0;
    width: 70px;
    height: 70px;
    border: #fff 1px solid;
    background-position: 50% 50%;
}

.jssort01 .p.pdn .c {
    background-position: 50% 50%;
    width: 68px;
    height: 68px;
    border: #000 2px solid;
}

* html .jssort01 .c, * html .jssort01 .pdn .c, * html .jssort01 .pav .c {
    width: 72px;
    height: 72px;
}

</style>