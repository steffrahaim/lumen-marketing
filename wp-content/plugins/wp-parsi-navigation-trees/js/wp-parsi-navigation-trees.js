jQuery(document).ready(function() {

  // If we ever want more children... oy. Don't do it.
  jQuery('#wb_tree ul li ul li ul.sub-menu')
    .siblings('a')
    .addClass('first_child');

  jQuery('#wb_tree ul li ul li ul li')
    .children('a')
    .addClass('last_child')

  jQuery('#wb_tree ul li').has('.sub-menu')
    .children('a')
    .append('<span class="circle"></span>')
    .addClass('toggle_menu');

  jQuery('#wb_tree ul.sub-menu').map((i, e) => {
    const childCount = jQuery(e).children().length;
    jQuery(e).css('top', (childCount - 1) * -13)
  })

  jQuery('#wb_tree ul li ul li').has('.sub-menu').has('a.first_child')
    .children('a').children('span.circle')
    .addClass('first_child');

  const location = window.location.href.replace(/\/$/, '');
  jQuery('#wb_tree ul li a[href="' + location + '"').siblings('ul').show();

  jQuery('#wb_tree a.toggle_menu:not([href])').click(toggle);

  // Open parent link if on a child page.
  const openLink = jQuery('#wb_tree a.last_child').filter(
    (i, e) =>  e.href && e.href.replace(/\/$/, '') == location
  );
  open(openLink, false, true);
});

function drawMenu(className, width, childCount, childHeight) {
  const childrenHeight = childCount * childHeight;
  const offset = 20;
  jQuery(`.${className}.menuBranches`).map((b, a) => {
    if (a.getContext) {
      var ctx = a.getContext("2d");

      ctx.fillStyle = "#bbb";
      // Horizontal
      const horizontal_offset = (childCount % 2 == 0) ? childHeight : childHeight/2;
      const stem_y = childHeight * childCount / 2;
      ctx.fillRect (0, stem_y, width - 5, 1);
      for (var i = 0; i <= childCount; i++) { 
        ctx.fillRect (offset, (childHeight/2) + (childHeight * i), width - offset, 1);
      }

      // Vertical
      ctx.fillRect (offset, childHeight/2, 1, childrenHeight - childHeight);
    }
  });
}

function initializeBranches(parentLink, className) {
  const childCount = parentLink.children().length;
  // This is just coincidental.
  const childHeight = 26;
  const width = 26;
  const top = (-1 * childHeight * (childCount - 1) / 2);
  const dimensions = `width="${width}" height="${childCount * childHeight}"`;
  const id = parentLink.parent().attr('id') || '';
  const canvas = `<canvas class="menuBranches ${id} ${className}" style="top:${top}px;" ${dimensions}></canvas>`;
  parentLink.after(canvas); 
  drawMenu(className, width, childCount, childHeight);
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
  element.removeClass('active');
  element.parent().children('a').children('span.circle').hide();
  element.siblings('ul').hide();
  element.parent().children('.menuBranches').remove();
}

function open(element, animate=true, delayLoad=false) {

  const parent = element.parent().parent();

  if (element.hasClass('last_child')) {
    jQuery('a.last_child').map((i, c) => close(jQuery(c)));
    const grandparent = parent.parent().parent();
    open(parent.siblings('a'), false);
  } else if (element.hasClass('first_child')) {
    jQuery('a.first_child').map((i, c) => close(jQuery(c)));
    jQuery('a.last_child').map((i, c) => close(jQuery(c)));
    open(parent.siblings('a'), false);
    initializeBranches(element.siblings('ul'), 'lower');
  } else {
    jQuery('a.toggle_menu').map((i, c) => close(jQuery(c)));
    initializeBranches(element.siblings('ul'), 'upper');
  }

  element.addClass('active');
  element.siblings('ul').show();
  element.children('span.circle').show();
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



