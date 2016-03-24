<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the archive loop.
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Now_Hiring
 * @subpackage Now_Hiring/public/partials
 */

/**
 * now-hiring-before-loop hook
 *
 * @hooked 		list_wrap_start 		10
 */
do_action( 'now-hiring-before-loop' );

foreach ( $items as $item ) {

	$meta = get_post_custom( $item->ID );

	/**
	 * now-hiring-before-loop-content hook
	 *
	 * @param 		object  	$item 		The post object
	 *
	 * @hooked 		content_wrap_start 		10
	 */
	do_action( 'now-hiring-before-loop-content', $item, $meta );

		/**
		 * now-hiring-loop-content hook
		 *
		 * @param 		object  	$item 		The post object
		 *
		 * @hooked 		content_job_title 		10
		 * @hooked 		content_job_location 	15
		 */
		do_action( 'now-hiring-loop-content', $item, $meta );

	/**
	 * now-hiring-after-loop-content hook
	 *
	 * @param 		object  	$item 		The post object
	 *
	 * @hooked 		content_link_end 		10
	 * @hooked 		content_wrap_end 		90
	 */
	do_action( 'now-hiring-after-loop-content', $item, $meta );

} // foreach

/**
 * now-hiring-after-loop hook
 *
 * @hooked 		list_wrap_end 			10
 */
do_action( 'now-hiring-after-loop' );
