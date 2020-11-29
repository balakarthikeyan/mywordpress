<?php
/**
 * Plugin Name: A Simple Widget
 * Plugin URI: https://www.github.com/balakarthikeyan/wp-plugins
 * Description: A widget that displays authors name.
 * Version: 1.0.0
 * Author: Balakarthikeyan
 * Author URI: https://www.github.com/balakarthikeyan
 * License: GPLv2 or later
 */

/**
 * Class Simple_Widget
 */
class Simple_Widget extends WP_Widget {

	/**
	 * Initializing the widget
	 */
	public function __construct() {
		$widget_ops = array( 'classname' => 'example', 'description' => __('A widget that displays the authors name', 'example') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'example-widget' );
		
		parent::__construct( 'example-widget', __('Example Widget', 'example'), $widget_ops, $control_ops );
	}

	/**
	 * Displaying the widget on the back-end
	 * @param  array $instance An instance of the widget
	 */
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Example', 'example'), 'name' => __('Balakarthikeyan', 'example'), 'show_info' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!--Widget Title: Text Input.-->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo stripslashes_deep ( esc_attr ($instance['title']) ); ?>" class="widefat" />
		</p>

		<!--Text Input.-->
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Your Name:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo stripslashes_deep ( esc_attr ($instance['name']) ); ?>" class="widefat" />
		</p>

		
		<!--Checkbox.-->
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_info'], true ); ?> id="<?php echo $this->get_field_id( 'show_info' ); ?>" name="<?php echo $this->get_field_name( 'show_info' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_info' ); ?>"><?php _e('Display info publicly?', 'example'); ?></label>
		</p>

	<?php
	}

	/**
	 * Making the widget updateable
	 * @param  array $new_instance New instance of the widget
	 * @param  array $old_instance Old instance of the widget
	 * @return array An updated instance of the widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['show_info'] = $new_instance['show_info'];

		return $instance;
	}

	/**
	 * Displaying the widget on the front-end
	 * @param  array $args     Widget options
	 * @param  array $instance An instance of the widget
	 */			
	public function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		if ( $name )
			printf( '<p>' . __('My name is %1$s.', 'example') . '</p>', $name );

		
		if ( $show_info )
			printf( $name );

		
		echo $after_widget;
	}
}

function Simple_Widget() {
	register_widget( 'Simple_Widget' );
}

add_action( 'widgets_init', 'Simple_Widget' );
