<?php
/**
 * Plugin Name: AffiliateWP - Change Affiliate Application Email 
 * Plugin URI: https://affiliatewp.com
 * Description: Change the email that is sent affiliate applications.  
 * Author: Pippin Williamson
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */ 

function affwp_set_registration_alert_email( $email ) {
    return 'contact@site.com'; // This will cause all new registration email notifications to be sent to contact@site.com
}

add_filter( 'affwp_registration_admin_email', 'affwp_set_registration_alert_email' );
