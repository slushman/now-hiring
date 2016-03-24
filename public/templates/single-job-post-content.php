<?php
/**
 * The view for the post content used on the single post
 */

?><div class="content-job" itemtype="description">
	<h2><?php echo esc_html( apply_filters( 'now-hiring-title-job-label', 'Job Description' ), 'now-hiring' ); ?></h2><?php

	the_content();

?></div>