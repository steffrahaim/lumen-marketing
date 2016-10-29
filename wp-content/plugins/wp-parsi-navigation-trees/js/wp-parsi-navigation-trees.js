jQuery(document).ready(function(){

  jQuery('#wb_tree ul li').has('.sub-menu').prepend('<span>+</span>');
  const location = window.location.href.replace(/\/$/, '');
  jQuery('#wb_tree ul li a[href="' + location + '"').siblings('ul').show();
  jQuery('#wb_tree ul li a[href="' + location + '"').siblings('span').text('-');
  jQuery('#wb_tree ul .sub-menu').prepend('<div id="pacman"></div>');

  jQuery('#wb_tree span').click(
    function(){}).toggle(
       function(){
           // Sorry about the below for anyone who might see it and know better, but it works.
           jQuery('#wb_tree >div >ul >li >span').text('+')
           jQuery(this).text('-');
           
           jQuery('#wb_tree ul .sub-menu').hide();
       	   var parent = jQuery(this).parent();
           jQuery(parent).find('>ul').fadeIn();
       },
       function(){
           jQuery(this).text('+');
           var parent = jQuery(this).parent();
           jQuery(parent).find('>ul').fadeOut();
       }
    )
    
    jQuery("li:contains('+')").css("background-image", "none");


});