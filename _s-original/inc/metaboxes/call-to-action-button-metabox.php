<?php

/**
 *
 */
function _sSs_call_to_action_button_meta_box_display() {
	global $post;

	$cta_button_icon = get_post_meta($post->ID, 'cta_button_icon_field', true);
	$cta_button_text = get_post_meta($post->ID, 'cta_button_text_field', true);
	$cta_button_url = get_post_meta($post->ID, 'cta_button_url_field', true);

	wp_nonce_field( '_sSs_cta_button_meta_box_nonce', '_sSs_cta_button_meta_box_nonce' );
	?>

	<table width="100%">
		<thead>
			<tr>
				<th width="20%">Button Icon</th>
				<th width="40%">Button Text</th>
				<th width="40%">Button URL</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input style="width: 100%;" type="text" name="cta-button-icon" value="<?php if ($cta_button_icon != '') echo esc_attr($cta_button_icon); ?>" /></td>
				<td><input style="width: 100%;" type="text" name="cta-button-text" value="<?php if ($cta_button_text != '') echo esc_attr($cta_button_text); ?>" /></td>
				<td><input style="width: 100%;" type="text" name="cta-button-url" value="<?php if ($cta_button_url != '') echo esc_attr($cta_button_url); ?>" /></td>
			</tr>
		</tbody>
	</table>

	<p>
		The Icons used on this site from from <a href="https://fontawesome.com/v5.15/icons" target="_blank">Font Awesome</a>. In order to set an icon
		properly the icon value must be set here. You can find the icons by searching on <a href="https://fontawesome.com/v5.15/icons" target="_blank">
		https://fontawesome.com/v5.15/icons</a>. You'll find a variety of icons with names (eg. "tag"). Enter that name in the icon field above to get
		that icon to display on the site. The name will be clearly displayed on the website with the icon.
	</p>
	<p>
		If you happen to click into an icon you may see HTML code that can be used to display the icon on the website. For example, the "tag" icon code
		will be displayed on the above site as <code>&lt;i class="fas fa-tag"&gt;&lt;/i&gt;</code>. The only part we are interested in for this site is
		the <code>tag</code> at the end - which you will note is just the name of the icon from the site.
	</p>
	<p>
		Common icons you'll want to use include:
		<ul>
			<li><code>tag</code> for "Get a Quote"</li>
			<li><code>envelope</code> for "Contact a Dealer"</li>
		</ul>
	</p>

	<?php
}

/**
 *
 */
function _sSs_call_to_action_button_meta_box_save($post_id) {
	if (!isset($_POST['_sSs_cta_button_meta_box_nonce'])
		|| !wp_verify_nonce($_POST['_sSs_call_to_action_button_meta_box_nonce'], '_sSs_call_to_action_button_meta_box_nonce')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	$old_icon = get_post_meta($post_id, 'cta_button_icon_field', true);
	$new_icon = $_POST['cta-button-icon'];

	if (!empty($new_icon) && $new_icon != $old_icon) {
		update_post_meta($post_id, 'cta_button_icon_field', $new_icon);
	}
	elseif (empty($new_icon) && $old_icon) {
		delete_post_meta($post_id, 'cta_button_icon_field', $old_icon);
	}

	$old_text = get_post_meta($post_id, 'cta_button_text_field', true);
	$new_text = $_POST['cta-button-text'];

	if (!empty($new_text) && $new_text != $old_text) {
		update_post_meta($post_id, 'cta_button_text_field', $new_text);
	}
	elseif (empty($new_text) && $old_text) {
		delete_post_meta($post_id, 'cta_button_text_field', $old_text);
	}

	$old_url = get_post_meta($post_id, 'cta_button_url_field', true);
	$new_url = $_POST['cta-button-url'];

	if (!empty($new_url) && $new_url != $old_url) {
		update_post_meta($post_id, 'cta_button_url_field', $new_url);
	}
	elseif (empty($new_url) && $old_url) {
		delete_post_meta($post_id, 'cta_button_url_field', $old_url);
	}
}
add_action('save_post', '_sSs_call_to_action_button_meta_box_save');
