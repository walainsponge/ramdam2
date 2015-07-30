<?php
/**
 *
 * CS Toggle
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
if( ! function_exists( 'cs_toggle' ) ) {
  function cs_toggle( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'title'         => '',
      'icon'          => '',
      'no_icon'       => '',
      'icon_color'    => '',
      'title_color'   => '',
      'border_color'  => '',
      'open'          => '',
    ), $atts ) );

    $id           = ( $id ) ? ' id="'. $id .'"' : '';
    $class        = ( $class ) ? ' '. $class : '';
    $open         = ( $open ) ? ' selected' : '';
    $display      = ( $open ) ? ' style="display:block;"' : '';

    $el_style     = ( $border_color ) ? ' style="border-color:'. $border_color .';"' : '';
    $icon_style   = ( $icon_color ) ? ' style="color:'. $icon_color .';"' : '';
    $title        = ( $title_color ) ? '<span style="color:'. $title_color .';">'. $title .'</span>' : $title;

    $icon         = ( $icon ) ? cs_icon_class( $icon ) : 'cs-in fa cs-anim-icon';
    $icon         = ( ! $no_icon ) ? '<i class="'. $icon .'"'. $icon_style .'></i>' : '';

    // begin output
    $output   = '<div'. $id .' class="cs-toggle"'. $el_style .'>';
    $output  .= '<h6 class="cs-toggle-title'. $open .'">'. $icon . $title .'</h6>';
    $output  .= '<div class="cs-toggle-content"'. $display .'>';
    $output  .= cs_set_wpautop( $content );
    $output  .= '</div>';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('vc_toggle', 'cs_toggle');
}