<?php
/**
 * Plugin Name: AffiliateWP - Change Affiliate Admin Emails 
 * Plugin URI: https://affiliatewp.com
 * Description: Change the email address that is sent affiliate applications and referral notices.  
 * Author: Pippin Williamson
 * Author: Ginger Coolidge
 * Author URI: https://affiliatewp.com
 * Version: 1.1
 */ 

// This will cause all new admin affiliate registration email notifications to sent to the email listed below
function affwp_custom_set_registration_admin_email( $email ) {
    return 'new-admin@site.com'; 
}
add_filter( 'affwp_registration_admin_email', 'affwp_custom_set_registration_admin_email' );


// This will cause all new admin referral email notifications to be sent to the email listed below
function affwp_custom_set_referral_admin_email( $email ) {
    return 'new-admin@site.com'; 
}
add_filter( 'affwp_new_admin_referral_email_to', 'affwp_custom_set_referral_admin_email' );
