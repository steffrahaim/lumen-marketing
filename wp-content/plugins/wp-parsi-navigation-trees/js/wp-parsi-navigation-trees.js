jQuery(document).ready(function() {

  jQuery('#wb_tree ul li').has('.sub-menu')
    .children('a')
    .append('<span class="circle"></span>')
    .addClass('toggle_menu');

  const location = window.location.href.replace(/\/$/, '');
  jQuery('#wb_tree ul li a[href="' + location + '"').siblings('ul').show();
  jQuery('#wb_tree ul li a[href="' + location + '"').siblings('span').text('-');

  jQuery('#wb_tree a.toggle_menu').click(function(){}).toggle(open, closeAll);

  // Open parent link if on a child page.
  const openLink = jQuery('#wb_tree ul li a').filter(
    (i, e) => jQuery(e).attr('href') && jQuery(e).attr('href').replace(/\/$/, '') == location
  )
  // I know this is a dumb selector, sorry.
  const parentLink = jQuery(openLink).parent().parent().siblings('a.toggle_menu');
  if (openLink && parentLink) {
    open(null, parentLink);
    parentLink.click()
  }
});

function drawMenu(width, childCount, childHeight) {
  var menuBranches = document.getElementById("menuBranches");
  const childrenHeight = childCount * childHeight;
  const offset = 20;
  if (menuBranches.getContext) {
    var ctx = menuBranches.getContext("2d");

    ctx.fillStyle = "#bbb";
    // Horizontal
    ctx.fillRect (0, (childHeight * 1.5), width, 1);
    for (var i = 0; i <= childCount; i++) { 
      ctx.fillRect (offset, (childHeight/2) + (childHeight * i), width - offset, 1);
    }

    // Vertical
    ctx.fillRect (offset, childHeight/2, 1, childrenHeight - childHeight);
  }
}

function initializeBranches(parentLink) {
  // Precaution.
    jQuery('#menuBranches').remove();
    const childCount = parentLink.siblings('ul').children().length;
    // This is just coincidental.
    const childHeight = 26;
    const width = 26;
    const dimensions = 'width="' + width + '" height="' + childCount * childHeight + '"';
    parentLink.after('<canvas id="menuBranches" style="display: none;" ' + dimensions + '></canvas>')
    drawMenu(width, childCount, childHeight);
}

function closeAll() {
  jQuery('#wb_tree a').removeClass('active');
  jQuery('#menuBranches').remove();
  jQuery('#wb_tree ul .sub-menu').hide();
}

function open(event, item=undefined) {
  closeAll();
  
  const element = item || jQuery(this);
  initializeBranches(element);
  element.addClass('active');
  element.siblings('ul').fadeIn();
  element.siblings('#menuBranches').fadeIn();
}