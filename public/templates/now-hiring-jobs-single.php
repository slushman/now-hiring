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

$meta = get_post_custom( $item->ID );
$value = '';

if ( ! empty( $meta['job-location'][0] ) ) {

	$value = esc_attr( $meta['job-location'][0] );

}

//pretty( $meta );

?><div class="job-wrap">
	<p class="job-title"><a href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>"><?php echo esc_html( $item->post_title ); ?></a></p>
</div>