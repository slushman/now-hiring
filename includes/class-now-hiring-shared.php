<?php

/**
 * The public & admin-facing shared functionality of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/includes
 */

/**
 * The public & admin-facing shared functionality of the plugin.
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/includes
 * @author 		Slushman <chris@slushman.com>
 */

 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) { exit; }

class Now_Hiring_Shared {

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
	 * @param 		string 			$Now_Hiring 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $i18n, $version ) {

		$this->i18n = $i18n;
		$this->version = $version;

	}

	/**
	 * Flushes widget cache
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @param 		int 		$post_id 		The post ID
	 * @return 		void
	 */
	public function flush_widget_cache( $post_id ) {

		if ( wp_is_post_revision( $post_id ) ) { return; }

		$post = get_post( $post_id );

		if ( $post->post_type == 'jobs' ) {

			wp_cache_delete( $this->i18n, 'widget' );

		}

	}

	/**
	 * Registers widgets with WordPress
	 *
	 * @since 		1.0.0
	 * @access 		public
	 */
	public function widgets_init() {

		register_widget( 'now_hiring_widget' );

	} // widgets_init()

} // class