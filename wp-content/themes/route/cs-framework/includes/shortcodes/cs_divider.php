<?php
/**
 *
 * CS Divider Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_divider' ) ) {
  function cs_divider( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'in_style'      => '',
      'type'          => '',
      'color'         => '',
      'width'         => '',
      'custom_width'  => '',
      'align'         => '',
      'margin'        => '',
      'margin_top'    => 1,
      'margin_bottom' => 1,
    ), $atts ) );

    $id             = ( $id ) ? ' id="'. $id .'"' : '';
    $class          = ( $class ) ? ' '. $class : '';
    $margin_class   = ( $margin ) ? ' ' . $margin .'-margin': '';
    $divider_class  = ( $type ) ? ' cs-divider-'. $type : '';

    $width          = ( $width == 'custom' && $custom_width ) ? cs_validpx( $custom_width ) : $width;
    $width          = ( $width ) ? 'width:'. $width .';': '';
    $border_color   = ( $color ) ? 'border-color:'. $color .';': '';
    $custom_margin  = ( $margin == 'custom' ) ? 'margin-top:'. $margin_top .'px;margin-bottom:'. $margin_bottom .'px;': '';
    $el_style       = ( $custom_margin || $border_color || $width || $in_style ) ? ' style="'. $custom_margin . $border_color . $width . $in_style .'"': '';

    // begin output
    $output  = ( $align ) ? '<div class="cs-divider-align text-'. $align .'">' : '';
    $output .= '<hr'. $id .' class="cs-divider'. $margin_class . $divider_class . $class .'"'. $el_style .' />';
    $output .= ( $align ) ? '</div>' : '';
    // end output

    return $output;
  }
  add_shortcode('cs_divider', 'cs_divider');
}