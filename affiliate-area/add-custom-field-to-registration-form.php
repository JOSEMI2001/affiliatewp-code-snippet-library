<?php
/**
 * Plugin Name: AffiliateWP - Add BTC address field to the affiliate registration form
 * Plugin URI: https://affiliatewp.com
 * Description: Add a custom field (Bitcoin Address) to the affiliate registration form
 * Author: Tunbosun Ayinla, tubiz
 * Author URI: https://bosun.me
 * Version: 1.0
 */

/*
 * Add the BTC address field to the affiliate registration form
 */
function affwp_add_additional_field_to_affiliate_registration_form() {

	$errors = affiliate_wp()->register->get_errors();

	if ( ! array_key_exists( 'empty_btc_address', $errors ) ) {
		$btc_address = sanitize_text_field( $_POST['affwp_bitcoin_address'] );
	}

	?>
	<p>
		<label for="affwp-btc-address">Bitcoin Address</label>
		<input id="affwp-btc-address" type="text" name="affwp_btc_address" value="<?php if ( ! empty( $btc_address ) ) {
			echo $btc_address;
		} ?>" title="Bitcoin Address" />
	</p>
	<?php
}
add_action( 'affwp_register_fields_before_tos', 'affwp_add_additional_field_to_affiliate_registration_form' );

/*
 * Save the BTC address to the affiliate meta after registration
 */
function affwp_save_affiliate_bitcoin_address( $affiliate_id, $status, $args ) {

	$btc_address = sanitize_text_field( $_POST['affwp_btc_address'] );

	if ( ! empty( $btc_address ) ) {
		affwp_add_affiliate_meta( $affiliate_id, 'btc_address', $btc_address );
	}

}
add_action( 'affwp_register_user', 'affwp_save_affiliate_bitcoin_address', 10, 3 );

/*
 * Make BTC address field required during affiliate registration {Remove if it shouldn't be required}
 */
function affwp_add_btc_address_to_required_fields( $required_fields ) {

	$required_fields['affwp_btc_address'] = array(
		'error_id'      => 'empty_btc_address',
		'error_message' => 'Please enter your Bitcoin Address',
	);

	return $required_fields;
}
add_filter( 'affwp_register_required_fields', 'affwp_add_btc_address_to_required_fields' );

/*
 * Display the BTC address field in the Profile Settings page in the affiliate dashboard
 */
function affwp_show_btc_address_in_affiliate_dashboard( $affiliate_id, $affiliate_user_id ) {

	$btc_address = affwp_get_affiliate_meta( $affiliate_id, 'btc_address', true );

	?>

	<div class="affwp-wrap affwp-btc-address-wrap">
		<label for="affwp-btc-address"><?php _e( 'Your Bitcoin address', 'affiliate-wp' ); ?></label>
		<input id="affwp-btc-address" type="text" name="btc_address" value="<?php echo esc_attr( $btc_address ); ?>" />
	</div>

	<?php

}
add_action( 'affwp_affiliate_dashboard_before_submit', 'affwp_show_btc_address_in_affiliate_dashboard', 10, 2 );

/*
 * Update the BTC address field from the Profile Settings page in the affiliate dashboard
 */
function affwp_affiliate_dashboard_update_btc_address( $data ) {

	$affiliate_id = absint( $data['affiliate_id'] );

	if ( ! empty( $data['btc_address'] ) ) {

		$btc_address = sanitize_text_field( $data['btc_address'] );

		affwp_update_affiliate_meta( $affiliate_id, 'btc_address', $btc_address );

	} else {

		affwp_delete_affiliate_meta( $affiliate_id, 'btc_address' );

	}

}
add_action( 'affwp_update_affiliate_profile_settings', 'affwp_affiliate_dashboard_update_btc_address' );

/*
 * Display the BTC address field in the edit affiliate page in the admin dashboard
 */
function affwp_admin_edit_affiliate_show_btc_address( $affiliate ) {

	$btc_address = affwp_get_affiliate_meta( $affiliate->affiliate_id, 'btc_address', true );
	?>

	<tr class="form-row form-required">

		<th scope="row">
			<label for="payment_email">Bitcoin Address</label>
		</th>

		<td>
			<input class="regular-text" type="text" name="btc_address" id="btc_address" value="<?php echo esc_attr( $btc_address ); ?>" />
			<p class="description">The affiliate Bitcoin address</p>
		</td>

	</tr>

	<?php
}
add_action( 'affwp_edit_affiliate_end', 'affwp_admin_edit_affiliate_show_btc_address' );

/*
 * Update the affiliate BTC address field from the edit affiliate page in the admin dashboard
 */
function affwp_admin_update_affiliate_btc_address( $affiliate, $updated ) {

	if ( $updated ) {

		$affiliate_id = $affiliate->affiliate_id;

		if ( ! empty( $_POST['btc_address'] ) ) {

			$btc_address = sanitize_text_field( $_POST['btc_address'] );

			affwp_update_affiliate_meta( $affiliate_id, 'btc_address', $btc_address );

		} else {

			affwp_delete_affiliate_meta( $affiliate_id, 'btc_address' );

		}
	}

}
add_action( 'affwp_updated_affiliate', 'affwp_admin_update_affiliate_btc_address', 10, 2 );