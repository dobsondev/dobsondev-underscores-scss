<?php
/**
 * A collection of extra and extremely useful filters, actions and hooks.
 *
 * @package _sSs
 */

/**
 * Flush out the transients used in _sSs_categorized_blog.
 */
function _sSs_category_transient_flusher() {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  // Like, beat it. Dig?
  delete_transient( '_sSs_categories' );
}
add_action( 'edit_category', '_sSs_category_transient_flusher' );
add_action( 'save_post',     '_sSs_category_transient_flusher' );

/**
 * Change default embed to have wrapper so we can style it properly. Style can be found
 * in section 10.3 in style.css.
 *
 * https://wordpress.stackexchange.com/questions/134228/how-to-overwrite-youtube-embed
 * https://developer.wordpress.org/reference/hooks/embed_oembed_html/
 */
function _sSs_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="embed-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', '_sSs_embed_oembed_html', 99, 4 );
