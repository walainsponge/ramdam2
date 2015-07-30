<?php
/**
 *
 * VC COLUMN and VC COLUMN INNER
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_column' ) ) {
  function cs_column( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'                  => '',
      'class'               => '',
      'in_style'            => '',
      'width'               => '1/1',
      'offset'              => '',
      'animation'           => '',
      'animation_delay'     => '',
      'animation_duration'  => '',
    ), $atts ) );

    $id               = ( $id ) ? ' id="'. $id .'"' : '';
    $class            = ( $class ) ? ' '. $class : '';
    $in_style         = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $offset           = ( $offset ) ? ' '. str_replace( 'vc_', '', $offset ) : '';

    // element animation
    $animation        = ( $animation ) ? ' cs-animation '. $animation : '';
    $animation_data   = ( $animation && $animation_delay ) ? ' data-delay="'. $animation_delay .'"' : '';
    $animation_data   = ( $animation && $animation_duration ) ? $animation_data . ' data-duration="'. $animation_duration .'"' : $animation_data;

    return '<div'. $id .' class="col-md-'. cs_get_bootstrap_col( $width ) . $offset . $animation . $class .'"'. $animation_data . $in_style .'>'. do_shortcode( $content ) .'</div>';
  }
  add_shortcode( 'vc_column', 'cs_column' );
  add_shortcode( 'vc_column_inner', 'cs_column' );
}