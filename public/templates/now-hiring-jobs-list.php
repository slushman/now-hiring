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

do_action( 'now-hiring-jobs-list-before' );

foreach ( $items->posts as $item ) {

	include now_hiring_get_template( $args['view-single'] );

} // foreach

do_action( 'now-hiring-jobs-list-after' );