<?php
/*
 * Template Name: Front Page
 * Description: Front page template
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <body class="front-page"> >
<div id="buttonDiv">
<button id="splash-button" type="submit" onClick="window.location.href='/lumen3.0/work'">Enter</button>
</div>
<body>
<?php get_footer(); ?>