<?php
/**
 * The view for the single job metadata for the file
 */

if ( ! empty( $meta['url-file'][0] ) ) {

	?><a class="link-file" href="<?php echo esc_url( $meta['url-file'][0] ); ?>"><?php

		esc_html_e( $meta['label-file'][0], 'now-hiring' );

	?></a><?php

}