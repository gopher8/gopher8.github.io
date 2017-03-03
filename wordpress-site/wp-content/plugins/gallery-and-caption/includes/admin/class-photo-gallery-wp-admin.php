<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Photo_Gallery_WP_Admin
{

    /**
     * Array of pages in admin
     * @var array
     */
    public $pages = array();

    /**
     * Count of settings pages controled by WPDEV_Settings_API,
     * this is used to place featured images after the right settings page in admin menu
     * @var int
     */
    private $settings_page_count = 0;

    /**
     * Instance of Photo_Gallery_WP_General_Options class
     *
     * @var Photo_Gallery_WP_General_Options
     */

    /**
     * Instance of Photo_Gallery_WP_Galleries class
     *
     * @var Photo_Gallery_WP_Galleries
     */
    public $galleries = null;

    /**
     * Instance of Photo_Gallery_WP_Lightbox_Options class
     *
     * @var Photo_Gallery_WP_Lightbox_Options
     */

    /**
     * Instance of Photo_Gallery_WP_Featured_Plugins class
     *
     * @var Photo_Gallery_WP_Featured_Plugins
     */
    public $featured_plugins = null;


    /**
     * Instance of Photo_Gallery_WP_Albums class
     *
     * @var Photo_Gallery_WP_Albums
     */
    public $albums = null;

    /**
     * Photo_Gallery_WP_Admin constructor.
     */
    public function __construct()
    {
        $this->init();
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('wp_loaded', array($this, 'wp_loaded'));
        add_action('wp_loaded', array($this, 'wp_loaded_video'));
        add_action('wp_loaded', array($this, 'wp_loaded_duplicate_gallery'));
        add_action('wp_loaded', array($this, 'wp_loaded_remove_photo_gallery_wp'));
        add_action( 'wpdev_settings_photo_gallery_wp_admin_menu', array( $this, 'admin_menu_after_settings' ) );

        add_action( 'wpdev_settings_photo_gallery_wp_header', array( $this, 'free_banner' ) );
        add_action( 'photo_gallery_wp_before_featured_plugins', array( $this, 'free_banner' ) );
        add_action( 'photo_gallery_wp_before_galleries', array( $this, 'free_banner' ) );
    }

    /**
     * Initialize Image Gallery's admin
     */
    protected function init()
    {
        $this->galleries = new Photo_Gallery_WP_Galleries();
        $this->featured_plugins = new Photo_Gallery_WP_Featured_Plugins();
        $this->albums = new Photo_Gallery_WP_Albums();
    }

    public function admin_menu_after_settings(){
        ++$this->settings_page_count;
        if( $this->settings_page_count !== 2 )
            return;
        $this->pages['featured_plugins'] = add_submenu_page('photo_gallery_wp_gallery', __('Featured Plugins', 'photo-gallery-wp'), __('Featured Plugins', 'photo-gallery-wp'), 'manage_options', 'huge_it_ph_gallery_featured_plugins', array(
            Photo_Gallery_WP()->admin->featured_plugins,
            'show_page'
        ));
        $this->pages['licensing'] = add_submenu_page('photo_gallery_wp_gallery', __('Licensing', 'photo-gallery-wp'), __('Licensing', 'photo-gallery-wp'), 'manage_options', 'huge_it_ph_gallery_licensing', array($this, 'licensing_page'));
    }

    /**
     * Prints Gallery Menu
     */
    public function admin_menu()
    {
        $this->pages[] = add_menu_page(__('Photo Gallery WP', 'photo-gallery-wp'), __('Photo Gallery WP', 'photo-gallery-wp'), 'manage_options', 'photo_gallery_wp_gallery', array(
            Photo_Gallery_WP()->admin->galleries,
            'load_gallery_page'
        ), PHOTO_GALLERY_WP_IMAGES_URL . "/admin_images/huge-it-gallery-logo-for-menu.png");

        $this->pages[] = add_submenu_page('photo_gallery_wp_gallery', __('Galleries', 'photo-gallery-wp'), __('Galleries', 'photo-gallery-wp'), 'manage_options', 'photo_gallery_wp_gallery', array(
            Photo_Gallery_WP()->admin->galleries,
            'load_gallery_page'
        ));

    }


    public function wp_loaded()
    {

        if (isset($_REQUEST['photo_gallery_wp_nonce_add_galery'])) {
            $photo_gallery_wp_nonce_add_galery = $_REQUEST['photo_gallery_wp_nonce_add_galery'];
            if (!wp_verify_nonce($photo_gallery_wp_nonce_add_galery, 'photo_gallery_wp_nonce_add_galery')) {
                wp_die('Security check fail');
            }
        }
        global $wpdb;
        if (isset($_GET['task'])) {
            $task = sanitize_text_field($_GET['task']);
            if ($task == 'add_cat') {
                $table_name = $wpdb->prefix . "photo_gallery_wp_gallerys";
                $sql_2 = "
INSERT INTO 
`" . $table_name . "` ( `name`, `sl_height`, `sl_width`, `pause_on_hover`, `gallery_list_effects_s`, `description`, `param`, `sl_position`, `ordering`, `published`, `photo_gallery_wp_sl_effects`) VALUES
( 'New gallery', '375', '600', 'on', 'cubeH', '4000', '1000', 'center', '1', '300', '4')";
                $wpdb->query($sql_2);
                $query = "SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_gallerys order by id ASC";
                $rowsldcc = $wpdb->get_results($query);
                $last_key = key(array_slice($rowsldcc, -1, 1, true));


                foreach ($rowsldcc as $key => $rowsldccs) {
                    if ($last_key == $key) {
                        header('Location: admin.php?page=photo_gallery_wp_gallery&id=' . $rowsldccs->id . '&task=apply');
                    }
                }
            }
        }
    }

    public function wp_loaded_video()
    {
        if (isset($_REQUEST['photo_gallery_wp_nonce_add_video'])) {
            $photo_gallery_wp_nonce_add_video = $_REQUEST['photo_gallery_wp_nonce_add_video'];
            if (!wp_verify_nonce($photo_gallery_wp_nonce_add_video, 'photo_gallery_wp_nonce_add_video')) {
                wp_die('Security check fail');
            }
        }
        if (isset($_GET['page']) && $_GET['page'] == 'photo_gallery_wp_gallery') {
            if (photo_gallery_wp_get_gallery_task() && photo_gallery_wp_get_gallery_id()) {
                if (photo_gallery_wp_get_gallery_task() == 'photo_gallery_wp_video' && $_GET['closepop'] == 1) {
                    $id = photo_gallery_wp_get_gallery_id();
                    global $wpdb;
                    if (isset($_POST["photo_gallery_wp_add_video_input"])) {
                        if ($_POST["photo_gallery_wp_add_video_input"] != '') {
                            $table_name = $wpdb->prefix . "photo_gallery_wp_images";
                            $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_gallerys WHERE id= %d", $id);
                            $row = $wpdb->get_row($query);
                            $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_images where gallery_id = %d ", $row->id);
                            $rowplusorder = $wpdb->get_results($query);
                            foreach ($rowplusorder as $key => $rowplusorders) {
                                if ($rowplusorders->ordering == 0) {
                                    $rowplusorderspl = 1;
                                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET ordering = '" . $rowplusorderspl . "' WHERE id = %s ", $rowplusorders->id));
                                } else {
                                    $rowplusorderspl = $rowplusorders->ordering + 1;
                                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET ordering = '" . $rowplusorderspl . "' WHERE id = %s ", $rowplusorders->id));
                                }
                            }
                            $sql_video = "INSERT INTO 
`" . $table_name . "` ( `name`, `gallery_id`, `description`, `image_url`, `sl_url`, `sl_type`, `link_target`, `ordering`, `published`, `published_in_sl_width`) VALUES 
( '" . sanitize_text_field($_POST["show_title"]) . "', '" . $id . "', '" . sanitize_text_field($_POST["show_description"]) . "', '" . sanitize_text_field($_POST["photo_gallery_wp_add_video_input"]) . "', '" . sanitize_text_field($_POST["show_url"]) . "', 'video', 'on', '0', '1', '1' )";
                            $wpdb->query($sql_video);
                        }
                    }
                    header('Location: admin.php?page=photo_gallery_wp_gallery&id=' . $id . '&task=apply');
                }
            }
        }
    }

    /**
     * Duplicate Video
     */
    public function wp_loaded_duplicate_gallery()
    {
        if (isset($_GET["id"])) {
            $id = absint($_GET["id"]);
        }
        if (isset($_REQUEST['photo_gallery_wp_duplicate_nonce'])) {
            $gallery_edit_nonce = $_REQUEST['photo_gallery_wp_duplicate_nonce'];
            if (!wp_verify_nonce($gallery_edit_nonce, 'photo_gallery_wp_nonce_duplicate_gallery' . $id)) {
                wp_die('Security check fail');
            }
        }
        if (isset($_GET['page']) && $_GET['page'] == 'photo_gallery_wp_gallery') {
            if (photo_gallery_wp_get_gallery_task()) {
                if (photo_gallery_wp_get_gallery_task() == 'duplicate_photo_gallery_wp_image') {
                    global $wpdb;
                    $table_name = $wpdb->prefix . "photo_gallery_wp_gallerys";
                    $query = $wpdb->prepare("SELECT * FROM " . $table_name . " WHERE id=%d", $id);
                    $gallery_img = $wpdb->get_results($query);
                    $wpdb->insert(
                        $table_name,
                        array(
                            'name' => $gallery_img[0]->name . ' Copy',
                            'sl_height' => $gallery_img[0]->sl_height,
                            'sl_width' => $gallery_img[0]->sl_width,
                            'pause_on_hover' => $gallery_img[0]->pause_on_hover,
                            'gallery_list_effects_s' => $gallery_img[0]->gallery_list_effects_s,
                            'description' => $gallery_img[0]->description,
                            'param' => $gallery_img[0]->param,
                            'sl_position' => $gallery_img[0]->sl_position,
                            'ordering' => $gallery_img[0]->ordering,
                            'published' => $gallery_img[0]->published,
                            'photo_gallery_wp_sl_effects' => $gallery_img[0]->photo_gallery_wp_sl_effects,
                            'display_type' => $gallery_img[0]->display_type,
                            'content_per_page' => $gallery_img[0]->content_per_page,
                            'rating' => $gallery_img[0]->rating,
                            'autoslide' => $gallery_img[0]->autoslide
                        )
                    );
                    $last_key = $wpdb->insert_id;
                    $table_name = $wpdb->prefix . "photo_gallery_wp_images";
                    $query = $wpdb->prepare("SELECT * FROM " . $table_name . " WHERE gallery_id=%d", $id);
                    $galleries = $wpdb->get_results($query);
                    $galleries_list = "";
                    foreach ($galleries as $key => $gallery) {
                        $new_gallery = "('";
                        $new_gallery .= $gallery->name . "','" . $last_key . "','" . $gallery->description . "','" . $gallery->image_url . "','" .
                            $gallery->sl_url . "','" . $gallery->sl_type . "','" . $gallery->link_target . "','" . $gallery->ordering . "','" .
                            $gallery->published . "','" . $gallery->published_in_sl_width . "','" . $gallery->like . "','" .
                            $gallery->dislike . "')";
                        $galleries_list .= $new_gallery . ",";
                    }
                    $galleries_list = substr($galleries_list, 0, strlen($galleries_list) - 1);
                    $query = "INSERT into " . $table_name . " (`name`,`gallery_id`,`description`,`image_url`,`sl_url`,`sl_type`,`link_target`,`ordering`,`published`,`published_in_sl_width`,`like`,`dislike`)
					VALUES " . $galleries_list;
                    $wpdb->query($query);
                    wp_redirect('admin.php?page=photo_gallery_wp_gallery');
                }
            }
        }
    }

    /**
     * Removes Gallery
     */
    public function wp_loaded_remove_photo_gallery_wp()
    {
        if (isset($_GET["task"]) && $_GET["task"] == 'remove_photo_gallery_wp') {
            $id = absint($_GET["id"]);
            if (isset($_REQUEST['photo_gallery_wp_nonce_remove_gallery'])) {
                $photo_gallery_wp_nonce_remove_gallery = $_REQUEST['photo_gallery_wp_nonce_remove_gallery'];
                if (!wp_verify_nonce($photo_gallery_wp_nonce_remove_gallery, 'photo_gallery_wp_nonce_remove_gallery' . $id)) {
                    wp_die('Security check fail');
                }
            }
            global $wpdb;
            $sql_remov_tag = $wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_gallerys WHERE id = %d", $id);
            $sql_remove_image = $wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE gallery_id = %d", $id);
            if (!$wpdb->query($sql_remov_tag)) {
                setcookie('gallery_deleted', 'fail', time() + 2);
            } else {
                $wpdb->query($sql_remov_tag);
                $wpdb->query($sql_remove_image);
                setcookie('gallery_deleted', 'success', time() + 2);
            }
            wp_redirect('admin.php?page=photo_gallery_wp_gallery');
        }
    }

    public function licensing_page(){
        require Photo_Gallery_WP()->plugin_path().'/templates/admin/licensing.php';
    }

    public function free_banner(){
        require Photo_Gallery_WP()->plugin_path().'/templates/admin/free-banner.php';
    }
}

