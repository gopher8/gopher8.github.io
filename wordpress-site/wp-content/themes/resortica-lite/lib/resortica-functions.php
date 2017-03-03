<?php
if(!function_exists('resortica_lite_excerpt_more')):
    // Replaces the excerpt "more" text by a link
    function resortica_lite_excerpt_more($more) {
        return esc_html__('&hellip;','resortica-lite');
    }
    add_filter('excerpt_more', 'resortica_lite_excerpt_more');
endif;
function resortica_lite_excerpt_length( $length ){
    return 100;
}
add_filter( 'excerpt_length', 'resortica_lite_excerpt_length', 999 );

if(!function_exists('resortica_lite_register_required_plugins')):
    add_action( 'tgmpa_register', 'resortica_lite_register_required_plugins' );

    /**
     * Register the required plugins for this theme.
     * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
     */
    function resortica_lite_register_required_plugins() {

        $plugins = array(

            array(
                'name'      => 'Jetpack by WordPress.com',
                'slug'      => 'jetpack',
                'required'  => false,
            ),
             array(
                'name'      => 'Page Builder Sandwich',
                'slug'      => 'page-builder-sandwich',
                'required'  => false,
            ),
        );

        $config = array(
            'id'           => 'resortica-lite',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        );

        tgmpa( $plugins, $config );
    }
endif;

if(!function_exists('resortica_lite_social_icons')):
    function resortica_lite_social_icons(){
        $resortica_lite_theme_options = resortica_lite_theme_options();
        ob_start(); ?>
                <li class="pull-right">
            <?php if($resortica_lite_theme_options['social_media_enabled_header'] == 1) : ?>
                    <ul class="social">

                    <?php if(!empty($resortica_lite_theme_options['email_id'])): ?>
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
                          <?php endif;?>

                        </ul>

                <?php endif; ?>
                    <div class="search">
                        <div class="control" tabindex="1">
                            <div class="search-btn"></div>
                                <i class="icon-search ion-search"></i>
                        </div>
                    </div>
            </li>

        <?php return ob_get_clean();

    }
endif;

