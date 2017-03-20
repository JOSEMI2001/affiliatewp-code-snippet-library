<?php
/**
 * Plugin Name: AffiliateWP - Hide the Admin Toolbar from Logged-in Affiliates
 * Plugin URI: http://affiliatewp.com
 * Description: Hides the Admin Toolbar from logged-in affiliates on the front end.
 * Author: Drew Jaynes, DrewAPicture
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */

/**
 * Hides the Toolbar from logged-in affiliates (but not admins who are also affiliates) on the front end.
 *
 * @since 1.0
 *
 * @param bool $show_admin_bar Whether to display the admin toolbar.
 * @return bool Whether to show the admin toolbar.
 */
function affwp_hide_toolbar_from_affiliates( $show_admin_bar ) {
	if ( affwp_is_affiliate() && ! current_user_can( 'manage_affiliates' ) ) {
		$show_admin_bar = false;
	}
	
	return $show_admin_bar;
}
add_filter( 'show_admin_bar', 'affwp_hide_toolbar_from_affiliates' );
