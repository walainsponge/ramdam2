<?php
/**
 *
 * CS Pre and Code
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_precode' ) ) {
  function cs_precode( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'          => '',
      'class'       => '',
      'max_height'  => '',
      'scroll_horz' => '',
    ), $atts ) );

    $id           = ( $id ) ? ' id="'. $id .'"' : '';
    $class        = ( $class ) ? ' '. $class : '';
    $scroll_horz  = ( $scroll_horz ) ? ' pre-scrollable-horz' : '';
    $el_class     = ( $class || $scroll_horz  ) ? ' class="'. $class . $scroll_horz .'"' : '';
    $max_height   = ( $max_height ) ? ' style="max-height:'. $max_height . 'px;"' : '';

    return '<pre'. $el_class . $max_height .'>'. htmlentities( rawurldecode( base64_decode( $content ) ), ENT_COMPAT, 'UTF-8' ) .'</pre>';
  }
  add_shortcode('cs_precode', 'cs_precode');
}