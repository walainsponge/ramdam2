<?php
/**
 *
 * CS Responsive Slider
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_responsive_slider' ) ) {
  function cs_responsive_slider( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
      'id'          => '',
      'class'       => '',
      'in_style'    => '',
      'border'      => '',
      'cstype'      => 'slideshow',
    ), $atts ) );

    $id             = ( $id ) ? ' id="'. $id .'"' : '';
    $class          = ( $class ) ? ' '. $class : '';
    $in_style       = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $border         = ( $border ) ? ' cs-fluid-border' : '';
    $border_inline  = ( $cstype == 'gallery_nearby' ) ? ' cs-fluid-inline' : '';

    // begin output
    $output  = '<div'. $id .' class="cs-responsive-slider'. $border . $border_inline . $class .'"'. $in_style .'>';
    $output .= gallery_shortcode( $atts );
    $output .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_responsive_slider', 'cs_responsive_slider');
}