jQuery.each(param_obj, function (index, value) {
    if (!isNaN(value)) {
        param_obj[index] = parseInt(value);
    }
});
function Ph_Gallery_Thumbnails(id) {
    var _this = this;
    _this.body = jQuery('body');
    _this.container = jQuery('#' + id + '.view-thumbnails');
    _this.content = _this.container.parent();
    _this.element = _this.container.find('.element');
    _this.defaultBlockWidth = param_obj.thumb_image_width;
    _this.defaultBlockHeiight = param_obj.thumb_image_height;
    _this.ratingType = _this.content.data('rating-type');
    _this.likeContent = jQuery('.ph-g-wp_gallery_like_cont');
    _this.likeCountContainer = jQuery('.ph-g-wp_like_count');
    _this.loadMoreBtn = _this.content.find('.load_more_button3');
    _this.loadingIcon = _this.content.find('.loading3');
    _this.documentReady = function () {
        photoGalleryCountsOptimize(_this.container, _this.ratingType);
    };
    _this.addEventListeners = function () {
        _this.loadMoreBtn.on('click', _this.loadMoreBtnClick);
    };
    _this.loadMoreBtnClick = function () {
        var thumbnailLoadNonce = jQuery(this).attr('data-thumbnail-nonce-value');
        if (parseInt(_this.content.find(".pagenum:last").val()) < parseInt(_this.container.find("#total").val())) {
            var pagenum = parseInt(_this.content.find(".pagenum:last").val()) + 1;
            var perpage = gallery_obj[0].content_per_page;
            var galleryid = gallery_obj[0].id;
            var thumbtext = param_obj.thumb_view_text;
            var pID = postID;
            var likeStyle = _this.ratingType;
            var ratingCount = param_obj.ht_thumb_rating_count;
            _this.getResult(pagenum, perpage, galleryid, thumbtext, pID, likeStyle, ratingCount, thumbnailLoadNonce);
        } else {
            _this.loadMoreBtn.hide();
        }
        return false;
    };
    _this.getResult = function (pagenum, perpage, galleryid, thumbtext, pID, likeStyle, ratingCount, thumbnailLoadNonce) {
        var data = {
            action: "photo_gallery_wp_load_images_thumbnail",
            task: 'load_image_thumbnail',
            page: pagenum,
            perpage: perpage,
            galleryid: galleryid,
            thumbtext: thumbtext,
            pID: pID,
            likeStyle: likeStyle,
            ratingCount: ratingCount,
            galleryImgThumbnailLoadNonce: thumbnailLoadNonce
        };
        _this.loadingIcon.show();
        _this.loadMoreBtn.hide();
        jQuery.post(adminUrl, data, function (response) {
         if(response.success) {
                    var $objnewitems = jQuery(response.success);
                    _this.container.append($objnewitems);
                    _this.loadMoreBtn.show();
                    _this.loadingIcon.hide();
                    if (_this.content.find(".pagenum:last").val() == _this.content.find("#total").val()) {
                        _this.loadMoreBtn.hide();
                    }
                    jQuery('.ph-lightbox').lightbox();
                    photoGalleryCountsOptimize(_this.container, _this.ratingType);
                    setTimeout(function () {
                        if (param_obj.image_natural_size_thumbnail == 'natural') {
                            _this.naturalImageThumb();
                        }
                    }, 200);
                } else {
                    alert("no");
                }
            }
            , "json");
    };
    _this.naturalImageThumb = function () {
        _this.container.find(".huge_it_big_li img").each(function (i, img) {
            var imgStr = jQuery(this).prop('naturalWidth') / jQuery(this).prop('naturalHeight');
            var elemStr = _this.defaultBlockWidth / _this.defaultBlockHeiight;
            if (imgStr <= elemStr) {
                jQuery(img).css({
                    position: "relative",
                    width: '100%',
                    top: '50%',
                    transform: 'translateY(-50%)'
                });
            } else {
                jQuery(img).css({
                    position: "relative",
                    height: '100%',
                    left: '50%',
                    transform: 'translateX(-50%)'
                });
            }
        });
    };
    _this.init = function () {
        _this.documentReady();
        _this.addEventListeners();
        if (param_obj.image_natural_size_thumbnail == 'natural') {
            _this.naturalImageThumb();
        }
    };
    this.init();
}
var galleries = [];
jQuery(document).ready(function () {
    jQuery(".huge_it_gallery.view-thumbnails").each(function (i) {
        var id = jQuery(this).attr('id');
        galleries[i] = new Ph_Gallery_Thumbnails(id);
    });
});

