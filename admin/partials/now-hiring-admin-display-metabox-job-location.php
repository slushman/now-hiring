<?php

/**
 * Provide the view for a metabox
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Now_Hiring
 * @subpackage 	Now_Hiring/admin/partials
 */

$meta = get_post_custom( $object->ID );
$value = '';

print_r( $meta );

if ( ! empty( $meta['job-location'][0] ) ) {

	$value = $meta['job-location'][0];

}

wp_nonce_field( NOW_HIRING_BASENAME, 'job_location_nonce' );

?><p>
	<label for="job-location"><?php _e( 'Location', $this->i18n ); ?>: </label>
	<input class="widefat" type="text" name="job-location" id="job-location" value="<?php echo esc_attr( $value ); ?>" />
</p>