jQuery(document).ready(function() {

  // If we ever want more children... oy. Don't do it.
  jQuery('#wb_tree ul li ul li ul.sub-menu')
    .siblings('a')
    .addClass('first_child');

  jQuery('#wb_tree ul li ul li ul li ul.sub-menu')
    .siblings('a')
    .addClass('first_child');

  jQuery('#wb_tree ul li').has('.sub-menu')
    .children('a')
    .append('<span class="circle"></span>')
    .addClass('toggle_menu');

  const location = window.location.href.replace(/\/$/, '');
  jQuery('#wb_tree ul li a[href="' + location + '"').siblings('ul').show();

  jQuery('#wb_tree a.toggle_menu:not([href])').click(toggle);

  // Open parent link if on a child page.
  const openLink = jQuery('#wb_tree ul li a').filter(
    (i, e) => jQuery(e).attr('href') && jQuery(e).attr('href').replace(/\/$/, '') == location
  )
  // I know these are a dumb selectors, sorry.
  const parentLinks = jQuery('.active');
  const toOpen = parentLinks.length ? parentLinks : [openLink];
  toOpen.map(link => {
    open(link, parentLinks.length ? false : true, true);
    openLink.addClass('active');
  });
  parentLinks.map((i, e) => initializeBranches(jQuery(e)))

});

function drawMenu(width, childCount, childHeight) {
  const childrenHeight = childCount * childHeight;
  const offset = 20;
  jQuery('.menuBranches').map((b, a) => {
    if (a.getContext) {
      var ctx = a.getContext("2d");

      ctx.fillStyle = "#bbb";
      // Horizontal
      ctx.fillRect (0, (childHeight * 1.5), width, 1);
      for (var i = 0; i <= childCount; i++) { 
        ctx.fillRect (offset, (childHeight/2) + (childHeight * i), width - offset, 1);
      }

      // Vertical
      ctx.fillRect (offset, childHeight/2, 1, childrenHeight - childHeight);
    }
  });
}

function initializeBranches(parentLink) {
  console.log('parentLink', parentLink)
  const childCount = parentLink.siblings('ul').children().length;
  // This is just coincidental.
  const childHeight = 26;
  const width = 26;
  const dimensions = `width="${width}" height="${childCount * childHeight}"`;
  const id = parentLink.parent().attr('id') || '';
  const canvas = `<canvas class="menuBranches ${id}" ${dimensions}></canvas>`;
  console.log(canvas);
  parentLink.after(canvas); 
  drawMenu(width, childCount, childHeight);
}

function toggle() {
  const node = jQuery(this);
  const closed = node.hasClass('active');
  

  if (!closed) {
    open(jQuery(this));
  } else {
    node.removeClass('active');
  }
}

function close(element) {
  console.log(element)
  element.removeClass('active');
  element.siblings('ul').hide();
  element.children('.menuBranches').remove();
  //jQuery('#wb_tree a').removeClass('active');
  //jQuery('.menuBranches').remove();
  //jQuery('#wb_tree ul .sub-menu').hide();
  //jQuery('#wb_tree ul .sub-menu li').hide();
}


function open(element, animate=true, delayLoad=false) {

  if (element.hasClass('last_child')) {
    jQuery('a.last_child').map((i, c) => close(jQuery(c)));
  } else if (element.hasClass('first_child')) {
    jQuery('a.first_child').map((i, c) => close(jQuery(c)));
    jQuery('a.last_child').map((i, c) => close(jQuery(c)));
  } else {
    jQuery('a.toggle_menu').map((i, c) => close(jQuery(c)));
  }

  element.addClass('active');
  element.siblings('ul').show();
  const children = element.siblings('ul').children('.sub-menu li');
  if (animate) {
    queueChildren(children, delayLoad);
    //jQuery("#menuBranches").toggleClass("branch-wipe");
  } else {
    element.siblings('ul').children('.sub-menu li').show();
    element.siblings('.menuBranches').show();
  }



}

function queueChildren(children, delayLoad=false) {
  const duration = 400;
  // STEFFERS! Change the below from duration to a value to tweak.
  const delayDuration = 100;
  window.setTimeout(() => children.each((i, child) => jQuery(child)
    .delay(duration * i)
    .fadeIn({queue: true, duration: duration}
  )), (delayLoad ? delayDuration : 0));
}



