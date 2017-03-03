<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Photo_Gallery_WP_Galleries
{

    /**
     * Load Gallerys admin page
     */
    public function load_gallery_page()
    {
        global $wpdb;
        if (isset($_GET['page']) && $_GET['page'] == 'photo_gallery_wp_gallery') {
            $task = photo_gallery_wp_get_gallery_task();
            $id = photo_gallery_wp_get_gallery_id();
        }
        do_action('photo_gallery_wp_before_galleries');
        switch ($task) {
            case 'edit_cat':
                if (isset($_REQUEST['huge_it_gallery_nonce'])) {
                    $wp_nonce = $_REQUEST['huge_it_gallery_nonce'];
                    if (!wp_verify_nonce($wp_nonce, 'huge_it_gallery_nonce')) {
                        wp_die('Security check fail');
                    }
                }
                if ($id) {
                    $this->edit_gallery($id);
                } else {
                    $id = $wpdb->get_var("SELECT MAX( id ) FROM " . $wpdb->prefix . "photo_gallery_wp_gallerys");
                    $this->edit_gallery($id);
                }
                break;
            case 'save':
                if ($id) {
                    $this->save_gallery_data($id);
                }
                break;
            case 'apply':
                if (isset($_REQUEST['huge_it_gallery_nonce_save_galery'])) {
                    $huge_it_gallery_nonce_save_galery = $_REQUEST['huge_it_gallery_nonce_save_galery'];
                    if (!wp_verify_nonce($huge_it_gallery_nonce_save_galery, 'huge_it_gallery_nonce_save_galery')) {
                        wp_die('Security check fail');
                    }
                }
                if ($id) {
                    $this->save_gallery_data($id);
                    $this->edit_gallery($id);
                }
                break;
            default:
                $this->show_galleries_page();
                break;
        }
    }

    /**
     * Shows Gallery Main Page
     */
    public function show_galleries_page()
    {
        if (isset($_COOKIE['gallery_deleted'])) {
            if ($_COOKIE['gallery_deleted'] == 'success') {
                ?>
                <div class="updated"><p><strong><?php _e('Item Deleted.'); ?></strong></p></div>
                <?php
            } elseif ($_COOKIE["gallery_deleted"] == 'fail') {
                ?>
                <div id="message" class="error"><p>Gallery Not Deleted</p></div>
            <?php }
        }

        $offset = 0;
        $limit = 10;
        $where = "";
        $params = array();
        if(isset($_GET['search_keyword']) && $_GET['search_keyword'] != "") {
            $where = "WHERE galleries.name LIKE %s";
            array_unshift($params, "%".trim($_GET['search_keyword'])."%");
            $pagination = $this->add_gallery_pagination(trim($_GET['search_keyword']), $limit);
        } else {
            $pagination = $this->add_gallery_pagination(null, $limit);
        }
        if(!isset($_GET['paged'])) {
            $offset = 0;
        } else {
            if ((int)$_GET['paged'] == 0) wp_die('Pagination Error');
            if ($pagination['pagination_links_count'] >= (int)$_GET['paged']) {
                $offset = (int)$_GET['paged'] * $limit - $limit;
                $pagination['current'] = (int)$_GET['paged'];
            }
        }
        array_push($params, $limit, $offset);

        global $wpdb;
        $query = "SELECT galleries.*, COUNT(images.id) as images_count FROM ".$wpdb->prefix."photo_gallery_wp_gallerys AS galleries LEFT JOIN ".$wpdb->prefix."photo_gallery_wp_images AS images ON galleries.id = images.gallery_id ".$where." GROUP BY galleries.id LIMIT %d OFFSET %d";
        $galleries = $wpdb->get_results($wpdb->prepare($query, $params));
        require_once(PHOTO_GALLERY_WP_TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'photo-gallery-wp-admin-galleries-list.php');

    }

    /**
     * Prints Gallery images after edit data
     *
     * @param $id
     *
     * @return string
     */
    public function edit_gallery($id)
    {
        if (isset($_GET["removeslide"])) {
            $idfordelete = esc_html($_GET["removeslide"]);
        }
        if (isset($_REQUEST['gallery_nonce_remove_image'])) {
            $gallery_nonce_remove_image = $_REQUEST['gallery_nonce_remove_image'];
            if (!wp_verify_nonce($gallery_nonce_remove_image, 'gallery_nonce_remove_image' . $idfordelete)) {
                wp_die('Security check fail');
            }
        }
        global $wpdb;
        if (isset($_POST["photo_gallery_wp_sl_effects"])) {
            if (isset($_GET["removeslide"])) {
                if ($_GET["removeslide"] != '') {
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_images  WHERE id = %d ", $idfordelete));
                }
            }
        }
        $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_gallerys WHERE id= %d", $id);
        $row = $wpdb->get_row($query);
        if (!isset($row->gallery_list_effects_s)) {
            return 'id not found';
        }
        $images = explode(";;;", $row->gallery_list_effects_s);
        $par = explode('	', $row->param);
        $count_ord = count($images);
        $query = $wpdb->prepare("SELECT name,ordering FROM " . $wpdb->prefix . "photo_gallery_wp_gallerys WHERE sl_width=%d  ORDER BY `ordering` ", $row->sl_width);
        $ord_elem = $wpdb->get_results($query);
        $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_images where gallery_id = %d order by ordering ASC  ", $row->id);
        $rowim = $wpdb->get_results($query);
        if (isset($_GET["addslide"])) {
            if ($_GET["addslide"] == 1) {
                $table_name = $wpdb->prefix . "photo_gallery_wp_images";
                $sql_2 = "
INSERT INTO 
`" . $table_name . "` ( `name`, `gallery_id`, `description`, `image_url`, `sl_url`, `ordering`, `published`, `published_in_sl_width`) VALUES
( '', '" . $row->id . "', '', '', '', 'par_TV', 2, '1' )";
                $wpdb->query($sql_2);
            }
        }
        $query = "SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_gallerys order by id ASC";
        $rowsld = $wpdb->get_results($query);
        $paramssld = photo_gallery_wp_get_general_options();

        $query = "SELECT * FROM " . $wpdb->prefix . "posts where post_type = 'post' and post_status = 'publish' order by id ASC";
        $rowsposts = $wpdb->get_results($query);
        $rowsposts8 = '';
        $postsbycat = '';
        if (isset($_POST["iframecatid"])) {
            $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "term_relationships where term_taxonomy_id = %d order by object_id ASC", sanitize_text_field($_POST["iframecatid"]));
            $rowsposts8 = $wpdb->get_results($query);
            foreach ($rowsposts8 as $rowsposts13) {
                $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "posts where post_type = 'post' and post_status = 'publish' and ID = %d  order by ID ASC", $rowsposts13->object_id);
                $rowsposts1 = $wpdb->get_results($query);
                $postsbycat = $rowsposts1;
            }
        }
        require_once(PHOTO_GALLERY_WP_TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'photo-gallery-wp-admin-gallery-images-list-html.php');
    }

    /**
     * Edit Gallery images and data
     *
     * @param $id
     *
     * @return bool
     */
    function save_gallery_data($id)
    {
        global $wpdb;
        if (!is_numeric($id)) {
            echo 'insert numeric id';

            return false;
        }
        if (!(isset($_POST['sl_width']) && isset($_POST["name"]))) {
            echo '';
        }
        if (isset($_POST['photo_gallery_wp_admin_image_hover_preview'])) {
            $img_hover_preview = sanitize_text_field($_POST['photo_gallery_wp_admin_image_hover_preview']);
            update_option('photo_gallery_wp_admin_image_hover_preview', $img_hover_preview);
        }
        // Created By Karen S.
        if (isset($_POST["name"])) {
            if ($_POST["name"] != '') {
                $data = array(
                    "name" => sanitize_text_field($_POST["name"]),
                    "sl_width" => sanitize_text_field($_POST["sl_width"]),
                    "sl_height" => sanitize_text_field($_POST["sl_height"]),
                    "pause_on_hover" => sanitize_text_field($_POST["pause_on_hover"]),
                    "gallery_list_effects_s" => sanitize_text_field($_POST["gallery_list_effects_s"]),
                    "description" => sanitize_text_field($_POST["sl_pausetime"]),
                    "param" => sanitize_text_field($_POST["sl_changespeed"]),
                    "sl_position" => sanitize_text_field($_POST["sl_position"]),
                    "photo_gallery_wp_sl_effects" => sanitize_text_field($_POST["photo_gallery_wp_sl_effects"]),
                    "ordering" => '1',
                    "rating" => sanitize_text_field($_POST["rating"]),
                    "autoslide" => sanitize_text_field($_POST["autoslide"])
                );
                $format = array("%s","%s","%s","%s","%s","%s","%s","%s","%s",'%s',"%s",'%s');
                $where = array('id' => $id);
                $where_format = array('%d');
                if (isset($_POST["display_type"]) && isset($_POST["content_per_page"])) {
                    $data['content_per_page'] = sanitize_text_field($_POST["content_per_page"]);
                    $data['display_type'] = sanitize_text_field($_POST["display_type"]);
                    array_push($format, '%s', '%s');
                }
                $data['gallery_loader_type'] = 0;
                array_push($format, '%s');
                if (isset($_POST['show-hide-loading']) && $_POST['show-hide-loading'] == 1) {
                    if(isset($_POST['gallery_loader_type']) && in_array($_POST['gallery_loader_type'],array(1,2,3,4))) {
                        $data['gallery_loader_type'] = $_POST["gallery_loader_type"];
                    }
                }

                $wpdb->update($wpdb->prefix . "photo_gallery_wp_gallerys",$data,$where,$format,$where_format );
            }
        }
        // End Created By Karen S.
        $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_gallerys WHERE id = %d", $id);
        $row = $wpdb->get_row($query);

        if (isset($_POST['changedvalues']) && $_POST['changedvalues'] != '') {

            $changedValues = preg_replace('#[^0-9,]+#', '', $_POST['changedvalues']);
            $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_images where gallery_id = %d  AND id in (" . $changedValues . ")  order by id ASC", $row->id);
            $rowim = $wpdb->get_results($query);
            foreach ($rowim as $key => $rowimages) {
                $orderBy = sanitize_text_field($_POST["order_by_" . $rowimages->id]);
                $linkTaret = sanitize_text_field($_POST["sl_link_target" . $rowimages->id]);
                $slUrl = sanitize_text_field(str_replace('%', '__5_5_5__', $_POST["sl_url" . $rowimages->id]));
                $name = wp_unslash(str_replace('%', '__5_5_5__', $_POST["titleimage" . $rowimages->id]));
                $desc = wp_unslash(str_replace('%', '__5_5_5__', $_POST["im_description" . $rowimages->id]));
                $imageUrl = sanitize_text_field($_POST["imagess" . $rowimages->id]);
                $like = sanitize_text_field($_POST["like_" . $rowimages->id]);
                $dislike = sanitize_text_field($_POST["dislike_" . $rowimages->id]);

                if (isset($_POST["order_by_" . $rowimages->id . ""]) && isset($_POST["like_" . $rowimages->id . ""])) {
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  ordering = '%s'  WHERE ID = %d ", $orderBy, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  link_target = '%s'  WHERE ID = %d ", $linkTaret, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  sl_url = '%s' WHERE ID = %d ", $slUrl, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  name = '%s'  WHERE ID = %d ", $name, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  description = '%s'  WHERE ID = %d ", $desc, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  image_url = '%s'  WHERE ID = %d ", $imageUrl, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  `like` = %d  WHERE ID = %d ", $like, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  dislike = %d  WHERE ID = %d ", $dislike, $rowimages->id));
                }
                if (isset($_POST["order_by_" . $rowimages->id . ""]) && isset($_POST["heart_" . $rowimages->id . ""])) {
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  ordering = '%s'  WHERE ID = %d ", $orderBy, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  link_target = '%s'  WHERE ID = %d ", $linkTaret, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  sl_url = '%s' WHERE ID = %d ", $slUrl, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  name = '%s'  WHERE ID = %d ", $name, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  description = '%s'  WHERE ID = %d ", $desc, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  image_url = '%s'  WHERE ID = %d ", $imageUrl, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  `like` = %d  WHERE ID = %d ", $like, $rowimages->id));
                }
            }
        }
        if (isset($_POST["imagess"])) {
            if ($_POST["imagess"] != '') {
                $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_images where gallery_id = %d order by id ASC", $row->id);
                $rowim = $wpdb->get_results($query);
                foreach ($rowim as $key => $rowimages) {
                    $orderingplus = $rowimages->ordering + 1;
                    $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  ordering = %d  WHERE ID = %d ", $orderingplus, $rowimages->id));
                }
                $table_name = $wpdb->prefix . "photo_gallery_wp_images";
                $imagesnewuploader = explode(";;;", $_POST["imagess"]);
                array_pop($imagesnewuploader);
                foreach ($imagesnewuploader as $imagesnewupload) {
                    $sql_2 = " INSERT INTO `" . $table_name . "` ( `name`, `gallery_id`, `description`, `image_url`, `sl_url`, `sl_type`, `link_target`, `ordering`, 
                    `published`, `published_in_sl_width`) VALUES ( '', '" . $row->id . "', '', '" . $imagesnewupload . "', '', 'image', 'on', 'par_TV', 2, '1' )";
                    $wpdb->query($sql_2);
                }
            }
        }
        if (isset($_POST["posthuge-it-description-length"])) {
            $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_gallerys SET  published = %d WHERE id = %d ", $_POST["posthuge-it-description-length"], $_GET['id']));
        }
        ?>
        <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
        <?php
        return true;

    }


    /**
     * Get Galleries with keyword
     */
    protected function search_gallery($keyword)
    {
        $galleries = array();
        return $galleries;
    }


    /**
     * @param $condition string default null
     * @return int
    */
    protected function add_gallery_pagination($condition = null, $limit) {
        $pagination = array(
            'total' => 0,
            'enable' => false,
            'current' => 1,
            'pagination_links_count' => 0,
            'links' => 'admin.php?page=photo_gallery_wp_gallery'
        );
        $parts = parse_url($_SERVER['REQUEST_URI']);
        global $wpdb;
        if ($condition) {
            $query = $wpdb->prepare("SELECT COUNT(`id`) FROM `".$wpdb->prefix."photo_gallery_wp_gallerys` WHERE `name` LIKE %s", '%'.$condition.'%');
            $pagination['links'] .= "&search_keyword=".$condition;
        } else {
            $query = "SELECT COUNT(id) FROM ".$wpdb->prefix."photo_gallery_wp_gallerys";
        }
        $pagination['total'] = $wpdb->get_var($query);
        if ($pagination['total'] > $limit) {
            $pagination['enable'] = true;
            $pagination['pagination_links_count'] = ceil($pagination['total'] / $limit);
        }
        return $pagination;
    }
}


