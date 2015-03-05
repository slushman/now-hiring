<?php

/**
 * The widget functionality of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/includes
 */

/**
 * The widget functionality of the plugin.
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/includes
 * @author 		Slushman <chris@slushman.com>
 */
class Now_Hiring_Widget extends WP_Widget {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 			$fields 		Contains all the field info
	 */
	private $fields;

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$i18n 		The ID of this plugin.
	 */
	private $i18n;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		$this->i18n 			= 'now-hiring';
		$name 					= __( 'Now Hiring', 'now-hiring' );
		$opts['classname'] 		= '';
		$opts['description'] 	= __( 'Display job postings on a sidebar', 'now-hiring' );
		$control				= array( 'width' => '', 'height' => '' );

		parent::__construct( false, $name, $opts, $control );

		// Create all the form fields here. This is used for both form() and update()
		$this->fields[] = array( 'name' => 'Title', 'underscored' => 'title', 'type' => 'text', 'value' => 'Now Hiring' );

	} // __construct()

	/**
	 * Back-end widget form.
	 *
	 * @see		WP_Widget::form()
	 *
	 * @uses	wp_parse_args
	 * @uses	esc_attr
	 * @uses	get_field_id
	 * @uses	get_field_name
	 * @uses	checked
	 *
	 * @param	array	$instance	Previously saved values from database.
	 */
	function form( $instance ) {

		$defaults['title'] = '';
		$instance 			= wp_parse_args( (array) $instance, $defaults );

		$textfield 	= 'title'; // This is the name of the textfield
		$id 		= $this->get_field_id( $textfield );
		$name 		= $this->get_field_name( $textfield );
		$value 		= esc_attr( $instance[$textfield] );

		echo '<p><label for="' . $id . '">' . __( ucwords( $textfield ) ) . ': <input class="widefat" id="' . $id . '" name="' . $name . '" type="text" value="' . $value . '" /></label>';

		// foreach ( $this->fields as $field ) {

		// 	$corv 				= ( $field['type'] == 'checkbox' ? 'check' : 'value' );
		// 	$args[$corv]		= ( isset( $instance[$field['underscored']] ) ? $instance[$field['underscored']] : $field['value'] );
		// 	$args['blank']		= ( $field['type'] == 'select' ? TRUE : '' );
		// 	$args['class']		= $field['underscored'] . ( $field['type'] == 'text' ? ' widefat' : '' );
		// 	$args['desc'] 		= ( !empty( $field['desc'] ) ? $field['desc'] : '' );
		// 	$args['id'] 		= $this->get_field_id( $field['underscored'] );
		// 	$args['label']		= $field['name'];
		// 	$args['name'] 		= $this->get_field_name( $field['underscored'] );
		// 	$args['selections']	= ( !empty( $field['sels'] ) ? $field['sels'] : array() );
		// 	$args['type'] 		= ( empty( $field['type'] ) ? '' : $field['type'] );

		// 	echo '<p>' . $adp->create_settings( $args ) . '</p>';

		// } // End of $fields foreach

	} // form()

	/**
	 * Front-end display of widget.
	 *
	 * @see		WP_Widget::widget()
	 *
	 * @uses	apply_filters
	 * @uses	get_widget_layout
	 *
	 * @param	array	$args		Widget arguments.
	 * @param 	array	$instance	Saved values from database.
	 */
	function widget( $args, $instance ) {

		$cache = wp_cache_get( $this->i18n, 'widget' );

		if ( ! is_array( $cache ) ) {

			$cache = array();

		}

		if ( ! isset ( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->i18n;

		}

		if ( isset ( $cache[ $args['widget_id'] ] ) ) {

			return print $cache[ $args['widget_id'] ];

		}

		extract( $args, EXTR_SKIP );

		$widget_string = $before_widget;

		// Manipulate widget's values based on their input fields here

		ob_start();

		include( plugin_dir_path( __FILE__ ) . 'partials/now-hiring-display-widget.php' );

		$widget_string .= ob_get_clean();
		$widget_string .= $after_widget;

		$cache[ $args['widget_id'] ] = $widget_string;

		wp_cache_set( $this->i18n, $cache, 'widget' );

		print $widget_string;

	} // widget()

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see		WP_Widget::update()
	 *
	 * @param	array	$new_instance	Values just sent to be saved.
	 * @param	array	$old_instance	Previously saved values from database.
	 *
	 * @return 	array	$instance		Updated safe values to be saved.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = sanitize_text_field( $new_instance['title'] );

/*		foreach ( $this->fields as $field ) {

			$name = $field['underscored'];

			switch ( $field['type'] ) {

				case ( 'email' )		: $instance[$name] = sanitize_email( $new_instance[$name] ); break;
				case ( 'number' )		: $instance[$name] = intval( $new_instance[$name] ); break;
				case ( 'url' ) 			: $instance[$name] = esc_url( $new_instance[$name] ); break;
				case ( 'text' ) 		: $instance[$name] = sanitize_text_field( $new_instance[$name] ); break;
				case ( 'textarea' )		: $instance[$name] = esc_textarea( $new_instance[$name] ); break;
				case ( 'checkgroup' ) 	: $instance[$name] = strip_tags( $new_instance[$name] ); break;
				case ( 'radios' ) 		: $instance[$name] = strip_tags( $new_instance[$name] ); break;
				case ( 'select' )		: $instance[$name] = strip_tags( $new_instance[$name] ); break;
				case ( 'tel' ) 			: $instance[$name] = $adp->sanitize_phone( $new_instance[$name] ); break;
				case ( 'checkbox' ) 	: $instance[$name] = ( isset( $new_instance[$name] ) ? 1 : 0 ); break;

			} // switch

		} // foreach*/

		return $instance;

	} // update()

} // class
