<?php
/**
 * Plugin Name: AffiliateWP - Move Login Form Above Register Form
 * Plugin URI: https://affiliatewp.com
 * Description: Swaps the position of the login and register form on the Affiliate Area
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0.1
 */

/**
 * This code snippet requires AffiliateWP v2.0+
 */
function affwp_custom_move_login_above_register( $atts, $content = null ) {

	if ( ! function_exists( 'affiliate_wp' ) ) {
		return;
	}

	// See https://github.com/AffiliateWP/AffiliateWP/issues/867
	if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		return;
	}

	affwp_enqueue_script( 'affwp-frontend', 'affiliate_area' );

	/**
	 * Filters the display of the registration form
	 *
	 * @since 2.0
	 * @param bool $show Whether to show the registration form. Default true.
	 */
	$show_registration = apply_filters( 'affwp_affiliate_area_show_registration', true );

	/**
	 * Filters the display of the login form
	 *
	 * @since 2.0
	 * @param bool $show Whether to show the login form. Default true.
	 */
	$show_login = apply_filters( 'affwp_affiliate_area_show_login', true );

	ob_start();

	if ( is_user_logged_in() && affwp_is_affiliate() ) {
		affiliate_wp()->templates->get_template_part( 'dashboard' );
	} elseif ( is_user_logged_in() && affiliate_wp()->settings->get( 'allow_affiliate_registration' ) ) {

		if ( true === $show_registration ) {
			affiliate_wp()->templates->get_template_part( 'register' );
		}

	} else {

		if ( ! is_user_logged_in() ) {

			if ( true === $show_login ) {
				affiliate_wp()->templates->get_template_part( 'login' );
			}

		}

		if ( affiliate_wp()->settings->get( 'allow_affiliate_registration' ) ) {

			if ( true === $show_registration ) {
				affiliate_wp()->templates->get_template_part( 'register' );
			}

		} else {
			affiliate_wp()->templates->get_template_part( 'no', 'access' );
		}



	}

	return ob_get_clean();

}

function affwp_custom_move_login_above_register_load() {
	$affiliate_wp = function_exists( 'affiliate_wp' ) ? affiliate_wp() : '';
	remove_shortcode( 'affiliate_area', array( $affiliate_wp, 'affiliate_area' ) );
	add_shortcode( 'affiliate_area', 'affwp_custom_move_login_above_register', 10, 2 );
}
add_action( 'template_redirect', 'affwp_custom_move_login_above_register_load' );
