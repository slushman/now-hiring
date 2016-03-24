<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @author 				slushman
 * @link 				http://slushman.com
 * @since 				1.0.0
 * @package 			Now_Hiring
 *
 * @wordpress-plugin
 * Plugin Name: 		Now Hiring
 * Plugin URI: 			http://slushman.com/plugins/now-hiring/
 * Description: 		A simple way to manage job opening posts
 * Version: 			1.0.0
 * Author: 				Slushman
 * Author URI: 			http://slushman.com/
 * License: 			GPL-2.0+
 * License URI: 		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: 		now-hiring
 * Domain Path: 		/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Used for referring to the plugin file or basename
if ( ! defined( 'NOW_HIRING_FILE' ) ) {
	define( 'NOW_HIRING_FILE', plugin_basename( __FILE__ ) );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-now-hiring-activator.php
 */
function activate_Now_Hiring() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-now-hiring-activator.php';
	Now_Hiring_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-now-hiring-deactivator.php
 */
function deactivate_Now_Hiring() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-now-hiring-deactivator.php';
	Now_Hiring_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Now_Hiring' );
register_deactivation_hook( __FILE__, 'deactivate_Now_Hiring' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-now-hiring.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 		1.0.0
 */
function run_Now_Hiring() {

	$plugin = new Now_Hiring();
	$plugin->run();

}
run_Now_Hiring();
