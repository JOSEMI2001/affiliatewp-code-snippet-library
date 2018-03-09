<?php
/**
 * Plugin Name: AffiliateWP - Affiliate Forms For Gravity Forms - Set User Role
 * Plugin URI: https://affiliatewp.com
 * Description: Sets the user role of the affiliate at registration when using the Affiliate Forms For Gravity Forms add-on.
 * Author: Andrew Munro
 * Author URI: https://amdrew.com
 * Version: 1.0
 */

/**
 * Sets the user role of the affiliate at registration when using the Affiliate Forms For Gravity Forms add-on. 
 * 
 * Shown below is how to set the user role to "affiliate". 
 * Important: The user role already exist in WordPress beforehand or the affiliate.
 */
function affwp_custom_afgf_set_user_role( $args ) {
	$args['role'] = 'affiliate';
	return $args;
}
add_filter( 'affiliatewp_afgf_insert_user', 'affwp_custom_afgf_set_user_role' );