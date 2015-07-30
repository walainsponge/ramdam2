<?php
/**
 *
 * CS Blockquote Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_blockquote' ) ) {
  function cs_blockquote( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'in_style'      => '',
      'type'          => 'normal',
      'icon'          => '',
      'icon_size'     => '',
      'icon_color'    => '',
      'border_color'  => '',
      'cite'          => '',
    ), $atts ) );

    $id             = ( $id ) ? ' id="'. $id .'"' : '';
    $class          = ( $class ) ? ' '. $class : '';
    $cite           = ( $cite ) ? '<cite>'. $cite .'</cite>': '';
    $icon           = ( $icon ) ? ' cs-blockquote-quote-icon' : '';
    $icon_size      = ( $icon_size ) ? 'font-size:'. $icon_size .'px;' : '';
    $icon_color     = ( $icon_color ) ? 'color:'. $icon_color .';' : '';
    $icon_style     = ( $icon_size || $icon_color ) ? ' style="'. $icon_size . $icon_color . '"' : '';
    $border_color   = ( $border_color ) ? 'border-color:'. $border_color .';' : '';
    $quote_style    = ( $border_color || $in_style ) ? ' style="'. $border_color . $in_style . '"' : '';

    // begin output
    $output   = '<blockquote'. $id .' class="cs-blockquote cs-blockquote-'. $type . $icon . $class .'"'. $quote_style .'>';
    $output  .= ( $icon ) ? '<div class="cs-blockquote-icon fa fa-quote-left"'. $icon_style .'></div>' : '';
    $output  .= ( $icon ) ? '<div class="cs-blockquote-content">' : '';
    $output  .= cs_set_wpautop( $content ) . $cite;
    $output  .= ( $icon ) ? '</div>' : '';
    $output  .= '</blockquote>';
    // end output

    return $output;
  }
  add_shortcode('cs_blockquote', 'cs_blockquote');
}