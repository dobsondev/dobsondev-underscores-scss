<?php

/**
 *
 */
function _sSs_links_bar_meta_box_display() {
	global $post;

	$link_bar_1_icon = get_post_meta($post->ID, 'link_bar_1_icon', true);
	$link_bar_1_text = get_post_meta($post->ID, 'link_bar_1_text', true);
	$link_bar_1_url = get_post_meta($post->ID, 'link_bar_1_url', true);

  $link_bar_2_icon = get_post_meta($post->ID, 'link_bar_2_icon', true);
	$link_bar_2_text = get_post_meta($post->ID, 'link_bar_2_text', true);
	$link_bar_2_url = get_post_meta($post->ID, 'link_bar_2_url', true);

	wp_nonce_field( '_sSs_links_bar_meta_box_nonce', '_sSs_links_bar_meta_box_nonce' );
	?>

	<table width="100%">
		<thead>
			<tr>
				<th width="20%">Link Icon</th>
				<th width="40%">Link Text</th>
				<th width="40%">Link URL</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input style="width: 100%;" type="text" name="link-bar-1-icon" value="<?php if ($link_bar_1_icon != '') echo esc_attr($link_bar_1_icon); ?>" /></td>
				<td><input style="width: 100%;" type="text" name="link-bar-1-text" value="<?php if ($link_bar_1_text != '') echo esc_attr($link_bar_1_text); ?>" /></td>
				<td><input style="width: 100%;" type="text" name="link-bar-1-url" value="<?php if ($link_bar_1_url != '') echo esc_attr($link_bar_1_url); ?>" /></td>
			</tr>
      <tr>
        <td><input style="width: 100%;" type="text" name="link-bar-2-icon" value="<?php if ($link_bar_2_icon != '') echo esc_attr($link_bar_2_icon); ?>" /></td>
				<td><input style="width: 100%;" type="text" name="link-bar-2-text" value="<?php if ($link_bar_2_text != '') echo esc_attr($link_bar_2_text); ?>" /></td>
				<td><input style="width: 100%;" type="text" name="link-bar-2-url" value="<?php if ($link_bar_2_url != '') echo esc_attr($link_bar_2_url); ?>" /></td>
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
			<li><code>user-friends</code> for "Become a Dealer"</li>
			<li><code>envelope</code> for "Contact Us"</li>
		</ul>
	</p>

	<?php
}

/**
 *
 */
function _sSs_links_bar_meta_box_save($post_id) {
	if (!isset($_POST['_sSs_links_bar_meta_box_nonce'])
		|| !wp_verify_nonce($_POST['_sSs_links_bar_meta_box_nonce'], '_sSs_links_bar_meta_box_nonce')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	$old_icon_1 = get_post_meta($post_id, 'link_bar_1_icon', true);
	$new_icon_1 = $_POST['link-bar-1-icon'];

	if (!empty($new_icon_1) && $new_icon_1 != $old_icon_1) {
		update_post_meta($post_id, 'link_bar_1_icon', $new_icon_1);
	}
	elseif (empty($new_icon_1) && $old_icon_1) {
		delete_post_meta($post_id, 'link_bar_1_icon', $old_icon_1);
	}

	$old_text_1 = get_post_meta($post_id, 'link_bar_1_text', true);
	$new_text_1 = $_POST['link-bar-1-text'];

	if (!empty($new_text_1) && $new_text_1 != $old_text_1) {
		update_post_meta($post_id, 'link_bar_1_text', $new_text_1);
	}
	elseif (empty($new_text_1) && $old_text_1) {
		delete_post_meta($post_id, 'link_bar_1_text', $old_text_1);
	}

	$old_url_1 = get_post_meta($post_id, 'link_bar_1_url', true);
	$new_url_1 = $_POST['link-bar-1-url'];

	if (!empty($new_url_1) && $new_url_1 != $old_url_1) {
		update_post_meta($post_id, 'link_bar_1_url', $new_url_1);
	}
	elseif (empty($new_url_1) && $old_url_1) {
		delete_post_meta($post_id, 'link_bar_1_url', $old_url_1);
	}

  $old_icon_2 = get_post_meta($post_id, 'link_bar_2_icon', true);
	$new_icon_2 = $_POST['link-bar-2-icon'];

	if (!empty($new_icon_2) && $new_icon_2 != $old_icon_2) {
		update_post_meta($post_id, 'link_bar_2_icon', $new_icon_2);
	}
	elseif (empty($new_icon_2) && $old_icon_2) {
		delete_post_meta($post_id, 'link_bar_2_icon', $old_icon_2);
	}

	$old_text_2 = get_post_meta($post_id, 'link_bar_2_text', true);
	$new_text_2 = $_POST['link-bar-2-text'];

	if (!empty($new_text_2) && $new_text_2 != $old_text_2) {
		update_post_meta($post_id, 'link_bar_2_text', $new_text_2);
	}
	elseif (empty($new_text_2) && $old_text_2) {
		delete_post_meta($post_id, 'link_bar_2_text', $old_text_2);
	}

	$old_url_2 = get_post_meta($post_id, 'link_bar_2_url', true);
	$new_url_2 = $_POST['link-bar-2-url'];

	if (!empty($new_url_2) && $new_url_2 != $old_url_2) {
		update_post_meta($post_id, 'link_bar_2_url', $new_url_2);
	}
	elseif (empty($new_url_2) && $old_url_2) {
		delete_post_meta($post_id, 'link_bar_2_url', $old_url_2);
	}
}
add_action('save_post', '_sSs_links_bar_meta_box_save');
