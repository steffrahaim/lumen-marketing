<?php
/*
 * Theme functions and definitions.
 */

// Sets up theme defaults and registers various WordPress features that theme supports
	function leftside_setup() { 
		// Set max content width for img, video, and more
			global $content_width; 
			if ( ! isset( $content_width ) )
			$content_width = 740;

		// Make theme available for translation
			load_theme_textdomain('leftside', get_template_directory() . '/languages');  

		// Register Menu
			register_nav_menus( array( 
				'primary' => __( 'Primary Navigation', 'leftside' ), 
	 		) ); 

		// Add document title
			add_theme_support( 'title-tag' );

		// Add editor styles
			add_editor_style( array( 'custom-editor-style.css', leftside_font_url() ) );

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
					'description' => __( 'Default header', 'leftside' )
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
			add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'gallery', 'audio' ) );
	}
	add_action( 'after_setup_theme', 'leftside_setup' ); 


// Enqueues scripts and styles for front-end
	function leftside_scripts() {
		wp_enqueue_style( 'leftside-style', get_stylesheet_uri() );
		wp_enqueue_script( 'leftside-nav', get_template_directory_uri() . '/js/nav.js', array( 'jquery' ) );
		wp_enqueue_style( 'leftside-googlefonts', leftside_font_url() ); 

		// Add html5 support for IE 8 and older 
		wp_enqueue_script( 'leftside_html5', get_template_directory_uri() . '/js/ie.js' );
		wp_script_add_data( 'leftside_html5', 'conditional', 'lt IE 9' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'leftside_scripts' );


// Font family
	function leftside_font_url() {
		$font_url = '//fonts.googleapis.com/css?family=Open+Sans';
		return esc_url_raw( $font_url );
	}


// Sidebars
	function leftside_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Primary Sidebar', 'leftside' ),
			'id' => 'primary',
			'description' => __( 'You can add one or multiple widgets here.', 'leftside' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer Right', 'leftside' ),
			'id' => 'footer-right',
			'description' => __( 'You can add one or multiple widgets here.', 'leftside' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer Middle', 'leftside' ),
			'id' => 'footer-middle',
			'description' => __( 'You can add one or multiple widgets here.', 'leftside' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer Left', 'leftside' ),
			'id' => 'footer-left',
			'description' => __( 'You can add one or multiple widgets here.', 'leftside' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );
	}
	add_action( 'widgets_init', 'leftside_widgets_init' );


// Add class to post nav 
	function leftside_post_next() { 
		return 'class="nav-next"'; 
	}
	add_filter('next_posts_link_attributes', 'leftside_post_next', 999); 

	function leftside_post_prev() { 
		return 'class="nav-prev"'; 
	}
	add_filter('previous_posts_link_attributes', 'leftside_post_prev', 999); 


// Add class to comment nav 
	function leftside_comment_next() { 
		return 'class="comment-next"'; 
	}
	add_filter('next_comments_link_attributes', 'leftside_comment_next', 999); 

	function leftside_comment_prev() { 
		return 'class="comment-prev"'; 
	}
	add_filter('previous_comments_link_attributes', 'leftside_comment_prev', 999); 


// Custom excerpt lenght (default length is 55 words)
	function leftside_excerpt_length( $length ) { 
		return 55; 
	} 
	add_filter( 'excerpt_length', 'leftside_excerpt_length', 999 ); 


// Theme Customizer
	function leftside_theme_customizer( $wp_customize ) { 
		$wp_customize->add_section( 'leftside_logo_section' , array( 
			'title' => __( 'Logo', 'leftside' ), 
			'priority' => 30, 
			'description' => __( 'Set a logo to replace site title and tagline.', 'leftside' ),
		) );
		$wp_customize->add_setting( 'leftside_logo', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'esc_url_raw', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'leftside_logo', array( 
			'label' => __( 'Logo', 'leftside' ), 
			'section' => 'leftside_logo_section', 
			'settings' => 'leftside_logo', 
		) ) );
		$wp_customize->add_section( 'leftside_menu_title_section' , array( 	
			'title' => __( 'Menu Title', 'leftside' ), 
			'priority' => 31, 
			'description' => __( 'Change title displayed above the menu.', 'leftside' ),
		) );
		$wp_customize->add_setting( 'leftside_menu_title', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'sanitize_text_field', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Control ( $wp_customize, 'leftside_menu_title', array( 
			'label' => __( 'Title', 'leftside' ), 
			'description' => __( 'This will overwrite the default title.', 'leftside' ), 
			'section' => 'leftside_menu_title_section', 
			'settings' => 'leftside_menu_title', 
		) ) );
		$wp_customize->add_section( 'leftside_blog_section' , array( 
			'title' => __( 'Blog Page', 'leftside' ), 
			'priority' => 32, 
			'description' => __( 'Set a page title and content above your posts.', 'leftside' ),
		) );
		$wp_customize->add_setting( 'leftside_blog_title', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'sanitize_text_field', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'leftside_blog_title', array( 
			'label' => __( 'Title', 'leftside' ), 
			'section' => 'leftside_blog_section', 
			'settings' => 'leftside_blog_title', 
		) ) );
		$wp_customize->add_setting( 'leftside_blog_content', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'wp_kses_post', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'leftside_blog_content', array( 
			'label' => __( 'Content', 'leftside' ), 
			'type' => 'textarea', 
			'section' => 'leftside_blog_section', 
			'settings' => 'leftside_blog_content', 
		) ) );
		$wp_customize->add_section( 'leftside_post_section' , array( 
			'title' => __( 'Posts', 'leftside' ), 
			'priority' => 33, 
			'description' => __( 'Customize the way how posts are displayed.', 'leftside' ),
		) );
		$wp_customize->add_setting( 'leftside_content_type', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'sanitize_text_field', 
			'default' => 'yes', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'leftside_content_type', array( 
			'label' => __( 'Show a summary', 'leftside' ), 
			'section' => 'leftside_post_section', 
			'settings' => 'leftside_content_type', 
			'type' => 'radio', 
			'choices' => array( 
				'yes' => __('Yes', 'leftside'), 
				'no' => __('No', 'leftside'), 
			), 
		) ) );
		$wp_customize->add_setting( 'leftside_read_more', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'sanitize_text_field', 
			'default' => 'yes', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'leftside_read_more', array( 
			'label' => __( 'Show Read More button', 'leftside' ), 
			'section' => 'leftside_post_section', 
			'settings' => 'leftside_read_more', 
			'type' => 'radio', 
			'choices' => array( 
				'yes' => __('Yes', 'leftside'), 
				'no' => __('No', 'leftside'), 
			), 
		) ) );
	} 
	add_action('customize_register', 'leftside_theme_customizer');

?>