<?php
/**
 *
 * CS Alert
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_alert' ) ) {
  function cs_alert( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
      'id'                 => '',
      'class'              => '',
      'in_style'           => '',
      'type'               => 'success',
      'icon'               => '',
      'outlined'           => '',
      'close'              => '',
      'bgcolor'            => '',
      'border_color'       => '',
      'text_color'         => '',
      'animation'          => '',
      'animation_delay'    => '',
      'animation_duration' => '',
    ), $atts ) );

    $id           = ( $id ) ? ' id="'. $id .'"' : '';
    $class        = ( $class ) ? ' '. $class : '';
    $icon         = ( $icon ) ? ' <i class="'. cs_icon_class( $icon ) .' icon-vertically"></i>': '';
    $outlined     = ( $outlined ) ? ' cs-alert-outlined': '';
    $close        = ( $close ) ? ' cs-alert-dismissable': '';

    $bgcolor      = ( $bgcolor ) ? 'background-color:'. $bgcolor . ';' : '';
    $border_color = ( $border_color ) ? 'border-color:'. $border_color . ';' : '';
    $text_color   = ( $text_color ) ? 'color:'. $text_color . ';' : '';
    $el_style     = ( $bgcolor || $border_color || $text_color || $in_style ) ? ' style="'. $bgcolor . $border_color . $text_color . $in_style .'"': '';

    // element animation
    $animation        = ( $animation ) ? ' cs-animation '. $animation : '';
    $animation_data   = ( $animation && $animation_delay ) ? ' data-delay="'. $animation_delay .'"' : '';
    $animation_data   = ( $animation && $animation_duration ) ? $animation_data . ' data-duration="'. $animation_duration .'"' : $animation_data;

    // begin output
    $output   = '<div'. $id .' class="cs-alert cs-alert-'. $type . $close . $outlined . $animation . $class .'"'. $animation_data . $el_style .'>';
    $output  .= ( $close ) ? '<div class="cs-alert-close fa fa-times"></div>' : '';
    $output  .= ( $close ) ? '<div class="cs-alert-content">' : '';
    $output  .= cs_set_wpautop( $icon . $content );
    $output  .= ( $close ) ? '</div>' : '';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_alert', 'cs_alert');
}