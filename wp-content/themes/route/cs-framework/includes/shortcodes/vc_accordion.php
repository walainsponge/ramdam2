<?php
/**
 *
 * CS Accordions
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_accordion' ) ) {
  function cs_accordion( $atts, $content = '', $id = '' ) {

    global $cs_accordion_tabs;
    $cs_accordion_tabs = array();

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'no_icons'      => '',
      'icon_color'    => '',
      'title_color'   => '',
      'border_color'  => '',
      'active_tab'    => 0,
    ), $atts ) );

    do_shortcode( $content );

    // is not empty clients
    if( empty( $cs_accordion_tabs ) ) { return; }

    $id          = ( $id ) ? ' id="'. $id .'"' : '';
    $class       = ( $class ) ? ' '. $class : '';

    $el_style    = ( $border_color ) ? ' style="border-color:'. $border_color .';"' : '';
    $icon_style  = ( $icon_color ) ? ' style="color:'. $icon_color .';"' : '';

    // begin output
    $output      = '<div'. $id .' class="cs-accordions'. $class .'">';

    foreach ( $cs_accordion_tabs as $key => $tab ) {

      $selected  = ( ( $key + 1 ) == $active_tab ) ? ' selected' : '';
      $opened    = ( ( $key + 1 ) == $active_tab ) ? ' style="display: block;"' : '';
      $icon      = ( isset( $tab['atts']['icon'] ) ) ? cs_icon_class( $tab['atts']['icon'] ) : 'cs-in fa cs-anim-icon';
      $icon      = ( ! $no_icons ) ? '<i class="'. $icon .'"'. $icon_style .'></i>' : '';
      $title     = ( $title_color ) ? '<span style="color:'. $title_color .';">'. $tab['atts']['title'] .'</span>' : $tab['atts']['title'];

      $output   .= '<div class="cs-accordion"'. $el_style .'>';
      $output   .= '<h6 class="cs-accordion-title'. $selected .'">'. $icon . $title .'</h6>';
      $output   .= '<div class="cs-accordion-content"'. $opened .'>'. do_shortcode( $tab['content'] ) . '</div>';
      $output   .= '</div>';

    }

    $output     .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('vc_accordion', 'cs_accordion');
}


/**
 *
 * CS Accordion
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_accordion_tab' ) ) {
  function cs_accordion_tab( $atts, $content = '', $id = '' ) {
    global $cs_accordion_tabs;
    $cs_accordion_tabs[]  = array( 'atts' => $atts, 'content' => $content );
    return;
  }
  add_shortcode('vc_accordion_tab', 'cs_accordion_tab');
}