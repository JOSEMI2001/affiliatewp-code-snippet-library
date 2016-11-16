<?php
/**
 * Plugin Name: AffiliateWP - Affiliate Info - Change Gravatar Size
 * Plugin URI: https://affiliatewp.com/
 * Description: Change the size of the Gravatar that is displayed with the [affiliate_info_gravatar] shortcode
 * Author: Michael Beil
 * Author URI: http://michaelbeil.com
 * Version: 1.0
 */

 function affwp_affiliate_info_change_gravatar_size( $args ) {

    // Specify the size you would like, default is 96px X 96px
    $args['size'] =  150;

    return $args;

}

add_filter( 'affwp_affiliate_info_gravatar_defaults', 'affwp_affiliate_info_change_gravatar_size', 10, 1 );
