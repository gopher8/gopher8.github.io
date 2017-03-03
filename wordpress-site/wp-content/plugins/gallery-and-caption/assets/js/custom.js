function galleryImgIsotope(elem,option){
    if(typeof elem.isotope == 'function'){
        elem.isotope(option);
    }
    else{
        elem.hugeitmicro(option);
    }
}
function galleryImgRandomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
}
function galleryImgSetCookie(name, value, expires, path, domain, secure) {
    document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}
function galleryImgGetCookie(name) {
    var cookie = " " + document.cookie;
    var search = " " + name + "=";
    var setStr = null;
    var offset = 0;
    var end = 0;
    if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = cookie.indexOf(";", offset)
            if (end == -1) {
                end = cookie.length;
            }
            setStr = unescape(cookie.substring(offset, end));
        }
    }
    return (setStr);
}
function galleryImgDelCookie(name) {
    document.cookie = name + "=" + "; expires=Thu, 01 Jan 1970 00:00:01 GMT";
}
function photoGalleryCountsOptimize(container, ratingType) {
    if (ratingType != 'heart') {
        container.find('.ph-g-wp_like_count').each(function () {
            if (jQuery(this).text() < 0)jQuery(this).text(0);
            if ((jQuery(this).text().length > 3 || jQuery(this).text().length > 4 || jQuery(this).text().length > 5) && jQuery(this).text().length < 7) {
                jQuery(this).text(function (_, txt) {
                    return txt.slice(0, -3) + 'k'
                });
            }
            else if ((jQuery(this).text().length > 6 || jQuery(this).text().length > 7 || jQuery(this).text().length > 8) && jQuery(this).text().length < 10) {
                jQuery(this).text(function (_, txt) {
                    return txt.slice(0, -6) + 'm'
                });
            }
            else if (jQuery(this).text().length > 9 || jQuery(this).text().length > 10 || jQuery(this).text().length > 11) {
                jQuery(this).text(function (_, txt) {
                    return txt.slice(0, -9) + 'b'
                });
            }
        });
        container.find('.huge_it_dislike_count').each(function () {
            if (jQuery(this).text() < 0)jQuery(this).text(0);
            if ((jQuery(this).text().length > 3 || jQuery(this).text().length > 4 || jQuery(this).text().length > 5) && jQuery(this).text().length < 7) {
                jQuery(this).text(function (_, txt) {
                    return txt.slice(0, -3) + 'k'
                });
            }
            else if ((jQuery(this).text().length > 6 || jQuery(this).text().length > 7 || jQuery(this).text().length > 8) && jQuery(this).text().length < 10) {
                jQuery(this).text(function (_, txt) {
                    return txt.slice(0, -6) + 'm'
                });
            }
            else if (jQuery(this).text().length > 9 || jQuery(this).text().length > 10 || jQuery(this).text().length > 11) {
                jQuery(this).text(function (_, txt) {
                    return txt.slice(0, -9) + 'b'
                });
            }
        })
    }
    if (ratingType == 'heart') {
        container.find('.huge_it_like_thumb').each(function () {
            if (jQuery(this).text() < 0)jQuery(this).text(0);
            var currentNum = jQuery(this).text();
            var resNum = jQuery.trim(currentNum);
            if ((resNum.length > 3 || resNum.length > 4 || resNum.length > 5) && resNum.length < 7) {
                return jQuery(this).text(resNum.slice(0, -3) + 'k');
            }
            else if ((resNum.length > 6 || resNum.length > 7 || resNum.length > 8) && resNum.length < 10) {
                return jQuery(this).text(resNum.slice(0, -6) + 'm');
            }
            else if (resNum.length > 9 || resNum.length > 10 || resNum.length > 11) {
                return jQuery(this).text(resNum.slice(0, -9) + 'b');
            }
        });
        var thumbLike;
        container.find('.huge_it_like_thumb').each(function () {
            thumbLike = jQuery(this).attr('data-status');
            if (thumbLike == 'liked') {
                jQuery(this).parent().find('.likeheart').addClass('like_thumb_active');
                jQuery(this).parent().find('.huge_it_like_thumb').addClass('like_font_active');
            }
        });
    }
    else {
        var thumbLike;
        container.find('.huge_it_like_thumb').each(function () {
            thumbLike = jQuery(this).attr('data-status');
            if (thumbLike == 'liked') {
                jQuery(this).parent().find('.like_thumb_up').addClass('like_thumb_active');
                jQuery(this).parent().addClass('like_font_active');
            }
        });
        var thumbDislike;
        container.find('.huge_it_dislike_thumb').each(function () {
            thumbDislike = jQuery(this).attr('data-status');
            if (thumbDislike == 'disliked') {
                jQuery(this).parent().find('.dislike_thumb_down').addClass('like_thumb_active');
                jQuery(this).parent().addClass('like_font_active');
            }
        });
    }
};
function galleryImgRatingClick(e) {
    var ratingType = jQuery(e.target).parents('.gallery-img-content').data('rating-type');
    var image_id = jQuery(this).parent().find('.ph-g-wp_like_count').attr('id');
    var status = jQuery("span.huge_it_like_thumb[id='" + image_id + "']").attr('data-status');
    var resStatus = jQuery(this).parent().find("span.huge_it_like_thumb[id='" + image_id + "']").attr('data-status');
    var resStatus2 = jQuery(".huge_it_dislike_thumb[id='" + image_id + "']").attr('data-status');
    if (ratingType == 'heart') {
        if (resStatus == 'unliked') {
            jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.likeheart').addClass('like_thumb_active');
            jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.huge_it_like_thumb').addClass('like_font_active');
            //jQuery("span.huge_it_like_thumb[id='"+image_id+"']").attr('data-status','liked')
        } else if (resStatus == 'liked') {
            jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.likeheart').removeClass('like_thumb_active').addClass('likeheart');
            jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.huge_it_like_thumb').removeClass('like_font_active');
            //jQuery("span.huge_it_like_thumb[id='"+image_id+"']").attr('data-status','unliked')
            //galleryImgDelCookie('Like_'+image_id);
        }
    }
    /////////////////////////////
    if (resStatus2 == undefined) {
        if (resStatus == 'unliked') {
            date = new Date();
            date.setHours(date.getFullYear() + 1);
            var cookie = galleryImgSetCookie('Like_' + image_id, galleryImgRandomString(10, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), date.toUTCString());
        } else if (resStatus == 'liked') {
            var cookie = galleryImgGetCookie('Like_' + image_id);
        }
    } else {
        if (resStatus == 'unliked' && resStatus2 == 'unliked') {
            date = new Date();
            date.setHours(date.getFullYear() + 1);
            var cookie = galleryImgSetCookie('Like_' + image_id, galleryImgRandomString(10, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), date.toUTCString());
        } else if (resStatus == 'unliked' && resStatus2 == 'disliked') {
            date = new Date();
            date.setHours(date.getFullYear() + 1);
            var newCookie = galleryImgGetCookie('Dislike_' + image_id);
            var cookie = galleryImgSetCookie('Like_' + image_id, newCookie, date.toUTCString());
            galleryImgDelCookie('Dislike_' + image_id);
        } else if (resStatus == 'liked') {
            var cookie = galleryImgGetCookie('Like_' + image_id);
        }
    }
    var data = {
        action: 'photo_gallery_wp_like_dislike',
        task: 'like',
        image_id: image_id,
        cook: galleryImgGetCookie('Like_' + image_id),
        status: status
    };
    jQuery.post(adminUrl, data, function (response) {
        if (response) {
            response = JSON.parse(response);
            if (response.like) {
                var likeNumber = response.like;
                if ((likeNumber.length > 3 || likeNumber.length > 4 || likeNumber.length > 5) && likeNumber.length < 7) {
                    likeNumber = likeNumber.slice(0, -3) + 'k';
                }
                else if ((likeNumber.length > 6 || likeNumber.length > 7 || likeNumber.length > 8) && likeNumber.length < 10) {
                    likeNumber = likeNumber.slice(0, -6) + 'm';
                }
                else if (likeNumber.length > 9 || likeNumber.length > 10 || likeNumber.length > 11) {
                    likeNumber = likeNumber.slice(0, -9) + 'b';
                }
                response.like = likeNumber;
            }
            if (response.dislike) {
                var dislikeNumber = response.dislike;
                if ((dislikeNumber.length > 3 || dislikeNumber.length > 4 || dislikeNumber.length > 5) && dislikeNumber.length < 7) {
                    dislikeNumber = dislikeNumber.slice(0, -3) + 'k';
                }
                else if ((dislikeNumber.length > 6 || dislikeNumber.length > 7 || dislikeNumber.length > 8) && dislikeNumber.length < 10) {
                    dislikeNumber = dislikeNumber.slice(0, -6) + 'm';
                }
                else if (dislikeNumber.length > 9 || dislikeNumber.length > 10 || dislikeNumber.length > 11) {
                    dislikeNumber = dislikeNumber.slice(0, -9) + 'b';
                }
                response.dislike = dislikeNumber;
            }
            if (ratingType != 'heart') {
                if (response.like < 0)response.like = 0;
                jQuery("span.ph-g-wp_like_count[id='" + image_id + "']").text(response.like);
            }
            if (ratingType == 'heart') {
                if (response.like < 0)response.like = 0;
                jQuery("span.huge_it_like_thumb[id='" + image_id + "']").text(response.like);
            }
            if (response.dislike < 0)response.dislike = 0;
            jQuery("span.huge_it_dislike_count[id='" + image_id + "']").text(response.dislike);
            //jQuery("span.huge_it_dislike_thumb[id='"+image_id+"']").text(response.statDislike);
            if (ratingType == 'heart') {
                if (response.statLike == 'Liked') {
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.likeheart').addClass('like_thumb_active');
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.huge_it_like_thumb').addClass('like_font_active');
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").attr('data-status', 'liked')
                } else if (response.statLike == 'Like') {
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.likeheart').removeClass('like_thumb_active').addClass('likeheart');
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.huge_it_like_thumb').removeClass('like_font_active');
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").attr('data-status', 'unliked')
                    galleryImgDelCookie('Like_' + image_id);
                }
            }
            else {
                if (response.statLike == 'Liked') {
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.like_thumb_up').addClass('like_thumb_active');
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().addClass('like_font_active');
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").attr('data-status', 'liked')
                } else if (response.statLike == 'Like') {
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.like_thumb_up').removeClass('like_thumb_active').addClass('like_thumb_up');
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().removeClass('like_font_active');
                    jQuery("span.huge_it_like_thumb[id='" + image_id + "']").attr('data-status', 'unliked')
                    galleryImgDelCookie('Like_' + image_id);
                }
            }
            if (response.statDislike == 'Disliked') {
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").parent().find('.dislike_thumb_down').addClass('like_thumb_active');
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").parent().addClass('like_font_active');
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").attr('data-status', 'disliked')
            } else if (response.statDislike == 'Dislike') {
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").parent().find('.dislike_thumb_down').removeClass('like_thumb_active').addClass('dislike_thumb_down');
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").parent().removeClass('like_font_active');
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").attr('data-status', 'unliked')
            }
        }
    });
    return false;
}
function galleryImgDislikeClick() {
    var image_id = jQuery(this).parent().find('.huge_it_dislike_count').attr('id');
    var resStatus = jQuery(this).parent().find("span.huge_it_dislike_thumb[id='" + image_id + "']").attr('data-status');
    var resStatus2 = jQuery(".huge_it_like_thumb[id='" + image_id + "']").attr('data-status');
    if (resStatus == 'unliked' && resStatus2 == 'unliked') {
        date = new Date();
        date.setHours(date.getFullYear() + 1);
        var cook = galleryImgSetCookie('Dislike_' + image_id, galleryImgRandomString(10, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), date.toUTCString());
    } else if (resStatus == 'unliked' && resStatus2 == 'liked') {
        date = new Date();
        date.setHours(date.getFullYear() + 1);
        var newCookie = galleryImgGetCookie('Like_' + image_id);
        var cook = galleryImgSetCookie('Dislike_' + image_id, newCookie, date.toUTCString());
        galleryImgDelCookie('Like_' + image_id);
    } else if (resStatus == 'disliked') {
        var cook = galleryImgGetCookie('Dislike_' + image_id);
    }
    var data = {
        action: 'photo_gallery_wp_like_dislike',
        task: 'dislike',
        image_id: image_id,
        cook: galleryImgGetCookie('Dislike_' + image_id)
    };
    jQuery.post(adminUrl, data, function (response) {
        if (response) {
            response = JSON.parse(response);
            if (response.like) {
                var likeNumber = response.like;
                if ((likeNumber.length > 3 || likeNumber.length > 4 || likeNumber.length > 5) && likeNumber.length < 7) {
                    likeNumber = likeNumber.slice(0, -3) + 'k';
                }
                else if ((likeNumber.length > 6 || likeNumber.length > 7 || likeNumber.length > 8) && likeNumber.length < 10) {
                    likeNumber = likeNumber.slice(0, -6) + 'm';
                }
                else if (likeNumber.length > 9 || likeNumber.length > 10 || likeNumber.length > 11) {
                    likeNumber = likeNumber.slice(0, -9) + 'b';
                }
                response.like = likeNumber;
            }
            if (response.dislike) {
                var dislikeNumber = response.dislike;
                if ((dislikeNumber.length > 3 || dislikeNumber.length > 4 || dislikeNumber.length > 5) && dislikeNumber.length < 7) {
                    dislikeNumber = dislikeNumber.slice(0, -3) + 'k';
                }
                else if ((dislikeNumber.length > 6 || dislikeNumber.length > 7 || dislikeNumber.length > 8) && dislikeNumber.length < 10) {
                    dislikeNumber = dislikeNumber.slice(0, -6) + 'm';
                }
                else if (dislikeNumber.length > 9 || dislikeNumber.length > 10 || dislikeNumber.length > 11) {
                    dislikeNumber = dislikeNumber.slice(0, -9) + 'b';
                }
                response.dislike = dislikeNumber;
            }
            if (response.like < 0)response.like = 0;
            jQuery("span.ph-g-wp_like_count[id='" + image_id + "']").text(response.like);
            if (response.dislike < 0)response.dislike = 0;
            jQuery("span.huge_it_dislike_count[id='" + image_id + "']").text(response.dislike);
            if (response.statLike == 'Liked') {
                jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.like_thumb_up').addClass('like_thumb_active');
                jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().addClass('like_font_active');
                jQuery("span.huge_it_like_thumb[id='" + image_id + "']").attr('data-status', 'liked')
            } else if (response.statLike == 'Like') {
                jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().find('.like_thumb_up').removeClass('like_thumb_active').addClass('like_thumb_up');
                jQuery("span.huge_it_like_thumb[id='" + image_id + "']").parent().removeClass('like_font_active');
                jQuery("span.huge_it_like_thumb[id='" + image_id + "']").attr('data-status', 'unliked')
                galleryImgDelCookie('Like_' + image_id);
            }
            if (response.statDislike == 'Disliked') {
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").parent().find('.dislike_thumb_down').addClass('like_thumb_active');
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").parent().addClass('like_font_active');
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").attr('data-status', 'disliked');
            } else if (response.statDislike == 'Dislike') {
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").parent().find('.dislike_thumb_down').removeClass('like_thumb_active').addClass('dislike_thumb_down');
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").parent().removeClass('like_font_active');
                jQuery("span.huge_it_dislike_thumb[id='" + image_id + "']").attr('data-status', 'unliked');
                galleryImgDelCookie('Dislike_' + image_id);
            }
        }
    });
    return false;
}

jQuery(document).ready(function () {
    jQuery('.gallery-img-content').on("click tap", '.ph-g-wp_gallery_like_wrapper', galleryImgRatingClick);
    jQuery('.gallery-img-content').on("click tap", '.huge_it_gallery_dislike_wrapper', galleryImgDislikeClick);
    jQuery('.ph-lightbox').lightbox();
    jQuery('.ph-lightbox').each(function () {
        jQuery(this).removeClass("cboxElement");
        jQuery(this).removeClass("responsive_lightbox");
    });
});