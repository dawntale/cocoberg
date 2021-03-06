<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Cocoberg
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cocoberg_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds custom layout classes to the of body classes.
	if (get_theme_mod( 'cocoberg_theme_layouts_settings')){
		$layout = get_theme_mod( 'cocoberg_theme_layouts_settings', 'full-width' );
		$classes[] = 'layout-' . $layout;
	}

	return $classes;
}
add_filter( 'body_class', 'cocoberg_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cocoberg_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'cocoberg_pingback_header' );
