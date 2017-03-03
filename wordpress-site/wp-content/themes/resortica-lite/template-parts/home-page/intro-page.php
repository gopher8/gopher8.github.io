<?php $resortica_lite_theme_options = resortica_lite_theme_options();
$intro_pages = $resortica_lite_theme_options['intro_pages'];
if(!empty($intro_pages)):
    $intro_pages_arg = array(
            'post_type' => 'page',
            'posts_per_page' => 1,
            'post_status' => 'publish',
            'page_id' => $intro_pages );
    $intro_pages_query =new WP_Query($intro_pages_arg);
    if($intro_pages_query->have_posts()): ?>
        <section id="section-about" class="rl-section section-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                     <?php
                      while($intro_pages_query->have_posts()):
                            $intro_pages_query->the_post();
                        $gallery = get_post_gallery_images( $post );
                        $gallery_count = count($gallery);
                        $ori_url = explode( "\n", get_the_content() );
                        $url = $ori_url[0];
                        $url_chk = resortica_lite_is_url($url);
                        if(!empty($gallery) && !in_array( 'jetpack/jetpack.php', apply_filters( 'resortica_jetpack_check', get_option( 'active_plugins' ) ) )  ):
                            $content_check = 'resortica-gallery';
                            $content_length = '125';
                        elseif (!empty($url_chk)):
                            $content_check = 'resortica-video';
                            $content_length = '250';
                        elseif(get_the_post_thumbnail()):
                            $content_check = 'resortica-image';
                            $content_length = '250';
                        else:
                            $content_check = '';
                            $content_length = '250';
                        endif; ?>
                        <div class="about-content <?php echo esc_attr($content_check); ?>">
                            <h1><?php the_title(); ?></h1>
                            <p><?php echo wp_kses_post(resortica_lite_get_excerpt($intro_pages_query->post->ID,$content_length) );?></p>
                            <a href="<?php echo esc_url(get_permalink($intro_pages)) ?>" class="about-read-more"><?php esc_html_e( 'Read More', 'resortica-lite' );?><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                        <?php if(!empty($gallery) && !in_array( 'jetpack/jetpack.php', apply_filters( 'resortica_jetpack_check', get_option( 'active_plugins' ) ) ) ): ?>
                            <div class="about-slider">
                                <?php // resortica_lite_check($gallery);
                                foreach( $gallery as $image_url ) { ?>
                                    <div class="about-slider-item" style="background-image: url(<?php echo esc_url($image_url) ?>)"></div>
                                    <?php
                                }?>
                            </div>
                        <?php elseif (!empty($url_chk)): ?>
                            <div class="about-video">
                                <?php echo wp_oembed_get( $url ); ?>
                            </div>
                        <?php elseif(get_the_post_thumbnail()):
                            $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' ); ?>
                            <div class="about-image" style="background-image: url(<?php echo esc_url($feat_image[0]); ?>)">
                            </div>
                        <?php else: ?>
                            <div class="no-image">
                                <div class="no-image"></div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($gallery) && !in_array( 'jetpack/jetpack.php', apply_filters( 'resortica_jetpack_check', get_option( 'active_plugins' ) ) )): ?>
                                <div class="slider-nav">
                                    <?php for( $i=1; $i<$gallery_count; $i++) { ?>
                                            <div class="slider-nav-thumb">
                                                <img src="<?php echo esc_url($gallery[$i]) ?>">
                                            </div>
                                    <?php } ?>
                                    <div class="slider-nav-thumb">
                                        <img src="<?php echo esc_url($gallery[0]) ?>">
                                    </div>
                                </div>
                    <?php endif; ?>
                    <?php  endwhile;  wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;
endif;