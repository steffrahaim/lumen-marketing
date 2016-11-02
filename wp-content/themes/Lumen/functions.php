<?php
/*
 * Theme functions and definitions.
 */

// Sets up theme defaults and registers various WordPress features that lumen supports
	function lumen_setup() { 
		// Set max content width for img, video, and more
			global $content_width; 
			if ( ! isset( $content_width ) )
			$content_width = 740;

		// Make theme available for translation
			load_theme_textdomain('lumen', get_template_directory() . '/languages');  

		// Register Menu
			register_nav_menus( array( 
				'primary' => __( 'Primary Navigation', 'lumen' ), 
	 		) ); 

		// Add document title
			add_theme_support( 'title-tag' );

		// Add editor styles
			add_editor_style( 'custom-editor-style.css' );

		// Custom header	
			$header_args = array(		
				'width' => 800,
				'height' => 450,
				'default-image' => get_template_directory_uri() . '/images/boats.jpg',
				'header-text' => false,
				'uploads' => true,
			);	
			add_theme_support( 'custom-header', $header_args );

		// Default header
			register_default_headers( array(
				'boats' => array(
					'url' => get_template_directory_uri() . '/images/boats.jpg',
					'thumbnail_url' => get_template_directory_uri() . '/images/boats.jpg',
					'description' => __( 'Default header', 'lumen' )
				)
			) );

		// Post thumbnails
			add_theme_support( 'post-thumbnails' ); 

		// Resize thumbnails
			set_post_thumbnail_size( 300, 300 ); 

		// Resize single page thumbnail
			add_image_size( 'single', 300, 300 ); 

		// This feature adds RSS feed links to html head 
			add_theme_support( 'automatic-feed-links' );

		// Switch default core markup for search form, comment form, comments and caption to output valid html5
			add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'caption' ) );

		// Background color
			$background_args = array( 
				'default-color' => 'eeeeee', 
			); 
			add_theme_support( 'custom-background', $background_args ); 

		// Post formats
			add_theme_support( 'post-formats', array( 'aside', 'status', 'image', 'video', 'gallery', 'audio' ) );
	}
	add_action( 'after_setup_theme', 'lumen_setup' ); 


// Enqueues scripts and styles for front-end

	//Add google fonts//
	

	function lumen_scripts() {
		wp_enqueue_style( 'lumen-style', get_stylesheet_uri() );
		wp_enqueue_script( 'lumen-nav', get_template_directory_uri() . '/js/nav.js', array( 'jquery' ) );
		wp_enqueue_style( 'lumen-googlefonts', '//fonts.googleapis.com/css?family=Lato:100,300,400,700' );

		// Add html5 support for IE 8 and older 
		wp_enqueue_script( 'lumen_html5', get_template_directory_uri() . '/js/ie.js' );
		wp_script_add_data( 'lumen_html5', 'conditional', 'lt IE 9' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// mobile nav args
		$lumen_mobile_nav_args = array(
			'navText' => __( 'Menu', 'lumen' )
		);
		// localize script with data for mobile nav
		wp_localize_script( 'lumen-nav', 'objectL10n', $lumen_mobile_nav_args );
	}
	add_action( 'wp_enqueue_scripts', 'lumen_scripts' );


// Sidebars
	function lumen_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Primary Sidebar', 'lumen' ),
			'id' => 'primary',
			'description' => __( 'You can add one or multiple widgets here.', 'lumen' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer Right', 'lumen' ),
			'id' => 'footer-right',
			'description' => __( 'You can add one or multiple widgets here.', 'lumen' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer Middle', 'lumen' ),
			'id' => 'footer-middle',
			'description' => __( 'You can add one or multiple widgets here.', 'lumen' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer Left', 'lumen' ),
			'id' => 'footer-left',
			'description' => __( 'You can add one or multiple widgets here.', 'lumen' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );
	}
	add_action( 'widgets_init', 'lumen_widgets_init' );


// Add class to post nav 
	function lumen_post_next() { 
		return 'class="nav-next"'; 
	}
	add_filter('next_posts_link_attributes', 'lumen_post_next', 999); 

	function lumen_post_prev() { 
		return 'class="nav-prev"'; 
	}
	add_filter('previous_posts_link_attributes', 'lumen_post_prev', 999); 


// Add class to comment nav 
	function lumen_comment_next() { 
		return 'class="comment-next"'; 
	}
	add_filter('next_comments_link_attributes', 'lumen_comment_next', 999); 

	function lumen_comment_prev() { 
		return 'class="comment-prev"'; 
	}
	add_filter('previous_comments_link_attributes', 'lumen_comment_prev', 999); 


// Custom excerpt lenght (default length is 55 words)
	function lumen_excerpt_length( $length ) { 
		return 55; 
	} 
	add_filter( 'excerpt_length', 'lumen_excerpt_length', 999 ); 


// Theme Customizer (logo and menu title)
	function lumen_theme_customizer( $wp_customize ) { 
		$wp_customize->add_section( 'lumen_logo_section' , array( 
			'title' => __( 'Logo', 'lumen' ), 
			'priority' => 30, 
			'description' => __( 'Set a logo to replace site title and tagline.', 'lumen' ),
		) );
		$wp_customize->add_setting( 'lumen_logo', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'esc_url_raw', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lumen_logo', array( 
			'label' => __( 'Logo', 'lumen' ), 
			'section' => 'lumen_logo_section', 
			'settings' => 'lumen_logo', 
		) ) );
		$wp_customize->add_section( 'lumen_menu_title_section' , array( 	
			'title' => __( 'Menu Title', 'lumen' ), 
			'priority' => 31, 
			'description' => __( 'Change title displayed above the menu.', 'lumen' ),
		) );
		$wp_customize->add_setting( 'lumen_menu_title', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'sanitize_text_field', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Control ( $wp_customize, 'lumen_menu_title', array( 
			'label' => __( 'Title', 'lumen' ), 
			'description' => __( 'This will overwrite the default title.', 'lumen' ), 
			'section' => 'lumen_menu_title_section', 
			'settings' => 'lumen_menu_title', 
		) ) );

	} 
	add_action('customize_register', 'lumen_theme_customizer');

?>