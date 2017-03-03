<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Photo_Gallery_WP_Ajax
{

    public function __construct()
    {
        add_action('wp_ajax_photo_gallery_wp_load_images_content', array($this, 'load_images_content'));
        add_action('wp_ajax_photo_gallery_wp_load_images_lightbox', array($this, 'load_images_lightbox'));
        add_action('wp_ajax_photo_gallery_wp_load_images_justified', array($this, 'load_images_justified'));
        add_action('wp_ajax_photo_gallery_wp_load_images_thumbnail', array($this, 'load_images_thumbnail'));
        add_action('wp_ajax_photo_gallery_wp_load_images_masonry', array($this, 'load_images_masonry'));
        add_action('wp_ajax_photo_gallery_wp_load_blog_view', array($this, 'load_blog_view'));
        add_action('wp_ajax_photo_gallery_wp_like_dislike', array($this, 'like_dislike'));
        add_action('wp_ajax_nopriv_photo_gallery_wp_load_images_content', array($this, 'load_images_content'));
        add_action('wp_ajax_nopriv_photo_gallery_wp_load_images_lightbox', array($this, 'load_images_lightbox'));
        add_action('wp_ajax_nopriv_photo_gallery_wp_load_images_justified', array($this, 'load_images_justified'));
        add_action('wp_ajax_nopriv_photo_gallery_wp_load_images_thumbnail', array($this, 'load_images_thumbnail'));
        add_action('wp_ajax_nopriv_photo_gallery_wp_load_images_masonry', array($this, 'load_images_masonry'));
        add_action('wp_ajax_nopriv_photo_gallery_wp_load_blog_view', array($this, 'load_blog_view'));
        add_action('wp_ajax_nopriv_photo_gallery_wp_like_dislike', array($this, 'like_dislike'));
    }

    /**
     * Load Content For Lazy Loading
    */
    public function load_images_content() {
        if (isset($_POST['task']) && $_POST['task'] == "load_images_content") {
            if (isset($_POST['photoGalleryWpContentLoadNonce'])) {
                $photoGalleryWpContentLoadNonce = esc_html($_POST['photoGalleryWpContentLoadNonce']);
                if (!wp_verify_nonce($photoGalleryWpContentLoadNonce, 'photo_gallery_wp_content_load_nonce')) {
                    wp_die('Security check fail');
                }
            }
            global $wpdb;
            global $huge_it_ip;
            $page = 1;
            if (!empty($_POST["page"]) && is_numeric($_POST['page']) && $_POST['page'] > 0) {
                $page = intval($_POST["page"]);
                $num = intval($_POST['perpage']);
                $start = $page * $num - $num;
                $idofgallery = intval($_POST['galleryid']);
                $pID = intval($_POST['pID']);
                $likeStyle = esc_html($_POST['likeStyle']);
                $ratingCount = esc_html($_POST['ratingCount']);
                $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_images where gallery_id = '%d' order by ordering ASC LIMIT %d,%d", $idofgallery, $start, $num);
                $page_images = $wpdb->get_results($query);
                $output = '';
                foreach ($page_images as $key => $row) {
                    if (!isset($_COOKIE['Like_' . $row->id . ''])) {
                        $_COOKIE['Like_' . $row->id . ''] = '';
                    }
                    if (!isset($_COOKIE['Dislike_' . $row->id . ''])) {
                        $_COOKIE['Dislike_' . $row->id . ''] = '';
                    }
                    $num2 = $wpdb->prepare("SELECT `image_status`,`ip` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip` = '" . $huge_it_ip . "'", (int)$row->id);
                    $res3 = $wpdb->get_row($num2);
                    $num3 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE['Like_' . $row->id . ''] . "'", (int)$row->id);
                    $res4 = $wpdb->get_row($num3);
                    $num4 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE['Dislike_' . $row->id . ''] . "'", (int)$row->id);
                    $res5 = $wpdb->get_row($num4);
                    $link = $row->sl_url;
                    $video_name =
                        str_replace('__5_5_5__', '%', $row->name);
                    $id = $row->id;
                    $descnohtml = strip_tags(
                        str_replace('__5_5_5__', '%', $row->description));
                    $result = substr($descnohtml, 0, 50);
                    if($video_name == '' && (empty($row->sl_url) || $row->sl_url == '') )
                        $no_title = 'no-title';
                    else
                        $no_title = '';
                    ?>
                    <?php
                    $imagerowstype = $row->sl_type;
                    if ($row->sl_type == '') {
                        $imagerowstype = 'image';
                    }
                    switch ($imagerowstype) {
                        case 'image':
                            ?>
                            <?php
                            if (get_option('image_natural_size_contentpopup') == 'natural') {
                                $imgurl = $row->image_url;
                            } else {
                                $imgurl = esc_url(photo_gallery_wp_get_image_by_sizes_and_src($row->image_url, array(
                                    get_option('ht_view2_element_width'),
                                    get_option('ht_view2_element_height')
                                ), false));
                            } ?>
                            <?php if ($row->image_url != ';') {
                            $video = '<img id="wd-cl-img' . $key . '" src="' . $imgurl . '" alt="" />';
                        } else {
                            $video = '<img id="wd-cl-img' . $key . '" src="images/noimage.jpg" alt="" />';
                        } ?>
                            <?php
                            break;
                        case 'video':
                            ?>
                            <?php
                            $videourl = photo_gallery_wp_get_video_id_from_url($row->image_url);
                            if ($videourl[1] == 'youtube') {
                                if (empty($row->thumb_url)) {
                                    $thumb_pic = 'http://img.youtube.com/vi/' . $videourl[0] . '/mqdefault.jpg';
                                } else {
                                    $thumb_pic = $row->thumb_url;
                                }
                                $video = '<img src="' . $thumb_pic . '" alt="" />';
                            } else {
                                $hash = unserialize(wp_remote_fopen("http://vimeo.com/api/v2/video/" . $videourl[0] . ".php"));
                                if (empty($row->thumb_url)) {
                                    $imgsrc = $hash[0]['thumbnail_large'];
                                } else {
                                    $imgsrc = $row->thumb_url;
                                }
                                $video = '<img src="' . $imgsrc . '" alt="" />';
                            }
                            ?>
                            <?php
                            break;
                    }
                    ?>
                    <?php if ($link == '' || empty($link)) {
                        $button = '';
                    } else {
                        if ($row->link_target == "on") {
                            $target = 'target="_blank"';
                        } else {
                            $target = '';
                        }
                        $button = '<div class="button-block"><a href="' . $link . '" ' . $target . ' >' . $_POST['linkbutton'] . '</a></div>';
                    }
                    ?>
                    <?php
                    $thumb_status_like = '';
                    if (isset($res3->image_status) && $res3->image_status == 'liked') {
                        $thumb_status_like = $res3->image_status;
                    } elseif (isset($res4->image_status) && $res4->image_status == 'liked') {
                        $thumb_status_like = $res4->image_status;
                    } else {
                        $thumb_status_like = 'unliked';
                    }
                    $thumb_status_dislike = '';
                    if (isset($res3->image_status) && $res3->image_status == 'disliked') {
                        $thumb_status_dislike = $res3->image_status;
                    } elseif (isset($res5->image_status) && $res5->image_status == 'disliked') {
                        $thumb_status_dislike = $res5->image_status;
                    } else {
                        $thumb_status_dislike = 'unliked';
                    }
                    $likeIcon = '';
                    if ($likeStyle == 'heart') {
                        $likeIcon = '<i class="hugeiticons-heart likeheart"></i>';
                    } elseif ($likeStyle == 'dislike') {
                        $likeIcon = '<i class="hugeiticons-thumbs-up like_thumb_up"></i>';
                    }
                    $likeCount = '';
                    if ($likeStyle != 'heart') {
                        $likeCount = $row->like;
                    }
                    $thumb_text_like = '';
                    if ($likeStyle == 'heart') {
                        $thumb_text_like = $row->like;
                    }
                    $displayCount = '';
                    if ($ratingCount == 'off') {
                        $displayCount = 'huge_it_hide';
                    }
                    if ($likeStyle != 'heart') {
                        $dislikeHtml = '<div class="huge_it_gallery_dislike_wrapper">
                                <span class="huge_it_dislike">
                                    <i class="hugeiticons-thumbs-down dislike_thumb_down"></i>
                                    <span class="huge_it_dislike_thumb" id="' . $row->id . '" data-status="' . $thumb_status_dislike . '"></span>
                                    <span class="huge_it_dislike_count ' . $displayCount . '" id="' . $row->id . '">' . $row->dislike . '</span>
                                </span>
                            </div>';
                    }
/////////////////////////////
                    if ($likeStyle != 'off') {
                        $likeCont = '<div class="ph-g-wp_gallery_like_cont_' . $idofgallery . $pID . '">
                                <div class="ph-g-wp_gallery_like_wrapper">
                                    <span class="huge_it_like">' . $likeIcon . '
                                        <span class="huge_it_like_thumb" id="' . $row->id . '" data-status="' . $thumb_status_like . '">' . $thumb_text_like . '</span>
                                        <span class="ph-g-wp_like_count ' . $displayCount . '" id="' . $row->id . '">' . $likeCount . '</span>
                                    </span>
                                </div>' . $dislikeHtml . '
                           </div>';
                    }
///////////////////////////////
                    $output .= '<div class="ph_element '.$no_title.' ph_element_' . $idofgallery . ' " tabindex="0" data-symbol="' . $video_name . '"  data-category="alkaline-earth">';
                    $output .= '<input type="hidden" class="pagenum" value="' . $page . '" />';
                    $output .= '<div class="image-block image-block_' . $idofgallery . '">';
                    $output .= $video;
                    $output .= '<div class="ph-g-wp-gallery-image-overlay"><a href="#' . $id . '" title="' . $video_name . '"></a>' . $likeCont . '
                         </div>';
                    $output .= '</div>';
                    $output .= '<div class="title-block_' . $idofgallery . '" title="' . $video_name . '">';
                    $output .= '<h3>' . $video_name . '</h3>';
                    $output .= $button;
                    $output .= '</div>';
                    $output .= '</div>';
                }
                echo json_encode(array("success" => $output));
                die();
            }
        }
    }

    /**
     * Load Content in Light box
     */
    public function load_images_lightbox()
    {
        if (isset($_POST['task']) && $_POST['task'] == "load_images_lightbox") {
            if (isset($_POST['galleryImgLightboxLoadNonce'])) {
                $galleryImgLightboxLoadNonce = esc_html($_POST['galleryImgLightboxLoadNonce']);
                if (!wp_verify_nonce($galleryImgLightboxLoadNonce, 'gallery_img_lightbox_load_nonce')) {
                    wp_die('Security check fail');
                }
            }
            global $wpdb;
            global $huge_it_ip;
            $page = 1;
            if (!empty($_POST["page"]) && is_numeric($_POST['page']) && $_POST['page'] > 0) {
                $page = intval($_POST["page"]);
                $num = intval($_POST["perpage"]);
                $start = $page * $num - $num;
                $idofgallery = intval($_POST["galleryid"]);
                $pID = intval($_POST["pID"]);
                $likeStyle = esc_html($_POST['likeStyle']);
                $ratingCount = esc_html($_POST['ratingCount']);
                $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_images where gallery_id = '%d' order by ordering ASC LIMIT %d,%d", $idofgallery, $start, $num);
                $page_images = $wpdb->get_results($query);
                $output = '';
                foreach ($page_images as $key => $row) {
                    if (!isset($_COOKIE['Like_' . $row->id . ''])) {
                        $_COOKIE['Like_' . $row->id . ''] = '';
                    }
                    if (!isset($_COOKIE['Dislike_' . $row->id . ''])) {
                        $_COOKIE['Dislike_' . $row->id . ''] = '';
                    }
                    $num2 = $wpdb->prepare("SELECT `image_status`,`ip` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip` = '" . $huge_it_ip . "'", (int)$row->id);
                    $res3 = $wpdb->get_row($num2);
                    $num3 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE['Like_' . $row->id . ''] . "'", (int)$row->id);
                    $res4 = $wpdb->get_row($num3);
                    $num4 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE['Dislike_' . $row->id . ''] . "'", (int)$row->id);
                    $res5 = $wpdb->get_row($num4);
                    $link = $row->sl_url;
                    $video_name =
                        str_replace('__5_5_5__', '%', $row->name);
                    $descnohtml = strip_tags(str_replace('__5_5_5__', '%', $row->description));
                    $result = substr($descnohtml, 0, 50);
                    ?>
                    <?php
                    $imagerowstype = $row->sl_type;
                    if ($row->sl_type == '') {
                        $imagerowstype = 'image';
                    }
                    switch ($imagerowstype) {
                        case 'image':
                            ?>
                            <?php $imgurl = explode(";", $row->image_url); ?>
                            <?php
                            if ($row->image_url != ';') {
                                $video = '<a  class="ph-lightbox" href="' . $imgurl[0] . '" title="' . $video_name . '"><img id="wd-cl-img' . $key . '" src="' . esc_url(photo_gallery_wp_get_image_by_sizes_and_src(
                                        $imgurl[0], array(
                                        get_option('ht_view6_width'),
                                        ''
                                    ), false
                                    )) . '" alt="' . $video_name . '" /></a>';
                            } else {
                                $video = '<img id="wd-cl-img' . $key . '" src="images/noimage.jpg" alt="" />';
                            } ?>
                            <?php
                            break;
                        case 'video':
                            ?>
                            <?php
                            $videourl = photo_gallery_wp_get_video_id_from_url($row->image_url);
                            if ($videourl[1] == 'youtube') {
                                if (empty($row->thumb_url)) {
                                    $thumb_pic = 'http://img.youtube.com/vi/' . $videourl[0] . '/mqdefault.jpg';
                                } else {
                                    $thumb_pic = $row->thumb_url;
                                }
                                $video = '<a  class="ph-lightbox" class="giyoutube huge_it_videogallery_item gallery_group'.$idofgallery.'"  href="https://www.youtube.com/embed/' . $videourl[0] . '" title="' . $video_name . '">
                                            <img src="' . $thumb_pic . '" alt="' . $video_name . '" />
                                            <div class="play-icon ' . $videourl[1] . '-icon"></div>
                                        </a>';
                            } else {
                                $hash = unserialize(wp_remote_fopen("http://vimeo.com/api/v2/video/" . $videourl[0] . ".php"));
                                if (empty($row->thumb_url)) {
                                    $imgsrc = $hash[0]['thumbnail_large'];
                                } else {
                                    $imgsrc = $row->thumb_url;
                                }
                                $video = '<a  class="ph-lightbox" class="givimeo huge_it_videogallery_item gallery_group'.$idofgallery.'" href="http://player.vimeo.com/video/' . $videourl[0] . '" title="' . $video_name . '">
                                    <img src="' . $imgsrc . '" alt="" />
                                    <div class="play-icon ' . $videourl[1] . '-icon"></div>
                                </a>';
                            }
                            ?>
                            <?php
                            break;
                    }
                    ?>
                    <?php if (
                        str_replace('__5_5_5__', '%', $row->name) != ""
                    ) {
                        if ($row->link_target == "on") {
                            $target = 'target="_blank"';
                        } else {
                            $target = '';
                        }
                        $linkimg = '<div class="title-block_' . $idofgallery . '" title="' . $video_name . '">';
                        if($link != '' || !empty($link))
                            $linkimg .= '<a href="' . $link . '"' . $target . '>';
                        $linkimg .= $video_name;
                        if($link != '' || !empty($link))
                            $linkimg .= '</a>';
                        $linkimg .= '</div>';
                    } else {
                        $linkimg = '';
                    }
                    ?>
                    <?php
                    $thumb_status_like = '';
                    if (isset($res3->image_status) && $res3->image_status == 'liked') {
                        $thumb_status_like = $res3->image_status;
                    } elseif (isset($res4->image_status) && $res4->image_status == 'liked') {
                        $thumb_status_like = $res4->image_status;
                    } else {
                        $thumb_status_like = 'unliked';
                    }
                    $thumb_status_dislike = '';
                    if (isset($res3->image_status) && $res3->image_status == 'disliked') {
                        $thumb_status_dislike = $res3->image_status;
                    } elseif (isset($res5->image_status) && $res5->image_status == 'disliked') {
                        $thumb_status_dislike = $res5->image_status;
                    } else {
                        $thumb_status_dislike = 'unliked';
                    }
                    $likeIcon = '';
                    if ($likeStyle == 'heart') {
                        $likeIcon = '<i class="hugeiticons-heart likeheart"></i>';
                    } elseif ($likeStyle == 'dislike') {
                        $likeIcon = '<i class="hugeiticons-thumbs-up like_thumb_up"></i>';
                    }
                    $likeCount = '';
                    if ($likeStyle != 'heart') {
                        $likeCount = $row->like;
                    }
                    $thumb_text_like = '';
                    if ($likeStyle == 'heart') {
                        $thumb_text_like = $row->like;
                    }
                    $displayCount = '';
                    if ($ratingCount == 'off') {
                        $displayCount = 'huge_it_hide';
                    }
                    if ($likeStyle != 'heart') {
                        $dislikeHtml = '<div class="huge_it_gallery_dislike_wrapper">
                                <span class="huge_it_dislike">
                                    <i class="hugeiticons-thumbs-down dislike_thumb_down"></i>
                                    <span class="huge_it_dislike_thumb" id="' . $row->id . '" data-status="' . $thumb_status_dislike . '">
                                    </span>
                                    <span class="huge_it_dislike_count ' . $displayCount . '" id="' . $row->id . '">' . $row->dislike . '</span>
                                </span>
                            </div>';
                    }
/////////////////////////////
                    if ($likeStyle != 'off') {
                        $likeCont = '<div class="ph-g-wp_gallery_like_cont_' . $idofgallery . $pID . '">
                                <div class="ph-g-wp_gallery_like_wrapper">
                                    <span class="huge_it_like">' . $likeIcon . '
                                        <span class="huge_it_like_thumb" id="' . $row->id . '" data-status="' . $thumb_status_like . '">' . $thumb_text_like . '</span>
                                        <span class="ph-g-wp_like_count ' . $displayCount . '" id="' . $row->id . '">' . $likeCount . '</span>
                                    </span>
                                </div>' . $dislikeHtml . '
                           </div>';
                    }
///////////////////////////////
                    $output .= '<div class="ph_element ph_element_' . $idofgallery . '" tabindex="0" data-symbol="' . $video_name . '"  data-category="alkaline-earth">';
                    $output .= '<input type="hidden" class="pagenum" value="' . $page . '" />';
                    $output .= '<div class="image-block_' . $idofgallery . '">';
                    $output .= $video;
                    $output .= $linkimg;
                    $output .= $likeCont;
                    $output .= '</div>';
                    $output .= '</div>';
                }
                echo json_encode(array("success" => $output));
                die();
            }
        }
    }

    /**
     * Load Content Justified
     */
    public function load_images_justified()
    {
        if (isset($_POST['task']) && $_POST['task'] == "load_image_justified") {
            if (isset($_POST['galleryImgJustifiedLoadNonce'])) {
                $galleryImgJustifiedLoadNonce = esc_html($_POST['galleryImgJustifiedLoadNonce']);
                if (!wp_verify_nonce($galleryImgJustifiedLoadNonce, 'gallery_img_justified_load_nonce')) {
                    wp_die('Security check fail');
                }
            }
            global $wpdb;
            global $huge_it_ip;
            $page = 1;
            if (!empty($_POST["page"]) && is_numeric($_POST['page']) && $_POST['page'] > 0) {
                $page = intval($_POST["page"]);
                $num = intval($_POST["perpage"]);
                $start = $page * $num - $num;
                $idofgallery = intval($_POST["galleryid"]);
                $pID = intval($_POST["pID"]);
                $likeStyle = esc_html($_POST['likeStyle']);
                $ratingCount = esc_html($_POST['ratingCount']);
                $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_images where gallery_id = '%d' order by ordering ASC LIMIT %d,%d", $idofgallery, $start, $num);
                $output = '';
                $page_images = $wpdb->get_results($query);
                foreach ($page_images as $key => $row) {
                    if (!isset($_COOKIE['Like_' . $row->id . ''])) {
                        $_COOKIE['Like_' . $row->id . ''] = '';
                    }
                    if (!isset($_COOKIE['Dislike_' . $row->id . ''])) {
                        $_COOKIE['Dislike_' . $row->id . ''] = '';
                    }
                    $num2 = $wpdb->prepare("SELECT `image_status`,`ip` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip` = '" . $huge_it_ip . "'", (int)$row->id);
                    $res3 = $wpdb->get_row($num2);
                    $num3 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE['Like_' . $row->id . ''] . "'", (int)$row->id);
                    $res4 = $wpdb->get_row($num3);
                    $num4 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE['Dislike_' . $row->id . ''] . "'", (int)$row->id);
                    $res5 = $wpdb->get_row($num4);
                    $video_name = str_replace('__5_5_5__', '%', $row->name);
                    $videourl = photo_gallery_wp_get_video_id_from_url($row->image_url);
                    $imgurl = explode(";", $row->image_url);
                    $image_prefix = "_huge_it_small_gallery";
                    $imagerowstype = $row->sl_type;
                    $thumb_status_like = '';
                    if (isset($res3->image_status) && $res3->image_status == 'liked') {
                        $thumb_status_like = $res3->image_status;
                    } elseif (isset($res4->image_status) && $res4->image_status == 'liked') {
                        $thumb_status_like = $res4->image_status;
                    } else {
                        $thumb_status_like = 'unliked';
                    }
                    $thumb_status_dislike = '';
                    if (isset($res3->image_status) && $res3->image_status == 'disliked') {
                        $thumb_status_dislike = $res3->image_status;
                    } elseif (isset($res5->image_status) && $res5->image_status == 'disliked') {
                        $thumb_status_dislike = $res5->image_status;
                    } else {
                        $thumb_status_dislike = 'unliked';
                    }
                    $likeIcon = '';
                    if ($likeStyle == 'heart') {
                        $likeIcon = '<i class="hugeiticons-heart likeheart"></i>';
                    } elseif ($likeStyle == 'dislike') {
                        $likeIcon = '<i class="hugeiticons-thumbs-up like_thumb_up"></i>';
                    }
                    $likeCount = '';
                    if ($likeStyle != 'heart') {
                        $likeCount = $row->like;
                    }
                    $thumb_text_like = '';
                    if ($likeStyle == 'heart') {
                        $thumb_text_like = $row->like;
                    }
                    $displayCount = '';
                    if ($ratingCount == 'off') {
                        $displayCount = 'huge_it_hide';
                    }
                    if ($likeStyle != 'heart') {
                        $dislikeHtml = '<div class="huge_it_gallery_dislike_wrapper">
                                <span class="huge_it_dislike">
                                    <i class="hugeiticons-thumbs-down dislike_thumb_down"></i>
                                    <span class="huge_it_dislike_thumb" id="' . $row->id . '" data-status="' . $thumb_status_dislike . '">
                                    </span>
                                    <span class="huge_it_dislike_count ' . $displayCount . '" id="' . $row->id . '">' . $row->dislike . '</span>
                                </span>
                            </div>';
                    }
/////////////////////////////
                    if ($likeStyle != 'off') {
                        $likeCont = '<div class="ph-g-wp_gallery_like_cont_' . $idofgallery . $pID . '">
                                <div class="ph-g-wp_gallery_like_wrapper">
                                    <span class="huge_it_like">' . $likeIcon . '
                                        <span class="huge_it_like_thumb" id="' . $row->id . '" data-status="' . $thumb_status_like . '">' . $thumb_text_like . '
                                        </span>
                                        <span class="ph-g-wp_like_count ' . $displayCount . '" id="' . $row->id . '">' . $likeCount . '</span>
                                    </span>
                                </div>' . $dislikeHtml . '
                           </div>';
                    }
///////////////////////////////
                    if ($row->sl_type == '') {
                        $imagerowstype = 'image';
                    }
                    switch ($imagerowstype) {
                        case 'image':
                            if ($row->image_url != ';') {
                                $imgperfix = esc_url(photo_gallery_wp_get_image_by_sizes_and_src($imgurl[0], array('', get_option('ht_view8_element_height')), false));
                                $video = '<a class="ph-lightbox gallery_group' . $idofgallery . '" href="' . $imgurl[0] . '" title="' . $video_name . '">
                                            <img  id="wd-cl-img' . $key . '" alt="' . $video_name . '" src="' . $imgperfix . '"/>
                                            ' . $likeCont . '
                                        </a>
                                        <input type="hidden" class="pagenum" value="' . $page . '" />'; ?>
                            <?php } else {
                                $video = '<img alt="' . $video_name . '" id="wd-cl-img' . $key . '" src="images/noimage.jpg"  />
                                                ' . $likeCont . '
                                        <input type="hidden" class="pagenum" value="' . $page . '" />';
                            } ?>
                            <?php
                            break;
                        case 'video':
                            if ($videourl[1] == 'youtube') {
                                if (empty($row->thumb_url)) {
                                    $thumb_pic = 'http://img.youtube.com/vi/' . $videourl[0] . '/mqdefault.jpg';
                                } else {
                                    $thumb_pic = $row->thumb_url;
                                }
                                $video = '<a class="ph-lightbox giyoutube huge_it_videogallery_item gallery_group' . $idofgallery . '"  href="https://www.youtube.com/embed/' . $videourl[0] . '" title="' . $video_name . '">
                                                <img  src="' . $thumb_pic . '" alt="' . $video_name . '" />
                                                ' . $likeCont . '
                                                <div class="play-icon ' . $videourl[1] . '-icon"></div>
                                        </a>';
                            } else {
                                $hash = unserialize(wp_remote_fopen("http://vimeo.com/api/v2/video/" . $videourl[0] . ".php"));
                                if (empty($row->thumb_url)) {
                                    $imgsrc = $hash[0]['thumbnail_large'];
                                } else {
                                    $imgsrc = $row->thumb_url;
                                }
                                $video = '<a class="ph-lightbox givimeo huge_it_videogallery_item gallery_group' . $idofgallery . '" href="http://player.vimeo.com/video/' . $videourl[0] . '" title="' . $video_name . '">
                                                <img alt="' . $video_name . '" src="' . $imgsrc . '"/>
                                                ' . $likeCont . '
                                                <div class="play-icon ' . $videourl[1] . '-icon"></div>
                                        </a>';
                            }
                            break;
                    }
                    $output .= $video . '<input type="hidden" class="pagenum" value="' . $page . '" />';
                }
                echo json_encode(array("success" => $output));
                die();
            }
        }
    }

    /**
     * Load Images Thumbnail
     */
    public function load_images_thumbnail()
    {
        if (isset($_POST['task']) && $_POST['task'] == "load_image_thumbnail") {
            if (isset($_POST['galleryImgThumbnailLoadNonce'])) {
                $galleryImgThumbnailLoadNonce = esc_html($_POST['galleryImgThumbnailLoadNonce']);
                if (!wp_verify_nonce($galleryImgThumbnailLoadNonce, 'gallery_img_thumbnail_load_nonce')) {
                    wp_die('Security check fail');
                }
            }
            global $wpdb;
            global $huge_it_ip;
            $page = 1;
            if (!empty($_POST["page"]) && is_numeric($_POST['page']) && $_POST['page'] > 0) {
                $page = intval($_POST["page"]);
                $num = intval($_POST["perpage"]);
                $start = $page * $num - $num;
                $idofgallery = intval($_POST["galleryid"]);
                $pID = intval($_POST["pID"]);
                $likeStyle = esc_html($_POST['likeStyle']);
                $ratingCount = esc_html($_POST['ratingCount']);
                $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_images where gallery_id = '%d' order by ordering ASC LIMIT %d,%d", $idofgallery, $start, $num);
                $output = '';
                $page_images = $wpdb->get_results($query);
                foreach ($page_images as $key => $row) {
                    if (!isset($_COOKIE['Like_' . $row->id . ''])) {
                        $_COOKIE['Like_' . $row->id . ''] = '';
                    }
                    if (!isset($_COOKIE['Dislike_' . $row->id . ''])) {
                        $_COOKIE['Dislike_' . $row->id . ''] = '';
                    }
                    $num2 = $wpdb->prepare("SELECT `image_status`,`ip` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip` = '" . $huge_it_ip . "'", (int)$row->id);
                    $res3 = $wpdb->get_row($num2);
                    $num3 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE['Like_' . $row->id . ''] . "'", (int)$row->id);
                    $res4 = $wpdb->get_row($num3);
                    $num4 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE['Dislike_' . $row->id . ''] . "'", (int)$row->id);
                    $res5 = $wpdb->get_row($num4);
                    $video_name = str_replace('__5_5_5__', '%', $row->name);
                    $imgurl = explode(";", $row->image_url);
                    $image_prefix = "_huge_it_small_gallery";
                    $videourl = photo_gallery_wp_get_video_id_from_url($row->image_url);
                    $imagerowstype = $row->sl_type;
                    if ($row->sl_type == '') {
                        $imagerowstype = 'image';
                    }
                    switch ($imagerowstype) {
                        case 'image':
                            if (get_option('image_natural_size_thumbnail') == 'resize') {
                                $imgperfix = esc_url(photo_gallery_wp_get_image_by_sizes_and_src($imgurl[0], array(get_option('thumb_image_width'), get_option('thumb_image_height')), false));
                            } else {
                                $imgperfix = $imgurl[0];
                            }
                            $video = '<a class="ph-lightbox gallery_group' . $idofgallery . '" href="' . $row->image_url . '" title="' . $video_name . '"></a>
                            <img  src="' . $imgperfix . '" alt="' . $video_name . '" />';
                            break;
                        case 'video':
                            if ($videourl[1] == 'youtube') {
                                $video = '<a class="ph-lightbox giyoutube huge_it_gallery_item gallery_group' . $idofgallery . '"  href="https://www.youtube.com/embed/' . $videourl[0] . '" title="' . str_replace("__5_5_5__", "%", $row->name) . '"></a>
                                    <img alt="' . str_replace("__5_5_5__", "%", $row->name) . '" src="http://img.youtube.com/vi/' . $videourl[0] . '/mqdefault.jpg"  />';
                            } else {
                                $hash = unserialize(wp_remote_fopen("http://vimeo.com/api/v2/video/" . $videourl[0] . ".php"));
                                $imgsrc = $hash[0]['thumbnail_large'];
                                $video = '<a class="ph-lightbox givimeo huge_it_gallery_item gallery_group' . $idofgallery . '" href="http://player.vimeo.com/video/' . $videourl[0] . '" title="' . str_replace("__5_5_5__", "%", $row->name) . '"></a>
                                    <img alt="' . str_replace("__5_5_5__", "%", $row->name) . '" src="' . $imgsrc . '"  />';
                            }
                            ?>
                            <?php
                            break;
                    }
                    ?>
                    <?php
                    $thumb_status_like = '';
                    if (isset($res3->image_status) && $res3->image_status == 'liked') {
                        $thumb_status_like = $res3->image_status;
                    } elseif (isset($res4->image_status) && $res4->image_status == 'liked') {
                        $thumb_status_like = $res4->image_status;
                    } else {
                        $thumb_status_like = 'unliked';
                    }
                    $thumb_status_dislike = '';
                    if (isset($res3->image_status) && $res3->image_status == 'disliked') {
                        $thumb_status_dislike = $res3->image_status;
                    } elseif (isset($res5->image_status) && $res5->image_status == 'disliked') {
                        $thumb_status_dislike = $res5->image_status;
                    } else {
                        $thumb_status_dislike = 'unliked';
                    }
                    $likeIcon = '';
                    if ($likeStyle == 'heart') {
                        $likeIcon = '<i class="hugeiticons-heart likeheart"></i>';
                    } elseif ($likeStyle == 'dislike') {
                        $likeIcon = '<i class="hugeiticons-thumbs-up like_thumb_up"></i>';
                    }
                    $likeCount = '';
                    if ($likeStyle != 'heart') {
                        $likeCount = $row->like;
                    }
                    $thumb_text_like = '';
                    if ($likeStyle == 'heart') {
                        $thumb_text_like = $row->like;
                    }
                    $displayCount = '';
                    if ($ratingCount == 'off') {
                        $displayCount = 'huge_it_hide';
                    }
                    if ($likeStyle != 'heart') {
                        $dislikeHtml = '<div class="huge_it_gallery_dislike_wrapper">
                                <span class="huge_it_dislike">
                                    <i class="hugeiticons-thumbs-down dislike_thumb_down"></i>
                                    <span class="huge_it_dislike_thumb" id="' . $row->id . '" data-status="' . $thumb_status_dislike . '">
                                    </span>
                                    <span class="huge_it_dislike_count ' . $displayCount . '" id="' . $row->id . '">' . $row->dislike . '</span>
                                </span>
                            </div>';
                    }
/////////////////////////////
                    if ($likeStyle != 'off') {
                        $likeCont = '<div class="ph-g-wp_gallery_like_cont_' . $idofgallery . $pID . '">
                                <div class="ph-g-wp_gallery_like_wrapper">
                                    <span class="huge_it_like">' . $likeIcon . '
                                        <span class="huge_it_like_thumb" id="' . $row->id . '" data-status="' . $thumb_status_like . '">' . $thumb_text_like . '
                                        </span>
                                        <span class="ph-g-wp_like_count ' . $displayCount . '" id="' . $row->id . '">' . $likeCount . '</span>
                                    </span>
                                </div>' . $dislikeHtml . '
                           </div>';
                    }
///////////////////////////////
                    $output .= '
                <li class="huge_it_big_li">
                     ' . $likeCont . '<input type="hidden" class="pagenum" value="' . $page . '" />
                        ' . $video . '
                    <div class="overLayer"></div>
                    <div class="infoLayer">
                        <ul>
                            <li>
                                <h2>
                                    ' . $video_name . '
                                </h2>
                            </li>
                            <li>
                                <p>
                                    ' . $_POST['thumbtext'] . '
                                </p>
                            </li>
                        </ul>
                    </div>
                </li>
            ';
                }
                echo json_encode(array("success" => $output));
                die();
            }
        }
    }

    /**
     * For Blog
     */
    public function load_blog_view()
    {
        if (isset($_POST['task']) && $_POST['task'] == "load_blog_view") {
            if (isset($_POST['galleryImgBlogLoadNonce'])) {
                $galleryImgBlogLoadNonce = esc_html($_POST['galleryImgBlogLoadNonce']);
                if (!wp_verify_nonce($galleryImgBlogLoadNonce, 'gallery_img_blog_load_nonce')) {
                    wp_die('Security check fail');
                }
            }
            global $wpdb;
            global $huge_it_ip;
            $page = 1;
            if (!empty($_POST["page"]) && is_numeric($_POST['page']) && $_POST['page'] > 0) {
                $page = intval($_POST["page"]);
                $num = intval($_POST["perpage"]);
                $start = $page * $num - $num;
                $idofgallery = intval($_POST["galleryid"]);
                $pID = intval($_POST["pID"]);
                $likeStyle = esc_html($_POST['likeStyle']);
                $ratingCount = esc_html($_POST['ratingCount']);
                $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_images where gallery_id = '%d' order by ordering ASC LIMIT %d,%d", $idofgallery, $start, $num);
                $output = '';
                $page_images = $wpdb->get_results($query);
                foreach ($page_images as $key => $row) {
                    $img2video = '';
                    if (!isset($_COOKIE['Like_' . $row->id . ''])) {
                        $_COOKIE['Like_' . $row->id . ''] = '';
                    }
                    if (!isset($_COOKIE['Dislike_' . $row->id . ''])) {
                        $_COOKIE['Dislike_' . $row->id . ''] = '';
                    }
                    $num2 = $wpdb->prepare("SELECT `image_status`,`ip` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip` = '" . $huge_it_ip . "'", (int)$row->id);
                    $res3 = $wpdb->get_row($num2);
                    $num3 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE['Like_' . $row->id . ''] . "'", (int)$row->id);
                    $res4 = $wpdb->get_row($num3);
                    $num4 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_COOKIE['Dislike_' . $row->id . ''] . "'", (int)$row->id);
                    $res5 = $wpdb->get_row($num4);
                    $img_src = $row->image_url;
                    $img_name = str_replace('__5_5_5__', '%', $row->name);
                    $img_desc = str_replace('__5_5_5__', '%', $row->description);
                    $videourl = photo_gallery_wp_get_video_id_from_url($row->image_url);
                    $imagerowstype = $row->sl_type;
                    $img3video = '';
                    if ($imagerowstype == '') {
                        $imagerowstype = 'image';
                    }
                    if ($imagerowstype == 'image') {
                        $img2video .= '<img class="view9_img" src="' . $img_src . '">';
                    } else {
                        if ($videourl[1] == 'youtube') {
                            $img3video .= '<div class="iframe_cont">
                                        <iframe class="video_blog_view" src="//www.youtube.com/embed/' . $videourl[0] . '" style="border: 0;" allowfullscreen></iframe>
                                    </div>';
                        } else {
                            $img3video .= '<div class="iframe_cont">
                                                <iframe class="video_blog_view" src="//player.vimeo.com/video/' . $videourl[0] . '" style="border: 0;" allowfullscreen></iframe>
                                            </div>';
                        }
                    }
                    if ($imagerowstype == 'image') {
                        $link_img_video = $img2video;
                    } else {
                        $link_img_video = $img3video;
                    }
                    $thumb_status_like = '';
                    if (isset($res3->image_status) && $res3->image_status == 'liked') {
                        $thumb_status_like = $res3->image_status;
                    } elseif (isset($res4->image_status) && $res4->image_status == 'liked') {
                        $thumb_status_like = $res4->image_status;
                    } else {
                        $thumb_status_like = 'unliked';
                    }
                    $thumb_status_dislike = '';
                    if (isset($res3->image_status) && $res3->image_status == 'disliked') {
                        $thumb_status_dislike = $res3->image_status;
                    } elseif (isset($res5->image_status) && $res5->image_status == 'disliked') {
                        $thumb_status_dislike = $res5->image_status;
                    } else {
                        $thumb_status_dislike = 'unliked';
                    }
                    $likeIcon = '';
                    if ($likeStyle == 'heart') {
                        $likeIcon = '<i class="hugeiticons-heart likeheart"></i>';
                    } elseif ($likeStyle == 'dislike') {
                        $likeIcon = '<i class="hugeiticons-thumbs-up like_thumb_up"></i>';
                    }
                    $likeCount = '';
                    if ($likeStyle != 'heart') {
                        $likeCount = $row->like;
                    }
                    $thumb_text_like = '';
                    if ($likeStyle == 'heart') {
                        $thumb_text_like = $row->like;
                    }
                    $displayCount = '';
                    if ($ratingCount == 'off') {
                        $displayCount = 'huge_it_hide';
                    }
                    if ($likeStyle != 'heart') {
                        $dislikeHtml = '<div class="huge_it_gallery_dislike_wrapper">
                                <span class="huge_it_dislike">
                                    <i class="hugeiticons-thumbs-down dislike_thumb_down"></i>
                                    <span class="huge_it_dislike_thumb" id="' . $row->id . '" data-status="' . $thumb_status_dislike . '">
                                    </span>
                                    <span class="huge_it_dislike_count ' . $displayCount . '" id="' . $row->id . '">' . $row->dislike . '</span>
                                </span>
                            </div>';
                    }
/////////////////////////////
                    if ($likeStyle != 'off') {
                        $likeCont = '<div class="ph-g-wp_gallery_like_cont_' . $idofgallery . $pID . '">
                                <div class="ph-g-wp_gallery_like_wrapper">
                                    <span class="huge_it_like">' . $likeIcon . '
                                        <span class="huge_it_like_thumb" id="' . $row->id . '" data-status="' . $thumb_status_like . '">' . $thumb_text_like . '
                                        </span>
                                        <span class="ph-g-wp_like_count ' . $displayCount . '" id="' . $row->id . '">' . $likeCount . '</span>
                                    </span>
                                </div>' . $dislikeHtml . '
                           </div>';
                    }
///////////////////////////////
                    if ($likeStyle != 'heart') {
                        $output .= '<div class="view9_container">
                                <input type="hidden" class="pagenum" value="' . $page . '" />
                                <h1 class="new_view_title">' . $img_name . '</h1>' . $link_img_video . '
                                <div class="new_view_desc">' . $img_desc . '</div>' . $likeCont . '</div>
                          <div class="clear"></div>';
                    }
                    if ($likeStyle == 'heart') {
                        $output .= '<div class="view9_container">
                                <input type="hidden" class="pagenum" value="' . $page . '" />
                                <h1 class="new_view_title">' . $img_name . '</h1><div class="blog_img_wrapper">' . $link_img_video . $likeCont . '</div>
                                <div class="new_view_desc">' . $img_desc . '</div></div>
                          <div class="clear"></div>';
                    }
                }
            }
            echo json_encode(array("success" => $output, "typeOfres" => $imagerowstype));
            die();
        }
    }

    public function load_images_masonry() {
        if (isset($_POST['task']) && $_POST['task'] == "load_images_masonry") {
            if ( isset( $_POST['galleryImgMasonryLoadNonce'] ) ) {
                $galleryImgMasonryLoadNonce = esc_html( $_POST['galleryImgMasonryLoadNonce'] );
                if ( ! wp_verify_nonce( $galleryImgMasonryLoadNonce, 'galleryImgMasonryLoadNonce' ) ) {
                    wp_die( 'Security check fail' );
                }
            }
            global $wpdb;
            global $huge_it_ip;
            if ( ! isset( $_POST["ph_gallery_id"] ) || ! absint( $_POST['ph_gallery_id'] ) || absint( $_POST['ph_gallery_id'] ) != $_POST['ph_gallery_id'] ) {
                wp_die( '"ph_gallery_id" parameter is required to be not negative integer' );
            }
            $ph_gallery_id = absint( $_POST["ph_gallery_id"] );
            if ( ! isset( $_POST["content_per_page"] ) || ! absint( $_POST['content_per_page'] ) || absint( $_POST['content_per_page'] ) != $_POST['content_per_page'] ) {
                wp_die( '"content_per_page" parameter is required to be not negative integer' );
            }
            $content_per_page = absint( $_POST["content_per_page"] );
            $current_page     = absint( $_POST['current_page'] );
            $start            = $current_page * $content_per_page - $content_per_page;
            $query            = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE gallery_id=%d ORDER BY ordering LIMIT %d,%d", $ph_gallery_id, $start, $content_per_page );
            $group_key1       = $start;
            $rows             = $wpdb->get_results( $query );
            ob_start();
            foreach ( $rows as $key => $row ) :
                $imagerowstype = $row->sl_type;
                if ( $row->sl_type == '' ) {
                    $imagerowstype = 'image';
                }
                ?>
                <div class="grid-item">
                    <?php
                    switch ( $imagerowstype ) {
                        case 'image': ?>
                            <a href="<?php echo $row->image_url; ?>" class="ph-lightbox">
                                <img src="<?php echo $row->image_url; ?>" alt="">
                            </a>
                            <?php if ( Photo_Gallery_WP()->settings->masonry_title_show_title == 'yes' ) { ?>
                                <div class="title-masonry-image">
                                    <a title="<?php echo $row->name; ?>" href="<?php echo $row->sl_url; ?>"
                                       target="_blank"><?php echo $row->name; ?></a>
                                </div>
                            <?php }
                            break;
                        case 'video':
                            $videourl = photo_gallery_wp_get_video_id_from_url( $row->image_url );
                            if ( $videourl[1] == 'youtube' ) {
                                ?>
                                <a href="<?php echo $row->image_url; ?>" class="ph-lightbox">
                                    <img src="http://img.youtube.com/vi/<?php echo $videourl[0]; ?>/mqdefault.jpg"
                                         alt="">
                                </a>
                                <?php if ( Photo_Gallery_WP()->settings->masonry_title_show_title == 'yes' ) { ?>
                                    <div class="title-masonry-image">
                                        <a title="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"
                                           href="<?php echo $row->sl_url; ?>"
                                           target="_blank"><?php echo str_replace( '__5_5_5__', '%', $row->name ); ?></a>
                                    </div>
                                <?php }
                            } else {
                                $hash   = unserialize( wp_remote_fopen( "http://vimeo.com/api/v2/video/" . $videourl[0] . ".php" ) );
                                $imgsrc = $hash[0]['thumbnail_large'];
                                ?>
                                <a href="<?php echo $row->image_url; ?>" class="ph-lightbox">
                                    <img src="<?php echo esc_attr( $imgsrc ); ?>" alt="">
                                </a>
                                <?php if ( Photo_Gallery_WP()->settings->masonry_title_show_title == 'yes' ) { ?>
                                    <div class="title-masonry-image">
                                        <a title="<?php echo str_replace( '__5_5_5__', '%', $row->name ); ?>"
                                           href="<?php echo $row->sl_url; ?>"
                                           target="_blank"><?php echo str_replace( '__5_5_5__', '%', $row->name ); ?></a>
                                    </div>
                                    <?php
                                }
                            }
                            break;
                    }
                    ?>
                </div>
                </div>
                <?php
            endforeach;
            wp_die();
            return ob_get_clean();
        }
    }

    /**
     * Like Dislike
    */
    public function like_dislike()
    {
        if (isset($_POST['task']) && $_POST['task'] == "like") {
            $huge_it_ip = '';
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $huge_it_ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $huge_it_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $huge_it_ip = $_SERVER['REMOTE_ADDR'];
            }
            global $wpdb;
            $num = $wpdb->prepare("SELECT `image_status`,`ip` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d", (int)$_POST['image_id']);
            $num2 = $wpdb->prepare("SELECT `image_status`,`ip` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip` = '" . $huge_it_ip . "'", (int)$_POST['image_id']);
            $res = $wpdb->get_results($num);
            $res2 = $wpdb->get_results($num, ARRAY_A);
            $res3 = $wpdb->get_row($num2);
            $num3 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_POST['cook'] . "'", (int)$_POST['image_id']);
            $res4 = $wpdb->get_row($num3);
            $resIP = '';
            for ($i = 0; $i < count($res2); $i++) {
                $resIP .= $res2[$i]['ip'] . '|';
            }
            $arrIP = explode("|", $resIP);
            if (!isset($res3) && !isset($res4)) {
                $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "photo_gallery_wp_like_dislike (`image_id`,`image_status`,`ip`,`cook`) VALUES ( %d, 'liked', '" . $huge_it_ip . "',%s)", (int)$_POST['image_id'], $_POST['cook']));
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  `like` = `like`+1 WHERE id = %d ", (int)$_POST['image_id']));
                $numLike = $wpdb->prepare("SELECT `like` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resLike = $wpdb->get_results($numLike);
                $numDislike = $wpdb->prepare("SELECT `dislike` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resDislike = $wpdb->get_results($numDislike);
                echo json_encode(array("like" => $resLike[0]->like, "statLike" => 'Liked'));
            } elseif ((isset($res3) && $res3->image_status == 'liked' && $res3->ip == $huge_it_ip) || (isset($res4) && $res4->image_status == 'liked' && $res4->cook == $_POST['cook'])) {
                if (isset($res3) && $res3->image_status == 'liked' && $res3->ip == $huge_it_ip) {
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip`='" . $huge_it_ip . "'", (int)$_POST['image_id']));
                } elseif (isset($res4) && $res4->cook == $_POST['cook']) {
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook`='" . $_POST['cook'] . "'", (int)$_POST['image_id']));
                }
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  `like` = `like`-1 WHERE id = %d ", (int)$_POST['image_id']));
                $numLike = $wpdb->prepare("SELECT `like` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resLike = $wpdb->get_results($numLike);
                $numDislike = $wpdb->prepare("SELECT `dislike` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resDislike = $wpdb->get_results($numDislike);
                echo json_encode(array("like" => $resLike[0]->like, "statLike" => 'Like'));
            } elseif ((isset($res3) && $res3->image_status == 'disliked' && $res3->ip == $huge_it_ip) || (isset($res4) && $res4->image_status == 'disliked' && $res4->cook == $_POST['cook'])) {
                if (isset($res3) && $res3->image_status == 'disliked' && $res3->ip == $huge_it_ip) {
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip`='" . $huge_it_ip . "'", (int)$_POST['image_id']));
                } elseif (isset($res4) && $res4->image_status == 'disliked' && $res4->cook == $_POST['cook']) {
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook`='" . $_POST['cook'] . "'", (int)$_POST['image_id']));
                }
                $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "photo_gallery_wp_like_dislike (`image_id`,`image_status`,`ip`,`cook`) VALUES ( %d, 'liked', '" . $huge_it_ip . "',%s)", (int)$_POST['image_id'], $_POST['cook']));
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  `like` = `like`+1 WHERE id = %d ", (int)$_POST['image_id']));
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  `dislike` = `dislike`-1 WHERE id = %d ", (int)$_POST['image_id']));
                $numLike = $wpdb->prepare("SELECT `like` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resLike = $wpdb->get_results($numLike);
                $numDislike = $wpdb->prepare("SELECT `dislike` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resDislike = $wpdb->get_results($numDislike);
                echo json_encode(array(
                    "like" => $resLike[0]->like,
                    "dislike" => $resDislike[0]->dislike,
                    "statLike" => 'Liked',
                    "statDislike" => 'Dislike'
                ));
            }
            die();
        } elseif (isset($_POST['task']) && $_POST['task'] == "dislike") {
            $huge_it_ip = '';
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $huge_it_ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $huge_it_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $huge_it_ip = $_SERVER['REMOTE_ADDR'];
            }
            global $wpdb;
            $num = $wpdb->prepare("SELECT `image_status`,`ip` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d", (int)$_POST['image_id']);
            $num2 = $wpdb->prepare("SELECT `image_status`,`ip` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip` = '" . $huge_it_ip . "'", (int)$_POST['image_id']);
            $res = $wpdb->get_results($num);
            $res2 = $wpdb->get_results($num, ARRAY_A);
            $res3 = $wpdb->get_row($num2);
            $num3 = $wpdb->prepare("SELECT `image_status`,`ip`,`cook` FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook` = '" . $_POST['cook'] . "'", (int)$_POST['image_id']);
            $res4 = $wpdb->get_row($num3);
            $resIP = '';
            for ($i = 0; $i < count($res2); $i++) {
                $resIP .= $res2[$i]['ip'] . '|';
            }
            $arrIP = explode("|", $resIP);
            if (!isset($res3) && !isset($res4)) {
                $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "photo_gallery_wp_like_dislike (`image_id`,`image_status`,`ip`,`cook`) VALUES ( %d, 'disliked', '" . $huge_it_ip . "',%s)", (int)$_POST['image_id'], $_POST['cook']));
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  `dislike` = `dislike`+1 WHERE id = %d ", (int)$_POST['image_id']));
                $numDislike = $wpdb->prepare("SELECT `dislike` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resDislike = $wpdb->get_results($numDislike);
                $numLike = $wpdb->prepare("SELECT `like` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resLike = $wpdb->get_results($numLike);
                echo json_encode(array("dislike" => $resDislike[0]->dislike, "statDislike" => 'Disliked'));
            } elseif ((isset($res3) && $res3->image_status == 'disliked' && $res3->ip == $huge_it_ip) || (isset($res4) && $res4->image_status == 'disliked' && $res4->cook == $_POST['cook'])) {
                if (isset($res3) && $res3->image_status == 'disliked' && $res3->ip == $huge_it_ip) {
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip`='" . $huge_it_ip . "'", (int)$_POST['image_id']));
                } elseif (isset($res4) && $res4->image_status == 'disliked' && $res4->cook == $_POST['cook']) {
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook`='" . $_POST['cook'] . "'", (int)$_POST['image_id']));
                }
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  `dislike` = `dislike`-1 WHERE id = %d ", (int)$_POST['image_id']));
                $numDislike = $wpdb->prepare("SELECT `dislike` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resDislike = $wpdb->get_results($numDislike);
                $numLike = $wpdb->prepare("SELECT `like` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resLike = $wpdb->get_results($numLike);
                echo json_encode(array("dislike" => $resDislike[0]->dislike, "statDislike" => 'Dislike'));
            } elseif ((isset($res3) && $res3->image_status == 'liked' && $res3->ip == $huge_it_ip) || (isset($res4) && $res4->image_status == 'liked' && $res4->cook == $_POST['cook'])) {
                if (isset($res3) && $res3->image_status == 'liked' && $res3->ip == $huge_it_ip) {
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `ip`='" . $huge_it_ip . "'", (int)$_POST['image_id']));
                } elseif (isset($res4) && $res4->image_status == 'liked' && $res4->cook == $_POST['cook']) {
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "photo_gallery_wp_like_dislike WHERE image_id = %d AND `cook`='" . $_POST['cook'] . "'", (int)$_POST['image_id']));
                }
                $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "photo_gallery_wp_like_dislike (`image_id`,`image_status`,`ip`,`cook`) VALUES ( %d, 'disliked', '" . $huge_it_ip . "',%s)", (int)$_POST['image_id'], $_POST['cook']));
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  `dislike` = `dislike`+1 WHERE id = %d ", (int)$_POST['image_id']));
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "photo_gallery_wp_images SET  `like` = `like`-1 WHERE id = %d ", (int)$_POST['image_id']));
                $numDislike = $wpdb->prepare("SELECT `dislike` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resDislike = $wpdb->get_results($numDislike);
                $numLike = $wpdb->prepare("SELECT `like` FROM " . $wpdb->prefix . "photo_gallery_wp_images WHERE id = %d LIMIT 1", (int)$_POST['image_id']);
                $resLike = $wpdb->get_results($numLike);
                echo json_encode(array(
                    "like" => $resLike[0]->like,
                    "dislike" => $resDislike[0]->dislike,
                    "statLike" => 'Like',
                    "statDislike" => 'Disliked'
                ));
            }
            die();
        }
    }
}

new Photo_Gallery_WP_Ajax();