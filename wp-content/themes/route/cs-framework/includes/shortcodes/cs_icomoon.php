<?php
/**
 *
 * CS Icomoon Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_icomoon' ) ) {
  function cs_icomoon( $atts, $content = '' ){
    extract( shortcode_atts( array(
      'icon'  => '',
    ), $atts ) );
    return '<i class="im im-'. $icon .'"></i>';
  }
  add_shortcode('cs_icomoon', 'cs_icomoon');
}