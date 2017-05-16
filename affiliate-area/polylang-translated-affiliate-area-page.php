<?php
/**
 * Plugin Name: AffiliateWP - Polylang Translated Affiliate Area
 * Plugin URI: https://affiliatewp.com
 * Description: Makes it possible to have an Affiliate Area page translated with Polylang.
 * Author: Drew Jaynes, DrewAPicture
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */

/**
 * Filters the Affiliate Area page ID for the current language in Polylang.
 *
 * @param int $page_id Affiliate Area page ID.
 * @return int (Maybe) filtered Affiliate Area page ID.
 */
function affwp_polylang_filter_affiliate_area_id( $page_id ) {
	if ( function_exists( 'pll_get_post' ) && ! is_admin() ) {
		$page_id = pll_get_post( $page_id );
	}

	return $page_id;
}
add_filter( 'affwp_affiliate_area_page_id', 'affwp_polylang_filter_affiliate_area_id' );
