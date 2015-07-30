<?php
/**
 *
 * CS Button Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_counter' ) ) {
  function cs_counter( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'              => '',
      'class'           => '',
      'in_style'         => '',
      'from'            => 0,
      'to'              => 100,
      'decimals'        => '',
      'duration'        => '',
      'separator'       => '',
      'prefix_text'     => '',
      'prefix_icon'     => '',
      'prefix_size'     => '',
      'prefix_pos'      => 'right',
      'prefix_opacity'  => '',
      'prefix_color'    => '',
      'counter_size'    => '',
      'counter_color'   => '',
      'title'           => '',
      'title_size'      => '',
      'title_color'     => '',
    ), $atts ) );

    $id               = ( $id ) ? ' id="'. $id .'"' : '';
    $class            = ( $class ) ? ' '. $class : '';
    $data_from        = ( $from ) ? ' data-from="'. $class .'"': '';
    $data_to          = ( $to ) ? ' data-to="'. $to .'"': '';
    $separator        = ( $separator ) ? ' data-separator="'. $separator .'"': '';
    $decimals         = ( $decimals ) ? ' data-decimals="'. $decimals .'"': '';
    $duration         = ( $duration ) ? ' data-duration="'. $duration .'"': '';

    $prefix_icon      = ( $prefix_icon ) ? '<i class="'. cs_icon_class( $prefix_icon ) .'"></i>' : '';
    $prefix_text      = ( $prefix_text ) ? '<span class="prefix-text">'. $prefix_text .'</span>' : '';

    // prefix-style
    $prefix_size      = ( $prefix_size ) ? 'font-size:'. cs_validpx( $prefix_size ) .';' : '';
    $prefix_color     = ( $prefix_color ) ? 'color:'. $prefix_color .';' : '';
    $prefix_opacity   = ( $prefix_opacity ) ? 'opacity:'. $prefix_opacity .';' : '';
    $prefix_style     = ( $prefix_size || $prefix_color || $prefix_opacity ) ? ' style="'. $prefix_size . $prefix_color . $prefix_opacity . '"' : '';

    // counter-style
    $counter_size     = ( $counter_size ) ? 'font-size:'. cs_validpx( $counter_size ) .';' : '';
    $counter_color    = ( $counter_color ) ? 'color:'. $counter_color .';' : '';
    $counter_style    = ( $counter_size || $counter_color || $in_style ) ? ' style="'. $counter_size . $counter_color . $in_style .'"' : '';

    // title-style
    $title_size       = ( $title_size ) ? 'font-size:'. $title_size .'px;' : '';
    $title_color      = ( $title_color ) ? 'color:'. $title_color .';' : '';
    $title_style      = ( $title_size || $title_color ) ? ' style="'. $title_size . $title_color . '"' : '';

    $prefix_wrap      = ( $prefix_text || $prefix_icon ) ? '<span class="cs-counter-prefix cs-counter-pos-'. $prefix_pos .'"'. $prefix_style .'>'. $prefix_text . $prefix_icon .'</span>': '';

    // begin output
    $output   = '<div'. $id .' class="cs-counter'. $class .'"'. $counter_style .'>';
    $output  .= ( $prefix_pos == 'left'  || $prefix_pos == 'top' ) ? $prefix_wrap : '';
    $output  .= '<span class="cs-count"'. $data_from . $data_to . $decimals . $duration . $separator .'>'. $to .'</span>';
    $output  .= ( $prefix_pos == 'right' || $prefix_pos == 'bottom' ) ? $prefix_wrap : '';
    $output  .= ( $title ) ? '<h3 class="cs-counter-title"'. $title_style .'>'. $title .'</h3>': '';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_counter', 'cs_counter');
}