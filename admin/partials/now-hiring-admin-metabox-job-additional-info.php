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

wp_nonce_field( $this->plugin_name, 'job_additional_info' );

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'job-location';
$atts['label'] 			= 'Location';
$atts['name'] 			= 'job-location';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );

?></p><?php



$atts 					= array();
$atts['description'] 	= '';
$atts['id'] 			= 'job-responsibilities';
$atts['label'] 			= 'Responsibilities';
$atts['settings']['textarea_name'] = 'job-responsibilities';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

//include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-textarea.php' );
include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-editor.php' );

?></p><?php



$atts 					= array();
$atts['description'] 	= '';
$atts['id'] 			= 'job-additional-info';
$atts['label'] 			= 'Additional Info';
$atts['settings']['textarea_name'] = 'job-additional-info';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-editor.php' );

?></p>