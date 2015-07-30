<?php
/**
 *
 * CS Divider Icon
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_divider_icon' ) ) {
  function cs_divider_icon( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'              => '',
      'class'           => '',
      'in_style'        => '',
      'icon'            => '',
      'text'            => '',
      'align'           => 'center',
      'size'            => '',
      'color'           => '',
      'border_color'    => '',
      'border_type'     => '',
      'width'           => '',
      'custom_width'    => '',
      'margin'          => '',
      'margin_top'      => '',
      'margin_bottom'   => '',
      'no_space'        => '',
    ), $atts ) );

    $id             = ( $id ) ? ' id="'. $id .'"' : '';
    $class          = ( $class ) ? ' '. $class : '';
    $align          = ( $align ) ? ' text-'. $align : '';
    $border_type    = ( $border_type ) ? ' cs-divider-icon-'. $border_type : '';
    $no_space       = ( $no_space ) ? ' cs-divider-inner-no-space' : '';
    $margin_class   = ( $margin ) ? ' ' . $margin .'-margin': '';
    $custom_margin  = ( $margin == 'custom' ) ? 'margin-top:'. $margin_top .'px;margin-bottom:'. $margin_bottom .'px;': '';

    $width          = ( $width == 'custom' && $custom_width ) ? cs_validpx( $custom_width ) : $width;
    $width          = ( $width ) ? 'width:'. $width .';': '';
    $el_style       = ( $width || $custom_margin || $in_style ) ? ' style="'. $width . $custom_margin . $in_style .'"' : '';

    $size           = ( $size ) ? 'font-size:'. cs_esc_string( $size ) .'px;' : '';
    $color          = ( $color ) ? 'color:'. $color .';' : '';
    $border_color   = ( $border_color ) ? 'border-top-color:'. $border_color .';' : '';
    $inner_style    = ( $size || $color || $border_color ) ? ' style="'. $size . $color . $border_color .'"' : '';


    // begin output
    $output  = '<div'. $id .' class="cs-divider-icon'. $align . $margin_class . $class .'"'. $el_style .'>';
    $output .= '<div class="cs-divider-icon-inner'. $no_space . $border_type .'"'. $inner_style .'>';
    $output .= ( $icon ) ? '<i class="'. cs_icon_class( $icon ) .'"></i>' : '';
    $output .= ( $text ) ? '<span class="inner-text">'. $text .'</span>' : '';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    $output .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_divider_icon', 'cs_divider_icon');
}