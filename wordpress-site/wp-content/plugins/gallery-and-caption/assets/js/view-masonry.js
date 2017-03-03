function Ph_Gallery_Masonry(id) {
    var _this = this;
    _this.body = jQuery('body');
    _this.container = jQuery('#' + id + '.view-masonry');
    _this.element = _this.container.find('.grid-item');
    _this.isCentered = _this.container.data("show-center") == "yes";
    //_this.ratingType = _this.content.data('rating-type');
    _this.likeContent = jQuery('.ph-g-wp_gallery_like_cont');
    _this.likeCountContainer = jQuery('.ph-g-wp_like_count');
    _this.loadMoreBtn = _this.container.find('.load_more_button8');
    _this.loadingIcon = _this.container.find('.loading8');
    _this.phGalleryId = _this.container.attr('data-ph-gallery-id');
    _this.contentPerPage = parseInt(_this.container.attr('data-content-per-page'));
    _this.pagesCount = parseInt(_this.container.attr('data-pages-count'));
    _this.defaultBlockWidth = parseInt(_this.container.attr('data-element-width'));
    _this.documentReady = function () {
        _this.container.find('.grid').masonry({
                itemSelector: '.grid-item',
                columnWidth: parseInt(photo_param_obj.masonry_image_width_in_px)+parseInt(photo_param_obj.masonry_image_margin_in_px)
            });
    };
    _this.showCenter = function () {
        if (_this.isCentered) {
            var count = _this.container.find('.grid-item').length;
            var elementWidth = _this.defaultBlockWidth +  parseInt(photo_param_obj.masonry_image_border_width_in_px);
            var enteryContent = _this.container.width();
            var whole = Math.floor(enteryContent /elementWidth);
            if (whole > count) whole = count;
            if (whole == 0) {
                return false;
            }
            else {
                var sectionWidth = whole * elementWidth ;
            }
            _this.container.find('.grid').css({
                "width": sectionWidth,
                "max-width": "100%",
                "margin": "0px auto",
                "overflow": "hidden"
            });
            var loadInterval = setInterval(function(){
                _this.container.find('.grid').masonry();
                _this.container.find('.grid').masonry('layout');
            },100);
            setTimeout(function(){clearInterval(loadInterval);},5000);
        }
    };


    _this.addEventListeners = function () {
        _this.loadMoreBtn.on('click', _this.loadMoreClick);
        jQuery(window).resize(_this.resizeEvent);
    };
    _this.resizeEvent = function () {
        _this.showCenter();
    };
    _this.loadMoreClick = function () {
        var currentPage = _this.container.attr('data-current-page');
        var data = {
            action: 'photo_gallery_wp_load_images_masonry',
            content_per_page: _this.contentPerPage,
            task: 'load_images_masonry',
            ph_gallery_id: _this.phGalleryId,
            current_page: currentPage
        };
        _this.loadingIcon.show();
        _this.loadMoreBtn.hide();
        jQuery.post(adminUrl, data, function (response) {
            if (response) {
                _this.container.find('.grid').css('width','100%');
                _this.container.find('.grid').append(response);
                _this.container.find('img').on('load', function () {
                    setTimeout(function(){

                        _this.container.find('.grid').masonry({initLayout: true});
                        _this.container.find('.grid').masonry();
                        _this.container.find('.grid').masonry({
                            itemSelector: '.grid-item',
                            columnWidth: parseInt(photo_param_obj.masonry_image_width_in_px)+parseInt(photo_param_obj.masonry_image_border_width_in_px)
                        });
                        _this.container.find('.grid').masonry('reloadItems');
                        _this.container.find('.grid').masonry({sortBy:'original-order'});
                        _this.container.find('.grid').masonry('layout');
                        _this.showCenter();
                        jQuery('.ph-lightbox').lightbox();
                    },50);

                });
                _this.loadMoreBtn.show();
                _this.loadingIcon.hide();
                _this.container.attr('data-current-page',parseInt(_this.container.attr('data-current-page'))+1);
                if (_this.container.attr('data-current-page') == _this.pagesCount+1 ) {
                    _this.loadMoreBtn.hide();
                }
            }
            else{
                alert('Load More Fail');
            }
        });
    };
    _this.init = function () {
        _this.documentReady();
        _this.addEventListeners();
        _this.showCenter();
    };

    _this.init();
}
var galleries = [];
jQuery(document).ready(function () {
    jQuery(".ph-g-wp_gallery_container.view-masonry").each(function (i) {
        var id = jQuery(this).attr('id');
        galleries[i] = new Ph_Gallery_Masonry(id);
    });
});

