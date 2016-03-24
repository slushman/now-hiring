<?php
/**
 * The template for displaying all single jobs posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Now_Hiring
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Get a custom header-employee.php file, if it exists.
 * Otherwise, get default header.
 */
get_header( 'job' );

if ( have_posts() ) :

	/**
	 * now-hiring-single-before-loop hook
	 *
	 * @hooked 		job_single_content_wrap_start 		10
	 */
	do_action( 'now-hiring-single-before-loop' );

	while ( have_posts() ) : the_post();

		include now_hiring_get_template( 'single-content' );

	endwhile;

	/**
	 * now-hiring-single-after-loop hook
	 *
	 * @hooked 		job_single_content_wrap_end 		90
	 */
	do_action( 'now-hiring-single-after-loop' );

endif;

get_footer( 'job' );