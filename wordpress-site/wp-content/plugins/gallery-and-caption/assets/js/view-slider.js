jQuery(document).ready(function ($) {
    switch(re_slider_obj.ph_re_slider_effects) {
        case 'fade':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),$Opacity:2}
            ];
            break;
        case 'swing_inside_stairs':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),x:0.2,y:-0.1,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$JssorEasing$.$EaseInWave,$Top:$JssorEasing$.$EaseInWave,$Clip:$JssorEasing$.$EaseOutQuad},$Assembly:260,$Round:{$Left:1.3,$Top:2.5}}
            ];
            break;

        case 'dodge_dance':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),x:0.3,y:-0.3,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$JssorEasing$.$EaseInJump,$Top:$JssorEasing$.$EaseInJump,$Clip:$JssorEasing$.$EaseOutQuad},$Assembly:260,$Outside:true,$Round:{$Left:0.8,$Top:2.5}}
            ];
            break;
        case 'switch':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),x:0.25,$Zoom:1.5,$Easing:{$Left:$JssorEasing$.$EaseInWave,$Zoom:$JssorEasing$.$EaseInSine},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:1400,x:-0.25,$Zoom:1.5,$Easing:{$Left:$JssorEasing$.$EaseInWave,$Zoom:$JssorEasing$.$EaseInSine},$Opacity:2,$ZIndex:-10}}
            ];
            break;
        case 'expand_stairs':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),$Delay:30,$Cols:8,$Rows:4,$Clip:15,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:$JssorEasing$.$EaseInQuad,$Assembly:2050}
            ];
            break;
        case 'rotate':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),x:-1,y:2,$Rows:2,$Zoom:11,$Rotate:1,$ChessMode:{$Row:15},$Easing:{$Left:$JssorEasing$.$EaseInCubic,$Top:$JssorEasing$.$EaseInCubic,$Zoom:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseOutQuad,$Rotate:$JssorEasing$.$EaseInCubic},$Assembly:2049,$Opacity:2,$Round:{$Rotate:0.8}}
            ];
            break;
        case 'flutter_outside':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),x:1,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo,$Clip:$JssorEasing$.$EaseInOutQuad},$Assembly:260,$Outside:true,$Round:{$Top:0.8}}
            ];
        case 'zoom_in':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),y:2,$Rows:2,$Zoom:11,$ChessMode:{$Row:15},$Easing:{$Top:$JssorEasing$.$EaseInCubic,$Zoom:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseOutQuad},$Assembly:2049,$Opacity:2}
            ];
        case 'clips_chess_in':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),y:-1,$Cols:8,$Rows:4,$Clip:15,$During:{$Top:[0.5,0.5],$Clip:[0,0.5]},$Formation:$JssorSlideshowFormations$.$FormationStraight,$ChessMode:{$Column:12},$ScaleClip:0.5}
            ];
        case 'clip_jump_in':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),x:-1,y:0.7,$Delay:80,$Cols:12,$Clip:11,$Move:true,$During:{$Left:[0.35,0.65],$Top:[0.35,0.65],$Clip:[0,0.1]},$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:{$Left:$JssorEasing$.$EaseOutQuad,$Top:$JssorEasing$.$EaseOutJump,$Clip:$JssorEasing$.$EaseOutQuad},$Assembly:2049,$ScaleClip:0.7,$Round:{$Top:4}}
            ];
        case 'bounce_down':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),y:1,$Easing:$JssorEasing$.$EaseInBounce}
            ];
        case 'parabola_zigzag_in':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),x:1,y:1,$Delay:60,$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$ChessMode:{$Row:3},$Easing:{$Top:$JssorEasing$.$EaseInQuart,$Opacity:$JssorEasing$.$EaseLinear},$Assembly:260,$Opacity:2}
            ];
        case 'jump_in_rectangle_cross':
            var jssor_1_SlideshowTransitions = [
                {$Duration:parseInt(re_slider_obj.ph_re_slider_change_speed),x:-1,y:-0.5,$Delay:50,$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationRectangleCross,$Easing:{$Left:$JssorEasing$.$EaseSwing,$Top:$JssorEasing$.$EaseInJump},$Assembly:260,$Round:{$Top:1.5}}
            ];
            break;
    }
if(re_slider_obj.ph_re_slider_show_thumbnails_show_all == 'default'){
    var showallthumbs = 5;
}
else {
    var showallthumbs = 10;
}

var jssor_1_slider,
    pause_on_hover;
    
    pause_on_hover = (re_slider_obj.pause_on_hover === 'on') ? true : false;

