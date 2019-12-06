<?php
/**
 * Plugin Name: AffiliateWP - Affiliate Status Body Classes
 * Plugin URI: https://affiliatewp.com
 * Description: Adds body classes based on the affiliate's status
 * Author: Drew Jaynes, DrewAPicture
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */

add_filter( 'body_class', function( $body_classes ) {
	$affiliate = affwp_get_affiliate();

	if ( false !== $affiliate ) {
		// Current logged-in user is an affiliate.
		$body_classes[] = 'affwp-logged-in';

		// Current affiliate status (active, inactive, pending, rejected).
		$body_classes[] = "affwp-{$affiliate->status}-affiliate";
	}

	return $body_classes;
} );