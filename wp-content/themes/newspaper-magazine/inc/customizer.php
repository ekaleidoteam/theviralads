<?php
/**
 * Newspaper Magazine Theme Customizer
 *
 * @package Newspaper_Magazine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newspaper_magazine_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// 
	require_once trailingslashit( get_template_directory() ) . '/inc/class.php'; 

	// Sanitization Callback
	require_once trailingslashit( get_template_directory() ) . '/inc/sanitize.php'; 

	// Customization Options
	require_once trailingslashit( get_template_directory() ) . '/inc/options.php';

}
add_action( 'customize_register', 'newspaper_magazine_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function newspaper_magazine_customize_preview_js() {
	wp_enqueue_script( 'newspaper_magazine_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'newspaper_magazine_customize_preview_js' );
