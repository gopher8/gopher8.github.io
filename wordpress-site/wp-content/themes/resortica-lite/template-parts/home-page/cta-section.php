<?php $resortica_lite_theme_options = resortica_lite_theme_options();
$call_to_action_title = $resortica_lite_theme_options['call_to_action_title'];
$call_to_action_description = $resortica_lite_theme_options['call_to_action_description'];
$call_to_action_btn_txt = $resortica_lite_theme_options['call_to_action_btn_txt'];
$call_to_action_btn_link = $resortica_lite_theme_options['call_to_action_btn_link'];
?>


<section class="rl-section cta-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="section-content">
                    <?php if(!empty($call_to_action_title) || !empty($call_to_action_description)) { ?>
                       <h1 class="cta-title"><?php echo esc_html( $call_to_action_title ); ?></h1>
                       <p><?php echo esc_html( $call_to_action_description ); ?></p>
                    <?php }
                    if(!empty($call_to_action_btn_txt)){ ?>
                        <a href="<?php echo esc_url($call_to_action_btn_link) ?>" class="btn cta-btn"><?php echo esc_html($call_to_action_btn_txt); ?><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
