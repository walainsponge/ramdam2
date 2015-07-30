<?php
/**
 *
 * CS Countdown
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_countdown' ) ) {
  function cs_countdown( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'in_style'      => '',
      'date'          => date( 'M d Y' ),
      'format'        => 'yowdhms',
      'count'         => 'down',
      'layout'        => 'boxed',
      'color'         => '',
      'border_color'  => '',
    ), $atts ) );

    wp_enqueue_script( 'cs-countdown' );

    $id         = ( $id ) ? ' id="'. $id .'"' : '';
    $class      = ( $class ) ? ' '. $class : '';
    $format     = ( $format ) ? ' data-format="'. $format .'"' : '';
    $count      = ( $count ) ? ' data-count="'. $count .'"' : '';

    $uniqid_class  = '';
    if ( $in_style || $color || $border_color ) {

      $uniqid        = uniqid();
      $uniqid_class  = ' cs-countdown-'. $uniqid;
      $custom_style  = '.cs-countdown-'. $uniqid .' .countdown-section{';
      $custom_style .= ( $color ) ? 'color:'. $color .';' : '';
      $custom_style .= ( $border_color ) ? 'border-color:'. $border_color .';' : '';
      $custom_style .= ( $in_style ) ? $in_style : '';
      $custom_style .= '}';

      cs_add_inline_style( $custom_style );

    }

    return '<span'. $id .' class="cs-countdown cs-countdown-'. $layout . $uniqid_class . $class .'" data-date="'. $date .'"'. $format . $count .'></span>';
  }
  add_shortcode('cs_countdown', 'cs_countdown');
}