<?php
/*
Plugin Name: Very Simple Splash Page
Plugin URI: 
Description: Creates a very simple splash page for your homepage.
Version: 1.0.0
Author: 
Author URI:
*/

require_once( 'vssp-config.php' );

require_once( 'includes/activation.php' );

add_action( 'init', 'vssp_plugin_init' );

function vssp_plugin_init() {

	if (is_admin()) {
		require_once( 'includes/dc-library.php' );	
		require_once (VS_SPLASH_PAGE_ROOT_PATH.'includes/admin.php');
		$vssp_admin	= new VSSP_Admin();	
	}

	if (!is_admin()) {
		require_once(VS_SPLASH_PAGE_ROOT_PATH.'includes/splash-page.php');
		$vssp = new VSSP_SplashPage();	
		if ($vssp->state) {

			$vssp->splash_page();
		}
		
	}
}