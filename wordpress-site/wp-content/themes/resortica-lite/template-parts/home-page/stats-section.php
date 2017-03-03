<?php $resortica_lite_theme_options = resortica_lite_theme_options();
$stat_title_1 = $resortica_lite_theme_options['stat_title_1'];
$stat_number_1 = $resortica_lite_theme_options['stat_number_1'];
$stat_title_2 = $resortica_lite_theme_options['stat_title_2'];
$stat_number_2 = $resortica_lite_theme_options['stat_number_2'];
$stat_title_3 = $resortica_lite_theme_options['stat_title_3'];
$stat_number_3 = $resortica_lite_theme_options['stat_number_3'];
$stat_title_4 = $resortica_lite_theme_options['stat_title_4'];
$stat_number_4 = $resortica_lite_theme_options['stat_number_4'];
$mid_bg_image = $resortica_lite_theme_options['mid_bg_image'];
?>

<section id="section-specials" class="rl-section section-special-offers gradient-bg" style="background-image: url(<?php echo esc_url($mid_bg_image) ?>)">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="counter-wrap">

                    <?php if( !empty($stat_title_1) || !empty($stat_number_1) || !empty($stat_title_2) || !empty($stat_number_2) || !empty($stat_title_3) || !empty($stat_number_3) || !empty($stat_title_4) || !empty($stat_number_4) ) : ?>

                        <?php for($i=1; $i<5; $i++){
                            if(!empty($resortica_lite_theme_options['stat_title_'.$i]) || !empty($resortica_lite_theme_options['stat_number_'.$i])){ ?>
                             <div class="counter-item">
                                <span class="timer" data-from="0" data-to="<?php echo absint($resortica_lite_theme_options['stat_number_'.$i]); ?>" data-speed="2000" data-refresh-interval="50"></span>
                                <div class="counter-info">
                                    <h3><?php  echo esc_html($resortica_lite_theme_options['stat_title_'.$i]); ?></h3>
                                </div>
                            </div>
                         <?php   }
                         } ?>

                    <?php endif; ?>
                </div>
                <?php get_template_part( 'template-parts/home-page/mid', 'sections' ); ?>
            </div>
        </div>
    </div>
</section>