if ( ! function_exists( 'resortica_lite_header_style' ) ) :
    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see resortica_lite_custom_header_setup().
     */
    function resortica_lite_header_style($output = '') {
        $header_text_color = get_header_textcolor();

        /*
         * If no custom options for text are set, let's bail.
         * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
         */
            if ( HEADER_TEXTCOLOR === $header_text_color ) {
                return;
            }

        // If we get this far, we have custom styles. Let's do this.
            // Has the text been hidden?
            if ( ! display_header_text() ) :
            $output = '.site-title,
                    .site-description {
                        position: absolute;
                        clip: rect(1px, 1px, 1px, 1px);
                    }';
            // If the user has set a custom color for the text use that.
            else :
            $output ='.site-title a,
                    .site-description {
                        color: #'.esc_attr( $header_text_color ).'}';
            endif;
            return $output;
    }
endif;

if ( ! function_exists( 'resortica_lite_get_excerpt' ) ) :
    function resortica_lite_get_excerpt( $post_id, $count ) {
        $content_post = get_post($post_id);
        $excerpt = $content_post->post_content;
        $excerpt = strip_tags($excerpt);
        $excerpt = strip_shortcodes($excerpt);
        $excerpt = preg_replace('/\s\s+/', ' ', $excerpt);
        $strip = explode( ' ' ,$excerpt );
        foreach($strip as $key => $single){
            if (!filter_var($single, FILTER_VALIDATE_URL) === false) {
                unset($strip[$key]);
            }
        }
        $excerpt = implode( ' ', $strip );
        $excerpt = substr($excerpt, 0, $count);
        if(strlen($excerpt) >= $count){
            $excerpt = substr($excerpt, 0, strripos($excerpt, ' '));
            $excerpt = $excerpt . '...';
        }
        return $excerpt;
    }
endif;

if ( ! function_exists( 'resortica_lite_the_featured_video' ) ) {
    function resortica_lite_the_featured_video($content) {
        $ori_url = explode( "\n", $content );
        $url = $ori_url[0];
        $w = get_option( 'embed_size_w' );
        if ( !is_single() )
            $url = str_replace( '448', $w, $url );

        if ( 0 === strpos( $url, 'https://' ) || 0 == strpos($url, 'http://' ) ) {
            echo wp_oembed_get( $url );
            $content = trim( str_replace( $url, '', $content ) );
        }
        elseif ( preg_match ( '#^<(script|iframe|embed|object)#i', $url ) ) {
            $h = get_option( 'embed_size_h' );
            echo $url;
            if ( !empty( $h ) ) {

                if ( $w === $h ) $h = ceil( $w * 0.75 );
                $url = preg_replace(
                    array( '#height="[0-9]+?"#i', '#height=[0-9]+?#i' ),
                    array( sprintf( 'height="%d"', $h ), sprintf( 'height=%d', $h ) ),
                    $url
                    );
                echo $url;
            }

            $content = trim( str_replace( $url, '', $content ) );

        }
    }
}

    /* Breadcrumbs  */
    if(!function_exists('resortica_lite_breadcrumbs')):
        function resortica_lite_breadcrumbs() {
                $delimiter = '';
                $home = __( 'Home', 'resortica-lite' ); // text for the 'Home' link
                $before = '<li>'; // tag before the current crumb
                $after = '</li>'; // tag after the current crumb
                echo '<ul class="breadcrumb">';
                global $post;
                $homeLink = home_url();
                echo '<li><a href="' . esc_url($homeLink) . '">' . $home . '</a></li>' . $delimiter . ' ';
                if ( is_category() ) {
                    global $wp_query;
                    $cat_obj = $wp_query->get_queried_object();
                    $thisCat = $cat_obj->term_id;
                    $thisCat = get_category( $thisCat );
                    $parentCat = get_category( $thisCat->parent );
                    if ($thisCat->parent != 0)
                        echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
                    echo $before . single_cat_title('', false) . $after;
                } elseif (is_day()) {
                    echo '<li><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_attr( get_the_time( 'Y' ) ) . '</a></li> ' . $delimiter . ' ';
                    echo '<li><a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) )) . '">' . esc_attr( get_the_time('F') ) . '</a></li> ' . $delimiter . ' ';
                    echo $before . esc_attr( get_the_time( 'd' ) ) . $after;
                } elseif ( is_month() ) {
                    echo '<li><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_attr( get_the_time( 'Y' ) ) . '</a></li> ' . $delimiter . ' ';
                    echo $before . esc_attr( get_the_time('F') ) . $after;
                } elseif ( is_year() ) {
                    echo $before . esc_attr( get_the_time( 'Y' ) ) . $after;
                } elseif ( is_single() && !is_attachment() ) {
                    if ( get_post_type() != 'post' ) {
                        $post_type = get_post_type_object( get_post_type() );
                        $slug = $post_type->rewrite;
                        echo '<li><a href="' . esc_url( $homeLink ) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
                        echo $before . esc_attr( get_the_title() ) . $after;
                    } else {
                        $cat = get_the_category();
                        $cat = $cat[0];
                        //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                        echo $before . esc_attr( get_the_title() ) . $after;
                    }

                } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
                    $post_type = get_post_type_object(get_post_type());
                    if(!empty($post_type)){
                        echo $before . $post_type->labels->singular_name . $after;
                    }
                } elseif (is_attachment()) {
                    $parent = get_post($post->post_parent);
                    $cat = get_the_category($parent->ID);
                    $cat = $cat[0];
                    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    echo '<li><a href="' . esc_url(get_permalink($parent)) . '">' . esc_attr( $parent->post_title ) . '</a></li> ' . $delimiter . ' ';
                    echo $before . esc_attr( get_the_title() ) . $after;
                } elseif ( is_page() && !$post->post_parent ) {
                    echo $before . esc_attr( get_the_title() ) . $after;
                } elseif ( is_page() && $post->post_parent ) {
                    $parent_id = $post->post_parent;
                    $breadcrumbs = array();
                    while ( $parent_id ) {
                        $page = get_page($parent_id);
                        $breadcrumbs[] = '<li><a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
                        $parent_id = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    foreach ($breadcrumbs as $crumb)
                        echo $crumb . ' ' . $delimiter . ' ';
                    echo $before . get_the_title() . $after;
                } elseif ( is_search() ) {
                    echo $before . _e( "Search results for","resortica-lite" )  . get_search_query() . '"' . $after;

                } elseif ( is_tag() ) {
                    echo $before . _e( 'Tag','resortica-lite' ) . single_tag_title( '', false ) . $after;
                } elseif ( is_author() ) {
                    global $author;
                    $userdata = get_userdata( $author );
                    echo $before . _e( "Articles posted by","resortica-lite" ) . $userdata->display_name . $after;
                } elseif (is_404()) {
                    echo $before . _e( "Error 404","resortica-lite" ) . $after;
                }

                echo '</ul>';
        }
    endif;

    if(!function_exists('resortica_lite_is_url')):
        function resortica_lite_is_url($uri){
            if(preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$uri)){
              return $uri;
            }
            else{
                return false;
            }
        }
    endif;

    if ( function_exists( 'wp_update_custom_css_post' ) ) {
        $resortica_lite_theme_options = resortica_lite_theme_options();
        $custom_css = ( !empty($resortica_lite_theme_options['custom_css']) ? $resortica_lite_theme_options['custom_css'] : '');
        $core_css = wp_get_custom_css();
        if ( !empty($custom_css) && empty($core_css) ) {
            $return = wp_update_custom_css_post( $core_css . $custom_css );
        }
    }
