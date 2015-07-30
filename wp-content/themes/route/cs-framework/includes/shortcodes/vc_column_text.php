<?php
/**
 *
 * VC Column Text
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'vc_column_text' ) ) {
  function vc_column_text( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'                  => '',
      'class'               => '',
      'in_style'            => '',
      'animation'           => '',
      'animation_delay'     => '',
      'animation_duration'  => '',
    ), $atts ) );

    $id               = ( $id ) ? ' id="'. $id .'"' : '';
    $class            = ( $class ) ? ' '. $class : '';
    $in_style         = ( $in_style ) ? ' style="'. $in_style .'"' : '';

    // element animation
    $animation        = ( $animation ) ? ' cs-animation '. $animation : '';
    $animation_data   = ( $animation && $animation_delay ) ? ' data-delay="'. $animation_delay .'"' : '';
    $animation_data   = ( $animation && $animation_duration ) ? $animation_data . ' data-duration="'. $animation_duration .'"' : $animation_data;

    return '<div'. $id .' class="cs-column-text'. $animation . $class .'"'. $animation_data . $in_style .'>'. cs_set_wpautop( $content ) .'</div>';
  }
  add_shortcode( 'vc_column_text', 'vc_column_text' );
}