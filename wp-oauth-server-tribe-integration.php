<?php
/**
 * Plugin Name: WP OAuth Server - Tribe Integration
 * Plugin URI: https://github.com/justingreerbbi/wp-oauth-server-tribe-intergration
 * Description: Provides user info resource endpoint data for tribe integration.
 * Author: Dash10 Digital
 * Version: 0.1.0
 * Author URI: https://dash10.digital
 * Text Domain: Dash10 Digital
 */

define( 'WPOS_TRIBE_INTEGRATION_FILE', plugin_dir_path( __FILE__ ) );

/**
 *  TRIBE.SO LOOKS TO REQUIRE 3 PARAMETERS THAT WP OAUTH SERVER DOES NOT OFFER OUT OF BOX.
 *
 * id, name, email
 *
 * This filter will modifiy the resources retunred to meet the requirement of Tribe.so.
 */
add_filter( 'wo_me_resource_return', 'wpos_tribe_integration_mapping', 99 );
function wpos_tribe_integration_mapping( $data ) {

	// Grab a custom user meta field
	$first_name = get_user_meta( $data['ID'], 'first_name', true );
	$last_name  = get_user_meta( $data['ID'], 'last_name', true );

	$data['name'] = $first_name . ' ' . $last_name;
	$data['email'] = $data['user_email'];

	return $data;
}