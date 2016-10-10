<?php

function danny_script_enqueue() {
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/danny.css', array(), '1.0.0', 'all');
	wp_enqueue_script('customjs', get_template_directory_uri() . '/js/danny.js', array(), '1.0.0', true);
}

add_action( 'wp_enqueue_scripts', 'danny_script_enqueue');

function danny_theme_setup() {
	add_theme_support( 'menus' );

	register_nav_menu('primary', 'Primary Header Navigation');
}

add_action('init', 'danny_theme_setup');