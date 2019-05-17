<?php
/**
 * Plugin Name: AffiliateWP - Store Credit - Disable Store Credit Per Affiliate
 * Plugin URI: https://affiliatewp.com
 * Description: Disable store credit per affiliate if store credit is globally enabled for all affiliates
 * Author: Tunbosun Ayinla
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */

/**
 * Check if an affiliate can receive store credit
 */
function affwp_can_affiliate_receive_store_credit( $can_receive_store_credit, $affiliate_id, $referral ) {

	if ( affiliate_wp()->settings->get( 'store-credit-all-affiliates' ) ) {

		$store_credit_disabled = affwp_get_affiliate_meta( $affiliate_id, 'store_credit_disabled', true );

		if ( $store_credit_disabled ) {
			return false;
		}
	}

	return $can_receive_store_credit;
}
add_filter( 'affwp_store_credit_can_receive_store_credit', 'affwp_can_affiliate_receive_store_credit', 10, 3 );

/**
 * Allow an admin to disable Store credit for an affiliate from the Edit affiliate page.
 */
function affwp_per_affiliate_disable_store_credit_setting( $affiliate ) {

	$store_credit_disabled = affwp_get_affiliate_meta( $affiliate->affiliate_id, 'store_credit_disabled', true );

	?>

	<?php if ( affiliate_wp()->settings->get( 'store-credit-all-affiliates' ) ): ?>

		<table class="form-table">
			<tr><th scope="row"><label for="affwp_settings[store_credit_header]"><?php _e( 'Store Credit', 'affiliatewp-store-credit' ); ?></label></th><td><hr></td></tr>
		</table>

		<table class="form-table">

			<tr class="form-row">

				<th scope="row">
					<label for="disable_store_credit">Disable Store Credit?</label>
				</th>

				<td>
					<input type="checkbox" name="disable_store_credit" id="disable_store_credit" value="1" <?php checked( 1, $store_credit_disabled, true ); ?> />
					<p class="description">Disable payouts via store credit for this affiliate.</p>
				</td>

			</tr>

		</table>

	<?php

	endif;
}
add_action( 'affwp_edit_affiliate_end', 'affwp_per_affiliate_disable_store_credit_setting', 20 );

/**
 * Save disable store credit option in the affiliate meta table.
 */
function affwp_save_disable_store_credit_affiliate_meta( $data ) {

	if ( empty( $data['affiliate_id'] ) ) {
		return false;
	}

	if ( ! current_user_can( 'manage_affiliates' ) ) {
		return;
	}

	$disable_store_credit = isset( $data['disable_store_credit'] ) ? $data['disable_store_credit'] : '';

	if ( $disable_store_credit ) {
		affwp_update_affiliate_meta( $data['affiliate_id'], 'store_credit_disabled', $disable_store_credit );
	} else {
		affwp_delete_affiliate_meta( $data['affiliate_id'], 'store_credit_disabled' );
	}

}
add_action( 'affwp_update_affiliate', 'affwp_save_disable_store_credit_affiliate_meta' );