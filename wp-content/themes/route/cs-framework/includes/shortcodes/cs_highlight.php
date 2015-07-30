<?php
/**
 *
 * CS Highlight
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_highlight' ) ) {
  function cs_highlight( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'        => '',
      'class'     => '',
      'in_style'  => '',
      'bgcolor'   => '',
      'color'     => '',
      'size'      => '',
    ), $atts ) );

    $id         = ( $id ) ? ' id="'. $id .'"' : '';
    $class      = ( $class ) ? ' '. $class : '';
    $bgcolor    = ( $bgcolor ) ? 'background-color:'. $bgcolor .';' : '';
    $color      = ( $color ) ? 'color:'. $color .';' : '';
    $size       = ( $size ) ? 'font-size:'. $size .'px;' : '';
    $in_style   = ( $in_style || $bgcolor || $color || $size ) ? ' style="'. $bgcolor . $color . $size . $in_style . '"' : '';

    return '<span'. $id .' class="cs-highlight'. $class .'"'. $in_style .'>'. do_shortcode( $content ) .'</span>';
  }
  add_shortcode('cs_highlight', 'cs_highlight');
}