<?php
/**
 * The view for the single job metadata for additional info
 */

if ( ! empty( $meta['job-additional-info'][0] ) ) {

	?><h3><?php echo esc_html( apply_filters( 'now-hiring-title-job-additional-info', 'Additional Information' ), 'now-hiring' ); ?></h3>
	<p class="<?php echo esc_attr( 'job-additional-info' ); ?>"><?php echo html_entity_decode( $meta['job-additional-info'][0] ); ?></p><?php

}