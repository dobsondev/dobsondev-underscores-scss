<?php

/**
 * https://codex.wordpress.org/Shortcode_API
 */
function _sSs_call_to_action_shortcode( $atts, $content = NULL ) {
  extract(shortcode_atts(array(
    'text' => "Contact Us Today!",
    'icon' => "envelope",
    'url' => "/contact-us",
    'button' => "Get in Touch",
  ), $atts));

  $output = '<div class="call-to-action-shortcode">';
  $output .= '<div class="text-container">';
  $output .= $text;
  $output .= '</div>';
  $output .= '<div class="button-container">';
  $output .= '<a class="button" href="' . $url . '"> <i class="fas fa-' . $icon . '"></i>' . $button . '</a>';
  $output .= '</div>';
  $output .= '</div><!-- .call-to-action-shortcode -->';

	return $output;
}
add_shortcode( 'call-to-action', '_sSs_call_to_action_shortcode' );
