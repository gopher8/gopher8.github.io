<?php $resortica_lite_theme_options = resortica_lite_theme_options();
$mid_section_1_title = $resortica_lite_theme_options['mid_section_1_title'];
$mid_section_1_cat = ($resortica_lite_theme_options['mid_section_1_cat'] != 'resortica_lite_default'?$resortica_lite_theme_options['mid_section_1_cat']:'');
if(!empty($mid_section_1_cat)) :
     $mid_section_1_arg = array(
            'post_type' => 'post',
            'posts_per_page' => 2,
            'post_status' => 'publish',
            'order' => 'desc',
            'orderby' => 'menu_order date',
            'category_name' => $mid_section_1_cat,
            );
    $mid_section_1_query = new WP_Query($mid_section_1_arg);
    if($mid_section_1_query->have_posts()): ?>

        <div class="section-content">

            <div class="decor-bar">
                <?php  if( $resortica_lite_theme_options['decor_image'] ): ?>
                     <img src="<?php echo esc_url($resortica_lite_theme_options['decor_image']); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
                <?php endif; ?>
            </div>
            <h1 class="section-title text-center"><?php echo esc_html($mid_section_1_title); ?></h1>
            <div class="special-offers-wrap">
                <div class="row">
                    <?php while($mid_section_1_query->have_posts()):
                        $mid_section_1_query->the_post();
                        $special_image_id = get_post_thumbnail_id();
                        $special_image_url = wp_get_attachment_image_src($special_image_id,'full' ); ?>
                        <div class="col-md-6">
                            <div class="card">
                                <img class="card-img-top" src="<?php echo esc_url($special_image_url[0]); ?>" alt="<?php the_title() ?>">
                                <div class="card-block">
                                    <h3 class="card-title"><?php the_title(); ?> <a href="<?php the_permalink() ?>" class="pull-right"><i class="icon ion-android-arrow-forward"></i></a></h3>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    $category_special = get_category_by_slug($mid_section_1_cat);
                    $category_link = get_category_link( $category_special->cat_ID ); ?>
                </div>
                 <div class="specials-btn">
                    <a href="<?php echo esc_url( $category_link ); ?>" class="btn rl-btn"><?php echo esc_html__('View All', 'resortica-lite') ?></a>
                </div>
            </div>
        </div>
    <?php
    wp_reset_postdata();
endif;
endif; ?>
