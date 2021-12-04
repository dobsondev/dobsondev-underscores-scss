<?php

/**
 * Metabox backend display.
 */
function _sSs_second_content_meta_box_display() {
	global $post;

	wp_nonce_field( '_sSs_second_content_meta_box_nonce', '_sSs_second_content_meta_box_nonce' );

	$editor_text = get_post_meta( $post->ID, 'second_content_wysiwyg', true );
	wp_editor( htmlspecialchars_decode( $editor_text ), '_sSs_second_content_wysiwyg', $settings = array( 'textarea_name' => 'second-content-wysiwyg' ) );
}

/**
 * Save the data from the metabox when the post is saved.
 */
function _sSs_second_content_meta_box_save($post_id) {
	if (!isset($_POST['_sSs_second_content_meta_box_nonce'])
		|| !wp_verify_nonce($_POST['_sSs_second_content_meta_box_nonce'], '_sSs_second_content_meta_box_nonce')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	$editor_data = htmlspecialchars( $_POST['second-content-wysiwyg'] );
  update_post_meta( $post_id, 'second_content_wysiwyg', $editor_data );
}
add_action('save_post', '_sSs_second_content_meta_box_save');
