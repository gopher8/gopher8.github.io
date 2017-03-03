<?php $resortica_lite_theme_options = resortica_lite_theme_options();
$mid_section_3_title = $resortica_lite_theme_options['mid_section_3_title'];
$mid_section_3_cat = ($resortica_lite_theme_options['mid_section_3_cat'] != 'resortica_lite_default'?$resortica_lite_theme_options['mid_section_3_cat']:'');
if(!empty($mid_section_3_cat)) :
     $mid_section_1_arg = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'order' => 'desc',
            'orderby' => 'menu_order date',
            'category_name' => $mid_section_3_cat,
            );
    $mid_section_3_query = new WP_Query($mid_section_1_arg);
    if($mid_section_3_query->have_posts()): ?>
        <section id="section-accomodation" class="rl-section section-accomodation">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h1 class="section-title text-left"><?php echo esc_html($mid_section_3_title) ?></h1>
                        <div class="section-content">
                            <div class="rl-accomodation-wrapper">
                                <?php while($mid_section_3_query->have_posts()):
                                    $mid_section_3_query->the_post();
                                    $special_image_id = get_post_thumbnail_id();
                                    $special_image_url = wp_get_attachment_image_src($special_image_id,'full' ); ?>
                                    <div class="col-md-4 pad0">
                                        <div class="accomodation-post-wrap" style="background-image: url(<?php echo esc_url($special_image_url[0]) ?>)">
                                            <div class="accomodation-footer">
                                                <h2><?php the_title(); ?></h2>
                                            </div>
                                        </div>
                                    </div>

                                <?php endwhile;
                                wp_reset_postdata();
                                $category_id = get_cat_ID( $mid_section_3_cat );
                                $category_link = get_category_link( $category_id ); ?>
                            </div>

                            <div class="specials-btn">
                                <a href="<?php echo esc_url( $category_link ); ?>" class="btn rl-btn"><?php echo esc_html__( 'View all', 'resortica-lite' );?></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;
endif; ?>