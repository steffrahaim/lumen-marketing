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
<div id="buttonDiv">
<button id="splash-button" type="submit" onClick="window.location.href='/menu'">Enter</button>
</div>
<div class="fullscreen-bg">
    <video muted autoplay class="fullscreen-bg__video">
        <source src="http://www.lumen-arts.com/wp-content/uploads/2016/12/Lumen_Splash2000pxNO-LOGO_4sec.mp4" type="video/mp4">
    </video>
</div>

<div>
<a href="http://www.lumen-arts.com/menu/" id="logo-link">
<img src="http://www.lumen-arts.com/wp-content/uploads/2016/12/LA-logo-copy_PROG.jpg" id="splash-image" class="ri"/></a>
</div>


<body>
<?php get_footer(); ?>