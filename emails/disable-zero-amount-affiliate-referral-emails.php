<?php
/**
 * Plugin Name: AffiliateWP - Disable Zero Amount Affiliate Referral Emails
 * Plugin URI: http://affiliatewp.com
 * Description: Disables new referral emails to affiliates if the amount is zero
 * Author: Ginger Coolidge
 * Author URI: http://affiliatewp.com
 * Version: 1.0
 */

function affwp_check_for_zero_amount_referral_disable_email( $affiliate_id, $referral) {

	//check to see if AffiliateWP is active
	if ( ! function_exists( 'affiliate_wp' ) ) {
		return;
	}

	// get the referral amount from the referral object passed in
	$referral_amount = $referral->amount;

	//check of the referral amount is zero, will be formatted to a string at this point
	if ( $referral_amount == '0.00' ) {

		// Disables the "New Referral Email" sent to the affiliate if the amount of the referral is zero
		remove_action( 'affwp_referral_accepted', 'affwp_notify_on_new_referral', 10, 2 );

	}
}

add_action('affwp_referral_accepted', 'affwp_check_for_zero_amount_referral_disable_email', 9, 2);
