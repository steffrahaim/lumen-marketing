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
<button id="splash-button" type="submit" onClick="window.location.href='/lumen-arts/menu'">Enter</button>
</div>
<div class="fullscreen-bg">
    <video muted autoplay class="fullscreen-bg__video">
        <source src="/lumen-arts/wp-content/uploads/2017/01/Lumen_Splash2000pxNO-LOGO_4sec.mp4" type="video/mp4">
    </video>
</div>

<div onClick="window.location.href='/lumen-arts/menu'">
<div id="logo-link">
<img src="/lumen-arts/wp-content/uploads/2016/11/LA-logo-copy.png" id="splash-image" class="ri"/></div>
</div>


<body>
<?php get_footer(); ?>