init_jssor_slider = function(){
    var jssor_1_options = {
        $AutoPlay: true,
        $AutoPlayInterval: +re_slider_obj.ph_re_slider_pause_time,
        $PauseOnHover: pause_on_hover,
        $SlideshowOptions: {
            $Class: $JssorSlideshowRunner$,
            $Transitions: jssor_1_SlideshowTransitions,
            $TransitionsOrder: 1
        },
        $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$,
            $ChanceToShow: re_slider_obj.ph_re_slider_show_arrows			},
        $ThumbnailNavigatorOptions: {
            $Class: $JssorThumbnailNavigator$,
            $Cols: showallthumbs,
            $SpacingX: 8,
            $SpacingY: 8,
            $Align: 360,
            $ChanceToShow: re_slider_obj.ph_re_slider_show_thumbnails			},
        $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$,
            $ChanceToShow: re_slider_obj.ph_re_slider_show_bullets,
            $Orientation: re_slider_obj.ph_re_slider_show_bullets_orientation,
            $SpacingX: parseInt(re_slider_obj.ph_re_slider_show_bullets_Spacing_x),
            $SpacingY: parseInt(re_slider_obj.ph_re_slider_show_bullets_Spacing_y),
            $AutoCenter: 1 // Arac chi
        }
    };

    jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

    /*responsive code begin*/
    /*you can remove responsive code if you don't want the slider scales while window resizing*/
    function ScaleSlider() {
        var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
        if (refSize) {
            refSize = Math.min(refSize, re_slider_obj.ph_re_slider_widht);
            jssor_1_slider.$ScaleWidth(refSize);
        }
        else {
            window.setTimeout(ScaleSlider, 30);
        }
    }
    ScaleSlider();
    jQuery(window).bind("load", ScaleSlider);
    jQuery(window).bind("resize", ScaleSlider);
    jQuery(window).bind("orientationchange", ScaleSlider);
    /*responsive code end*/
};


});

jQuery(function($) {

    (function initSlider() {
        init_jssor_slider();
    })();
});

var _$_ = jQuery('div#jssor_1'),
    $slider_width = re_slider_obj.ph_re_slider_widht,
    __$__ = _$_.parent().width(),
    $width;

switch(re_slider_obj.ph_re_slider_position){
    case 'left':
        _$_.css({'left' : '0'});
        break;
    case 'right':
        $width = __$__ - $slider_width;
        _$_.css({
            'left' : $width + 'px'
        });
        break;
    case 'center':
        $width = ( __$__ - $slider_width ) / 2;
        _$_.css({'left' : $width + 'px'});
        break;
        break;
}


var tag = document.createElement('script');
tag.src = "//www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var playerInfoList = [], YTplayer = {}, i;
jQuery('.huge_it_youtube_iframe').each(function(){
    var id = jQuery(this).attr('id'),
        _this = jQuery(this).parent().find('img').attr('src'),
        index = _this.indexOf('vi/') + 3,
        videoId = _this.slice(index, index + 11),
        playButton = jQuery(this).parent().find('div[class*=youtube_play_icon]'),
        controls = jQuery(this).attr('data-controls'),
        showinfo = jQuery(this).attr('data-showinfo'),
        rel = jQuery(this).attr('data-rel');
    YTplayer[i] = {
        id:id,
        videoId: videoId,
        playButton: playButton,
        controls: controls,
        showinfo: showinfo,
        rel: rel
    };
    playerInfoList.push(YTplayer[i]);
    i++;
});

function onYouTubeIframeAPIReady() {
    if(typeof playerInfoList === 'undefined')
        return;

    for(var i = 0; i < playerInfoList.length; i++) {
        createPlayer(playerInfoList[i]);
    }
}

function createPlayer(playerInfo) {
    var _player = new YT.Player(playerInfo.id, {
        width: +re_slider_obj.ph_re_slider_widht,
        height: +re_slider_obj.ph_re_slider_height,
        videoId: playerInfo.videoId,
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        },
        playerVars: {
            'controls': playerInfo.controls,
            'showinfo': playerInfo.showinfo,
            'rel': playerInfo.rel
        }

    });

    function onPlayerReady(e) {

        var playButton = playerInfo.playButton,
            nextButton = jQuery('.jssora05r'),
            prevButton = jQuery('.jssora05l');

        playButton.on("click", function() {
            _player.playVideo();
            jQuery(this).css({display : 'none'});
            jQuery(this).parent().find('img[class*=video_cover]').css({display : 'none'});
            jssor_1_slider.$Pause();

            nextButton.on('click', function(){
                _player.pauseVideo();
                jssor_1_slider.$Play();
            });
            prevButton.on('click', function(){
                _player.pauseVideo();
                jssor_1_slider.$Play();
            });
        });
        e.target.setPlaybackQuality('small');
    }

    function onPlayerStateChange(e) {
        if(e.data === 0) {
            jssor_1_slider.$Play();
        }
    }

    return _player;
}

jQuery('iframe.huge_it_vimeo_iframe').each(function(){
    Froogaloop(this).addEvent('ready', ready);
});

function ready(player_id) {

    var froogaloop = $f(player_id),
        playButton =  jQuery('div[class*=vimeo_play_icon]'),
        arrows = jQuery('.jssora05l, .jssora05r');

    playButton.on('click', function(e) {

        var vid = jQuery(this).parent().find('iframe').attr('id');
        froogaloop = $f(vid);
        froogaloop.api('play');

        jQuery(this).css({display : 'none'});
        jQuery(this).parent().find('img[class*=video_cover]').css({display : 'none'});
    });

    arrows.on('click', function(){
        froogaloop.api('pause');
    });

    froogaloop.addEvent('ready', function() {
        froogaloop.addEvent('finish', onFinish);
    });

    function onFinish(id) {
        jssor_1_slider.$Play();
    }

}

jQuery('div[class*=youtube_play_icon], div[class*=vimeo_play_icon]').on('click', function(e) {
    jssor_1_slider.$Pause();
});

jQuery('.jssora05l, .jssora05r').on('click', function(){
    jssor_1_slider.$Play();
});