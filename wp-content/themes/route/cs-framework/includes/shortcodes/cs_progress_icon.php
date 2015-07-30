<?php
/**
 *
 * CS Progress Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_progress_icon' ) ) {
  function cs_progress_icon( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'in_style'      => '',
      'icon'          => '',
      'total'         => 20,
      'active'        => 10,
      'size'          => '',
      'active_color'  => '',
      'base_color'    => '',
    ), $atts ) );

    $id             = ( $id ) ? ' id="'. $id .'"' : '';
    $class          = ( $class ) ? ' '. $class : '';
    $size           = ( $size ) ? 'font-size:'. $size .'px;' : '';
    $active_color   = ( $active_color ) ? ' data-active-color="'. $active_color .'"' : '';
    $base_color     = ( $base_color ) ? 'color:'. $base_color .';' : '';
    $icon_style     = ( $size || $base_color || $in_style ) ? ' style="'. $size . $base_color . $in_style .'"' : '';

    // begin output
    $output   = '<div'. $id .' class="cs-progress-icon'. $class .'" data-count="'. $active .'"'. $icon_style . $active_color .'>';

    for ($i=0; $i < $total; $i++) {
      $selected = ( $i < $active ) ? ' active' : '';
      $output  .= '<i class="count '. cs_icon_class( $icon ) .'"></i> ';
    }

    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_progress_icon', 'cs_progress_icon');
}