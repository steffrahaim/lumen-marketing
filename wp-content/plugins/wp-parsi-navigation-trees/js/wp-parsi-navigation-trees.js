jQuery(document).ready(function(){

  jQuery('#wb_tree ul li').has('.sub-menu')
    .children('a')
    .addClass('toggle_menu')
    .prepend('<span>+</span>');
    
  const location = window.location.href.replace(/\/$/, '');
  jQuery('#wb_tree ul li a[href="' + location + '"').siblings('ul').show();
  jQuery('#wb_tree ul li a[href="' + location + '"').siblings('span').text('-');

  jQuery('#wb_tree a.toggle_menu').click(function(){}).toggle(open,close)});

const open = function(){
  jQuery('#wb_tree ul li span').text('+')
  jQuery(this).find('span').text('-');
  
  jQuery('#wb_tree ul .sub-menu').hide();
  jQuery(this).siblings('ul').fadeIn();
}

const close = function(){
  jQuery(this).find('span').text('+');
  jQuery(this).siblings('ul').fadeOut();
}