<?php
/**
 * Plugin Name: AffiliateWP - Store Credit - Turn off "Individual use only"
 * Plugin URI: https://affiliatewp.com
 * Description: Turns off the "Individual use only" option when an affiliate coupon is generated in WooCommerce
 * Author: Andrew Munro
 * Author URI: https://amdrew.com
 * Version: 1.0
 */

/**
 * When an affiliate coupon is generated, the "Individual use only" checkbox is
 * enabled by default on the WooCommerce coupon's "Usage restriction" tab.
 * This code snippet prevents that checkbox from being enabled, allowing 
 * Store Credit to work alongside other coupons.
 * 
 * Requires Store Credit v2.2 or later.
 */
function affwp_custom_store_credit_prevent_individual_use_only( $data ) {
	$data['individual_use'] = 'no';
	return $data;
}
add_filter( 'affwp_store_credit_woocommerce_coupon_data', 'affwp_custom_store_credit_prevent_individual_use_only', 10, 2 );