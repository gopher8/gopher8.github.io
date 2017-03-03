(function(jQuery) {

  /**
   * Copyright 2012, Digital Fusion
   * Licensed under the MIT license.
   * http://teamdf.com/jquery-plugins/license/
   *
   * @author Sam Sehnert
   * @desc A small plugin that checks whether elements are within
   *     the user visible viewport of a web browser.
   *     only accounts for vertical position, not horizontal.
   */

  jQuery.fn.visible = function(partial) {
    
      var jQueryt            = jQuery(this),
          jQueryw            = jQuery(window),
          viewTop       = jQueryw.scrollTop(),
          viewBottom    = viewTop + jQueryw.height(),
          _top          = jQueryt.offset().top,
          _bottom       = _top + jQueryt.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;
    
    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };
    
})(jQuery);

jQuery(window).scroll(function(event) {
	
	jQuery(".frontwidget .widget").each(function(i, el) {
    var el = jQuery(el);
    if (el.visible(true)) {
      el.addClass("animated fadeInUp"); 
    } 
  });
  
  jQuery(".attachment-blanche-blogthumb").each(function(i, el) {
    var el = jQuery(el);
    if (el.visible(true)) {
      el.addClass("animated fadeIn"); 
    } 
  });
  
});

var win = jQuery(window);
var allMods = jQuery(".attachment-blanche-blogthumb");

// Already visible modules
allMods.each(function(i, el) {
  var el = jQuery(el);
  if (el.visible(true)) {
    el.addClass("already-visible"); 
  } 
});