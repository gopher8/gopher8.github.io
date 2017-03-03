(function ($) {

    'use strict';

    function Lightbox(element, options) {

        this.el = element;
        this.$element = $(element);
        this.$body = $('body');
        this.objects = {};
        this.videoModul = {};
        this.$item = '';
        this.$cont = '';
        this.$items = this.$body.find('a.ph-lightbox');

        this.settings = $.extend({}, this.constructor.defaults, options);

        this.init();

        return this;
    }

    Lightbox.defaults = {
        idPrefix: 'rwd-',
        classPrefix: 'rwd-',
        attrPrefix: 'data-',
        slideAnimationType: 'effect_'+lightbox_obj.ph_slide_animation_type,     /*  effect_1   effect_2    effect_3
                                                effect_4   effect_5    effect_6
                                                effect_7   effect_8    effect_9   */
        lightboxView: 'view'+lightbox_obj.ph_lightbox_style_view,              //  view1, view2, view3, view4
        speed: lightbox_obj.ph_lightbox_speed,
        width: '100%',
        height: '100%',
        videoMaxWidth: '790',
        sizeFix: lightbox_obj.ph_lightbox_size_fix === 'yes',
        overlayDuration: 150,
        slideAnimation: lightbox_obj.ph_lightbox_slider_animation === 'yes',
        overlayClose: lightbox_obj.ph_lightbox_overlay_close === 'yes',
        loop: lightbox_obj.ph_lightbox_loop === 'yes',
        escKey: lightbox_obj.ph_lightbox_esc_key_close === 'yes',
        keyPress: lightbox_obj.ph_lightbox_keypress_navigation === 'yes',
        arrows: lightbox_obj.ph_lightbox_arrows === 'yes',
        mouseWheel: true,
        download: lightbox_obj.ph_lightbox_download_image === 'yes',
        showCounter: true,
        defaultTitle: lightbox_obj.ph_lightbox_default_title,
        preload: 1,
        showAfterLoad: true,
        nextHtml: '',
        prevHtml: '',
        sequence_info: '',
        sequenceInfo: 'of',
        slideshow: lightbox_obj.ph_lightbox_slideshow_on === 'yes',
        slideshowAuto: lightbox_obj.ph_lightbox_slideshow_auto === 'yes',
        slideshowSpeed: lightbox_obj.ph_lightbox_slideshow_speed,
        slideshowStart: '',
        slideshowStop: '',
        hideControlOnEnd: false,
        watermark: false,
        socialSharing: lightbox_obj.ph_lightbox_social_on_off === 'yes',
        share: {
            facebookButton: lightbox_obj.ph_lightbox_social_facebook === 'yes',
            twitterButton: lightbox_obj.ph_lightbox_social_twitter === 'yes',
            googleplusButton: lightbox_obj.ph_lightbox_social_google === 'yes',
            pinterestButton: lightbox_obj.ph_lightbox_social_pinterest === 'yes',
            linkedinButton: lightbox_obj.ph_lightbox_social_linkedin === 'yes',
            tumblrButton: lightbox_obj.ph_lightbox_social_tumblr === 'yes',
            redditButton: lightbox_obj.ph_lightbox_social_reddit === 'yes',
            bufferButton: lightbox_obj.ph_lightbox_social_buffer === 'yes',
            diggButton: lightbox_obj.ph_lightbox_social_digg === 'yes',
            vkButton: lightbox_obj.ph_lightbox_social_vk === 'yes',
            yummlyButton: lightbox_obj.ph_lightbox_social_yummly === 'yes'
        }
    };

    Lightbox.prototype.init = function () {

        var $object = this,
            $hash;

        $hash = window.location.hash;

        ($object.settings.watermark && $('.watermark').watermark());

        if ($hash.indexOf('lightbox&') > 0) {
            $object.index = parseInt($hash.split('&slide=')[1], 10) - 1;

            $object.$body.addClass('rwd-share');
            if (!$object.$body.hasClass('rwd-on')) {
                setTimeout(function () {
                    $object.build($object.index);
                }, 900);
                $object.$body.addClass('rwd-on');
            }
        }

        (($object.settings.preload > $object.$items.length) && ($object.settings.preload = $object.$items.length));

        $object.$items.on('click.rwdcustom', function (event) {

            event = event || window.event;
            event.preventDefault ? event.preventDefault() : (event.returnValue = false);

            $object.index = $object.$items.index(this);

            if (!$object.$body.hasClass($object.settings.classPrefix + 'on')) {
                $object.build($object.index);
                $object.$body.addClass($object.settings.classPrefix + 'on');
            }
        });

    };

    Lightbox.prototype.build = function (index) {

        var $object = this;

        $object.structure();

        $object.videoModul['video'] = new $.fn.lightbox.videoModul['video']($object.el);

        $object.slide(index, false, false);

        ($object.settings.keyPress && $object.addKeyEvents());

        if ($object.$items.length > 1) {

            $object.arrow();

            ($object.settings.mouseWheel && $object.mousewheel());

            ($object.settings.slideshow && $object.slideShow());

        }

        $object.counter();

        $object.closeGallery();

        $object.$cont.on('click.rwd-container', function () {

            $object.$cont.removeClass($object.settings.classPrefix + 'hide-items');

        });

        $('.shareLook').on('click.rwd-container', function(){
            $(this).css({'display' : 'none'});
            $('.rwd-share-buttons').css({'display' : 'block'});
            setTimeout(function(){
                $('.shareLook').css({'display' : 'block'});
                $('.rwd-share-buttons').css({'display' : 'none'});
            }, 9000);
        });

        $object.calculateDimensions();

    };

    Lightbox.prototype.structure = function () {

        var $object = this, list = '', controls = '',i,
            subHtmlCont1 = '', subHtmlCont2 = '',
            close1 = '', close2 = '', socialIcons = '',
            template, $arrows, $next, $prev,
            $_next, $_prev, $close_bg, $download_bg;

        this.$body.append(
            this.objects.overlay = $('<div class="' + this.settings.classPrefix + 'overlay"></div>')
        );
        this.objects.overlay.css('transition-duration', this.settings.overlayDuration + 'ms');

        for (i = 0; i < this.$items.length; i++) {
            list += '<div class="' + this.settings.classPrefix + 'item"></div>';
        }

        $close_bg    = '<svg class="close_bg" width="16px" height="16px" fill="#999" viewBox="-341 343.4 15.6 15.6">' +
            '<path d="M-332.1,351.2l6.5-6.5c0.3-0.3,0.3-0.8,0-1.1s-0.8-0.3-1.1,0l-6.5,6.5l-6.5-6.5c-0.3-0.3-0.8-0.3-1.1,0s-0.3,0.8,0,1.1l6.5,6.5l-6.5,6.5c-0.3,0.3-0.3,0.8,0,1.1c0.1,0.1,0.3,0.2,0.5,0.2s0.4-0.1,0.5-0.2l6.5-6.5l6.5,6.5c0.1,0.1,0.3,0.2,0.5,0.2s0.4-0.1,0.5-0.2c0.3-0.3,0.3-0.8,0-1.1L-332.1,351.2z"/>' +
            '</svg>';

        switch (this.settings.lightboxView) {
            case 'view1':
            default:
                $_next       = '<svg class="next_bg" width="22px" height="22px" fill="#999" viewBox="-333 335.5 31.5 31.5" >' +
                    '<path d="M-311.8,340.5c-0.4-0.4-1.1-0.4-1.6,0c-0.4,0.4-0.4,1.1,0,1.6l8,8h-26.6c-0.6,0-1.1,0.5-1.1,1.1s0.5,1.1,1.1,1.1h26.6l-8,8c-0.4,0.4-0.4,1.2,0,1.6c0.4,0.4,1.2,0.4,1.6,0l10-10c0.4-0.4,0.4-1.1,0-1.6L-311.8,340.5z"/>' +
                    '</svg>';
                $_prev       = '<svg class="prev_bg" width="22px" height="22px" fill="#999" viewBox="-333 335.5 31.5 31.5" >' +
                    '<path d="M-322.7,340.5c0.4-0.4,1.1-0.4,1.6,0c0.4,0.4,0.4,1.1,0,1.6l-8,8h26.6c0.6,0,1.1,0.5,1.1,1.1c0,0.6-0.5,1.1-1.1,1.1h-26.6l8,8c0.4,0.4,0.4,1.2,0,1.6c-0.4,0.4-1.1,0.4-1.6,0l-10-10c-0.4-0.4-0.4-1.1,0-1.6L-322.7,340.5z"/>' +
                    '</svg>';
                subHtmlCont1 = '<div class="' + this.settings.classPrefix + 'title"></div>';
                close1 = '<span class="' + this.settings.classPrefix + 'close ' + $object.settings.classPrefix + 'icon">' + $close_bg + '</span>';
               break;
            case 'view2':
                $_next       = '<svg class="next_bg" width="22px" height="22px" fill="#999" viewBox="-123 125.2 451.8 451.8" >' +
                    '<g><path d="M222.4,373.4L28.2,567.7c-12.4,12.4-32.4,12.4-44.8,0c-12.4-12.4-12.4-32.4,0-44.7l171.9-171.9L-16.6,179.2c-12.4-12.4-12.4-32.4,0-44.7c12.4-12.4,32.4-12.4,44.8,0l194.3,194.3c6.2,6.2,9.3,14.3,9.3,22.4C231.7,359.2,228.6,367.3,222.4,373.4z"/></g>' +
                    '</svg>';
                $_prev       = '<svg class="prev_bg" width="22px" height="22px" fill="#999" viewBox="-123 125.2 451.8 451.8" >' +
                    '<g><path d="M-25.9,351.1c0-8.1,3.1-16.2,9.3-22.4l194.3-194.3c12.4-12.4,32.4-12.4,44.8,0c12.4,12.4,12.4,32.4,0,44.7L50.5,351.1L222.4,523c12.4,12.4,12.4,32.4,0,44.7c-12.4,12.4-32.4,12.4-44.7,0L-16.6,373.4C-22.8,367.3-25.9,359.2-25.9,351.1z"/></g>' +
                    '</svg>';
                subHtmlCont2 = '<div class="' + this.settings.classPrefix + 'title"></div>';
                close2       = '<div class="barCont"></div><span class="' + this.settings.classPrefix + 'close ' + $object.settings.classPrefix + 'icon">' + $close_bg + '</span>';
                break;
            case 'view3':
                $_next       = '<svg class="next_bg" width="22px" height="22px" fill="#999" viewBox="-104 105.6 490.4 490.4" >' +
                    '<g><g><path d="M141.2,596c135.2,0,245.2-110,245.2-245.2s-110-245.2-245.2-245.2S-104,215.6-104,350.8S6,596,141.2,596z M141.2,130.1c121.7,0,220.7,99,220.7,220.7s-99,220.7-220.7,220.7s-220.7-99-220.7-220.7S19.5,130.1,141.2,130.1z"/>' +
                    '<path d="M34.7,363.1h183.4l-48,48c-4.8,4.8-4.8,12.5,0,17.3c2.4,2.4,5.5,3.6,8.7,3.6s6.3-1.2,8.7-3.6l68.9-68.9c4.8-4.8,4.8-12.5,0-17.3l-68.9-68.9c-4.8-4.8-12.5-4.8-17.3,0s-4.8,12.5,0,17.3l48,48H34.7c-6.8,0-12.3,5.5-12.3,12.3C22.4,357.7,27.9,363.1,34.7,363.1z"/></g></g>' +
                    '</svg>';
                $_prev       = '<svg class="prev_bg" width="22px" height="22px" fill="#999" viewBox="-104 105.6 490.4 490.4" >' +
                    '<g><g><path d="M141.2,596c135.2,0,245.2-110,245.2-245.2s-110-245.2-245.2-245.2S-104,215.6-104,350.8S6,596,141.2,596z M141.2,130.1c121.7,0,220.7,99,220.7,220.7s-99,220.7-220.7,220.7s-220.7-99-220.7-220.7S19.5,130.1,141.2,130.1z"/>' +
                    '<path d="M94.9,428.4c2.4,2.4,5.5,3.6,8.7,3.6s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-48-48h183.4c6.8,0,12.3-5.5,12.3-12.3c0-6.8-5.5-12.3-12.3-12.3H64.3l48-48c4.8-4.8,4.8-12.5,0-17.3c-4.8-4.8-12.5-4.8-17.3,0l-68.9,68.9c-4.8,4.8-4.8,12.5,0,17.3L94.9,428.4z"/></g></g>' +
                    '</svg>';
                subHtmlCont1 = '<div class="' + this.settings.classPrefix + 'title"></div>';
                close1       = '<span class="' + this.settings.classPrefix + 'close ' + $object.settings.classPrefix + 'icon">' + $close_bg + '</span>';
                break;
            case 'view4':
                $_next       = '<svg class="next_bg" width="22px" height="22px" fill="#999" viewBox="-123 125.2 451.8 451.8" >' +
                    '<g><path d="M222.4,373.4L28.2,567.7c-12.4,12.4-32.4,12.4-44.8,0c-12.4-12.4-12.4-32.4,0-44.7l171.9-171.9L-16.6,179.2c-12.4-12.4-12.4-32.4,0-44.7c12.4-12.4,32.4-12.4,44.8,0l194.3,194.3c6.2,6.2,9.3,14.3,9.3,22.4C231.7,359.2,228.6,367.3,222.4,373.4z"/></g>' +
                    '</svg>';
                $_prev       = '<svg class="prev_bg" width="22px" height="22px" fill="#999" viewBox="-123 125.2 451.8 451.8" >' +
                    '<g><path d="M-25.9,351.1c0-8.1,3.1-16.2,9.3-22.4l194.3-194.3c12.4-12.4,32.4-12.4,44.8,0c12.4,12.4,12.4,32.4,0,44.7L50.5,351.1L222.4,523c12.4,12.4,12.4,32.4,0,44.7c-12.4,12.4-32.4,12.4-44.7,0L-16.6,373.4C-22.8,367.3-25.9,359.2-25.9,351.1z"/></g>' +
                    '</svg>';
                $close_bg    = '<svg class="close_bg" width="16px" height="16px" fill="#999" viewBox="-341 343.4 15.6 15.6">' +
                    '<path d="M-332.1,351.2l6.5-6.5c0.3-0.3,0.3-0.8,0-1.1s-0.8-0.3-1.1,0l-6.5,6.5l-6.5-6.5c-0.3-0.3-0.8-0.3-1.1,0s-0.3,0.8,0,1.1l6.5,6.5l-6.5,6.5c-0.3,0.3-0.3,0.8,0,1.1c0.1,0.1,0.3,0.2,0.5,0.2s0.4-0.1,0.5-0.2l6.5-6.5l6.5,6.5c0.1,0.1,0.3,0.2,0.5,0.2s0.4-0.1,0.5-0.2c0.3-0.3,0.3-0.8,0-1.1L-332.1,351.2z"/>' +
                    '</svg>';
                subHtmlCont2 = '<div class="' + this.settings.classPrefix + 'title"></div>';
                close1 = '<span class="' + this.settings.classPrefix + 'close ' + $object.settings.classPrefix + 'icon">' + $close_bg + '</span>';
                break;
        }

        if (this.settings.arrows && this.$items.length > 1) {
            controls = '<div class="' + this.settings.classPrefix + 'arrows">' +
                '<div class="' + this.settings.classPrefix + 'prev ' + $object.settings.classPrefix + 'icon">' + $_prev + this.settings.prevHtml + '</div>' +
                '<div class="' + this.settings.classPrefix + 'next ' + $object.settings.classPrefix + 'icon">' + $_next + this.settings.nextHtml + '</div>' +
                '</div>';
        }

        if (this.settings.socialSharing) {
            socialIcons = '<div class="' + this.settings.classPrefix + 'socialIcons"><button class="shareLook">share</button></div>';
        }

        template = '<div class="' + this.settings.classPrefix + 'cont ">' +
            '<div class="rwd-container rwd-' + this.settings.lightboxView + '">' +
            '<div class="cont-inner">' + list + '</div>' +
            '<div class="' + this.settings.classPrefix + 'toolbar group">' +
            close1 + subHtmlCont2 +
            '</div>' +
            controls +
            '<div class="' + this.settings.classPrefix + 'bar">' +
            close2 + subHtmlCont1 + socialIcons + '</div>' +
            '</div>' +
            '</div>';



        if ($object.settings.socialSharing) {
            setTimeout(function () {
                $object.socialShare();
            }, 50);
        }

        this.$body.append(template);
        this.$cont = $('.' + $object.settings.classPrefix + 'cont');
        this.$item = this.$cont.find('.' + $object.settings.classPrefix + 'item');

        if (!this.settings.slideAnimation) {
            this.$cont.addClass(this.settings.classPrefix + 'animation');
            this.settings.slideAnimationType = this.settings.classPrefix + 'slide';
        } else {
            this.$cont.addClass(this.settings.classPrefix + 'use');
        }

        $object.calculateDimensions();

        $(window).on('resize.rwd-container', function () {
            setTimeout(function () {
                $object.calculateDimensions();
            }, 100);
        });

        this.$item.eq(this.index).addClass(this.settings.classPrefix + 'current');

        if (this.effectsSupport()) {
            this.$cont.addClass(this.settings.classPrefix + 'support');
        } else {
            this.$cont.addClass(this.settings.classPrefix + 'noSupport');
            this.settings.speed = 0;
        }

        this.$cont.addClass(this.settings.slideAnimationType);

        ((this.settings.showAfterLoad) && (this.$cont.addClass(this.settings.classPrefix + 'show-after-load')));

        if (this.effectsSupport()) {
            var $inner = this.$cont.find('.cont-inner');
            $inner.css('transition-timing-function', 'ease');
            $inner.css('transition-duration', this.settings.speed + 'ms');
        }

        $object.objects.overlay.addClass('in');

        setTimeout(function () {
            $object.$cont.addClass($object.settings.classPrefix + 'visible');
        }, this.settings.overlayDuration);

        if (this.settings.download) {
            $download_bg = '<svg class="download_bg" width="20px" height="20px" stroke="#999" fill="#999"  viewBox="-328 330.3 41.7 41.7" >' +
                '<path class="st0" d="M-296.4,352.1c0.4-0.4,0.4-1.1,0-1.6c-0.4-0.4-1.1-0.4-1.6,0l-8,8V332c0-0.6-0.5-1.1-1.1-1.1c-0.6,0-1.1,0.5-1.1,1.1v26.5l-8-8c-0.4-0.4-1.2-0.4-1.6,0c-0.4,0.4-0.4,1.1,0,1.6l10,10c0.4,0.4,1.1,0.4,1.6,0L-296.4,352.1zM-288.5,359.4c0-0.6,0.5-1.1,1.1-1.1c0.6,0,1.1,0.5,1.1,1.1v10.9c0,0.6-0.5,1.1-1.1,1.1h-39.5c-0.6,0-1.1-0.5-1.1-1.1v-10.9c0-0.6,0.5-1.1,1.1-1.1c0.6,0,1.1,0.5,1.1,1.1v9.8h37.2V359.4z"/>' +
                '</svg>';
            switch (this.settings.lightboxView) {
                case 'view1':
                default:
                    this.$cont.find('.' + $object.settings.classPrefix + 'toolbar').append('<a id="' + $object.settings.classPrefix + 'download" target="_blank" download class="' + this.settings.classPrefix + 'download ' + $object.settings.classPrefix + 'icon">' + $download_bg + '</a>');
                    break;
                case 'view2':
                    this.$cont.find('.' + $object.settings.classPrefix + 'bar').append('<a id="' + $object.settings.classPrefix + 'download" target="_blank" download class="' + this.settings.classPrefix + 'download ' + $object.settings.classPrefix + 'icon">' + $download_bg + '</a>');
                    break;
                case 'view4':
                    $('<a id="' + $object.settings.classPrefix + 'download" target="_blank" download class="' + this.settings.classPrefix + 'download ' + $object.settings.classPrefix + 'icon">' + $download_bg + '</a>').insertBefore($('.rwd-title'));;
                    break;
            }
        }

        $arrows = $('.rwd-arrows .rwd-next, .rwd-arrows .rwd-prev');
        $next   = $('.rwd-arrows .rwd-next');
        $prev   = $('.rwd-arrows .rwd-prev');

        switch (this.settings.lightboxView) {
            case 'view1':
            default:
                $arrows.css({'top' : '50%'});
                $next.css({'right' : '20px'});
                $prev.css({'left' : '20px'});
                break;
            case 'view2':
                $arrows.css({'bottom' : '0'});
                $next.css({'right' : '40%'});
                $prev.css({'left' : '40%'});
                break;
            case 'view3':
                $arrows.css({'top' : '14px', 'z-index' : '1090'});
                $next.css({'right' : '20px'});
                $prev.css({'right' : '55px'});
                $('.rwd-title').css({'text-align' : 'left','border-top' : '1px solid #999'});
                $('.rwd-close').css({'margin-right' : '45%'});
                $('.rwd-overlay, .rwd-toolbar, .rwd-title, .rwd-next, .rwd-prev').css({'background' : 'rgba(255, 255, 255, 1)'});
                $('.rwd-title, .shareLook').css({'color' : '#999'});
                $('.rwd-toolbar').css({'border-bottom' : '1px solid #999'});
                $('.rwd-toolbar .rwd-icon, .rwd-arrows .rwd-icon').addClass('rwd-icon0');
                break;
            }

        this.prevScrollTop = $(window).scrollTop();

        $object.objects.content = $('.rwd-container');

        $object.objects.content.css({
            'width': $object.settings.width,
            'height': $object.settings.height
        });

        setTimeout(function () {
            $('.rwd-container').bind('contextmenu', function () {
                return false;
            });
        }, 50);

    };

    Lightbox.prototype.calculateDimensions = function () {
        var $object = this, $width;

        $width = $('.' + $object.settings.classPrefix + 'current').height() * 16 / 9;

        if ($width > $object.settings.videoMaxWidth) {
            $width = $object.settings.videoMaxWidth;
        }

        $('.' + $object.settings.classPrefix + 'video-cont ').css({
            'max-width': $width + 'px'
        });

    };

    Lightbox.prototype.effectsSupport = function () {
        var transition, root, support;
        support = function () {
            transition = ['transition', 'MozTransition', 'WebkitTransition', 'OTransition', 'msTransition', 'KhtmlTransition'];
            root = document.documentElement;
            for (var i = 0; i < transition.length; i++) {
                if (transition[i] in root.style) {
                    return transition[i] in root.style;
                }
            }
        };

        return support();
    };

    Lightbox.prototype.isVideo = function (src, index) {

        var youtube, vimeo;

        youtube = src.match(/\/\/(?:www\.)?youtu(?:\.be|be\.com)\/(?:watch\?v=|embed\/)?([a-z0-9\-\_\%]+)/i);
        vimeo = src.match(/\/\/(?:www\.)?vimeo.com\/([0-9a-z\-_]+)/i);

        if (youtube) {
            return {
                youtube: youtube
            };
        } else if (vimeo) {
            return {
                vimeo: vimeo
            };
        }
    };

    Lightbox.prototype.counter = function () {
        if (this.settings.showCounter) {
            switch (this.settings.lightboxView) {
                case 'view1':
                default:
                    $('.' + this.settings.classPrefix + 'toolbar').append(this.objects.counter = $('<div id="' + this.settings.idPrefix + 'counter"></div>'));
                    $('#rwd-counter').css({'padding-left' : '23px'});
                    break;
                case 'view2':
                case 'view4':
                    $('.' + this.settings.classPrefix + 'bar').append(this.objects.counter = $('<div class="barCont"></div><div id="' + this.settings.idPrefix + 'counter"></div>'));
                    break;
                }

            this.objects.counter.append(
                this.objects.current = $('<div>' + this.settings.sequence_info + ' <span id="' + this.settings.idPrefix + 'counter-current">' + (parseInt(this.index, 10) + 1) + '</span> ' +
                    this.settings.sequenceInfo + ' <span id="' + this.settings.idPrefix + 'counter-all">' + this.$items.length + '</span></div>')
            );
        }
    };

    Lightbox.prototype.setTitle = function (index) {
        var $object = this, $title, $currentElement;

        $currentElement = this.$items.eq(index);
        $title = $currentElement.find('img').attr('alt') ||
            $currentElement.next('img').attr('alt') ||
            $currentElement.find('img').attr('title') ||
            this.settings.defaultTitle || '';

        this.$cont.find('.' + this.settings.classPrefix + 'title').html('<div class="rwd-title-text">'+$title+'</div>');

        (($object.settings.lightboxView === 'view2') && $('.rwd-title-text').css({'width' : '100%'}));

        ($title === '' && $object.settings.socialSharing) ?
            this.$cont.find('.' + this.settings.classPrefix + 'title').hide() :
            this.$cont.find('.' + this.settings.classPrefix + 'title').show();
    };

    Lightbox.prototype.preload = function (index) {
        for (var i = 1; i <= this.settings.preload; i++) {
            if (i >= this.$items.length - index) {
                break;
            }

            this.loadContent(index + i, false, 0);
        }

        for (var j = 1; j <= this.settings.preload; j++) {
            if (index - j < 0) {
                break;
            }

            this.loadContent(index - j, false, 0);
        }
    };

    Lightbox.prototype.socialShare = function () {
        var $object = this;

        var shareButtons = '<ul class="rwd-share-buttons">';
        shareButtons += $object.settings.share.facebookButton ? '<li><a title="Facebook" id="rwd-share-facebook" target="_blank"></a></li>' : '';
        shareButtons += $object.settings.share.twitterButton ? '<li><a title="Twitter" id="rwd-share-twitter" target="_blank"></a></li>' : '';
        shareButtons += $object.settings.share.googleplusButton ? '<li><a title="Google Plus" id="rwd-share-googleplus" target="_blank"></a></li>' : '';
        shareButtons += $object.settings.share.pinterestButton ? '<li><a title="Pinterest" id="rwd-share-pinterest" target="_blank"></a></li>' : '';
        shareButtons += $object.settings.share.linkedinButton ? '<li><a title="Linkedin" id="rwd-share-linkedin" target="_blank"></a></li>' : '';
        shareButtons += $object.settings.share.tumblrButton ? '<li><a title="Tumblr" id="rwd-share-tumblr" target="_blank"></a></li>' : '';
        shareButtons += $object.settings.share.redditButton ? '<li><a title="Reddit" id="rwd-share-reddit" target="_blank"></a></li>' : '';
        shareButtons += $object.settings.share.bufferButton ? '<li><a title="Buffer" id="rwd-share-buffer" target="_blank"></a></li>' : '';
        shareButtons += $object.settings.share.diggButton ? '<li><a title="Digg" id="rwd-share-digg" target="_blank"></a></li>' : '';
        shareButtons += $object.settings.share.vkButton ? '<li><a title="VK" id="rwd-share-vk" target="_blank"></a></li>' : '';
        shareButtons += $object.settings.share.yummlyButton ? '<li><a title="Yummly" id="rwd-share-yummly" target="_blank"></a></li>' : '';
        shareButtons += '</ul>';

        $('.' + this.settings.classPrefix + 'socialIcons').append(shareButtons);

        setTimeout(function () {
            $('#rwd-share-facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + (encodeURIComponent(window.location.href)));
            $('#rwd-share-twitter').attr('href', 'https://twitter.com/intent/tweet?text=&url=' + (encodeURIComponent(window.location.href)));
            $('#rwd-share-googleplus').attr('href', 'https://plus.google.com/share?url=' + (encodeURIComponent(window.location.href)));
            $('#rwd-share-pinterest').attr('href', 'http://www.pinterest.com/pin/create/button/?url=' + (encodeURIComponent(window.location.href)));
            $('#rwd-share-linkedin').attr('href', 'http://www.linkedin.com/shareArticle?mini=true&amp;url=' + (encodeURIComponent(window.location.href)));
            $('#rwd-share-tumblr').attr('href', 'http://www.tumblr.com/share/link?url=' + (encodeURIComponent(window.location.href)));
            $('#rwd-share-reddit').attr('href', 'http://reddit.com/submit?url=' + (encodeURIComponent(window.location.href)));
            $('#rwd-share-buffer').attr('href', 'https://bufferapp.com/add?url=' + (encodeURIComponent(window.location.href)));
            $('#rwd-share-digg').attr('href', 'http://www.digg.com/submit?url=' + (encodeURIComponent(window.location.href)));
            $('#rwd-share-vk').attr('href', 'http://vkontakte.ru/share.php?url=' + (encodeURIComponent(window.location.href)));
            $('#rwd-share-yummly').attr('href', 'http://www.yummly.com/urb/verify?url=' + (encodeURIComponent(window.location.href)));
        }, 200);
    };

    Lightbox.prototype.changeHash = function (index) {
        var $object = this;

        (($object.settings.socialSharing) && (window.location.hash = '/lightbox&slide=' + (index + 1)));
    };

    Lightbox.prototype.loadContent = function (index, rec, delay) {

        var $object, src, isVideo;

        $object = this;

        function isImg() {
            src = $object.$items.eq(index).attr('href');
            return src.match(/\.(jpg|png|gif)\b/);
        }

        if ($object.settings.watermark) {
            if (isImg()) {
                src = $object.$items.eq(index).find('img').attr('data-src');
            }
        } else {
            src = $object.$items.eq(index).attr('href');
        }


        isVideo = $object.isVideo(src, index);
        if (!$object.$item.eq(index).hasClass($object.settings.classPrefix + 'loaded')) {
            if (isVideo) {
                $object.$item.eq(index).prepend('<div class="' + this.settings.classPrefix + 'video-cont "><div class="' + this.settings.classPrefix + 'video"></div></div>');
                $object.$element.trigger('hasVideo.rwd-container', [index, src]);
            } else {
                $object.$item.eq(index).prepend('<div class="' + this.settings.classPrefix + 'img-wrap"><img class="' + this.settings.classPrefix + 'object ' + $object.settings.classPrefix + 'image watermark" src="' + src + '" /></div>');
            }

            $object.$element.trigger('onAferAppendSlide.rwd-container', [index]);

            $object.$item.eq(index).addClass($object.settings.classPrefix + 'loaded');
        }

        $object.$item.eq(index).find('.' + $object.settings.classPrefix + 'object').on('load.rwd-container error.rwd-container', function () {

            var speed = 0;
            if (delay) {
                speed = delay;
            }

            setTimeout(function () {
                $object.$item.eq(index).addClass($object.settings.classPrefix + 'complete');
            }, speed);

        });

        if (rec === true) {

            if (!$object.$item.eq(index).hasClass($object.settings.classPrefix + 'complete')) {
                $object.$item.eq(index).find('.' + $object.settings.classPrefix + 'object').on('load.rwd-container error.rwd-container', function () {
                    $object.preload(index);
                });
            } else {
                $object.preload(index);
            }
        }

    };

    Lightbox.prototype.slide = function (index, fromSlide, fromThumb) {

        var $object, prevIndex;
        $object = this;
        prevIndex = this.$cont.find('.' + $object.settings.classPrefix + 'current').index();

        var length = this.$item.length,
            time = 0,
            next = false,
            prev = false;

        if (this.settings.download) {
            var src;
            src = $object.$items.eq(index).attr('data-download-url') !== 'false' && ($object.$items.eq(index).attr('data-download-url') || $object.$items.eq(index).attr('href'));

            if (src) {
                $('#' + $object.settings.classPrefix + 'download').attr('href', src);
                $object.$cont.removeClass($object.settings.classPrefix + 'hide-download');
            } else {
                $object.$cont.addClass($object.settings.classPrefix + 'hide-download');
            }
        }

        this.$element.trigger('onBeforeSlide.rwd-container', [prevIndex, index, fromSlide, fromThumb]);

        setTimeout(function () {
            $object.setTitle(index);
        }, time);

        this.arrowDisable(index);


        $object.$cont.addClass($object.settings.classPrefix + 'no-trans');

        this.$item.removeClass($object.settings.classPrefix + 'prev-slide ' + $object.settings.classPrefix + 'next-slide');
        if (!fromSlide) {

            if (index < prevIndex) {
                prev = true;
                if ((index === 0) && (prevIndex === length - 1) && !fromThumb) {
                    prev = false;
                    next = true;
                }
            } else if (index > prevIndex) {
                next = true;
                if ((index === length - 1) && (prevIndex === 0) && !fromThumb) {
                    prev = true;
                    next = false;
                }
            }

            if (prev) {

                this.$item.eq(index).addClass($object.settings.classPrefix + 'prev-slide');
                this.$item.eq(prevIndex).addClass($object.settings.classPrefix + 'next-slide');
            } else if (next) {

                this.$item.eq(index).addClass($object.settings.classPrefix + 'next-slide');
                this.$item.eq(prevIndex).addClass($object.settings.classPrefix + 'prev-slide');
            }

            setTimeout(function () {
                $object.$item.removeClass($object.settings.classPrefix + 'current');

                $object.$item.eq(index).addClass($object.settings.classPrefix + 'current');

                $object.$cont.removeClass($object.settings.classPrefix + 'no-trans');
            }, 50);
        } else {

            var slidePrev = index - 1;
            var slideNext = index + 1;

            if ((index === 0) && (prevIndex === length - 1)) {

                slideNext = 0;
                slidePrev = length - 1;
            } else if ((index === length - 1) && (prevIndex === 0)) {

                slideNext = 0;
                slidePrev = length - 1;
            }

            this.$item.removeClass($object.settings.classPrefix + 'prev-slide ' + $object.settings.classPrefix + 'current ' + $object.settings.classPrefix + 'next-slide');
            $object.$item.eq(slidePrev).addClass($object.settings.classPrefix + 'prev-slide');
            $object.$item.eq(slideNext).addClass($object.settings.classPrefix + 'next-slide');
            $object.$item.eq(index).addClass($object.settings.classPrefix + 'current');
        }

        $object.loadContent(index, true, $object.settings.overlayDuration);

        $object.$element.trigger('onAfterSlide.rwd-container', [prevIndex, index, fromSlide, fromThumb]);

        if (this.settings.showCounter) {
            $('#' + $object.settings.classPrefix + 'counter-current').text(index + 1);
        }

        if (this.settings.socialSharing) {
            $object.changeHash(index);
        }

        $object.calculateDimensions();

    };

    Lightbox.prototype.goToNextSlide = function (fromSlide) {
        var $object = this;
        if (($object.index + 1) < $object.$item.length) {
            $object.index++;
            $object.slide($object.index, fromSlide, false);
        } else {
            if ($object.settings.loop) {
                $object.index = 0;
                $object.slide($object.index, fromSlide, false);
            }
        }
    };

    Lightbox.prototype.goToPrevSlide = function (fromSlide) {
        var $object = this;
        if ($object.index > 0) {
            $object.index--;
            $object.slide($object.index, fromSlide, false);
        } else {
            if ($object.settings.loop) {
                $object.index = $object.$items.length - 1;
                $object.slide($object.index, fromSlide, false);
            }
        }
    };

    Lightbox.prototype.slideShow = function () {
        var $object = this, $toolbar, $play_bg, $pause_bg;

        $play_bg = '<svg class="play_bg" width="20px" height="20px" fill="#999" viewBox="-192 193.9 314.1 314.1">' +
            '<g><g id="_x33_56._Play"><g><path d="M101,272.5C57.6,197.4-38.4,171.6-113.5,215c-75.1,43.4-100.8,139.4-57.5,214.5c43.4,75.1,139.4,100.8,214.5,57.5C118.6,443.6,144.4,347.6,101,272.5z M27.8,459.7c-60.1,34.7-136.9,14.1-171.6-46c-34.7-60.1-14.1-136.9,46-171.6c60.1-34.7,136.9-14.1,171.6,46C108.5,348.2,87.9,425,27.8,459.7z M21.6,344.6l-82.2-47.9c-7.5-4.4-13.5-0.9-13.5,7.8l0.4,95.2c0,8.7,6.2,12.2,13.7,7.9l81.6-47.1C29,356,29,349,21.6,344.6z"/></g></g></g>' +
            '</svg>';
        $pause_bg = '<svg class="pause_bg" width="20px" height="20px" fill="#999" viewBox="-94 96 510 510" >' +
            '<g><g id="pause-circle-outline"><path d="M84.5,453h51V249h-51V453z M161,96C20.8,96-94,210.8-94,351S20.8,606,161,606s255-114.8,255-255S301.3,96,161,96zM161,555C48.8,555-43,463.2-43,351s91.8-204,204-204s204,91.8,204,204S273.2,555,161,555z M186.5,453h51V249h-51V453z"/></g></g>' +
            '</svg>';

        $toolbar = $('.' + $object.settings.classPrefix + 'toolbar');
        switch (this.settings.lightboxView) {
            case 'view1':
            default:
                $toolbar.append('<span class="' + $object.settings.classPrefix + 'autoplay-button ' + $object.settings.classPrefix + 'icon">' + $play_bg + $pause_bg + '</span>');
                break;
            case 'view2':
                $('.' + $object.settings.classPrefix + 'bar').append('<span class="' + $object.settings.classPrefix + 'autoplay-button ' + $object.settings.classPrefix + 'icon">' + $play_bg + $pause_bg + '</span>');
                break;
            case 'view3':
                $toolbar.append('<span class="' + $object.settings.classPrefix + 'autoplay-button ' + $object.settings.classPrefix + 'icon">' + $play_bg + $pause_bg + '</span>');
                $('.rwd-toolbar .rwd-icon').addClass('rwd-icon0');
                break;
            case 'view4':
                $('<span class="' + $object.settings.classPrefix + 'autoplay-button ' + $object.settings.classPrefix + 'icon">' + $play_bg + $pause_bg + '</span>').insertBefore($('.rwd-title'));
                $('.rwd-toolbar .rwd-icon').addClass('rwd-icon0');
                break;
          }

        if ($object.settings.slideshowAuto) {
            $object.slideshowAuto();
        }

        $object.$cont.find('.' + $object.settings.classPrefix + 'autoplay-button').on('click.rwd-container', function () {
            !$($object.$cont).hasClass($object.settings.classPrefix + 'show-autoplay') ? $object.startSlide() : $object.stopSlide();
        });

    };

    Lightbox.prototype.slideshowAuto = function () {
        var $object = this;

        $object.$cont.addClass('' + $object.settings.classPrefix + 'show-autoplay');
        $object.startSlide();
    };

    Lightbox.prototype.startSlide = function () {
        var $object = this;
        $object.$cont.addClass('' + $object.settings.classPrefix + 'show-autoplay');
        $('.rwd-autoplay-button > .pause_bg').css({'display' : 'inline-block'});
        $('.rwd-autoplay-button > .play_bg').css({'display' : 'none'});
        $object.interval = setInterval(function () {
            $object.goToNextSlide();
        }, $object.settings.slideshowSpeed);
    };
    
    Lightbox.prototype.stopSlide = function () {
        clearInterval(this.interval);
        this.$cont.removeClass(this.settings.classPrefix + 'show-autoplay');
        $('.rwd-autoplay-button > .pause_bg').css({'display' : 'none'});
        $('.rwd-autoplay-button > .play_bg').css({'display' : 'inline-block'});
    };

    Lightbox.prototype.addKeyEvents = function () {
        var $object = this;
        if (this.$items.length > 1) {
            $(window).on('keyup.rwd-container', function (e) {
                if ($object.$items.length > 1) {
                    if (e.keyCode === 37) {
                        e.preventDefault();
                        $object.goToPrevSlide();
                    }

                    if (e.keyCode === 39) {
                        e.preventDefault();
                        $object.goToNextSlide();
                    }
                }
            });
        }

        $(window).on('keydown.rwd-container', function (e) {
            if ($object.settings.escKey === true && e.keyCode === 27) {
                e.preventDefault();
                if (!$object.$cont.hasClass($object.settings.classPrefix + 'thumb-open')) {
                    $object.destroy();
                } else {
                    $object.$cont.removeClass($object.settings.classPrefix + 'thumb-open');
                }
            }
        });
    };

    Lightbox.prototype.arrow = function () {
        var $object = this;
        this.$cont.find('.' + $object.settings.classPrefix + 'prev').on('click.rwd-container', function () {
            $object.goToPrevSlide();
        });

        this.$cont.find('.' + $object.settings.classPrefix + 'next').on('click.rwd-container', function () {
            $object.goToNextSlide();
        });
    };

    Lightbox.prototype.arrowDisable = function (index) {

        if (!this.settings.loop && this.settings.hideControlOnEnd) {
            if ((index + 1) < this.$item.length) {
                this.$cont.find('.' + this.settings.classPrefix + 'next').removeAttr('disabled').removeClass('disabled');
            } else {
                this.$cont.find('.' + this.settings.classPrefix + 'next').attr('disabled', 'disabled').addClass('disabled');
            }

            if (index > 0) {
                this.$cont.find('.' + this.settings.classPrefix + 'prev').removeAttr('disabled').removeClass('disabled');
            } else {
                this.$cont.find('.' + this.settings.classPrefix + 'prev').attr('disabled', 'disabled').addClass('disabled');
            }
        }
    };

    Lightbox.prototype.setTranslate = function ($element, xValue, yValue) {
        if (!this.settings.slideAnimation) {
            $element.css('left', xValue);
        } else {
            $element.css({
                transform: 'translate3d(' + (xValue) + 'px, ' + yValue + 'px, 0px)'
            });
        }
    };

    Lightbox.prototype.mousewheel = function () {
        var $object = this, delta;

        $object.$cont.on('mousewheel', function (e) {
            e = e || window.event;
            delta = e.deltaY || e.detail || e.wheelDelta;

            (delta > 0) ? $object.goToNextSlide() : $object.goToPrevSlide();
            e.preventDefault ? e.preventDefault() : (e.returnValue = false);
        });

    };

    Lightbox.prototype.closeGallery = function () {

        var $object = this, mousedown = false;

        this.$cont.find('.' + $object.settings.classPrefix + 'close').on('click.rwd-container', function () {
            $object.destroy();
        });

        if ($object.settings.overlayClose) {

            $object.$cont.on('mousedown.rwd-container', function (e) {

                mousedown = ($(e.target).is('.' + $object.settings.classPrefix + 'cont') || $(e.target).is('.' + $object.settings.classPrefix + 'item ') || $(e.target).is('.' + $object.settings.classPrefix + 'img-wrap'));

            });

            $object.$cont.on('mouseup.rwd-container', function (e) {

                if ($(e.target).is('.' + $object.settings.classPrefix + 'cont') || $(e.target).is('.' + $object.settings.classPrefix + 'item ') || $(e.target).is('.' + $object.settings.classPrefix + 'img-wrap') && mousedown) {
                    if (!$object.$cont.hasClass($object.settings.classPrefix + 'dragEvent')) {
                        $object.destroy();
                    }
                }

            });

        }

    };

    Lightbox.prototype.destroy = function (d) {

        var $object = this;

        clearInterval($object.interval);

        $object.$body.removeClass($object.settings.classPrefix + 'on');

        $(window).scrollTop($object.prevScrollTop);

        if (d) {
            $.removeData($object.el, 'lightbox');
        }

        ($object.settings.socialSharing && (window.location.hash = ''));

        this.$element.off('.rwd-container.tm');

        $(window).off('.rwd-container');

        if ($object.$cont) {
            $object.$cont.removeClass($object.settings.classPrefix + 'visible');
        }

        $object.objects.overlay.removeClass('in');

        setTimeout(function () {
            if ($object.$cont) {
                $object.$cont.remove();
            }

            $object.objects.overlay.remove();

        }, $object.settings.overlayDuration + 50);
    };

    $.fn.lightbox = function (options) {
        return this.each(function () {
            if (!$.data(this, 'lightbox')) {
                $.data(this, 'lightbox', new Lightbox(this, options));
            }
        });
    };

    $.fn.lightbox.videoModul = {};

    var Video = function (element) {

        this.core = $(element).data('lightbox');

        this.$element = $(element);
        this.core.videoSettings = $.extend({}, this.constructor.defaultsVideo, this.core.videoSettings);

        this.init();

        return this;
    };

    Video.defaultsVideo = {
        idPrefix: 'rwd-',
        classPrefix: 'rwd-',
        attrPrefix: 'data-',
        videoMaxWidth: '790',
        //videoMaxHeight: '100%',
        youtubePlayerParams: false,
        vimeoPlayerParams: false
    };

    Video.prototype.init = function () {
        var $object = this;

        $object.core.$element.on('hasVideo.rwd-container.tm', function (event, index, src) {
            $object.core.$item.eq(index).find('.' + $object.core.videoSettings.classPrefix + 'video').append($object.loadVideo(src, '' + $object.core.videoSettings.classPrefix + 'object', index));
        });

        $object.core.$element.on('onAferAppendSlide.rwd-container.tm', function (event, index) {
            $object.core.$item.eq(index).find('.' + $object.core.settings.classPrefix + 'video-cont').css({
                'max-width': $object.core.videoSettings.videoMaxWidth + 'px'
                //'max-height'  :  $object.core.videoSettings.videoMaxHeight
            });
        });

        $object.core.$element.on('onBeforeSlide.rwd-container.tm', function (event, prevIndex, index) {

            var $videoSlide = $object.core.$item.eq(prevIndex),
                youtubePlayer = $videoSlide.find('.rwd-youtube').get(0),
                vimeoPlayer = $videoSlide.find('.rwd-vimeo').get(0);

            if (youtubePlayer) {
                youtubePlayer.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
            } else if (vimeoPlayer) {
                try {
                    $f(vimeoPlayer).api('pause');
                } catch (e) {
                    console.error('Make sure you have included froogaloop2 js');
                }
            }

            var src;
            src = $object.core.$items.eq(index).attr('href');

            var isVideo = $object.core.isVideo(src, index) || {};
            if (isVideo.youtube || isVideo.vimeo) {
                $object.core.$cont.addClass('' + $object.core.videoSettings.classPrefix + 'hide-download');
            }

        });

        $object.core.$element.on('onAfterSlide.rwd-container.tm', function (event, prevIndex) {
            $object.core.$item.eq(prevIndex).removeClass($object.core.videoSettings.classPrefix + 'video-playing');
        });
    };

    Video.prototype.loadVideo = function (src, addClass, index) {
        var video = '',
            autoplay = 0,
            a = '',
            isVideo = this.core.isVideo(src, index) || {};

        if (isVideo.youtube) {

            a = '?wmode=opaque&autoplay=' + autoplay + '&enablejsapi=1';
            if (this.core.videoSettings.youtubePlayerParams) {
                a = a + '&' + $.param(this.core.videoSettings.youtubePlayerParams);
            }

            video = '<iframe class="' + this.core.videoSettings.classPrefix + 'video-object ' + this.core.videoSettings.classPrefix + 'youtube ' + addClass + '" width="560" height="315" src="//www.youtube.com/embed/' + isVideo.youtube[1] + a + '" frameborder="0" allowfullscreen></iframe>';

        } else if (isVideo.vimeo) {

            a = '?autoplay=' + autoplay + '&api=1';
            if (this.core.videoSettings.vimeoPlayerParams) {
                a = a + '&' + $.param(this.core.videoSettings.vimeoPlayerParams);
            }

            video = '<iframe class="' + this.core.videoSettings.classPrefix + 'video-object ' + this.core.videoSettings.classPrefix + 'vimeo ' + addClass + '" width="560" height="315"  src="//player.vimeo.com/video/' + isVideo.vimeo[1] + a + '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

        }

        return video;
    };

    $.fn.lightbox.videoModul.video = Video;

    var WaterMark = function (element) {
        this.element = element;
        this.settings = $.extend({}, this.constructor.defaults);
        this.init();
    };

    WaterMark.defaults = {
        imgSrc: 'img/watermark.png',
        text: 'WaterMark',
        textColor: 'white',
        textFontSize: 160,
        containerBackground: 'rgba(0, 0, 0, 0.9)',
        containerWidth: 900,
        position: 'pos9',
        opacity: 0.7,
        margin: 100,
        done: function (imgURL) {
            this.dataset.src = imgURL;
        }
    };

    WaterMark.prototype.init = function () {

        var $object = this,
            $elem = $object.element,
            $settings = $object.settings,
            wmData = {},
            imageData = {};

        wmData = {
            imgurl: $settings.imgSrc,
            type: 'png'
        };

        imageData = {
            imgurl: $elem.src
        };

        var defer = $.Deferred();

        $.when(defer).done(function (imgObj) {
            imageData.$wmObject = imgObj;

            $object.imgurltodata(imageData, function (dataURL) {
                $settings.done.call($elem, dataURL);
            });
        });

        if ($settings.text !== '') {
            wmData.imgurl = $object.textwatermark();
        }

        $object.imgurltodata(wmData, function (imgObj) {
            defer.resolve(imgObj);
        });
    };

    WaterMark.prototype.textwatermark = function () {
        var $object = this,
            $settings,
            canvas,
            context,
            $width,
            $height;

        $settings = $object.settings;
        canvas = document.createElement('canvas');
        context = canvas.getContext('2d');

        $width = $settings.containerWidth;
        $height = $settings.textFontSize;

        canvas.width = $width;
        canvas.height = $height;

        context.fillStyle = $settings.containerBackground;
        context.fillRect(0, 0, $width, $height);

        context.fillStyle = $settings.textColor;
        context.textAlign = 'center';
        context.font = '500 ' + $settings.textFontSize + 'px Sans-serif';

        context.fillText($settings.text, ($width / 2), ($height - 20));

        return canvas.toDataURL();
    };

    WaterMark.prototype.imgurltodata = function (data, callback) {

        var $object = this,
            $settings = $object.settings,
            img;

        img = new Image();

        img.onload = function () {

            var canvas = document.createElement('canvas'),
                context = canvas.getContext('2d'),

                $imgWidth = this.width,
                $imgHeight = this.height;

            if (data.$wmObject) {

                if (data.width !== 'auto' && data.height === 'auto' && data.width < $imgWidth) {
                    $imgHeight = $imgHeight / $imgWidth * data.width;
                    $imgWidth = data.width;
                } else if (data.width === 'auto' && data.height !== 'auto' && data.height < $imgHeight) {
                    $imgWidth = $imgWidth / $imgHeight * data.height;
                    $imgHeight = data.height;
                } else if (data.width !== 'auto' && data.height !== 'auto' && data.width < $imgWidth && data.height < $imgHeight) {
                    $imgWidth = data.width;
                    $imgHeight = data.height;
                }

            }


            canvas.width = $imgWidth;
            canvas.height = $imgHeight;

            if (data.type === 'jpeg') {
                context.fillStyle = '#ffffff';
                context.fillRect(0, 0, $imgWidth, $imgHeight);
            }

            context.drawImage(this, 0, 0, $imgWidth, $imgHeight);

            if (data.$wmObject) {

                var $opacity = $settings.opacity;
                if ($opacity > 0 && $opacity < 1) {
                    context.globalAlpha = $settings.opacity;
                }

                var $wmWidth = data.$wmObject.width,
                    $wmHeight = data.$wmObject.height,
                    pos = $settings.margin,
                    $x, $y;

                switch ($settings.position) {
                    case 'pos1':
                        $x = 0;
                        $y = pos;
                        break;
                    case 'pos2':
                        $x = $imgWidth / 2 - $wmWidth / 2;
                        $y = pos;
                        break;
                    case 'pos3':
                        $x = $imgWidth - $wmWidth;
                        $y = pos;
                        break;
                    case 'pos4':
                        $x = 0;
                        $y = $imgHeight / 2 - $wmHeight / 2;
                        break;
                    case 'pos5':
                        $x = $imgWidth / 2 - $wmWidth / 2;
                        $y = $imgHeight / 2 - $wmHeight / 2;
                        break;
                    case 'pos6':
                        $x = $imgWidth - $wmWidth;
                        $y = $imgHeight / 2 - $wmHeight / 2;
                        break;
                    case 'pos7':
                        $x = 0;
                        $y = $imgHeight - $wmHeight - pos;
                        break;
                    case 'pos8':
                        $x = $imgWidth / 2 - $wmWidth / 2;
                        $y = $imgHeight - $wmHeight - pos;
                        break;
                    case 'pos9':
                        $x = $imgWidth - $wmWidth;
                        $y = $imgHeight - $wmHeight - pos;
                        break;
                    default:
                        $x = $imgWidth - $wmWidth - pos;
                        $y = $imgHeight - $wmHeight - pos;
                }
                context.drawImage(data.$wmObject, $x, $y, $wmWidth, $wmHeight);
            }

            var dataURL = canvas.toDataURL('image/' + data.type);

            if (typeof callback === 'function') {

                if (data.$wmObject) {
                    callback(dataURL);

                } else {
                    var $wmNew = new Image();
                    $wmNew.src = dataURL;
                    callback($wmNew);
                }
            }

            canvas = null;
        };

        img.src = data.imgurl;
    };

    $.fn['watermark'] = function () {
        return this.each(function () {
            if (!$.data(this, 'watermark')) {
                $.data(this, 'watermark', new WaterMark(this));
            }
        });
    };

})(jQuery);