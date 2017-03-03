<?php $resortica_lite_theme_options = resortica_lite_theme_options();
$mid_section_2_title = $resortica_lite_theme_options['mid_section_2_title'];
$mid_section_2_cat = ($resortica_lite_theme_options['mid_section_2_cat'] != 'resortica_lite_default'?$resortica_lite_theme_options['mid_section_2_cat']:'');
if(!empty($mid_section_2_cat)) :
    $mid_section_2_arg = array(
            'post_type' => 'post',
            'posts_per_page' => 2,
            'post_status' => 'publish',
            'order' => 'desc',
            'orderby' => 'menu_order date',
            'category_name' => $mid_section_2_cat,
            );
    $mid_section_2_query = new WP_Query($mid_section_2_arg);
    if($mid_section_2_query->have_posts()): ?>
        <section id="section-explore" class="rl-section section-explore">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h1 class="section-title text-left"><?php echo esc_html($mid_section_2_title ); ?></h1>
                        <div class="section-content">
                            <div class="rl-explore-slider">

                               <?php while($mid_section_2_query->have_posts()):
                                    $mid_section_2_query->the_post();
                                    $special_image_id = get_post_thumbnail_id();
                                    $special_image_url = wp_get_attachment_image_src($special_image_id,'full' ); ?>
                                    <div class="rl-explore-slider-item" style="background-image: url(<?php echo esc_url($special_image_url[0]) ?>)">
                                        <div class="explore-slider-desc-wrap">
                                            <div class="explore-body ">
                                                <h2 class="explore-slider-title"><?php the_title(); ?></h2>
                                                <p><?php echo wp_kses_post(resortica_lite_get_excerpt($post->ID,150)); ?> </p>
                                            </div>

                                            <div class="explore-footer">
                                                <a href="<?php echo esc_url(get_permalink()); ?>" class="about-read-more"><?php echo esc_html__( 'Read More', 'resortica-lite' );?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php endif;
endif;
