<?php
$resortica_lite_theme_options = resortica_lite_theme_options();
$banner_title = $resortica_lite_theme_options['banner_title'];
$banner_description = $resortica_lite_theme_options['banner_description'];
 ?>
<section id="resortica_banner_section">
    <?php if( !empty( $banner_title ) ): ?>
        <span><?php echo esc_html($banner_title); ?></span>
    <?php endif;
    if(!empty($banner_description)): ?>
        <span><?php echo esc_html( $banner_description );?></span>
    <?php endif; ?>
</section>