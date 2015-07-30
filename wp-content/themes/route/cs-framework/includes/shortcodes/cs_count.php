<?php
/**
 *
 * CS Count Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_count' ) ) {
  function cs_count( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'        => '',
      'class'     => '',
      'in_style'  => '',
      'from'      => 0,
      'to'        => 100,
      'decimals'  => '',
      'duration'  => '',
      'separator' => '',
    ), $atts ) );

    $id           = ( $id ) ? ' id="'. $id .'"' : '';
    $class        = ( $class ) ? ' '. $class : '';
    $in_style     = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $data_from    = ( $from ) ? ' data-from="'. $class .'"': '';
    $data_to      = ( $to ) ? ' data-to="'. $to .'"': '';
    $separator    = ( $separator ) ? ' data-separator="'. $separator .'"': '';
    $decimals     = ( $decimals ) ? ' data-decimals="'. $decimals .'"': '';
    $duration     = ( $duration ) ? ' data-duration="'. $duration .'"': '';

    return '<span'. $id .' class="cs-count'. $class .'"'. $data_from . $data_to . $decimals . $duration . $separator . $in_style .'>'. $to .'</span>';
  }
  add_shortcode('cs_count', 'cs_count');
}