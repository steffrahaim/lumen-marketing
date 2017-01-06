<?php
/*
 * The default template for displaying pages.
 */
?>

<?php get_header(); ?>
<div id="content">
	<?php while ( have_posts() ) : the_post(); ?>

		<h4 class="page-title"><?php the_title(); ?></h4>

		<?php if ( has_post_thumbnail() ) { 
				the_post_thumbnail('single', array('class' => 'single-image')); 
		} ?>

		<?php the_content(); ?>

		<?php if ( $multipage ) { ?>
			<div class="pagelink"><?php wp_link_pages(); ?></div>
		<?php } ?> 

		<?php comments_template(); ?>




    <?php endwhile; ?>


<?php /*
<div id="mobile-button-container">
<button class="mobile-button" type="button" onclick="smoothScroll(document.getElementById('sidebar'))">Menu</button>

<script>
    jQuery(document).ready(function() {
        if (jQuery("#container").height() < 1000) {
            jQuery(".mobile-button").addClass("hide");
        }
    });

    window.smoothScroll = function(target) {
        var scrollContainer = target;
        do { //find scroll container
            scrollContainer = scrollContainer.parentNode;
            if (!scrollContainer) return;
            scrollContainer.scrollTop += 1;
        } while (scrollContainer.scrollTop == 0);

        var targetY = 0;
        do { //find the top of target relatively to the container
            if (target == scrollContainer) break;
            targetY += target.offsetTop;
        } while (target = target.offsetParent);

        scroll = function(c, a, b, i) {
            i++; if (i > 30) return;
            c.scrollTop = a + (b - a) / 30 * i;
            setTimeout(function(){ scroll(c, a, b, i); }, 20);
        }
        // start scrolling
        scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
    }

</script>
</div>

*/
?>
	
<?php get_footer(); ?>