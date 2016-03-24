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

?><ol class="wrap-jobs"><?php

foreach ( $items->posts as $item ) {

	do_action( 'now-hiring-jobs-list-before' );

	?><li class="single-job"><?php

	include now_hiring_get_template( $args['view-single'] );

	?></li><?php

	do_action( 'now-hiring-jobs-list-after' );

} // foreach

?></ol><?php