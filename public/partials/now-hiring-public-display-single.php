<?php

/**
 * Provide a public-facing view for a single post
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/public/partials
 */

?>

<div class="job-wrap">
	<h1 class="job-title"><a href="<?php echo get_permalink( $item->ID ); ?>"><?php echo esc_attr( $item->post_title ); ?></a></h1>
	<div class="job-content"><?php echo $item->post_content; ?></h1>
</div>