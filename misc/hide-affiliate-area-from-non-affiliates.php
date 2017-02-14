<?php
/**
 * Plugin Name: AffiliateWP - Hide Affiliate Area From Non Affiliates
 * Plugin URI: http://affiliatewp.com
 * Description: Hides the Affiliate Area from appearing in the site navigation unless the user is an affiliate
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

function affwp_custom_hide_affiliate_area_from_non_affiliates( $items, $menu, $args ) {
    
    if ( ! function_exists( 'affiliate_wp' ) ) {
		return $items;
	}
    
    // grab the page ID of the affiliate area
    // Alternatively you can just set a page ID here
    // For example: $affiliate_area_page_id = 5;
    $affiliate_area_page_id = affiliate_wp()->settings->get( 'affiliates_page' );

    // loop through and remove the page from the menu if user is not an affiliate
    foreach ( $items as $key => $item ) {
        if ( ( $item->object_id == $affiliate_area_page_id ) && ( ! affwp_is_affiliate() ) ) {
            unset( $items[$key] );
        }
    }

    return $items;
}
add_filter( 'wp_get_nav_menu_items', 'affwp_custom_hide_affiliate_area_from_non_affiliates', 10, 3 );
