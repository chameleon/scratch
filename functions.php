<?php
/*
Call a function to do an action with a hook
*/


/*
======================
Include Scripts
======================
*/

/* Use this functions.php to activate features and include css, js, fonts, etc */
function scratch_script_enqueue(){
	//same as enqueue but with register function name
	wp_register_style( 'bootstrapcss', get_template_directory_uri() .'/css/bootstrap.css', array(), '3.3.7', 'all' );
	wp_register_style( 'myStyle', get_template_directory_uri() .'/css/scratch.css', array(), '1.0.0', 'all' );
	wp_register_style( 'robotoStyle', get_template_directory_uri() .'/css/robotoFont.css', array(), '1.0.0', 'all' );
	wp_register_style( 'iconicStyle', get_template_directory_uri() .'/css/material-design-iconic-font.min.css', array(), '1.0.0', 'all' );

	// CSS
	//wp_enqueue_style( 'bootstrapcss', get_template_directory_uri() .'/css/bootstrap-menu.css', array(), '3.3.7', 'all' );
	wp_enqueue_style( 'bootstrapcss', get_template_directory_uri() .'/css/bootstrap.css', array(), '3.3.7', 'all' );

	wp_enqueue_style( 'myStyle', get_template_directory_uri() .'/css/scratch.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'robotoStyle', get_template_directory_uri() .'/css/robotoFont.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'iconicStyle', get_template_directory_uri() .'/css/material-design-iconic-font.min.css', array(), '1.0.0', 'all' );

	// JS
	//enables the jquery that is built into wordpress BUT is better t use your own version for version control and WHERE on the age it is loaded!, etc.  Using my own now.
	/*	wp_enqueue_script( 'jquery');  */
	//  OR ... use your own version for control
	$myJqueryVersionNum = '2.1.4';
	wp_enqueue_script( 'myJquery', get_template_directory_uri() . '/js/jquery-' . $myJqueryVersionNum . '.min.js', array(), '1.0.0', true ); 

	wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.7', true );
	// wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.7', true );


	wp_enqueue_script( 'myScript', get_template_directory_uri() . '/js/scratch.js', array(), '1.0.0', true );  //true means this script WILL be written in the FOOTER
	wp_enqueue_script( 'scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array(), '1.0.0', true );
	

	
	
}
/* This has an 's' on the end- is a WP reserved 'when' function name */
add_action( 'wp_enqueue_scripts', 'scratch_script_enqueue' );


/*
======================
Include Fonts
======================
*/
//Add ROBOTO font  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
function wpb_add_google_fonts() {
	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,300,500,700', false );
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

/*
function add_circus_font() {
	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,300,500,700', false );
}
add_action( 'wp_enqueue_scripts', 'add_circus_font' );
*/


/*
======================
Activate Menus
======================
*/
function scratch_theme_setup(){
	add_theme_support( 'menus');

	register_nav_menu( 'primary', 'Primary Heaver Nav' );
	/*  Look on header.php for placeholder  */

	register_nav_menu( 'secondary', 'Footer Nav' );
}
add_action( 'init', 'scratch_theme_setup');

/*
======================
Enable Features in theme support
======================
*/
add_theme_support( 'custom-background');
add_theme_support( 'custom-header');
add_theme_support( 'post-thumbnails');

//give users ability to choose from 10 preset WP post formats- here's 3:
add_theme_support('post-formats', array('aside','image','video'));


/* Setup a SIDEBAR or two */
function scratch_widget_setup(){
	   /**
		* Creates a sidebar
		* @param string|array  Builds Sidebar based off of 'name' and 'id' values.
		*/
		$args = array(
			'name'          => __( 'Sidebar name', 'theme_text_domain' ),
			'id'            => 'unique-sidebar-id',
			'description'   => 'Main Sidebar here',
			'class'         => 'custom',  //generates the class .sidebar_custom  !!
			'before_widget' => '<li id="%1" class="widget %2">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		);
		register_sidebar( $args );
		/* Another sidebar here */
		// $args = array(
		// 	'name'          => __( 'Sidebar name', 'theme_text_domain' ),
		// 	'id'            => 'unique-sidebar-id',
		// 	'description'   => 'Main Sidebar here',
		// 	'class'         => 'custom',  //generates the class .sidebar_custom  !!
		// 	'before_widget' => '<li id="%1" class="widget %2">',
		// 	'after_widget'  => '</li>',
		// 	'before_title'  => '<h2 class="widgettitle">',
		// 	'after_title'   => '</h2>'
		// );
		// register_sidebar( $args );
	
}
/* 1st param is WHEN, */
add_action( 'widgets_init', 'scratch_widget_setup' );

/*  NOTES  */
// Registering the CSS Files
// If you're going to load CSS stylesheets, you should register them first with the wp_register_style() function:

// 1
// 2
// 3
// <? php
// wp_register_style( $handle, $src, $deps, $ver, $media );
// ? >
// $handle (string, required) is unique name for your stylesheet. Other functions will use this "handle" to enqueue and print your stylesheet.
// $src (string, required) refers to the URL of the stylesheet. You can use functions like get_template_directory_uri() to get the style files inside your theme's directory. Don't ever think about hard-coding it!
// $deps (array, optional) handles names for dependent styles. If your stylesheet won't work if some other style file is missing, use this parameter to set the "dependencies".
// $ver (string or boolean, optional) is the version number. You can use your theme's version number or make up one, if you want. If you don't want to use a version number, set it to null. It defaults to false, which makes WordPress add its own version number.
// $media (string, optional) is the CSS media types like "screen" or "handheld" or "print". If you're not sure you need to use this, don't use it. It defaults to "all".
/*
======================
REGISTER CSS 
(optional?  What about in WP 4.6 Pepper? )
// EX.  wp_register_style( $handle, $src, $deps, $ver, $media );
======================
*/


?>