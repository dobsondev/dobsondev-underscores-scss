<?php

/**
 * Metabox backend display.
 */
function _sSs_call_to_action_section_meta_box_display() {
	global $post;

	$cta_section_text = get_post_meta($post->ID, 'cta_section_button_text_field', true);
	$cta_section_url = get_post_meta($post->ID, 'cta_section_button_url_field', true);

	$cta_section_image_url = get_post_meta($post->ID, 'cta_section_image_url_field', true);

	wp_nonce_field( '_sSs_cta_section_meta_box_nonce', '_sSs_cta_section_meta_box_nonce' );

	$editor_text = get_post_meta( $post->ID, 'cta_section_wysiwyg', true );
	wp_editor( htmlspecialchars_decode( $editor_text ), '_sSs_cta_section_wysiwyg', $settings = array( 'textarea_name' => 'call-to-action-wysiwyg' ) );
  ?>

  <table width="100%">
		<thead>
			<tr>
				<th width="50%">Button Text</th>
				<th width="50%">Button URL</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input style="width: 100%;" type="text" name="cta-section-button-text" value="<?php if ($cta_section_text != '') echo esc_attr($cta_section_text); ?>" /></td>
				<td><input style="width: 100%;" type="text" name="cta-section-button-url" value="<?php if ($cta_section_url != '') echo esc_attr($cta_section_url); ?>" /></td>
			</tr>
		</tbody>
	</table>

	<script type="text/javascript">
	jQuery(document).ready(function($){

		var mediaUploader;

		$('#cta-section-image-upload-button').click(function(e) {
			e.preventDefault();
			// If the uploader object has already been created, reopen the dialog.
			if (mediaUploader) {
				mediaUploader.open();
				return;
			}

			// Extend the wp.media object.
			mediaUploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Call to Action Image',
				button: {
					text: 'Choose Image'
				},
				multiple: false
			});

			// When a file is selected, grab the URL and set it as the text field's value.
			mediaUploader.on('select', function() {
				var attachment = mediaUploader.state().get('selection').first().toJSON();
				$('#cta-section-image-url').val(attachment.url);
				$('#cta-section-image').attr('src', attachment.url);
			});

			// Open the uploader dialog.
			mediaUploader.open();
		});

		});
	</script>

	<h3>Call to Action Image</h3>
	<hr />
	<table width="100%">
		<thead>
			<tr>
				<th width="90%"></th>
				<th width="10%"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2">
					<img style="max-width: 100%;" id="cta-section-image" src="<?php if ($cta_section_image_url != '') { echo esc_attr($cta_section_image_url); } ?>" />
				</td>
			</tr>
			<tr>
				<td><input style="width: 100%;" id="cta-section-image-url" type="text" name="cta-section-image-url" value="<?php if ($cta_section_image_url != '') echo esc_attr($cta_section_image_url); ?>" /></td>
				<td><input id="cta-section-image-upload-button" type="button" class="button" value="Select Image" /></td>
			</tr>
		</tbody>
	</table>

  <?php
}

/**
 * Save the data from the metabox when the post is saved.
 */
function _sSs_call_to_action_section_meta_box_save($post_id) {
	if (!isset($_POST['_sSs_cta_section_meta_box_nonce'])
		|| !wp_verify_nonce($_POST['_sSs_cta_section_meta_box_nonce'], '_sSs_cta_section_meta_box_nonce')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	$old_button_text = get_post_meta($post_id, 'cta_section_button_text_field', true);
	$new_button_text = $_POST['cta-section-button-text'];

	if (!empty($new_button_text) && $new_button_text != $old_button_text) {
		update_post_meta($post_id, 'cta_section_button_text_field', $new_button_text);
	}
	elseif (empty($new_button_text) && $old_button_text) {
		delete_post_meta($post_id, 'cta_section_button_text_field', $old_button_text);
	}

  $old_button_url = get_post_meta($post_id, 'cta_section_button_url_field', true);
	$new_button_url = $_POST['cta-section-button-url'];

	if (!empty($new_button_url) && $new_button_url != $old_button_url) {
		update_post_meta($post_id, 'cta_section_button_url_field', $new_button_url);
	}
	elseif (empty($new_button_url) && $old_button_url) {
		delete_post_meta($post_id, 'cta_section_button_url_field', $old_button_url);
	}

	$old_image = get_post_meta($post_id, 'cta_section_image_url_field', true);
	$new_image = $_POST['cta-section-image-url'];

	if (!empty($new_image) && $new_image != $old_image) {
		update_post_meta($post_id, 'cta_section_image_url_field', $new_image);
	}
	elseif (empty($new_image) && $old_image) {
		delete_post_meta($post_id, 'cta_section_image_url_field', $old_image);
	}

	$editor_data = htmlspecialchars( $_POST['call-to-action-wysiwyg'] );
  update_post_meta( $post_id, 'cta_section_wysiwyg', $editor_data );
}
add_action('save_post', '_sSs_call_to_action_section_meta_box_save');
