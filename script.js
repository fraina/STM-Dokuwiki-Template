jQuery(function(){
    var $has_subList = jQuery('.has-subList'),
        $dw_search = jQuery('#dw__search'),
        $icon_search = jQuery('.icon-search'),
        $first_heading = jQuery('.main :header').eq(0),
        $wrap_column = jQuery('.wrap_column'),
        $sidebar_title = jQuery('.sidebar-title'),
        $not_pc_navBtn = jQuery('.header-nav.not-pc .header-navButton'),
        $not_pc_nav = jQuery('.nav-for-device');

    $has_subList.click(function(){
        jQuery(this).siblings('.has-subList').find('ul').slideUp('500');
        jQuery(this).find('ul').slideToggle('500');
    });

    $has_subList.find('ul').click(function(e) {
        e.stopPropagation();
    });

    $dw_search.find('.edit').attr('placeholder', 'Search!');

    $icon_search.click(function() {
        $dw_search.find('.button').click();
    });

    var isAdminMenu = $first_heading.prev().attr('href') && $first_heading.prev().attr('href').match(/http:\/\/www\.dokuwiki.org\/security/).length;
    if (! $first_heading.prev().length || isAdminMenu) {
        $first_heading.css('margin-top', 0);
    }

    if ($wrap_column) {
      $wrap_column.each(function(index) {
        if (! jQuery(this).find(':header').eq(0).prev().length) {
          jQuery(this).find(':header').eq(0).css('margin-top', 0);
        }
      });
    }

    var reg = /^([^:]+[\w]+[^<])+([<].*)/,
        regresult = $sidebar_title.html().match(reg);
    regresult && $sidebar_title.html('<span>' + regresult[1] + '</span>' + regresult[2]);

    $not_pc_nav.slideUp(0);
    $not_pc_navBtn.click(function() {
      jQuery(this).stop().toggleClass('is-active');
      $not_pc_nav.stop().slideToggle(500);
    })

});
