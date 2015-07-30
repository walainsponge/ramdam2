<?php
/**
 *
 * Visual Composer Plugin before init
 *
 */
if( ! function_exists( 'cs_vc_before_init' ) ) {
  function cs_vc_before_init() {

    vc_set_as_theme(true);
    vc_set_default_editor_post_types( array( 'page', 'post', 'portfolio' ) );

    include_once( FRAMEWORK_PLUGIN_DIR . '/js-composer-init/includes/map.php' );

  }
  add_action( 'vc_before_init', 'cs_vc_before_init' );
}