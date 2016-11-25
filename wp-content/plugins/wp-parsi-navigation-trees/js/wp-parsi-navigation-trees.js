jQuery(document).ready(function(){

  jQuery('#wb_tree ul li').has('.sub-menu').children('a').addClass('toggle_menu');

  const location = window.location.href.replace(/\/$/, '');
  jQuery('#wb_tree ul li a[href="' + location + '"').siblings('ul').show();
  jQuery('#wb_tree ul li a[href="' + location + '"').siblings('span').text('-');

  jQuery('#wb_tree a.toggle_menu').click(function(){}).toggle(open,close);

  // Open parent link if on a child page.
  const openLink = jQuery('#wb_tree ul li a').filter(
    (i, e) => jQuery(e).attr('href') && jQuery(e).attr('href').replace(/\/$/, '') == location
  )
  if (openLink) {
    open(null, jQuery(openLink).parent().parent().siblings('a.toggle_menu'));
  }
});

const open = function(event, item=undefined){
  const element = item || jQuery(this);
  jQuery('#wb_tree ul .sub-menu').hide();
  element.siblings('ul').fadeIn();
}

const close = function(e, item=undefined){
  const element = item || jQuery(this);
  element.siblings('ul').fadeOut();
}