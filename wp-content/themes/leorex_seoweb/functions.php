<?php


//Styles for the theme
function add_theme_styles() {
	wp_enqueue_style( 'slick', '/wp-content/themes/leorex_seoweb/css/slick.css', $media='all' );
	wp_enqueue_style( 'pure', '/wp-content/themes/leorex_seoweb/css/pure-min.css', $media='all' );
	wp_enqueue_style( 'fonts', '/wp-content/themes/leorex_seoweb/fonts/stylesheet.css', $media='all' );
	wp_enqueue_style( 'iconfont', '/wp-content/themes/leorex_seoweb/fonts/flaticon.css', $media='all' );
	wp_enqueue_style( 'style', '/wp-content/themes/leorex_seoweb/style.css', $deps = array(), $ver=null  ,$media = 'all');
}


//Scripts for the theme
function add_theme_scripts() {
	wp_enqueue_script( 'slick',  $src = '/wp-content/themes/leorex_seoweb/js/slick.min.js', $deps = array('jquery'),$ver = false,  $in_footer = true );
	wp_enqueue_script( 'waypoints',  $src = '/wp-content/themes/leorex_seoweb/js/waypoint.js', $deps = array('jquery'),$ver = false,  $in_footer = true );
	wp_enqueue_script( 'controller',  $src = '/wp-content/themes/leorex_seoweb/js/controller.js', $deps = array('jquery','waypoints','slick'), $ver = false, $in_footer = true );
	wp_enqueue_script( 'model',  $src = '/wp-content/themes/leorex_seoweb/js/model.js', $deps = array('jquery','waypoints','slick'), $ver = false, $in_footer = true );
	wp_enqueue_script( 'ui',  $src = '/wp-content/themes/leorex_seoweb/js/ui.js', $deps = array('jquery','waypoints','slick'), $ver = false, $in_footer = true );
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
add_action( 'wp_enqueue_scripts', 'add_theme_styles' );


// menu theme support
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );