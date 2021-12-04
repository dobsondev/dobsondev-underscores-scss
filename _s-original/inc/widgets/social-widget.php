<?php

/**
 * Adds Social_Widget widget.
 */
class Social_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'social_widget', // Base ID
			'Social Widget', // Name
			array( 'description' => __( 'Social Media Links', '_sSs_text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		$facebook = $instance['facebook'];
		$facebook_icon = '<i class="fab fa-facebook-square"></i>';

		$twitter = $instance['twitter'];
		$twitter_icon = '<i class="fab fa-twitter-square"></i>';

		$insta = $instance['insta'];
		$insta_icon = '<i class="fab fa-instagram-square"></i>';

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		if ( ! empty( $facebook ) ) {
			echo '<a href="' . $facebook . '" target="_blank">' . $facebook_icon . '</a>';
		}
		if ( ! empty( $twitter ) ) {
			echo '<a href="' . $twitter . '" target="_blank">' . $twitter_icon . '</a>';
		}
		if ( ! empty( $insta ) ) {
			echo '<a href="' . $insta . '" target="_blank">' . $insta_icon . '</a>';
		}
		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		if ( isset( $instance[ 'facebook' ] ) ) {
			$facebook = $instance[ 'facebook' ];
		}
		else {
			$facebook = __( '', '_sSs_text_domain' );
		}
		if ( isset( $instance[ 'twitter' ] ) ) {
			$twitter = $instance[ 'twitter' ];
		}
		else {
			$twitter = __( '', '_sSs_text_domain' );
		}
		if ( isset( $instance[ 'insta' ] ) ) {
			$insta = $instance[ 'insta' ];
		}
		else {
			$insta = __( '', '_sSs_text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'facebook' ); ?>"><?php _e( 'Facebook URL:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
			<br />
			<label for="<?php echo $this->get_field_name( 'twitter' ); ?>"><?php _e( 'Twitter URL:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
			<br />
			<label for="<?php echo $this->get_field_name( 'insta' ); ?>"><?php _e( 'Instagram URL:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'insta' ); ?>" name="<?php echo $this->get_field_name( 'insta' ); ?>" type="text" value="<?php echo esc_attr( $insta ); ?>" />
		</p>
	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook'] = ( !empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['twitter'] = ( !empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
		$instance['insta'] = ( !empty( $new_instance['insta'] ) ) ? strip_tags( $new_instance['insta'] ) : '';

		return $instance;
	}

} // END class Social_Widget
function register_social_widget() {
  register_widget( 'social_widget' );
}
// Register Social_Widget widget
add_action( 'widgets_init', 'register_social_widget' );
