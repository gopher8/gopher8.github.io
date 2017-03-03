jQuery.each(param_obj, function (index, value) {
    if (!isNaN(value)) {
        param_obj[index] = parseInt(value);
    }
});
//@todo natural images
function Ph_Gallery_Content_Popup(id) {
    var _this = this;
    _this.body = jQuery('body');
    _this.container = jQuery('#' + id + '.view-content-popup');
    _this.content = _this.container.parent();
    _this.ph_element = _this.container.find('.ph_element');
    _this.defaultBlockHeight = param_obj.view2_element_height;
    _this.defaultBlockWidth = param_obj.view2_element_width;
    _this.imageOverlay = _this.ph_element.find('.ph-g-wp-gallery-image-overlay a');
    _this.popupList = _this.content.next();
    _this.popupCloseButton = _this.popupList.find('a.close');
    _this.leftButton = _this.popupList.find('.heading-navigation .left-change');
    _this.rightButton = _this.popupList.find('.heading-navigation .right-change');
    _this.playIcon = _this.popupList.find('.video-thumb .play-icon');
    _this.imageBehaiour = _this.content.data('image-behaviour');
    _this.isCentered = _this.container.data("show-center") == 'on';
    _this.ratingType = _this.content.data('rating-type');
    _this.likeContent = jQuery('.ph-g-wp_gallery_like_cont');
    _this.likeCountContainer = jQuery('.ph-g-wp_like_count');
    _this.loadMoreBtn = _this.content.find('.load_more_button5');
    _this.loadingIcon = _this.content.find('.loading5');

    _this.documentReady = function () {
        var options = {
            itemSelector: _this.ph_element,
            masonry: {
                columnWidth: _this.defaultBlockWidth + 20 + param_obj.view2_element_width * 2
            },
            masonryHorizontal: {
                rowHeight: 300 + 20
            },
            cellsByRow: {
                columnWidth: 300 + 20,
                rowHeight: 240
            },
            cellsByColumn: {
                columnWidth: 300 + 20,
                rowHeight: 240
            },
            getSortData: {
                symbol: function ($elem) {
                    return $elem.attr('data-symbol');
                },
                category: function ($elem) {
                    return $elem.attr('data-category');
                },
                number: function ($elem) {
                    return parseInt($elem.find('.number').text(), 10);
                },
                weight: function ($elem) {
                    return parseFloat($elem.find('.weight').text().replace(/[\(\)]/g, ''));
                },
                id: function ($elem) {
                    return $elem.find('.id').text();
                }
            }
        };
        galleryImgIsotope(_this.container.children(), options);
        photoGalleryCountsOptimize(_this.container, _this.ratingType);
        photoGalleryCountsOptimize(_this.popupList, _this.ratingType);
    };
    _this.showCenter = function () {
        if (_this.isCentered) {
            var count = _this.ph_element.length;
            var elementwidth = _this.defaultBlockWidth + 10 + param_obj.view2_element_border_width * 2;
            var enterycontent = _this.content.width();
            var whole = ~~(enterycontent / (elementwidth));
            if (whole > count) whole = count;
            if (whole == 0) {
                return false;
            }
            else {
                var sectionwidth = whole * elementwidth + (whole - 1) * 20;
            }
            _this.container.css({
                "width": sectionwidth,
                "max-width": "100%",
                "margin": "0px auto",
                "overflow": "hidden"
            });
            var loadInterval = setInterval(function(){
                galleryImgIsotope(_this.container.children(), 'reLayout');
            },100);
            setTimeout(function(){clearInterval(loadInterval);},7000);
        }
    };

    _this.addEventListeners = function () {
        _this.container.on('click', '.ph-g-wp-gallery-image-overlay a', _this.overlayClick);
        _this.popupCloseButton.on('click', _this.closePopup);
        _this.body.on('click', '#ph-g-wp-popup-overlay-image', _this.closePopup);
        _this.playIcon.on('click', _this.playVideo);
        _this.leftButton.on('click', _this.leftChange);
        _this.rightButton.on('click', _this.rightChange);
        _this.body.keydown(_this.changeRightAndLeft);
        _this.loadMoreBtn.on('click', _this.loadMoreBtnClick);
        jQuery(window).resize(_this.resizeEvent);
    };
    _this.overlayClick = function () {
        var strid = jQuery(this).attr('href').replace('#', '');
        jQuery(this).parents('body').append('<div id="ph-g-wp-popup-overlay-image"></div>');
        _this.popupList.insertBefore('#ph-g-wp-popup-overlay-image');
        var height = jQuery(window).height();
        var width = jQuery(window).width();
        if (width <= 767) {
            jQuery(window).scrollTop(0);
            _this.popupList.find('.popup-wrapper .image-block iframe').height(jQuery('body').width() * 0.5);
        } else {
            _this.popupList.find('.popup-wrapper .image-block iframe').height(jQuery('body').width() * 0.23);
        }
        _this.popupList.find('#ph-g-wp_pupup_element_' + strid).addClass('active').css({height: height * 0.7});
        _this.popupList.addClass('active');


        if (jQuery('.pupup-element.active .description').height() + jQuery('.right-block h3').height() + 200 > jQuery('.pupup-element.active .right-block').height()) {
            if (jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block').height()) {
                jQuery('.pupup-element.active .right-block').css('overflow-y', '');
                jQuery('.pupup-element.active .popup-wrapper').css('overflow-y', 'auto');
            } else {
                jQuery('.pupup-element.active .right-block').css('overflow-y', 'auto');
            }
        } else {
            if (jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block').height()) {
                jQuery('.pupup-element.active .popup-wrapper').css('overflow-y', 'auto');
            }
        }


        return false;
    };
    _this.leftChange = function () {
        var height = jQuery(window).height();
        var num = jQuery(this).find("a").attr("href").replace('#', '');
        if(_this.popupList.find('.pupup-element.active .image-block iframe').length) {
            var videoSrc = _this.popupList.find('.pupup-element.active .image-block iframe').attr('src');
            videoSrc += 'autoplay=0';
            _this.popupList.find('.pupup-element.active .image-block iframe').attr('src', videoSrc);
        }
        if (num >= 1) {
            var strid = jQuery(this).closest(".pupup-element").prev(".pupup-element").find('a').data('popupid').replace('#', '');
            _this.popupList.find('#ph-g-wp_pupup_element_' + strid).css({height: height * 0.7});
            jQuery(this).closest(".pupup-element").removeClass("active");
            jQuery(this).closest(".pupup-element").prev(".pupup-element").addClass("active");
        } else {
            var strid = _this.popupList.find(".pupup-element").last().find('a').data('popupid').replace('#', '');
            _this.popupList.find('#ph-g-wp_pupup_element_' + strid).css({height: height * 0.7});
            jQuery(this).closest(".pupup-element").removeClass("active");
            _this.popupList.find(".pupup-element").last().addClass("active");
        }

        if (jQuery('.pupup-element.active .description').height() + jQuery('.right-block h3').height() + 200 > jQuery('.pupup-element.active .right-block').height()) {
            if (jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block').height()) {
                jQuery('.pupup-element.active .right-block').css('overflow-y', '');
                jQuery('.pupup-element.active .popup-wrapper').css('overflow-y', 'auto');
            } else {
                jQuery('.pupup-element.active .right-block').css('overflow-y', 'auto');
            }
        } else {
            if (jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block').height()) {
                jQuery('.pupup-element.active .popup-wrapper').css('overflow-y', 'auto');
            }
        }
    };
    _this.rightChange = function () {
        var height = jQuery(window).height();
        var num = jQuery(this).find("a").attr("href").replace('#', '');
        var cnt = 0;
        if(_this.popupList.find('.pupup-element.active .image-block iframe').length) {
            var videoSrc = _this.popupList.find('.pupup-element.active .image-block iframe').attr('src');
            videoSrc += '?autoplay=0';
            _this.popupList.find('.pupup-element.active .image-block iframe').attr('src', videoSrc);
        }
        _this.popupList.find(".pupup-element").each(function () {
            cnt++;
        });
        if (num <= cnt) {
            var strid = jQuery(this).closest(".pupup-element").next(".pupup-element").find('a').data('popupid').replace('#', '');
            _this.popupList.find('#ph-g-wp_pupup_element_' + strid).css({height: height * 0.7});
            jQuery(this).closest(".pupup-element").removeClass("active");
            jQuery(this).closest(".pupup-element").next(".pupup-element").addClass("active");
        } else {
            var strid = _this.popupList.find(".pupup-element:first-child a").data('popupid').replace('#', '');
            _this.popupList.find('#ph-g-wp_pupup_element_' + strid).css({height: height * 0.7});
            jQuery(this).closest(".pupup-element").removeClass("active");
            _this.popupList.find(".pupup-element:first-child").addClass("active");
        }

        if (jQuery('.pupup-element.active .description').height() + jQuery('.right-block h3').height() + 200 > jQuery('.pupup-element.active .right-block').height()) {
            if (jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block').height()) {
                jQuery('.pupup-element.active .right-block').css('overflow-y', '');
                jQuery('.pupup-element.active .popup-wrapper').css('overflow-y', 'auto');
            } else {
                jQuery('.pupup-element.active .right-block').css('overflow-y', 'auto');
            }
        } else {
            if (jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block').height()) {
                jQuery('.pupup-element.active .popup-wrapper').css('overflow-y', 'auto');
            }
        }
    };
    _this.closePopup = function () {
        jQuery('#ph-g-wp-popup-overlay-image').remove();
        var videsrc = _this.popupList.find('li.active iframe').attr('src');
        _this.popupList.find('li.active iframe').attr('src', '');
        _this.popupList.find('li.active iframe').attr('src', videsrc);
        _this.popupList.find('li').removeClass('active');
        _this.popupList.removeClass('active');
    };
    _this.changeRightAndLeft = function (e) {
        if (e.keyCode == 37) {
            _this.popupList.find('li.active .heading-navigation .left-change').click();
        }
        if (e.keyCode == 39) {
            _this.popupList.find('li.active .heading-navigation .right-change').click();
        }
        if (e.keyCode == 27) {
            _this.closePopup();
        }
    };
    _this.playVideo = function () {
        new_video_id = jQuery(this).attr("title");
        var showcontrols, new_video_id, prefix, add_src;
        if (!new_video_id)
            return;
        if (new_video_id.length == 11) {
            showcontrols = "?modestbranding=1&showinfo=0&controls=1";
            prefix = "//www.youtube.com/embed/";
        } else {
            showcontrols = "?title=0&amp;byline=0&amp;portrait=0";
            prefix = "//player.vimeo.com/video/";

        }
        add_src = prefix + new_video_id + showcontrols;
        var left_block = jQuery(this).parents('.right-block').prev();
        if (left_block.find('iframe').length != 0)
            left_block.find('iframe').attr('src', add_src);
        else
            left_block.html('<iframe src="' + add_src + '" frameborder allowfullscreen></iframe> ');

        return false;
    };
    _this.resizeEvent = function () {
        var iframeHeight = _this.popupList.find('.popup-wrapper .image-block').width() * 0.5;
        _this.popupList.find('.popup-wrapper .image-block iframe').height(iframeHeight);
        galleryImgIsotope(_this.container.children(), 'reLayout');
        _this.showCenter();

    };
    _this.imagesBehavior = function () {
        _this.container.find('.ph_element .image-block img').each(function (i, img) {
            var naturalRatio = jQuery(this).prop('naturalWidth') / jQuery(this).prop('naturalHeight');
            var defaultRatio = _this.defaultBlockWidth / _this.defaultBlockHeight;
            if (naturalRatio <= defaultRatio) {
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
    _this.loadMoreBtnClick = function () {
        var contentLoadNonce = jQuery(this).attr('data-content-nonce-value');
        if (parseInt(_this.content.find(".pagenum:last").val()) < parseInt(_this.container.find("#total").val())) {
            var pagenum = parseInt(_this.content.find(".pagenum:last").val()) + 1;
            var perpage = gallery_obj[0].content_per_page;
            var galleryid = gallery_obj[0].id;
            var linkbutton = param_obj.ht_view2_element_linkbutton_text;
            var showbutton = param_obj.ht_view2_element_show_linkbutton;
            var pID = postID;
            var likeStyle = _this.ratingType;
            var ratingCount = param_obj.ht_popup_rating_count;
            _this.getResult(pagenum, perpage, galleryid, linkbutton, showbutton, pID, likeStyle, ratingCount,contentLoadNonce);
        } else {
            _this.loadMoreBtn.hide();
        }
        return false;
    };
    _this.getResult = function (pagenum, perpage, galleryid, linkbutton, showbutton, pID, likeStyle, ratingCount,contentLoadNonce) {
        var data = {
            action: "photo_gallery_wp_load_images_content",
            task: 'load_images_content',
            page: pagenum,
            perpage: perpage,
            galleryid: galleryid,
            linkbutton: linkbutton,
            showbutton: showbutton,
            pID: pID,
            likeStyle: likeStyle,
            ratingCount: ratingCount,
            photoGalleryWpContentLoadNonce:contentLoadNonce
        };
        _this.loadingIcon.show();
        _this.loadMoreBtn.hide();
        jQuery.post(adminUrl, data, function (response) {
                if (response.success) {
                    var $objnewitems = jQuery(response.success);
                    _this.container.children().append($objnewitems);
                    setTimeout(function () {
                        galleryImgIsotope(_this.container.children().first(), 'reloadItems');
                        galleryImgIsotope(_this.container.children().first(), {sortBy: 'original-order'});
                        galleryImgIsotope(_this.container.children().first(), 'reLayout');
                    }, 100);

                    _this.container.children().find('img').on('load', function () {
                        var defaultBlockHeight = param_obj.view2_element_height + 37;
                        var defaultBlockWidth = param_obj.view2_element_width;
                        var options2 = {
                            itemSelector: '.ph_element',
                            masonry: {
                                columnWidth: defaultBlockWidth + 20 + param_obj.view2_element_border_width * 2
                            },
                            masonryHorizontal: {
                                rowHeight: defaultBlockHeight + 20
                            },
                            cellsByRow: {
                                columnWidth: defaultBlockWidth + 20,
                                rowHeight: defaultBlockHeight
                            },
                            cellsByColumn: {
                                columnWidth: defaultBlockWidth + 20,
                                rowHeight: defaultBlockHeight
                            },
                            getSortData: {
                                symbol: function ($elem) {
                                    return $elem.attr('data-symbol');
                                },
                                category: function ($elem) {
                                    return $elem.attr('data-category');
                                },
                                number: function ($elem) {
                                    return parseInt($elem.find('.number').text(), 10);
                                },
                                weight: function ($elem) {
                                    return parseFloat($elem.find('.weight').text().replace(/[\(\)]/g, ''));
                                },
                                name: function ($elem) {
                                    return $elem.find('.name').text();
                                }
                            }
                        };
                        galleryImgIsotope(_this.container.children(), options2);
                        if (param_obj.ht_view2_content_in_center == 'on') {
                            _this.showCenter();
                        }
                    });
                    _this.loadMoreBtn.show();
                    _this.loadingIcon.hide();
                    if (_this.content.find(".pagenum:last").val() == _this.content.find("#total").val()) {
                        _this.loadMoreBtn.hide();
                    }
                    photoGalleryCountsOptimize(_this.container, _this.ratingType);
                    if (param_obj.image_natural_size_contentpopup == 'natural') {
                        setTimeout(function () {
                            _this.imagesBehavior();
                        }, 100);
                    }
                }
                else {
                    alert("no");
                }
            }
            , "json");
    };
    _this.init = function () {
        _this.showCenter();
        _this.documentReady();
        _this.addEventListeners();
        if (_this.imageBehaiour == 'natural') {
            _this.imagesBehavior();
        }
    };

    this.init();
}
var galleries = [];
jQuery(document).ready(function () {
    jQuery(".ph-g-wp_gallery_container.view-content-popup").each(function (i) {
        var id = jQuery(this).attr('id');
        galleries[i] = new Ph_Gallery_Content_Popup(id);
    });
});

