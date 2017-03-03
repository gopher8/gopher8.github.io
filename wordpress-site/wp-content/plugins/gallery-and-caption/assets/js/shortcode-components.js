/**
 * Created by user on 23.11.2016.
 */
(function () {
    var $ = jQuery;
    var shortcode = null;
    $(document).ready(function () {
        jQuery('.ph-gallery-wp_galleryinsert').on('click', function() {
            if (shortcode != null) {
                window.send_to_editor('[photo_gallery_wp id="' + shortcode + '"]');
                tb_remove();
            } else {
                alert("Select one please");
            }
        });

        $('#ph-g-wp-list-view').click(function () {
            $('.ph-g-wp-popup-active').removeClass('ph-g-wp-popup-active');
            $(this).addClass('ph-g-wp-popup-active');
            $('.ph-g-wp-view-mode-thumb').hide();
            $('.ph-g-wp-view-mode-list').show();
        });
        $('#ph-g-wp-thumb-view').click(function () {
            $('.ph-g-wp-popup-active').removeClass('ph-g-wp-popup-active');
            $(this).addClass('ph-g-wp-popup-active');
            $('.ph-g-wp-view-mode-list').hide();
            $('.ph-g-wp-view-mode-thumb').show();
        });

        $('.ph-g-wp-gallery-tbl').click(function () {
           $('.ph-g-wp-gallery-tbl-selected').removeClass('ph-g-wp-gallery-tbl-selected');
           $(this).addClass('ph-g-wp-gallery-tbl-selected');
            shortcode = $(this).attr('data-shortcode');
        });
        $('.ph-g-wp-thumb-div').click(function () {
            $('.ph-g-wp-thumb-div-selected').removeClass('ph-g-wp-thumb-div-selected');
            $(this).addClass('ph-g-wp-thumb-div-selected');
            shortcode = $(this).attr('data-shortcode');
        });
    });
})();
