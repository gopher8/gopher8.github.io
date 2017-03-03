<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div id="ph-gallery-wp-add_videos" style="display: none;">
    <div id="ph-gallery-wp-add_videos_wrap">
        <h2><?php echo __('Add Video URL From Youtube or Vimeo', 'photo-gallery-wp'); ?></h2>
        <div class="control-panel">
            <form method="post"
                  action="admin.php?page=photo_gallery_wp_gallery&task=photo_gallery_wp_video&id=<?php echo $id ?>&closepop=1">
                <input type="text" id="photo_gallery_wp_add_video_input" name="photo_gallery_wp_add_video_input"/>
                <button class='save-slider-options button-primary ph-gallery-wp-insert-video-button'
                        id='ph-gallery-wp-insert-video-button'><?php echo __('Insert Video', 'photo-gallery-wp'); ?></button>
                <div id="ph-gallery-wp-add-video-popup-options">
                    <div>
                        <div>
                            <label for="show_title"><?php echo __('Title:', 'photo-gallery-wp'); ?></label>
                            <div>
                                <input name="show_title" value="" type="text"/>
                            </div>
                        </div>
                        <div>
                            <label for="show_description"><?php echo __('Description:', 'photo-gallery-wp'); ?></label>
                            <textarea id="show_description" name="show_description"></textarea>
                        </div>
                        <div>
                            <label for="show_url"><?php echo __('Url:', 'photo-gallery-wp'); ?></label>
                            <input type="text" name="show_url" value=""/>
                        </div>
                    </div>
                </div>
                <?php wp_nonce_field('photo_gallery_wp_nonce_add_video','photo_gallery_wp_nonce_add_video');?>
            </form>
        </div>
    </div>
</div>
