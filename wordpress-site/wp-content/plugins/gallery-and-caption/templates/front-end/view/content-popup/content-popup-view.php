<section style="position: relative" id="huge_it_gallery_content_<?php echo $galleryID; ?>" class="gallery-img-content"
         data-image-behaviour="<?php echo Photo_Gallery_WP()->settings->image_natural_size_contentpopup; ?>"
         data-rating-type="<?php echo $like_dislike; ?>">
	<div id="ph-gallery-wp-loading-icon"></div>
	<div style="visibility: hidden" id="ph-g-wp_gallery_container_<?php echo $galleryID; ?>"
	     class="ph-gallery-wp-loading-class ph-g-wp_gallery_container super-list variable-sizes clearfix view-<?php echo $view_slug; ?>"
	     data-show-center="<?php echo Photo_Gallery_WP()->settings->view2_content_in_center; ?>">
		<div id="ph-g-wp_gallery_container_moving_<?php echo $galleryID; ?>">
			<input type="hidden" class="pagenum" value="1"/>
			<input type="hidden" id="total" value="<?php echo $total; ?>"/>
			<?php
			foreach ( $page_images as $key => $row ) {
				if ( ! isset( $_COOKIE[ 'Like_' . $row->id . '' ] ) ) {
					$_COOKIE[ 'Like_' . $row->id . '' ] = '';
				}
				if ( ! isset( $_COOKIE[ 'Dislike_' . $row->id . '' ] ) ) {
					$_COOKIE[ 'Dislike_' . $row->id . '' ] = '';
				}
				$num2       = $wpdb->prepare( "SELECT `image_status`,`ip` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip` = '" . $huge_it_ip . "'", (int) $row->id );
				$res3       = $wpdb->get_row( $num2 );
				$num3       = $wpdb->prepare( "SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE[ 'Like_' . $row->id . '' ] . "'", (int) $row->id );
				$res4       = $wpdb->get_row( $num3 );
				$num4       = $wpdb->prepare( "SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE[ 'Dislike_' . $row->id . '' ] . "'", (int) $row->id );
				$res5       = $wpdb->get_row( $num4 );
				$title      = $row->name;
				$link       = str_replace( '__5_5_5__', '%', $row->sl_url );
				$descnohtml = strip_tags( str_replace( '__5_5_5__', '%', $row->description ) );
				$result     = substr( $descnohtml, 0, 50 );
				?>
				<div class="ph_element ph_element_<?php echo $galleryID; ?> <?php if ( $title == '' && $link == '' ) {
					echo 'no-title';
				} ?>"
				     tabindex="0"
				     data-symbol="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"
				     data-category="alkaline-earth">
					<div class="image-block image-block_<?php echo $galleryID; ?>">
						<?php
						$imagerowstype = $row->sl_type;
						if ( $row->sl_type == '' ) {
							$imagerowstype = 'image';
						}
						switch ( $imagerowstype ) {
							case 'image':
								?>
								<?php $imgurl = explode( ";", $row->image_url ); ?>
								<?php if ( $row->image_url != ';' ) { ?>
								<img alt="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"
								     id="wd-cl-img<?php echo $key; ?>"
								     src="<?php if ( Photo_Gallery_WP()->settings->image_natural_size_contentpopup == 'resize' ) {
									     echo esc_url( photo_gallery_wp_get_image_by_sizes_and_src( $imgurl[0], array(
										     Photo_Gallery_WP()->settings->view2_element_width,
										     Photo_Gallery_WP()->settings->view2_element_height
									     ), false ) );
								     } else {
									     echo $imgurl[0];
								     } ?>"/>
							<?php } else { ?>
								<img alt="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"
								     id="wd-cl-img<?php echo $key; ?>" src="images/noimage.jpg"/>
								<?php
							} ?>
								<?php
								break;
							case 'video':
								?>
								<?php
								$videourl = photo_gallery_wp_get_video_id_from_url( $row->image_url );
								if ( $videourl[1] == 'youtube' ) {
									?>
									<img alt="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"
									     src="http://img.youtube.com/vi/<?php echo $videourl[0]; ?>/mqdefault.jpg"/>
									<?php
								} else {
									$hash   = unserialize( wp_remote_fopen( "http://vimeo.com/api/v2/video/" . $videourl[0] . ".php" ) );
									$imgsrc = $hash[0]['thumbnail_large'];
									?>
									<img alt="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"
									     src="<?php echo esc_attr( $imgsrc ); ?>"/>
									<?php
								}
								?>
								<?php
								break;
						}
						?>
						<?php if ( str_replace( '__5_5_5__', '%', $row->sl_url ) == '' ) {
							$viwMoreButton = '';
						} else {
							if ( $row->link_target == 'on' ) {
								$target = 'target="_blank"';
							} else {
								$target = '';
							}
							$viwMoreButton = '<div class="button-block"><a href="' . str_replace( '__5_5_5__', '%', $row->sl_url ) . '" ' . $target . ' >' . Photo_Gallery_WP()->settings->view2_element_linkbutton_text . '</a></div>';
						}
						?>
						<div class="ph-g-wp-gallery-image-overlay">
							<a href="#<?php echo $row->id; ?>"
							   title="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"></a>
							<?php if ( $like_dislike != 'off' ): ?>
								<div
									class="ph-g-wp_gallery_like_cont ph-g-wp_gallery_like_cont_<?php echo $galleryID . $pID; ?>">
									<div class="ph-g-wp_gallery_like_wrapper">
						<span class="huge_it_like">
							<?php if ( $like_dislike == 'heart' ): ?>
								<i class="hugeiticons-heart likeheart"></i>
							<?php endif; ?>
							<?php if ( $like_dislike == 'dislike' ): ?>
								<i class="hugeiticons hugeiticons-thumbs-up like_thumb_up"></i>
							<?php endif; ?>
							<span class="huge_it_like_thumb" id="<?php echo $row->id ?>"
							      data-status="<?php if ( isset( $res3->image_status ) && $res3->image_status == 'liked' ) {
								      echo $res3->image_status;
							      } elseif ( isset( $res4->image_status ) && $res4->image_status == 'liked' ) {
								      echo $res4->image_status;
							      } else {
								      echo 'unliked';
							      } ?>">
							<?php if ( $like_dislike == 'heart' ): ?>
								<?php echo $row->like; ?>
							<?php endif; ?>
						</span>
							<span
								class="ph-g-wp_like_count <?php if ( Photo_Gallery_WP()->settings->popup_rating_count == 'off' ) {
									echo 'huge_it_hide';
								} ?>"
								id="<?php echo $row->id ?>"><?php if ( $like_dislike != 'heart' ): ?><?php echo $row->like; ?><?php endif; ?></span>
						</span>
									</div>
									<?php if ( $like_dislike != 'heart' ): ?>
										<div class="huge_it_gallery_dislike_wrapper">
						<span class="huge_it_dislike">
							<i class="hugeiticons-thumbs-down dislike_thumb_down"></i>
							<span class="huge_it_dislike_thumb" id="<?php echo $row->id ?>"
							      data-status="<?php if ( isset( $res3->image_status ) && $res3->image_status == 'disliked' ) {
								      echo $res3->image_status;
							      } elseif ( isset( $res5->image_status ) && $res5->image_status == 'disliked' ) {
								      echo $res5->image_status;
							      } else {
								      echo 'unliked';
							      } ?>">
							</span>
							<span
								class="huge_it_dislike_count <?php if ( Photo_Gallery_WP()->settings->popup_rating_count == 'off' ) {
									echo 'huge_it_hide';
								} ?>"
								id="<?php echo $row->id ?>"><?php echo $row->dislike; ?></span>
						</span>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php if ( $title != '' || $link != '' ): ?>
						<div
							class="title-block_<?php echo $galleryID; ?>">
							<?php if ( $title != '' && $title != null ) { ?>
								<h3
									title="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>">
									<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>
								</h3>
							<?php } ?>
							<?php if ( Photo_Gallery_WP()->settings->view2_element_show_linkbutton == 'yes' ) { ?>
								<?php echo $viwMoreButton ?>
							<?php } ?>
						</div>
					<?php endif; ?>
				</div>
				<?php
			} ?>
		</div>
		<div style="clear:both;"></div>
	</div>
	<?php
	$a = $disp_type;
	if ( $a == 1 ) {
		$protocol                       = stripos( $_SERVER['SERVER_PROTOCOL'], 'https' ) === true ? 'https://' : 'http://';
		$actual_link                    = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "";
		$pattern                        = "/\?p=/";
		$pattern2                       = "/&page-img[0-9]+=[0-9]+/";
		$pattern3                       = "/\?page-img[0-9]+=[0-9]+/";
		$photo_gallery_wp_content_load_nonce = wp_create_nonce( 'photo_gallery_wp_content_load_nonce' );
		if ( preg_match( $pattern, $actual_link ) ) {
			if ( preg_match( $pattern2, $actual_link ) ) {
				$actual_link = preg_replace( $pattern2, '', $actual_link );
				header( "Location:" . $actual_link . "" );
				exit;
			}
		} elseif ( preg_match( $pattern3, $actual_link ) ) {
			$actual_link = preg_replace( $pattern3, '', $actual_link );
			header( "Location:" . $actual_link . "" );
			exit;
		}
		?>
		<div class="load_more5">
			<div class="load_more_button5"
			     data-content-nonce-value="<?php echo $photo_gallery_wp_content_load_nonce; ?>"><?php echo Photo_Gallery_WP()->settings->video_view1_loadmore_text; ?></div>
			<div class="loading5"><img alt="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"
			                           src="<?php if ( Photo_Gallery_WP()->settings->video_view1_loading_type == '1' ) {
				                           echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading1.gif';
			                           } elseif ( Photo_Gallery_WP()->settings->video_view1_loading_type == '2' ) {
				                           echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading4.gif';
			                           } elseif ( Photo_Gallery_WP()->settings->video_view1_loading_type == '3' ) {
				                           echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading36.gif';
			                           } elseif ( Photo_Gallery_WP()->settings->video_view1_loading_type == '4' ) {
				                           echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading51.gif';
			                           } ?>">
			</div>

		</div>
		<?php
	} elseif ( $a == 0 ) {
		?>
		<div class="paginate5">
			<?php
			$protocol    = stripos( $_SERVER['SERVER_PROTOCOL'], 'https' ) === true ? 'https://' : 'http://';
			$actual_link = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "";
			$checkREQ    = '';
			$pattern     = "/\?p=/";
			$pattern2    = "/&page-img[0-9]+=[0-9]+/";
			//$res=preg_match($pattern, $actual_link);
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
				$pervpage = '<a href= ' . $checkREQ . '=1><i class="icon-style5 hugeiticons-fast-backward" ></i></a>  
			                               <a href= ' . $checkREQ . '=' . ( $page - 1 ) . '><i class="icon-style5 hugeiticons-chevron-left"></i></a> ';
			}
			$nextpage = '';
			if ( $page != $total ) {
				$nextpage = ' <a href= ' . $checkREQ . '=' . ( $page + 1 ) . '><i class="icon-style5 hugeiticons-chevron-right"></i></a>  
			                                   <a href= ' . $checkREQ . '=' . $total . '><i class="icon-style5 hugeiticons-fast-forward" ></i></a>';
			}
			echo $pervpage . $page . '/' . $total . $nextpage;
			?>
		</div>
		<?php
	}
	?>
