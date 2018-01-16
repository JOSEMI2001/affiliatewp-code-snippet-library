<?php
/**
 * Plugin Name: AffiliateWP - Disable Emails
 * Plugin URI: http://affiliatewp.com
 * Description: Disables various emails sent from AffiliateWP
 * Author: Andrew Munro
 * Author URI: http://affiliatewp.com
 * Version: 1.0
 */

/**
 * Comment out the emails you don't want to disable below.
 * If you really want all emails disabled, simply check the "Disable All Emails" option from Affiliates -> Settings -> Emails
 */

// Disables the "Registration Email" sent to the admin, even if the "Notify Admins" email setting is enabled
remove_action( 'affwp_register_user', 'affwp_notify_on_registration', 10, 3 );
remove_action( 'affwp_auto_register_user', 'affwp_notify_on_registration', 10, 3 );

// Disables the "Application Accepted Email" sent to the affiilate
remove_action( 'affwp_set_affiliate_status', 'affwp_notify_on_approval', 10, 3 );

// Disables the "New Referral Email" sent to the affiliate, even if the "Enable New Referral Notifications" setting is enabled in the Affiliae Area
remove_action( 'affwp_referral_accepted', 'affwp_notify_on_new_referral', 10, 2 );

// Disables the "Application Pending Email" sent to the affiliate
remove_action( 'affwp_register_user', 'affwp_notify_on_pending_affiliate_registration', 10, 3 );
remove_action( 'affwp_auto_register_user', 'affwp_notify_on_pending_affiliate_registration', 10, 3 );

// Disables the "Application Rejection Email" sent to the affiliate
remove_action( 'affwp_set_affiliate_status', 'affwp_notify_on_rejected_affiliate_registration', 10, 3 );
