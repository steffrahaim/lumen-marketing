<?php
/*
 * Template Name: Sidebar Page
 * Description: Page template with sidebar
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

	<?/* <?php edit_post_link( __( 'Edit', 'lumen' ), '<div class="edit-link">', '</div>' ); ?> */?>
	
<?php get_footer(); ?>