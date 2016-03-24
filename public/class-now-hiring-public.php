<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/public
 * @author 		Slushman <chris@slushman.com>
 */
class Now_Hiring_Public {

	/**
	 * The plugin options.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options    The plugin options.
	 */
	private $options;

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$plugin_name 		The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 			The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$Now_Hiring 		The name of the plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->set_options();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/now-hiring-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/now-hiring-public.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Processes shortcode howtoapply
	 *
	 * @param   array	$atts		The attributes from the shortcode
	 *
	 * @uses	get_option
	 * @uses	get_layout
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function how_to_apply() {

		if ( empty( $this->options['howtoapply'] ) ) { return; }

		ob_start();

		include now_hiring_get_template( 'now-hiring-how-to-apply' );

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // how_to_apply()

	/**
	 * Processes shortcode nowhiring
	 *
	 * @param   array	$atts		The attributes from the shortcode
	 *
	 * @uses	get_option
	 * @uses	get_layout
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function list_openings( $atts = array() ) {

		ob_start();

		$defaults['loop-template'] 	= $this->plugin_name . '-loop';
		$defaults['order'] 			= 'date';
		$defaults['quantity'] 		= 100;
		$args						= shortcode_atts( $defaults, $atts, 'nowhiring' );
		$shared 					= new Now_Hiring_Shared( $this->plugin_name, $this->version );
		$items 						= $shared->get_openings( $args );

		if ( is_array( $items ) || is_object( $items ) ) {

			include now_hiring_get_template( $args['loop-template'] );

		} else {

			echo $items;

		}

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // list_openings()

	/**
	 * Registers all shortcodes at once
	 *
	 * @return [type] [description]
	 */
	public function register_shortcodes() {

		add_shortcode( 'nowhiring', array( $this, 'list_openings' ) );
		add_shortcode( 'nowhiring-howtoapply', array( $this, 'how_to_apply' ) );

	} // register_shortcodes()

	/**
	 * Adds a default single view template for a job opening
	 *
	 * @param 	string 		$template 		The name of the template
	 * @return 	mixed 						The single template
	 */
	public function single_cpt_template( $template ) {

		global $post;

		$return = $template;

	    if ( $post->post_type == 'job' ) {

			$return = now_hiring_get_template( 'single-job' );

		}

		return $return;

	} // single_cpt_template()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	} // set_options()

} // class
