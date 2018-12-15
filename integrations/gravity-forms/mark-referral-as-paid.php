<?php
/**
 * Plugin Name: AffiliateWP - Gravity Forms - Automatically mark a Gravity Forms referral as unpaid
 * Plugin URI: https://affiliatewp.com
 * Description: Automatically mark a Gravity Forms referral as unpaid
 * Author: Tunbosun Ayinla, tubiz
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

function affwp_gravity_forms_mark_referrals_as_unpaid( $referral_id ) {

	$referral = affwp_get_referral( $referral_id );

	if ( $referral && 'gravityforms' == $referral->context && class_exists( 'GFCommon' ) ) {

		$entry  = GFFormsModel::get_lead( $referral->reference );

		$class_name  = affiliate_wp()->integrations->get_integration_class( 'gravityforms' );
		$integration = new $class_name;
		$integration->mark_referral_complete( $entry, array() );

	}

}
add_action( 'affwp_insert_referral', 'affwp_gravity_forms_mark_referrals_as_unpaid' );
