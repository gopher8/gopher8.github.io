<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Photo_Gallery_WP_Install {

    /**
     * Install  Photo Gallery WP.
     */
    public static function install() {
        if ( ! defined( 'PHOTO_GALLERY_WP_INSTALLING' ) ) {
            define( 'PHOTO_GALLERY_WP_INSTALLING', true );
        }
        self::create_tables();
        // Flush rules after install
        flush_rewrite_rules();
        // Trigger action
        do_action( 'photo_gallery_wp_installed' );
    }

    private static function create_tables() {
        global $wpdb;
/// creat database tables
        $sql_photo_gallery_wp_images       = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "photo_gallery_wp_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `gallery_id` varchar(200) DEFAULT NULL,
  `description` text,
  `image_url` text,
  `sl_url` varchar(128) DEFAULT NULL,
  `sl_type` text NOT NULL,
  `link_target` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(4) unsigned DEFAULT NULL,
  `published_in_sl_width` tinyint(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
)   DEFAULT CHARSET=utf8 AUTO_INCREMENT=5";
        $sql_photo_gallery_wp_like_dislike = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "photo_gallery_wp_like_dislike` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) NOT NULL,
  `image_status` varchar(10) NOT NULL,
  `ip` varchar(35) NOT NULL,
  `cook` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=10";
        $sql_photo_gallery_wp_gallerys     = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "photo_gallery_wp_gallerys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `sl_height` int(11) unsigned DEFAULT NULL,
  `sl_width` int(11) unsigned DEFAULT NULL,
  `pause_on_hover` text,
  `gallery_list_effects_s` text,
  `description` text,
  `param` text,
  `sl_position` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` text,
  `photo_gallery_wp_sl_effects` text NOT NULL,
  `gallery_loader_type` tinyint DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
)   DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ";

        $table_name = $wpdb->prefix . "photo_gallery_wp_images";
        $sql_2      = "
INSERT INTO 
`" . $table_name . "` (`id`, `name`, `gallery_id`, `description`, `image_url`, `sl_url`, `sl_type`, `link_target`, `ordering`, `published`, `published_in_sl_width`) VALUES
(1, 'Lorem ipsum', '1', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '" . PHOTO_GALLERY_WP_IMAGES_URL . "/front_images/projects/1.jpg" . "', 'http://huge-it.com/fields/order-website-maintenance/', 'image', 'on', 0, 1, NULL),
(2, 'lorem ipsumdolor', '1', '<p>lorem ipsumdolor sit amet lorem ipsum dolor sit amet</p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '" . PHOTO_GALLERY_WP_IMAGES_URL . "/front_images/projects/2.jpg" . "', 'http://huge-it.com/fields/order-website-maintenance/', 'image', 'on', 1, 1, NULL),
(3, 'Lorem ipsum', '1', '<h6>Lorem Ipsum </h6><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><ul><li>lorem ipsum</li><li>dolor sit amet</li><li>lorem ipsum</li><li>dolor sit amet</li></ul>', '" . PHOTO_GALLERY_WP_IMAGES_URL . "/front_images/projects/3.jpg" . "', 'http://huge-it.com/fields/order-website-maintenance/', 'image', 'on', 2, 1, NULL),
(4, 'Lorem ipsum dolor', '1', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p><h7>Dolor sit amet</h7><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '" . PHOTO_GALLERY_WP_IMAGES_URL . "/front_images/projects/4.jpg" . "', 'http://huge-it.com/fields/order-website-maintenance/', 'image', 'on', 3, 1, NULL),
(5, 'Lorem Ipsum', '1', '<h6>Lorem Ipsum</h6><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '" . PHOTO_GALLERY_WP_IMAGES_URL . "/front_images/projects/5.jpg" . "', 'http://huge-it.com/fields/order-website-maintenance/', 'image', 'on', 4, 1, NULL),
(6, 'lorem ipsumdolor', '1', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '" . PHOTO_GALLERY_WP_IMAGES_URL . "/front_images/projects/6.jpg" . "', 'http://huge-it.com/fields/order-website-maintenance/', 'image', 'on', 5, 1, NULL),
(7, 'ipsum dolor', '1', '<h6>Lorem Ipsum</h6><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '" . PHOTO_GALLERY_WP_IMAGES_URL . "/front_images/projects/7.jpg" . "', 'http://huge-it.com/fields/order-website-maintenance/', 'image', 'on', 6, 1, NULL),
(8, 'Photo with exposure', '1', '<h6>Lorem Ipsum </h6><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><ul><li>lorem ipsum</li><li>dolor sit amet</li><li>lorem ipsum</li><li>dolor sit amet</li></ul>', '" . PHOTO_GALLERY_WP_IMAGES_URL . "/front_images/projects/8.jpg" . "', 'http://huge-it.com/fields/order-website-maintenance/', 'image', 'on', 7, 1, NULL),
(9, 'Lorem Ipsum', '1', '<h6>Lorem Ipsum </h6><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><ul><li>lorem ipsum</li><li>dolor sit amet</li><li>lorem ipsum</li><li>dolor sit amet</li></ul>', '" . PHOTO_GALLERY_WP_IMAGES_URL . "/front_images/projects/9.jpg" . "', 'http://huge-it.com/fields/order-website-maintenance/', 'image', 'on', 7, 1, NULL)";
        $table_name = $wpdb->prefix . "photo_gallery_wp_gallerys";
        $sql_3      = "
INSERT INTO `$table_name` (`id`, `name`, `sl_height`, `sl_width`, `pause_on_hover`, `gallery_list_effects_s`, `description`, `param`, `sl_position`, `ordering`, `published`, `photo_gallery_wp_sl_effects`) VALUES
(1, 'My First Gallery', 375, 600, 'on', 'random', '4000', '1000', 'center', 1, '300', '5')";
        $wpdb->query( $sql_photo_gallery_wp_images );
        $wpdb->query( $sql_photo_gallery_wp_gallerys );
        $wpdb->query( $sql_photo_gallery_wp_like_dislike );

        if ( ! $wpdb->get_var( "select count(*) from " . $wpdb->prefix . "photo_gallery_wp_images" ) ) {
            $wpdb->query( $sql_2 );
        }
        if ( ! $wpdb->get_var( "select count(*) from " . $wpdb->prefix . "photo_gallery_wp_gallerys" ) ) {
            $wpdb->query( $sql_3 );
        }
        ////////////////////////////////////////
        $imagesAllFieldsInArray2 = $wpdb->get_results( "DESCRIBE " . $wpdb->prefix . "photo_gallery_wp_gallerys", ARRAY_A );
        $fornewUpdate            = 0;
        foreach ( $imagesAllFieldsInArray2 as $portfoliosField2 ) {
            if ( $portfoliosField2['Field'] == 'display_type' ) {
                $fornewUpdate = 1;
            }
        }
        if ( $fornewUpdate != 1 ) {
            $wpdb->query( "ALTER TABLE " . $wpdb->prefix . "photo_gallery_wp_gallerys ADD display_type integer DEFAULT '2' " );
            $wpdb->query( "ALTER TABLE " . $wpdb->prefix . "photo_gallery_wp_gallerys ADD content_per_page integer DEFAULT '5' " );
        }
        ///////////////////////////////////////////////////////////////////////
        $imagesAllFieldsInArray3 = $wpdb->get_results( "DESCRIBE " . $wpdb->prefix . "photo_gallery_wp_images", ARRAY_A );
        $fornewUpdate2           = 0;
        foreach ( $imagesAllFieldsInArray3 as $portfoliosField3 ) {
            if ( $portfoliosField3['Field'] == 'sl_url' && $portfoliosField3['Type'] == 'text' ) {
                $fornewUpdate2 = 1;
            }
        }
        if ( $fornewUpdate2 != 1 ) {
            $wpdb->query( "ALTER TABLE " . $wpdb->prefix . "photo_gallery_wp_images CHANGE sl_url sl_url TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL" );
        }
        //ADDING LIKE/DISLIKE COLUMNS
        ///////////////////////////////////////////////////////////////////////
        $imagesAllFieldsInArray4 = $wpdb->get_results( "DESCRIBE " . $wpdb->prefix . "photo_gallery_wp_images", ARRAY_A );
        $fornewUpdate3           = 0;
        foreach ( $imagesAllFieldsInArray4 as $portfoliosField4 ) {
            if ( $portfoliosField4['Field'] == 'like' ) {
                $fornewUpdate3 = 1;
            }
        }
        if ( $fornewUpdate3 != 1 ) {
            $wpdb->query( "ALTER TABLE " . $wpdb->prefix . "photo_gallery_wp_images  ADD `like` INT NOT NULL DEFAULT 0 AFTER `published_in_sl_width`" );
            $wpdb->query( "ALTER TABLE " . $wpdb->prefix . "photo_gallery_wp_images  ADD `dislike` INT NOT NULL DEFAULT '0' AFTER `like`" );
        }
        //ADDING Rating COLUMNS
        $imagesAllFieldsInArray5 = $wpdb->get_results( "DESCRIBE " . $wpdb->prefix . "photo_gallery_wp_gallerys", ARRAY_A );
        $fornewUpdate4           = 0;
        foreach ( $imagesAllFieldsInArray5 as $portfoliosField5 ) {
            if ( $portfoliosField5['Field'] == 'rating' ) {
                $fornewUpdate4 = 1;
            }
        }
        if ( $fornewUpdate4 != 1 ) {
            $wpdb->query( "ALTER TABLE " . $wpdb->prefix . "photo_gallery_wp_gallerys  ADD `rating` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  'off'" );
        }
        /////////////////////////////////////////////
        $imagesAllFieldsInArray6 = $wpdb->get_results( "DESCRIBE " . $wpdb->prefix . "photo_gallery_wp_gallerys", ARRAY_A );
        $fornewUpdate5           = 0;
        foreach ( $imagesAllFieldsInArray6 as $portfoliosField6 ) {
            if ( $portfoliosField5['Field'] == 'autoslide' ) {
                $fornewUpdate5 = 1;
            }
        }
        if ( $fornewUpdate5 != 1 ) {
            $wpdb->query( "ALTER TABLE " . $wpdb->prefix . "photo_gallery_wp_gallerys  ADD `autoslide` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  'on'" );
        }
        $table_name = $wpdb->prefix . "photo_gallery_wp_images";
        $query      = "SELECT id,image_url,gallery_id FROM " . $table_name . " WHERE gallery_id=1";
        $images_url = $wpdb->get_results( $query );
        foreach ( $images_url as $image_url ) {
            if ( strpos( $image_url->image_url, '/gallery-images/Front_images' ) > - 1 ) {
                $new_url = str_replace( 'gallery-images/Front_images/', 'gallery-images/assets/images/front_images/', $image_url->image_url );
                $wpdb->query( $wpdb->prepare( "UPDATE " . $table_name . " SET image_url= %s WHERE id=%d", $new_url, $image_url->id ) );
            }
            if ( strpos( $image_url->image_url, '/gallery-images-pro-master/Front_images' ) > - 1 ) {
                $new_url = str_replace( 'gallery-images-pro-master/Front_images/', 'gallery-images-pro-master/assets/images/front_images/', $image_url->image_url );
                $wpdb->query( $wpdb->prepare( "UPDATE " . $table_name . " SET image_url= %s WHERE id=%d", $new_url, $image_url->id ) );
            }
        }
        $table_name = $wpdb->prefix . 'photo_gallery_wp_params';
        if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name ) {
            $query                = "SELECT name,value FROM " . $table_name;
            $gallery_table_params = $wpdb->get_results( $query );
        }
        $gallery_default_params = photo_gallery_wp_get_general_options();
        if ( ! ( get_option( 'ht_blog_heart_likedislike_thumb_active_color' ) ) ) {
            if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name ) {
                if ( count( $gallery_table_params ) > 0 ) {
                    foreach ( $gallery_table_params as $gallery_table_param ) {
                        update_option( $gallery_table_param->name, $gallery_table_param->value );
                    }
                }
            } else {
                foreach ( $gallery_default_params as $name => $value ) {
                    update_option( $name, $value );
                }
            }
        }
        if ( ! get_option( 'photo_gallery_wp_admin_image_hover_preview' ) ) {
            add_option( 'photo_gallery_wp_admin_image_hover_preview' );
        }
    }
}