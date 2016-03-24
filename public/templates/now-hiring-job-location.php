<?php
/**
 * The view for the job location used in the loop
 */

if ( ! empty( $meta['job-location'][0] ) ) {

	?>, <span class="job-list-location"><?php echo esc_html( $meta['job-location'][0] ); ?></span><?php

}