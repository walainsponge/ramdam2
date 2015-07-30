<?php
/**
 *
 * CS Social Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_social' ) ) {
  function cs_social( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'      => '',
      'class'   => '',
      'icon'    => '',
      'type'    => '',
      'color'   => '',
    ), $atts ) );

    $id       = ( $id ) ? ' id="'. $id .'"' : '';
    $class    = ( $class ) ? ' '. $class : '';
    $color    = ( $color ) ? $color : $icon;

    // begin output
    $output   = '';
    $output  .= '<a href="" class="cs-social cs-'. $color .' cs-social-'. $type .'"><span class="'. cs_icon_class( $icon ) .'"></span></a>';
    // end output

    return $output;
  }
  add_shortcode('cs_social', 'cs_social');
}