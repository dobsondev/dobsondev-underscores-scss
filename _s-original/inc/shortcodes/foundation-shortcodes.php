<?php

/**
 * Shortcode for foundation grid-container div
 * [grid-container] and [/grid-container]
 *
 * https://codex.wordpress.org/Shortcode_API
 */
function foundation_grid_container_shortcode( $atts, $content = NULL ) {
	return '<div class="grid-container">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'grid-container', 'foundation_grid_container_shortcode' );

/**
 * Shortcode for foundation grid-x div
 * [grid-x] and [/grid-x]
 *
 * https://codex.wordpress.org/Shortcode_API
 */
function foundation_grid_x_shortcode( $atts, $content = NULL ) {
	return '<div class="grid-x">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'grid-x', 'foundation_grid_x_shortcode' );

/**
 * Shortcode for foundation cell div
 * [cell classes="small-12 medium-6 large-4"] and [/cell]
 *
 * https://codex.wordpress.org/Shortcode_API
 */
function foundation_cell_shortcode( $atts, $content = NULL ) {
	$attributes = shortcode_atts( array(
		'classes' => 'small-12',
	), $atts );
	return '<div class="' . $attributes['classes'] .' cell">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'cell', 'foundation_cell_shortcode' );
