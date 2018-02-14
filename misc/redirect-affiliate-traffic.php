<?php
/**
 * Plugin Name: AffiliateWP - Redirect Affiliate Traffic
 * Plugin URI: https://affiliatewp.com
 * Description: Redirects all affiliate traffic to a specific page
 * Author: Andrew Munro
 * Author URI: https://amdrew.com
 * Version: 1.0
 */

/*
 * Any URL that uses the referral variable configured inside AffiliateWP will redirect 
 * the user to the page specified in the $location variable below.
 * 
 * Example: https://yoursite.com/?ref=123 will redirect to https://yoursite.com/special-promotion/?ref=123
 * 
 * Note how the referral variable and value remain intact after the redirection,
 * allowing for the visit to still be recorded inside AffiliateWP.
 * 
 * This is especially useful if you are running a temporary promotion and affiliates
 * do not have the time to update their existing referral links (or add new ones)
 */
function affwp_custom_redirect_affiliate_traffic() {

	// The slug of the page where should all referral traffic should link to.
	$location = 'special-promotion';

	// Return early if not using AffiliateWP.
	if ( ! function_exists( 'affiliate_wp' ) ) {
		return;
	}

	// Get the referral variable being used in AffiliateWP.
	$referral_var = affiliate_wp()->tracking->get_referral_var();

	// Redirect the user to the location specified, but only if not on the $location page.
	if ( isset( $_GET[$referral_var] ) && ! is_page( $location ) ) {
		// Append the referral variable and value to the URL after the redirect.
		$location = add_query_arg( $referral_var, $_GET[$referral_var], $location );

		// Redirect the user to the $location page.
		wp_safe_redirect( $location );
	}

}
add_action( 'template_redirect', 'affwp_custom_redirect_affiliate_traffic' );