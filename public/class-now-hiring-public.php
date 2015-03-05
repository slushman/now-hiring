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
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$i18n 		The ID of this plugin.
	 */
	private $i18n;

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
	public function __construct( $i18n, $version ) {

		$this->i18n = $i18n;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->i18n, plugin_dir_url( __FILE__ ) . 'css/now-hiring-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->i18n, plugin_dir_url( __FILE__ ) . 'js/now-hiring-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Registers all shortcodes at once
	 *
	 * @return [type] [description]
	 */
	public function register_shortcodes() {

		add_shortcode( 'nowhiring', array( $this, 'shortcode' ) );

	} // register_shortcodes()

	/**
	 * Processes shortcode
	 *
	 * @param   array	$atts		The attributes from the shortcode
	 *
	 * @uses	get_option
	 * @uses	get_layout
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function shortcode( $atts ) {

		ob_start();

		$defaults['order'] 		= 'date';
		$defaults['quantity'] 	= -1;
		$args					= wp_parse_args( $atts, $defaults );
		$items 					= $this->get_job_posts( $args );

		if ( is_array( $items ) || is_object( $items ) ) {

			include( plugin_dir_path( __FILE__ ) . 'partials/now-hiring-public-display.php' );

		} else {

			echo $items;

		}

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode()

	/**
	 * Returns a post object of portfolio posts
	 *
	 * @param 	array 		$params 			An array of optional parameters
	 * 							types 			An array of portfolio item type slugs
	 * 							industries		An array of portfolio industry slugs
	 * 							quantity		Number of posts to return
	 *
	 * @return 	object 		A post object
	 */
	private function get_job_posts( $params ) {

		$return = '';

		$args['post_type'] 		= 'jobs';
		$args['post_status'] 	= 'publish';
		$args['order_by'] 		= $params['order'];
		$args['posts_per_page'] = $params['quantity'];

		$query = new WP_Query( $args );

		if ( 0 == $query->found_posts ) {

			$return = '<p>Thank you for your interest! There are no job openings at this time.</p>';

		} else {

			$return = $query;

		}

		return $return;

	} // get_job_posts()

}
