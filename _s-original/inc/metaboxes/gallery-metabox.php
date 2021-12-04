<?php

/**
 *
 */
function _sSs_gallery_meta_box_display() {
	global $post;

	$featured_image = get_post_meta($post->ID, 'gallery_featured_image_url_field', true);

	wp_nonce_field( '_sSs_gallery_meta_box_nonce', '_sSs_gallery_meta_box_nonce' );
	?>

	<script type="text/javascript">
	jQuery(document).ready(function($){

		var mediaUploader;

		$('#gallery-featured-image-upload-button').click(function(e) {
			e.preventDefault();
			// If the uploader object has already been created, reopen the dialog.
			if (mediaUploader) {
				mediaUploader.open();
				return;
			}

			// Extend the wp.media object.
			mediaUploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Gallery Featured Image',
				button: {
					text: 'Choose Image'
				},
				multiple: false
			});

			// When a file is selected, grab the URL and set it as the text field's value.
			mediaUploader.on('select', function() {
				var attachment = mediaUploader.state().get('selection').first().toJSON();
				$('#gallery-featured-image-url').val(attachment.url);
				$('#featured-image').attr('src', attachment.url);
			});

			// Open the uploader dialog.
			mediaUploader.open();
		});

		});
	</script>

	<h3>Gallery Featured Image</h3>
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
					<img style="max-width: 100%;" id="featured-image" src="<?php if ($featured_image != '') { echo esc_attr($featured_image); } ?>" />
				</td>
			</tr>
			<tr>
				<td><input style="width: 100%;" id="gallery-featured-image-url" type="text" name="gallery-featured-image-url" value="<?php if ($featured_image != '') echo esc_attr($featured_image); ?>" /></td>
				<td><input id="gallery-featured-image-upload-button" type="button" class="button" value="Select Featured Image" /></td>
			</tr>
		</tbody>
	</table>

	<p>
		&nbsp;
	</p>

	<h3>Gallery Grid</h3>
	<hr />
	<?php

	$editor_text = get_post_meta( $post->ID, 'gallery_wysiwyg', true );
	wp_editor( htmlspecialchars_decode( $editor_text ), '_sSs_gallery_wysiwyg', $settings = array( 'textarea_name' => 'gallery-wysiwyg' ) );
}

/**
 *
 */
function _sSs_gallery_meta_box_save($post_id) {
	if (!isset($_POST['_sSs_gallery_meta_box_nonce'])
		|| !wp_verify_nonce($_POST['_sSs_gallery_meta_box_nonce'], '_sSs_gallery_meta_box_nonce')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	$old = get_post_meta($post_id, 'gallery_featured_image_url_field', true);
	$new = $_POST['gallery-featured-image-url'];

	if (!empty($new) && $new != $old) {
		update_post_meta($post_id, 'gallery_featured_image_url_field', $new);
	}
	elseif (empty($new) && $old) {
		delete_post_meta($post_id, 'gallery_featured_image_url_field', $old);
	}

	$editor_data = htmlspecialchars( $_POST['gallery-wysiwyg'] );
  update_post_meta( $post_id, 'gallery_wysiwyg', $editor_data );
}
add_action('save_post', '_sSs_gallery_meta_box_save');
