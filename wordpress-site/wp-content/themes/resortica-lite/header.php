<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package resortica-lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
 $resortica_lite_theme_options = resortica_lite_theme_options();
 // resortica_lite_check($resortica_lite_theme_options);
    $description = get_bloginfo( 'description', 'display' );
    if(function_exists( 'get_custom_logo' ) && has_custom_logo() ) {
        $resortica_theme_logo = get_custom_logo(); }
    else{
        $resortica_theme_logo = "";
    }

    ?>
    <div class="search-box-wrapper">
    <i class="icon-close ion-ios-close-empty"></i>
    <?php
    get_search_form(); ?>
    </div>

    <!-- Offcanvas. Mobile Navigation -->
    <div id="sidr" class="hidden">
        <?php the_custom_logo();
       // if (!has_custom_logo()) {
            ?>
            <div class="back-btn-div menu-btn">
            <i class="icon ion-android-arrow-back"></i>
        </div>
            <div class="decor-bar">
                 <?php
                 $decor_image = $resortica_lite_theme_options['decor_image'];
                 if( esc_url($decor_image) ): ?>
                     <img src="<?php echo esc_url($decor_image); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>" />
                <?php  endif;
                 if($resortica_lite_theme_options['site_title_chk'] == 1): ?>
                    <h2 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ) ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name')) ?></a>
                    </h2>
                <?php
                endif;
                if ( $resortica_lite_theme_options['tagline_chk'] == 1 ) : ?>
                    <p class="site-description"><?php echo esc_html($description) ?></p>
                <?php endif; ?>
                <div class="hero-star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
            </div>
        <?php
        //}?>
        <?php wp_nav_menu(
            array(
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
                'menu_class' => 'nav navbar-nav',
                )
            );
        ?>
    </div>


    <!-- Wrapping everything in the Offcanvas wrap. -->
    <div class="offcanvas-wrap">

      <noscript>
        <p class="no-script"><?php __('Enable Javascript in your browser for better experience.', 'resortica-lite'); ?></p>
      </noscript>

    <!-- Header -->
    <?php if( is_page_template( 'page-templates/template-home.php' ) || is_home() ):
        $header_banner = 'header';
    else:
        $header_banner = '';
    endif; ?>
    <header id="top" class="<?php echo esc_attr($header_banner); ?> hero">

        <div class="navigation-wrap">
            <div class="container">
                <nav class="navbar navbar-default" role="navigation">
                 <ul class="nav navbar-nav">
                    <li class="pull-left"><a class="menu-btn" href="#sidr"><i class="fa fa-bars" aria-hidden="true"></i><?php echo esc_html__('Menu','resortica-lite'); ?></a></li>
                        <li class="pull-right">
                            <ul class="social"><?php echo resortica_lite_social_icons(); ?></ul>
                        </li>
                    <li class="nav-list">
                        <div class="navbar-brand">
                        <?php the_custom_logo();
                       // if (!has_custom_logo()) {
                            ?>
                                <div class="decor-bar">
                                     <?php  if( esc_url($decor_image) ): ?>
                                         <img src="<?php echo esc_url($decor_image); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
                                     <?php
                                     endif;
                                     if($resortica_lite_theme_options['site_title_chk'] == 1 ): ?>
                                    <h2 class="site-title">
                                        <a href="<?php echo esc_url( home_url( '/' ) ) ?>" rel="home"><?php echo get_bloginfo( 'name') ?></a>
                                    </h2>
                                    <?php
                                    endif;
                                    if ( $resortica_lite_theme_options['tagline_chk'] == 1  ) : ?>
                                        <p class="site-description"><?php echo $description ?></p>
                                    <?php endif; ?>
                                    <div class="hero-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        <?php
                        //}?>
                    </li>
                 </ul>
                </nav><!-- #site-navigation -->
            </div>
        </div>
        <?php if( is_page_template( 'page-templates/template-home.php' ) || is_home() ): ?>
            <div class="text-vertical-center gradient-bg">
                <?php if(!empty($resortica_lite_theme_options['banner_title']) || !empty($resortica_lite_theme_options['banner_description'])): ?>
                    <div class="content-inner">
                         <div class="decor-bar">
                            <?php  if( esc_url($decor_image )): ?>
                                 <img src="<?php echo esc_url($decor_image); ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" />
                             <?php
                             endif; ?>
                        </div>
                        <h1 class="hero-title"><?php echo esc_html($resortica_lite_theme_options['banner_title']); ?></h1>
                        <h3 class="hero-tagline"><?php echo esc_html($resortica_lite_theme_options['banner_description']); ?></h3>
                        <div class="hero-star">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        <a href="#section-about" class="scrollto-next"><i class="icon ion-chevron-down"></i></a>
        <?php endif; ?>

    </header>
    <?php if( !is_page_template( 'page-templates/template-home.php' ) && !is_home() ):
          if( get_header_image() ):
             $banner_image = get_header_image();
         else:
            $banner_image = '';
         endif; ?>
        <!-- Breadcrumb -->
        <div class="inner-banner-wrap  gradient-bg" style="background-image: url(<?php echo esc_url($banner_image) ?>)">
            <div class="container">
                <div class="row">
                    <div class="inner-banner-content">
                        <?php if(is_archive()): ?>
                            <h2><?php the_archive_title(); ?></h2>
                        <?php elseif (is_single()): ?>
                           <h2><?php the_title(); ?></h2>
                        <?php endif;
                        if(!is_search()):?>
                            <div class="header-breadcrumb">
                               <?php resortica_lite_breadcrumbs(); ?>
                            </div>
                        <?php else: ?>
                           <ul class="breadcrumb">
                                <h2><?php esc_html_e( 'Search Page', 'resortica-lite' ); ?></h2>
                           </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of breadcrumb sec -->
    <?php endif; ?>
