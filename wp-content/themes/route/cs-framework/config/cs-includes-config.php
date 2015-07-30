<?php
/**
 *
 * Load all of shortcode from folder
 * @since 1.0.0
 * @version 1.1.0
 *
 */
//
// Require plugin.php to use is_plugin_active() below
// ----------------------------------------------------------------------------------------------------
if ( ! function_exists( 'is_plugin_active' ) ) {
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

//
// Load Shortcodes
// ----------------------------------------------------------------------------------------------------
foreach ( glob( FRAMEWORK_INCLUDE_DIR . '/shortcodes/cs_*.php' ) as $shortcode ) {
  locate_template( 'cs-framework/includes/shortcodes/'. basename( $shortcode ), true );
}

//
// Visual Composer integration
// ----------------------------------------------------------------------------------------------------
$vc_exclude = cs_get_option( 'vc_exclude_shortcodes' );
$vc_exclude = ( is_array( $vc_exclude ) ) ? $vc_exclude : array();

if ( count( $vc_exclude ) !== 6 ) {

  foreach ( glob( FRAMEWORK_INCLUDE_DIR . '/shortcodes/vc_*.php' ) as $shortcode ) {

    $vc_name = str_replace( '.php', '', basename( $shortcode ) );

    if( ! in_array( $vc_name, $vc_exclude ) ) {
      locate_template( 'cs-framework/includes/shortcodes/'. basename( $shortcode ), true );
    }

  }

  if ( is_vc_activated() ) {
    locate_template( 'cs-framework/plugins/js-composer-init/includes/init.php', true );
  }

}

//
// Custom Style Adapted
// ----------------------------------------------------------------------------------------------------
locate_template( 'cs-framework/includes/custom-style.php', true );

//
// woocommerce integration
// ----------------------------------------------------------------------------------------------------
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
  locate_template( 'cs-framework/plugins/woocommerce/woocommerce-config.php', true );
}

//
// TGM integration
// ----------------------------------------------------------------------------------------------------
locate_template( 'cs-framework/plugins/tgm-plugin-activation/tgm-route-plugins.php', true );

//
// Route Theme Check
// ----------------------------------------------------------------------------------------------------
$username = cs_get_option( 'envato_username' );
$apikey   = cs_get_option( 'envato_apikey' );
if( ! empty( $username ) && ! empty( $apikey ) ) {
  locate_template( 'cs-framework/plugins/route-theme-updater/route-theme-updater.php', true );
}
