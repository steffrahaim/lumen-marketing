<?php
/*
 * The sidebar for displaying widgets.
 */
?>
<?php if ( is_active_sidebar( 'primary' ) ) {?>
	<div id="sidebar-widgets">
		<?php dynamic_sidebar( 'primary' ); ?>
	</div>

	<div class="site-info">
		<?php _e('©', 'lumen'); ?> <?php echo date('Y'); ?>  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>" > </a>
		<?php bloginfo('name');?>  
	</div>
<?php } ?>
