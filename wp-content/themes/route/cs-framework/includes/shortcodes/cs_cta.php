<?php
/**
 *
 * CS Call to Action
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_cta' ) ) {
  function cs_cta( $atts, $content = '', $id = '' ){

    global $cs_cta_blocks;
    $cs_cta_blocks = array();

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'in_style'      => '',
      'type'          => 'outlined',
      'top'           => '',
      'right'         => '',
      'bottom'        => '',
      'left'          => '',

      'bgcolor'      => '',
      'text_color'    => '',
      'border_color'  => '',
      'border_hcolor' => '',
    ), $atts ) );

    do_shortcode( $content );

    // is not empty clients
    if( empty( $cs_cta_blocks ) ) { return; }

    $id             = ( $id ) ? ' id="'. $id .'"' : '';
    $class          = ( $class ) ? ' '. $class : '';

    $border_top     = ( $top ) ? ' cs-cta-top' : '';
    $border_right   = ( $right ) ? ' cs-cta-right' : '';
    $border_bottom  = ( $bottom ) ? ' cs-cta-bottom' : '';
    $border_left    = ( $left ) ? ' cs-cta-left' : '';
    $box_type       = ( $type == 'bgcolor' ) ? ' cs-cta-bgcolor' : '';

    $text_color     = ( $text_color ) ? 'color:'. $text_color .';' : '';
    $border_color   = ( $border_color ) ? 'border-color:'. $border_color .';' : '';
    $bgcolor        = ( $bgcolor ) ? 'background-color:'. $bgcolor .';' : '';
    $el_style       = ( $text_color || $border_color || $bgcolor || $in_style ) ? ' style="'. $text_color . $border_color . $bgcolor . $in_style .'"' : '';

    // highlight bordercolor
    $border_hcolor  = ( $border_hcolor ) ? ' style="border-color:'. $border_hcolor .';"' : '';

    // begin output
    $output   = '';
    $output  .= '<div'. $id .' class="cs-cta'. $box_type . $class .'"'. $el_style .'>';

    foreach ( $cs_cta_blocks as $key => $block ) {
      $output  .= ( !empty( $block['content'] ) ) ? '<div class="cs-cta-block">'. do_shortcode( $block['content'] ) .'</div>' : '';
    }
    $output  .= ( $type == 'outlined' ) ? '<div class="cs-cta-outlined'. $border_top . $border_right . $border_bottom . $border_left .'"'. $border_hcolor .'></div>' : '';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_cta', 'cs_cta');
}


/**
 *
 * CS Call to Action Block
 * @version 1.0.0
 * @since 1.0.0
 *
 */
if( ! function_exists( 'cs_cta_block' ) ) {
  function cs_cta_block( $atts, $content = '', $id = '' ) {
    global $cs_cta_blocks;
    $cs_cta_blocks[]  = array( 'atts' => $atts, 'content' => $content );
    return;
  }
  add_shortcode('cs_cta_block', 'cs_cta_block');
}