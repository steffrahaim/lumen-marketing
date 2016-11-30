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

<body class="front-page">
<div class="fullscreen-bg">
    <video muted autoplay poster="img/videoframe.jpg" class="fullscreen-bg__video">
        <source src="http://localhost:8888/Lumen3.0/wp-content/uploads/2016/11/Lumen_Splash2000pxNO-LOGO_25MBPS-1.mp4" type="video/mp4">
    </video>
</div>
</div id="splash-image">
</div>
<img src="http://localhost:8888/Lumen3.0/wp-content/uploads/2016/11/LA-logo-copy.png" id="splash-image" class="ri">
</img>

<div id="buttonDiv">
<button id="splash-button" type="submit" onClick="window.location.href='/Lumen3.0/what-we-do'">Enter</button>
</div>

<body>
<?php get_footer(); ?>