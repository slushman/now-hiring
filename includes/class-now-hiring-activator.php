<?php

/**
 * Fired during plugin activation
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since 		1.0.0
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/includes
 * @author 		Slushman <chris@slushman.com>
 */
class Now_Hiring_Activator {

	/**
	 * Declare custom post types, taxonomies, and plugin settings
	 * Flushes rewrite rules afterwards
	 *
	 * @since 		1.0.0
	 */
	public static function activate() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-now-hiring-admin.php';

		Now_Hiring_Admin::new_cpt_job();
		Now_Hiring_Admin::new_taxonomy_type();

		flush_rewrite_rules();

		$opts 		= array();
		$options 	= Now_Hiring_Admin::get_options_list();

		foreach ( $options as $option ) {

			$opts[ $option[0] ] = $option[2];

		}

		update_option( 'now-hiring-options', $opts );

		Now_Hiring_Admin::add_admin_notices();

	} // activate()
} // class
