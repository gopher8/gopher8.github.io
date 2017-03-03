<script src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>

	<div id="jssor_1" style="position: relative; top: 0; width: <?php echo $gallery[0]->sl_width; ?>px; height: <?php echo $gallery[0]->sl_height+100; ?>px; overflow: hidden; visibility: hidden;">
		<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
			<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
			<div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
		</div>
		<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: <?php echo $gallery[0]->sl_width; ?>px; height: <?php echo $gallery[0]->sl_height; ?>px; overflow: hidden; border-radius: <?php echo floatval(Photo_Gallery_WP()->settings->slider_options_border_radius); ?>px; border: <?php echo floatval(Photo_Gallery_WP()->settings->slider_options_border); ?>px #<?php echo sanitize_hex_color_no_hash(Photo_Gallery_WP()->settings->slider_options_border_color) ?> solid;">
			<?php foreach($images as $k => $value ): ?>
				<div data-p="144.50" class="slides-div">

					<?php if($value->sl_type === 'video'){

						if ( ! function_exists( 'get_youtube_id_from_url' ) ) {
							function get_youtube_id_from_url( $url ) {
								if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) {
									return $match[1];
								}
							}
						}

						if ( strpos( $value->image_url, 'youtube' ) !== false || strpos( $value->image_url, 'youtu' ) !== false ) {
							$video_thumb_url = get_youtube_id_from_url( $value->image_url );
							$thumburl    = '<div class="videoCover'.$value->gallery_id.'_'.$value->id.' play-icon youtube_play_icon"></div><img src="https://img.youtube.com/vi/' . $video_thumb_url . '/hqdefault.jpg"  class="video_cover'.$value->gallery_id.'_'.$value->id.' construct_img" />';
							$thumburl = wp_kses_post($thumburl);
							$iframeSrc = '<div id="huge_it_youtube_iframe'.$value->gallery_id.'_'.$value->id.'" data-element-id="'.$value->id.'" class="huge_it_youtube_iframe" data-controls="1" data-showinfo="1" data-rel="0"></div>
										  <img u="thumb" src="https://img.youtube.com/vi/' . $video_thumb_url . '/hqdefault.jpg" alt="https://img.youtube.com/vi/' . $video_thumb_url . '/hqdefault.jpg"/>';
						} else if ( strpos( $value->image_url, 'vimeo' ) !== false ) {
							$vimeo    = $value->image_url;
							$temp_var = explode( "/", $vimeo );
							$imgid    = end( $temp_var );
							$imgid    = esc_html($imgid);
							$hash     = unserialize( file_get_contents( "https://vimeo.com/api/v2/video/" . $imgid . ".php" ) );
							$imgsrc   = $hash[0]['thumbnail_large'];
							$thumburl = '<div id="videoCover'.$value->gallery_id.'_'.$value->id.'" class="play-icon vimeo_play_icon"></div><img src="' . $imgsrc . '" class="video_cover'.$value->gallery_id.'_'.$value->id.' construct_img" />';
							$iframeSrc = '<iframe width="100%" height="100%" src="https://player.vimeo.com/video/'.$imgid.'?api=1&player_id=huge_it_vimeo_iframe'.$value->gallery_id.'_'.$value->id.'&showinfo=0&controls=0'.'"
											id="huge_it_vimeo_iframe'.$value->gallery_id.'_'.$value->id.'" data-element-id="'.$value->id.'" class="huge_it_vimeo_iframe" frameborder="0" allowfullscreen=""></iframe>
											<img u="thumb" src="' . $imgsrc . '" alt="' . $imgsrc . '"/>';
						}

						echo $thumburl;
						echo $iframeSrc;
						?>

					<?php } else { ?>
						<?php if($value->sl_url != ''){ ?>
						<a href="<?php echo esc_attr(esc_url( $value->sl_url )); ?>" <?php if($value->link_target == 'on'){ ?>target="_blank" <?php } ?>>
							<img data-u="image" src="<?php echo esc_attr(esc_url( $value->image_url )); ?>" />
						</a>
						<?php } else { ?>
							<img data-u="image" src="<?php echo esc_attr(esc_url( $value->image_url )); ?>" />
						<?php } ?>
						<img data-u="thumb" src="<?php echo esc_attr(esc_url( $value->image_url )); ?>" />
					<?php } ?>

					<?php if($value->name != ''){ ?>
					<div class="ph_slidetitle">
						<span><?php echo wp_kses_post( $value->name ); ?></span>
					</div>
					<?php } ?>
					<?php if($value->description != ''){ ?>
					<div class="ph_slide_description">
						<span><?php echo wp_kses_post($value->description); ?></span>
					</div>
					<?php } ?>
				</div>
			<?php endforeach; ?>
		</div>
		<div data-u="thumbnavigator" class="jssort01" style="position:absolute;left:0px;bottom:0px;width:<?php echo $gallery[0]->sl_width; ?>px;height:100px;" data-autocenter="1">
			<div data-u="slides" style="cursor: default;">
				<div data-u="prototype" class="p">
					<div class="w">
						<div data-u="thumbnailtemplate" class="t"></div>
					</div>
					<div class="c"></div>
				</div>
			</div>
		</div>
		<div data-u="navigator" class="jssorb01">
			<div data-u="prototype" style="width:12px;height:12px;"></div>
		</div>
		<span data-u="arrowleft" class="jssora05l" style="top:<?php echo ($gallery[0]->sl_height/2)-20; ?>px;left:8px;"></span>
		<span data-u="arrowright" class="jssora05r" style="top:<?php echo ($gallery[0]->sl_height/2)-20; ?>px;right:8px;"></span>
	</div>
