<?php
/**
 * Plugin Name: AffiliateWP - Set Default Affiliate Area Tab
 * Plugin URI: https://affiliatewp.com
 * Description: Forces AffiliateWP to treat a specific tab as the default (always loading it initially)
 * Author: Drew Jaynes, DrewAPicture
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */

add_filter( 'affwp_affiliate_area_tabs', function( $tabs ) {
	// Set your tab slug.
	$new_default_tab = 'welcome'

	// Remove the tab from wherever in the list it falls.
	if ( $key = array_search( $new_default_tab, $tabs ) ) {
		unset( $tabs[ $key ] );

		// Add the tab back to the beginning of the array.
		array_unshift( $tabs, $new_default_tab );
	}

	// Re-index the array.
	$tabs = array_values( $tabs );

	return $tabs;
} );
