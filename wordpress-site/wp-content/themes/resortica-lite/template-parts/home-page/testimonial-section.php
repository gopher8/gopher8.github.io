<?php
/**
 * Testimonials
 *
 *
 * @package resortica-lite
 * @since Resortica Lite 1.0.0
 */
$resortica_lite_theme_options = resortica_lite_theme_options();
$testimonial_bg_image = $resortica_lite_theme_options['testimonial_bg_image'];
$testimonial_category = ($resortica_lite_theme_options['testimonial_category'] != 'resortica_lite_default'?$resortica_lite_theme_options['testimonial_category']:'');
$testimonial_font_color = $resortica_lite_theme_options['testimonial_font_color'];

if(!empty($testimonial_bg_image)){
    $testimonial_bg_image_style = 'background: url('. esc_url($testimonial_bg_image ).') no-repeat fixed center';
}
else{
    $testimonial_bg_image_style = '';
}

if(!empty($testimonial_category)) :
    $testimonial_arg = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'order' => 'desc',
        'orderby' => 'menu_order date',
        'category_name' => $testimonial_category,
        );
    $testimonial_query = new WP_Query($testimonial_arg);
    if( $testimonial_query->have_posts() ) : ?>
        <section class="rl-section client-testimonials" style="<?php echo esc_attr($testimonial_bg_image_style); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="section-content">

                            <div class="testimonial-slider text-center">
                                <?php while( $testimonial_query->have_posts() ):
                                        $testimonial_query->the_post(); ?>
                                        <div class="testimonial-slide">
                                            <h1 class="section-title no-bor">
                                                <?php the_title(); ?>
                                            </h1>
                                            <div class="client-testimonial">
                                                <p><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink(); ?>"></a></p>
                                            </div>
                                        </div>
                                <?php endwhile;
                                wp_reset_postdata();?>

                            </div>
                            <span class="pagingInfo"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;
endif;
