<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package resortica-lite
 */
$resortica_lite_theme_options = resortica_lite_theme_options();
?>

     <!-- Footer -->
  <footer>

    <?php
    if(absint($resortica_lite_theme_options['pre_footer_display']) == 1):
     if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' )  ){ ?>
          <div class="widget-area footer-widgets footer-widget-area-top">
              <div class="container">
                  <div class="row">
                      <div class="col-md-4 col-sm-12 margin-bot">
                        <?php dynamic_sidebar( 'sidebar-2' );
                          if(absint($resortica_lite_theme_options['social_media_enabled_footer']) == 1) : ?>
                          <div class="social-footer">
                            <?php if(!empty($resortica_lite_theme_options['email_id'])): ?>
                                    <ul class="social">

                                        <li>
                                            <a href="mailto:<?php echo sanitize_email($resortica_lite_theme_options['email_id']) ?>" data-toggle="tooltip" data-placement="top" title="" class="fb" target="_blank" data-original-title="<?php echo esc_attr__('Mail Us','resortica-lite'); ?>">
                                                <i class="fa fa-envelope-o"></i>
                                            </a>
                                        </li>
                                      <?php endif;
                                if(!empty($resortica_lite_theme_options['phone_no'])): ?>
                                        <li>
                                            <a href="tel:+<?php echo absint($resortica_lite_theme_options['phone_no']) ?>" data-toggle="tooltip" data-placement="top" title="" class="fb" target="_blank" data-original-title="<?php echo esc_attr__('Call Us','resortica-lite'); ?>">
                                                <i class="fa fa-phone"></i>
                                            </a>
                                        </li>
                                      <?php endif;
                                if(!empty($resortica_lite_theme_options['fb_link'])): ?>
                                        <li>
                                            <a href="<?php echo esc_url($resortica_lite_theme_options['fb_link']) ?>" data-toggle="tooltip" data-placement="top" title="" class="fb" target="_blank" data-original-title="<?php echo esc_attr__('Follow us on Facebook','resortica-lite'); ?>">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                      <?php endif;
                                      if(!empty($resortica_lite_theme_options['gplus'])):
                                      ?>
                                        <li>
                                            <a href="<?php echo esc_url($resortica_lite_theme_options['gplus']) ?>" data-toggle="tooltip" data-placement="top" title="" class="gp" target="_blank" data-original-title="<?php echo esc_attr__('Follow us on Google Plus','resortica-lite'); ?>">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                      <?php endif;
                                      if(!empty($resortica_lite_theme_options['linkedin_link'])):?>
                                        <li>
                                            <a data-toggle="tooltip" data-placement="top" title="" href="<?php echo esc_url($resortica_lite_theme_options['linkedin_link']) ?>" class="ld" target="_blank" data-original-title="<?php echo esc_attr__('Follow us on Linkedin','resortica-lite'); ?>">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </li>
                                      <?php endif;
                                      if(!empty($resortica_lite_theme_options['youtube_link'])):?>
                                        <li>
                                            <a data-toggle="tooltip" data-placement="top" title="" href="<?php echo esc_url($resortica_lite_theme_options['youtube_link']) ?>" class="yt" target="_blank" data-original-title="<?php echo esc_attr__('Follow us on Youtube','resortica-lite'); ?>">
                                                <i class="fa fa-youtube-play"></i>
                                            </a>
                                        </li>
                                        <?php endif;
                                      if(!empty($resortica_lite_theme_options['instagram'])):?>
                                          <li>
                                              <a data-toggle="tooltip" data-placement="top" title="" href="<?php echo esc_url($resortica_lite_theme_options['instagram']) ?>" class="in" target="_blank" data-original-title="<?php echo esc_attr__('Follow us on instagram','resortica-lite'); ?>">
                                                  <i class="fa fa-instagram"></i>
                                              </a>
                                          </li>
                                      <?php endif;
                                       if(!empty($resortica_lite_theme_options['twitter_link'])):?>
                                          <li>
                                              <a data-toggle="tooltip" data-placement="top" title="" href="<?php echo esc_url($resortica_lite_theme_options['twitter_link']) ?>" class="in" target="_blank" data-original-title="<?php echo esc_attr__('Follow us on twitter','resortica-lite'); ?>">
                                                  <i class="fa fa-twitter"></i>
                                              </a>
                                          </li>
                                      <?php endif;
                                      if(!empty($resortica_lite_theme_options['pinterest'])):?>
                                          <li>
                                              <a data-toggle="tooltip" data-placement="top" title="" href="<?php echo esc_url($resortica_lite_theme_options['pinterest']) ?>" class="in" target="_blank" data-original-title="<?php echo esc_attr__('Follow us on pinterest','resortica-lite'); ?>">
                                                  <i class="fa fa-pinterest"></i>
                                              </a>
                                          </li>
                                      <?php endif; ?>

                                    </ul>
                          </div>
                  <?php endif; ?>
                          </div>

                    <?php if ( is_active_sidebar( 'sidebar-3' ) ){ ?>
                          <div class="col-md-4 col-sm-12 margin-bot">
                                <?php dynamic_sidebar( 'sidebar-3' ); ?>
                          </div>
                    <?php }
                    if ( is_active_sidebar( 'sidebar-4' ) ){ ?>
                          <div class="col-md-4 col-sm-12 margin-bot">
                                <?php dynamic_sidebar( 'sidebar-4' ); ?>
                          </div>
                    <?php } ?>
                  </div>
                  <!-- End Row -->
              </div>
              <!-- End Container -->
          </div>
    <?php }
  endif; ?>

      <!-- Footer Widgets -->

      <div class="copyright">
          <div class="container">
              <div class="row">

                <div class="col-md-6">
                      <p><?php echo esc_html( $resortica_lite_theme_options['footer_text'] ); ?></p>
                </div>

                <div class="col-md-6">
                <nav class="list-inline pull-right">
                    <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu','container' => '','items_wrap' => '%3$s'  ) );?>
                </nav>
                </div>

              </div>
          </div>
      </div>

  </footer>
  </div>

<?php wp_footer(); ?>

</body>
</html>