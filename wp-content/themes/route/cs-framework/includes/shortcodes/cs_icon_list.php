<?php
/**
 *
 * CS Icon List Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_icon_list' ) ) {
  function cs_icon_list( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'        => '',
      'class'     => '',
      'in_style'  => '',
    ), $atts ) );

    $id       = ( $id ) ? ' id="'. $id .'"' : '';
    $class    = ( $class ) ? ' '. $class : '';
    $in_style = ( $in_style ) ? ' style="'. $in_style .'"' : '';

    // begin output
    $output   = '';
    $output  .= '<ul'. $id .' class="cs-icon-list'. $class .'"'. $in_style .'>';
    $output  .= do_shortcode( $content );
    $output  .= '</ul>';
    // end output

    return $output;
  }
  add_shortcode('cs_icon_list', 'cs_icon_list');
}


/**
 *
 * CS Icon List Item Shortcode
 * @version 1.0.0
 * @since 1.0.0
 *
 */
if( ! function_exists( 'cs_icon_list_item' ) ) {
  function cs_icon_list_item( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'          => '',
      'class'       => '',
      'in_style'    => '',
      'icon'        => '',
      'icon_color'  => '',
      'text_color'  => '',
    ), $atts ) );

    $id           = ( $id ) ? ' id="'. $id .'"' : '';
    $class        = ( $class ) ? ' '. $class : '';
    $icon_color   = ( $icon_color ) ? ' style="color:'. $icon_color .';"' : '';
    $text_color   = ( $text_color ) ? 'color:'. $text_color .';' : '';
    $in_style     = ( $text_color || $in_style ) ? ' style="'. $text_color . $in_style .'"' : '';
    $icon         = ( $icon ) ? '<i class="'. cs_icon_class( $icon ) .'"'. $icon_color .'></i>' : '';

    return '<li'. $id . $class . $in_style .'>'. $icon . do_shortcode( $content ) . '</li>';

  }
  add_shortcode('cs_icon_list_item', 'cs_icon_list_item');
}