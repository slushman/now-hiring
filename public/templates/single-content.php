<?php
/**
 * The template for displaying all single job posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Now_Hiring
 */

$meta = get_post_custom( $post->ID );

/**
 * now-hiring-before-single hook
 */
do_action( 'now-hiring-before-single', $meta );

?><div class="wrap-job"><?php

	/**
	 * now-hiring-before-single-content hook
	 */
	do_action( 'now-hiring-before-single-content', $meta );

		/**
		 * now-hiring-single-content hook
		 */
		do_action( 'now-hiring-single-content', $meta );

	/**
	 * now-hiring-after-single-content hook
	 */
	do_action( 'now-hiring-after-single-content', $meta );

?></div><!-- .wrap-employee --><?php

/**
 * now-hiring-after-single hook
 */
do_action( 'now-hiring-after-single', $meta );