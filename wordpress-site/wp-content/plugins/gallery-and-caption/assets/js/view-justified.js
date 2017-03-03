jQuery.each(param_obj, function (index, value) {
    if (!isNaN(value)) {
        param_obj[index] = parseInt(value);
    }
});
function Ph_Gallery_Justified(id) {
    var _this = this;
    _this.body = jQuery('body');
    _this.container = jQuery('#' + id + '.view-justified');
    _this.content = _this.container.parent();
    _this.defaultBlockWidth = param_obj.ht_view6_width;
    _this.ratingType = _this.content.data('rating-type');
    _this.likeContent = jQuery('.ph-g-wp_gallery_like_cont');
    _this.likeCountContainer = jQuery('.ph-g-wp_like_count');
    _this.loadMoreBtn = _this.content.find('.load_more_button2');
    _this.loadingIcon = _this.content.find('.loading2');
    _this.documentReady = function () {
        jQuery(window).load(function () {
            jQuery('.justified-gallery a').each(function () {
                var img = jQuery(this).find('img');
                if (jQuery(this).find('img').attr('alt') == '') {
                    img.parent().find(".caption").css('display', 'none');
                }
            });
            photoGalleryCountsOptimize(_this.container, _this.ratingType);
        });
    };
    _this.addEventListeners = function () {
        _this.loadMoreBtn.on('click', _this.loadMoreBtnClick);
    };
    _this.loadMoreBtnClick = function () {
        var justifiedLoadNonce = jQuery(this).attr('data-justified-nonce-value');
        if (parseInt(_this.content.find(".pagenum:last").val()) < parseInt(_this.content.find("#total").val())) {
            var pagenum = parseInt(_this.content.find(".pagenum:last").val()) + 1;
            var perpage = gallery_obj[0].content_per_page;
            var galleryid = gallery_obj[0].id;
            var pID = postID;
            var likeStyle = _this.ratingType;
            var ratingCount = param_obj.ht_just_rating_count;
            _this.getResult(pagenum, perpage, galleryid, pID, likeStyle, ratingCount, justifiedLoadNonce);
        } else {
            _this.loadMoreBtn.hide();
        }
        return false;
    };
    _this.getResult = function (pagenum, perpage, galleryid, pID, likeStyle, ratingCount, justifiedLoadNonce) {
        var data = {
            action: "photo_gallery_wp_load_images_justified",
            task: 'load_image_justified',
            page: pagenum,
            perpage: perpage,
            galleryid: galleryid,
            pID: pID,
            likeStyle: likeStyle,
            ratingCount: ratingCount,
            galleryImgJustifiedLoadNonce: justifiedLoadNonce
        };
        _this.loadingIcon.show();
        _this.loadMoreBtn.hide();
        jQuery.post(adminUrl, data, function (response) {
                if (response.success) {
                    var $objnewitems = jQuery(response.success);
                    _this.container.append($objnewitems);
                    setTimeout(function () {
                        _this.container.justifiedGallery();

                    }, 100);
                    _this.loadMoreBtn.show();
                    _this.loadingIcon.hide();
                    if (_this.content.find(".pagenum:last").val() == _this.content.find("#total").val()) {
                        _this.loadMoreBtn.hide();
                    }
                    jQuery('.ph-lightbox').lightbox();
                    photoGalleryCountsOptimize(_this.container, _this.ratingType);
                    setTimeout(function () {
                        jQuery('.justified-gallery a').each(function () {
                            var img = jQuery(this).find('img');
                            if (jQuery(this).find('img').attr('alt') == '') {
                                img.parent().find(".caption").css('display', 'none');
                            }
                        });
                    }, 500);
                } else {
                    alert("no");
                }
            }
            , "json");
    };
    _this.init = function () {
        _this.container.justifiedGallery();
        _this.documentReady();
        _this.addEventListeners();
    };
    this.init();
}
var galleries = [];
jQuery(document).ready(function () {
    jQuery(".mygallery.view-justified").each(function (i) {
        var id = jQuery(this).attr('id');
        galleries[i] = new Ph_Gallery_Justified(id);
    });
});

