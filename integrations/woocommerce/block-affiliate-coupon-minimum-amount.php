<?php
/**
 * Plugin Name: AffiliateWP - WooCommerce - Block Affiliate Discount Based On Subtotal
 * Plugin URI: https://affiliatewp.com
 * Description: Blocks an affiliate coupon from being applied unless the minimum subtotal has been met
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

/**
 * Block the coupon (linked to affiliate) if the subtotal is not met
 */
function affwp_woocommerce_block_affiliate_coupon_based_on_subtotal( $return, $coupon ) {

    // Return if Affiliate or WooCommerce is not installed
    if ( ! ( function_exists( 'affiliate_wp' ) || class_exists( 'WooCommerce' ) ) ) {
        return $return;
    }

    // The minimum subtotal amount that must be met
    $minimum_subtotal_amount = 100;

    // Get the WooCommerce subtotal
    $subtotal = WC()->cart->subtotal;

    // Check to see if the coupon is linked to an affiliate
    $is_tracked_coupon = get_post_meta( $coupon->id, 'affwp_discount_affiliate', true );

    // Block the coupon if it's linked to an affiliate but doesn't met the required subtotal amount
    if ( $is_tracked_coupon && ( $subtotal < $minimum_subtotal_amount ) ) {
        $return = false;
    }

    return $return;

}
add_filter( 'woocommerce_coupon_is_valid', 'affwp_woocommerce_block_affiliate_coupon_based_on_subtotal', 10, 2 );
