<?php

/*
Plugin Name: Huge IT Photo Gallery
Plugin URI: https://huge-it.com/wordpress-photo-gallery/
Description: Photo Gallery is advanced solution for WordPress Gallery users. 7 advanced and customizable views will help to create beautiful content in minutes.
Version: 2.0.6
Author: Huge-IT
Author URI: https://huge-it.com/
License: GNU/GPLv3 https://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Photo_Gallery_WP' ) ) :

    final class Photo_Gallery_WP {

        /**
         * Version of plugin
         * @var String
         */
        public $version = "2.0.6";

        /**
         * Instance of Gallery_Img_Admin class to manage admin
         * @var Photo_Gallery_WP_Admin instancew
         */
        public $admin = null;

        /**
         * Instance of Photo_Gallery_WP_Template_Loader class to manage admin
         * @var Photo_Gallery_WP_Template_Loader instance
         */
        public $template_loader = null;

        /**
         * @var Photo_Gallery_WP_Settings
         */
        public $settings;

        /**
         * @var Photo_Gallery_WP_Lightbox_Settings
         */
        public $lightbox_settings;

        /**
         * The single instance of the class.
         *
         * @var Photo_Gallery_WP
         */
        protected static $_instance = null;

        /**
         * Main Photo_Gallery_WP Instance.
         *
         * Ensures only one instance of Photo_Gallery_WP is loaded or can be loaded.
         *
         * @static
         * @see Photo_Gallery_WP()
         * @return Photo_Gallery_WP - Main instance.
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        private function __clone() {
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'photo-gallery-wp' ), '0.1' );
        }

        /**
         * Unserializing instances of this class is forbidden.
         */
        private function __wakeup() {
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'photo-gallery-wp' ), '0.1' );
        }

        /**
         * Photo_Gallery_WP Constructor.
         */
        private function __construct() {
            $this->define_constants();
            $this->includes();
            $this->init_hooks();
            global $Photo_Gallery_WP_url,$Photo_Gallery_WP_path;
            $Photo_Gallery_WP_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
            $Photo_Gallery_WP_url = plugins_url('', __FILE__ );
            do_action( 'Photo_Gallery_WP_loaded' );
        }

        /**
         * Hook into actions and filters.
         */
        private function init_hooks() {
            register_activation_hook( __FILE__, array( 'Photo_Gallery_WP_Install', 'install' ) );
            add_action( 'init', array( $this, 'init' ), 0 );
            add_action( 'plugins_loaded', array($this,'load_plugin_textdomain') );

        }

        /**
         * Define Image Gallery Constants.
         */
        private function define_constants() {
            $this->define( 'PHOTO_GALLERY_WP_PLUGIN_URL', plugin_dir_path(__FILE__));
            $this->define( 'PHOTO_GALLERY_WP_PLUGIN_FILE', __FILE__ );
            $this->define( 'PHOTO_GALLERY_WP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
            $this->define( 'PHOTO_GALLERY_WP_VERSION', $this->version );
            $this->define( 'PHOTO_GALLERY_WP_IMAGES_PATH', $this->plugin_path(). DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR );
            $this->define( 'PHOTO_GALLERY_WP_IMAGES_URL', untrailingslashit($this->plugin_url() . '/assets/images/' ));
            $this->define( 'PHOTO_GALLERY_WP_TEMPLATES_PATH', $this->plugin_path() . DIRECTORY_SEPARATOR . 'templates');
            $this->define( 'PHOTO_GALLERY_WP_TEMPLATES_URL', untrailingslashit($this->plugin_url()) . '/templates/');
        }

        /**
         * Define constant if not already set.
         *
         * @param  string $name
         * @param  string|bool $value
         */
        private function define( $name, $value ) {
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
        }

        /**
         * What type of request is this?
         * string $type ajax, frontend or admin.
         *
         * @return bool
         */
        private function is_request( $type ) {
            switch ( $type ) {
                case 'admin' :
                    return is_admin();
                case 'ajax' :
                    return defined( 'DOING_AJAX' );
                case 'cron' :
                    return defined( 'DOING_CRON' );
                case 'frontend' :
                    return  ! is_admin() && ! defined( 'DOING_CRON' );
            }
        }

        /**
         * Include required core files used in admin and on the frontend.
         */
        public function includes() {
            include_once('includes/photo-gallery-wp-img-functions.php');
            include_once('vendor/wpdev-settings/class-wpdev-settings-api.php');
            include_once('includes/class-photo-gallery-wp-settings.php');
            include_once('includes/class-photo-gallery-wp-lightbox-settings.php');
            include_once('includes/photo-gallery-wp-video-function.php');
            include_once( 'includes/class-photo-gallery-wp-install.php' );
            include_once( 'includes/class-photo-gallery-wp-template-loader.php' );
            include_once( 'includes/class-photo-gallery-wp-ajax.php' );
            include_once( 'includes/class-photo-gallery-wp-widgets.php' );
            include_once( 'includes/class-photo-gallery-wp-gallery-widget.php' );
            include_once( 'includes/class-photo-gallery-wp-shortcode.php' );
            include_once( 'includes/class-photo-gallery-wp-frontend-scripts.php' );
            if ( $this->is_request( 'admin' ) ) {
                include_once('includes/admin/class-photo-gallery-wp-admin-functions.php');
                include_once( 'includes/admin/class-photo-gallery-wp-admin.php' );
                include_once( 'includes/admin/class-photo-gallery-wp-admin-assets.php' );
                include_once( 'includes/admin/class-photo-gallery-wp-galleries.php' );
                include_once( 'includes/admin/class-photo-gallery-wp-featured-plugins.php' );
                include_once( 'includes/admin/class-photo-gallery-wp-albums.php' );
            }
        }

        /**
         * Load plugin text domain
         */
        public function load_plugin_textdomain(){
            load_plugin_textdomain( 'photo-gallery-wp', false, $this->plugin_path() . '/languages/' );
        }

        /**
         * Init Image gallery when WordPress `initialises.
         */
        public function init() {
            // Before init action.
            do_action( 'before_Gallery_Img_init' );



            $this->template_loader = new Photo_Gallery_WP_Template_Loader();
            if ( $this->is_request( 'admin' ) ) {
                $this->admin = new Photo_Gallery_WP_Admin();
            }
            $this->settings = new Photo_Gallery_WP_Settings();
            $this->lightbox_settings = new Photo_Gallery_WP_Lightbox_Settings();
            // Init action.
            do_action( 'Gallery_Img_init' );
        }

        /**
         * Get Ajax URL.
         * @return string
         */
        public function ajax_url() {
            return admin_url( 'admin-ajax.php', 'relative' );
        }

        /**
         * Image Gallery Plugin Path.
         *
         * @var string
         * @return string
         */
        public function plugin_path(){
            return untrailingslashit( plugin_dir_path( __FILE__ ) );
        }

        /**
         * Image Gallery Plugin Url.
         * @return string
         */
        public function plugin_url(){
            return plugins_url('', __FILE__ );
        }
    }

endif;

function Photo_Gallery_WP(){
    return Photo_Gallery_WP::instance();
}

$GLOBALS['Photo_Gallery_WP'] = Photo_Gallery_WP();