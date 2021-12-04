<?php

/**
 *
 */
function _sSs_repeatable_features_meta_box_display() {
	global $post;

	$repeatable_fields = get_post_meta($post->ID, 'repeatable_feature_fields', true);

	wp_nonce_field( '_sSs_repeatable_features_meta_box_nonce', '_sSs_repeatable_features_meta_box_nonce' );
	?>

	<script type="text/javascript">
	jQuery(document).ready(function( $ ){
		$( '#add-feature-row' ).on('click', function() {
			var row = $( '.empty-features-row.screen-reader-text' ).clone(true);
			row.removeClass( 'empty-features-row screen-reader-text' );
			row.insertBefore( '#repeatable-features-fieldset-one tbody>tr:last' );
			return false;
		});

		$( '.remove-row' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});
	});
	</script>

	<table id="repeatable-features-fieldset-one" width="100%">
	<thead>
		<tr>
			<th width="40%">Name</th>
			<th width="52%">Value</th>
			<th width="8%"></th>
		</tr>
	</thead>
	<tbody>

	<?php
		if ($repeatable_fields):
    foreach ($repeatable_fields as $field) {
	?>

	<tr>
		<td><input type="text" class="widefat" name="feature_name[]" value="<?php if ($field['name'] != '') echo esc_attr($field['name']); ?>" /></td>
		<td><input type="text" class="widefat" name="feature_value[]" value="<?php if ($field['value'] != '') echo esc_attr($field['value']); ?>" /></td>
		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	<?php } else: // show a blank one ?>
	<tr>
		<td><input type="text" class="widefat" name="feature_name[]" /></td>
		<td><input type="text" class="widefat" name="feature_value[]" /></td>

		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	<?php endif; ?>

	<!-- empty hidden one for jQuery -->
	<tr class="empty-features-row screen-reader-text">
		<td><input type="text" class="widefat" name="feature_name[]" /></td>
		<td><input type="text" class="widefat" name="feature_value[]" /></td>

		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	</tbody>
	</table>

	<p><a id="add-feature-row" class="button" href="#">Add another</a></p>
	<?php
}

/**
 *
 */
function _sSs_repeatable_features_meta_box_save($post_id) {
	if (!isset($_POST['_sSs_repeatable_features_meta_box_nonce'])
		|| !wp_verify_nonce($_POST['_sSs_repeatable_features_meta_box_nonce'], '_sSs_repeatable_features_meta_box_nonce')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	$old = get_post_meta($post_id, 'repeatable_feature_fields', true);
	$new = array();

	$names = $_POST['feature_name'];
	$values = $_POST['feature_value'];

	$count = count($names);

	for ($i = 0;$i < $count;$i++) {
		if ($names[$i] != '') {
			$new[$i]['name'] = stripslashes(strip_tags($names[$i]));
			$new[$i]['value'] = stripslashes(strip_tags($values[$i]));
		}
	}

	if (!empty($new) && $new != $old) {
		update_post_meta($post_id, 'repeatable_feature_fields', $new);
	}
	elseif (empty($new) && $old) {
		delete_post_meta($post_id, 'repeatable_feature_fields', $old);
	}
}
add_action('save_post', '_sSs_repeatable_features_meta_box_save');
