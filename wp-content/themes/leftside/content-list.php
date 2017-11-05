<?php
/*
 * The content used by files archive, index and search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-list'); ?>>
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<h4 class="sticky-title"><?php _e( 'Featured post', 'leftside' ); ?></h4>
	<?php endif; ?>

	<h2 class="post-title entry-title">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permalink to %s', 'leftside'), the_title_attribute('echo=0')); ?>"> <?php the_title(); ?></a> 
	</h2>

	<?php get_template_part( 'content-postmeta' ); ?>

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) { 
			the_post_thumbnail(); 
		} ?>
		<?php if ( get_theme_mod( 'leftside_content_type' ) == "no" ) { ?>
			<?php the_content(); ?> 
		<?php } else { ?>
			<?php the_excerpt(); ?>
		<?php } ?>	
	</div>

	<?php if ( get_theme_mod( 'leftside_read_more' ) != "no" ) { ?>
		<div class="more">
			<a class="readmore" href="<?php the_permalink() ?>" rel="bookmark"><?php _e( 'Read More &raquo;', 'leftside' ); ?></a>
		</div>
	<?php } ?>	
</article>