</section>
<ul id="huge_it_gallery_popup_list_<?php echo $galleryID; ?>" class="huge_it_gallery_popup_list gallery-img-content"
    data-rating-type="<?php echo $like_dislike; ?>">
	<?php
	$changePopup = 1;
	foreach ( $images as $key => $row ) {
		$imgurl     = explode( ";", $row->image_url );
		$link       = str_replace( '__5_5_5__', '%', $row->sl_url );
		$descnohtml = strip_tags(
			str_replace( '__5_5_5__', '%', $row->description ) );
		$result     = substr( $descnohtml, 0, 50 );
		?>
		<li class="pupup-element" id="ph-g-wp_pupup_element_<?php echo $row->id; ?>">
			<div class="heading-navigation heading-navigation_<?php echo $galleryID; ?>">
				<div style="display: inline-block; float: left;">
					<div class="left-change"><a href="#<?php echo $changePopup - 1; ?>"
					                            data-popupid="#<?php echo $row->id; ?>"><</a></div>
					<div class="right-change"><a href="#<?php echo $changePopup + 1; ?>"
					                             data-popupid="#<?php echo $row->id; ?>">></a></div>
				</div>
				<?php $changePopup = $changePopup + 1; ?>
				<a href="#close" class="close"></a>
				<div style="clear:both;"></div>
			</div>
			<div class="popup-wrapper popup-wrapper_<?php echo $galleryID; ?>">
				<div class="image-block image-block_<?php echo $galleryID; ?>">
					<?php if ( $like_dislike == 'heart' ): ?>
						<div
							class="ph-g-wp_gallery_like_cont ph-g-wp_gallery_like_cont_<?php echo $galleryID . $pID; ?>">
							<div class="ph-g-wp_gallery_like_wrapper">
						<span class="huge_it_like">
							<?php if ( $like_dislike == 'heart' ): ?>
								<i class="hugeiticons-heart likeheart"></i>
							<?php endif; ?>
							<?php if ( $like_dislike == 'dislike' ): ?>
								<i class="hugeiticons hugeiticons-thumbs-up like_thumb_up"></i>
							<?php endif; ?>
							<span class="huge_it_like_thumb" id="<?php echo $row->id ?>"
							      data-status="<?php if ( isset( $res3->image_status ) && $res3->image_status == 'liked' ) {
								      echo $res3->image_status;
							      } elseif ( isset( $res4->image_status ) && $res4->image_status == 'liked' ) {
								      echo $res4->image_status;
							      } else {
								      echo 'unliked';
							      } ?>">
							<?php if ( $like_dislike == 'heart' ): ?>
								<?php echo $row->like; ?>
							<?php endif; ?>
							</span>
							<span
								class="ph-g-wp_like_count <?php if ( Photo_Gallery_WP()->settings->contentsl_rating_count == 'no' ) {
									echo 'huge_it_hide';
								} ?>"
								id="<?php echo $row->id ?>"><?php if ( $like_dislike != 'heart' ): ?><?php echo $row->like; ?><?php endif; ?></span>
						</span>
							</div>
							<?php if ( $like_dislike != 'heart' ): ?>
								<div class="huge_it_gallery_dislike_wrapper">
						<span class="huge_it_dislike">
							<i class="hugeiticons-thumbs-down dislike_thumb_down"></i>
							<span class="huge_it_dislike_thumb" id="<?php echo $row->id ?>"
							      data-status="<?php if ( isset( $res3->image_status ) && $res3->image_status == 'disliked' ) {
								      echo $res3->image_status;
							      } elseif ( isset( $res5->image_status ) && $res5->image_status == 'disliked' ) {
								      echo $res5->image_status;
							      } else {
								      echo 'unliked';
							      } ?>">
							</span>
							<span
								class="huge_it_dislike_count <?php if ( Photo_Gallery_WP()->settings->contentsl_rating_count == 'no' ) {
									echo 'huge_it_hide';
								} ?>"
								id="<?php echo $row->id ?>"><?php echo $row->dislike; ?></span>
						</span>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php
					$imagerowstype = $row->sl_type;
					if ( $row->sl_type == '' ) {
						$imagerowstype = 'image';
					}
					switch ( $imagerowstype ) {
						case 'image':
							?>
							<?php if ( $row->image_url != ';' ) { ?>
							<img alt="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"
							     id="wd-cl-big-img<?php echo $key; ?>" src="<?php echo esc_attr( $imgurl[0] ); ?>"/>
						<?php } else { ?>
							<img alt="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"
							     id="wd-cl-big-img<?php echo $key; ?>" src="images/noimage.jpg"/>
							<?php
						} ?>
							<?php
							break;
						case 'video':
							?>
							<?php
							$videourl = photo_gallery_wp_get_video_id_from_url( $row->image_url );
							if ( $videourl[1] == 'youtube' ) {
								?>
								<iframe src="//www.youtube.com/embed/<?php echo $videourl[0]; ?>" frameborder="0"
								        allowfullscreen></iframe>
								<?php
							} else {
								?>
								<iframe
									src="//player.vimeo.com/video/<?php echo $videourl[0]; ?>?title=0&amp;byline=0&amp;portrait=0"
									frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
								<?php
							}
							?>
							<?php
							break;
					}
					?>
					<?php if ( str_replace( '__5_5_5__', '%', $row->sl_url ) == '' ) {
						$viwMoreButton = '';
					} else {
						if ( $row->link_target == 'yes' ) {
							$target = 'target="_blank"';
						} else {
							$target = '';
						}
						$viwMoreButton = '<div class="button-block"><a href="' . str_replace( '__5_5_5__', '%', $row->sl_url ) . '" ' . $target . ' >' . Photo_Gallery_WP()->settings->view2_popup_linkbutton_text . '</a></div>';
					}
					?>
				</div>
				<div
					class="right-block"><?php if ( $row->name != '' && $row->name != null ) { ?>
						<h3 class="title"><?php echo str_replace( '__5_5_5__', '%', $row->name ); ?></h3><?php } ?>
					<?php if ( Photo_Gallery_WP()->settings->view2_show_description == 'yes' ) { ?>
						<div class="description"><?php echo str_replace( '__5_5_5__', '%', $row->description ); ?></div>
					<?php } ?>
					<?php if ( $like_dislike != 'off' && $like_dislike != 'heart' ): ?>
						<div
							class="ph-g-wp_gallery_like_cont ph-g-wp_gallery_like_cont_<?php echo $galleryID . $pID; ?>">
							<div class="ph-g-wp_gallery_like_wrapper">
						<span class="huge_it_like">
							<?php if ( $like_dislike == 'heart' ): ?>
								<i class="hugeiticons-heart likeheart"></i>
							<?php endif; ?>
							<?php if ( $like_dislike == 'dislike' ): ?>
								<i class="hugeiticons-thumbs-up like_thumb_up"></i>
							<?php endif; ?>
							<span class="huge_it_like_thumb" id="<?php echo $row->id ?>"
							      data-status="<?php if ( isset( $res3->image_status ) && $res3->image_status == 'liked' ) {
								      echo $res3->image_status;
							      } elseif ( isset( $res4->image_status ) && $res4->image_status == 'liked' ) {
								      echo $res4->image_status;
							      } else {
								      echo 'unliked';
							      } ?>">
							<?php if ( $like_dislike == 'heart' ): ?>
								<?php echo $row->like; ?>
							<?php endif; ?>
						</span>
							<span
								class="ph-g-wp_like_count <?php if ( Photo_Gallery_WP()->settings->popup_rating_count == 'no' ) {
									echo 'huge_it_hide';
								} ?>"
								id="<?php echo $row->id ?>"><?php if ( $like_dislike != 'heart' ): ?><?php echo $row->like; ?><?php endif; ?></span>
						</span>
							</div>
							<?php if ( $like_dislike != 'heart' ): ?>
								<div class="huge_it_gallery_dislike_wrapper">
						<span class="huge_it_dislike">
							<i class="hugeiticons-thumbs-down dislike_thumb_down"></i>
							<span class="huge_it_dislike_thumb" id="<?php echo $row->id ?>"
							      data-status="<?php if ( isset( $res3->image_status ) && $res3->image_status == 'disliked' ) {
								      echo $res3->image_status;
							      } elseif ( isset( $res5->image_status ) && $res5->image_status == 'disliked' ) {
								      echo $res5->image_status;
							      } else {
								      echo 'unliked';
							      } ?>">
							</span>
							<span
								class="huge_it_dislike_count <?php if ( Photo_Gallery_WP()->settings->popup_rating_count == 'no' ) {
									echo 'huge_it_hide';
								} ?>"
								id="<?php echo $row->id ?>"><?php echo $row->dislike; ?></span>
							</span>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php if ( Photo_Gallery_WP()->settings->view2_show_popup_linkbutton == 'yes' ) { ?>
						<?php echo $viwMoreButton; ?>
					<?php } ?>
					<div style="clear:both;"></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</li>
		<?php
	} ?>
</ul>