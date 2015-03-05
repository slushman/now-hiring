<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/public/partials
 */

foreach ( $items->posts as $item ) {

	include( plugin_dir_path( __FILE__ ) . 'now-hiring-public-display-single.php' );

} // foreach

?>