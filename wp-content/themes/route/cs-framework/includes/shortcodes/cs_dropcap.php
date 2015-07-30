<?php
/**
 *
 * CS Dropcap Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_dropcap' ) ) {
  function cs_dropcap( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'        => '',
      'class'     => '',
      'in_style'  => '',
      'word'      => '',
      'size'      => '',
      'color'     => '',
      'bgcolor'   => '',
      'shape'     => '',
    ), $atts ) );

    $id       = ( $id ) ? ' id="'. $id .'"' : '';
    $class    = ( $class ) ? ' '. $class : '';
    $color    = ( $color ) ? 'color:'. $color .';' : '';
    $bgcolor  = ( $bgcolor ) ? 'background-color:'. $bgcolor .';' : '';
    $size     = ( $size ) ? 'font-size:'. $size .'px;' : '';
    $style    = ( $color || $size || $bgcolor || $in_style ) ? ' style="'. $color . $bgcolor . $size . $in_style .'"' : '';
    $bgclass  = ( $bgcolor ) ? ' cs-dropcap-bgcolor' : '';
    $shape    = ( $shape ) ? ' cs-dropcap-'.$shape : '';

    return '<span'. $id .' class="cs-dropcap'. $bgclass . $shape . $class .'"'. $style .'>'. $word .'</span>';
  }
  add_shortcode('cs_dropcap', 'cs_dropcap');
}