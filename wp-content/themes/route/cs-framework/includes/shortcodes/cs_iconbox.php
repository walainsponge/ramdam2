<?php
/**
 *
 * CS Iconbox Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_iconbox' ) ) {
  function cs_iconbox( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'                  => '',
      'class'               => '',
      'in_style'            => '',
      'align'               => 'left',
      'icon'                => '',
      'icon_type'           => 'bgcolor',
      'icon_size'           => 'sm',
      'icon_shape'          => 'square',
      'icon_color'          => 'accent',
      'icon_background'     => '',
      'icon_border'         => '',
      'icon_border_width'   => '',
      'icon_border_style'   => '',
      'custom_icon_size'    => '',
      'custom_icon_spacing' => '',
      'title'               => '',
      'title_color'         => '',
      'title_size'          => 'h4',
      'custom_title_size'   => '',

      // in-progress
      'link'                => '',
      'apply_link'          => '',
      'target'              => '',
      'effect'              => 0,

      'animation'           => '',
      'animation_delay'     => '',
      'animation_duration'  => '',
    ), $atts ) );

    if ( function_exists( 'vc_parse_multi_attribute' ) ) {
      $parse_args   = vc_parse_multi_attribute( $link );
      $link         = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : $link;
      $target       = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : $target;
    }

    $id                 = ( $id ) ? ' id="'. $id .'"' : '';
    $class              = ( $class ) ? ' '. $class : '';
    $in_style           = ( $in_style ) ? ' style="'. $in_style .'"': '';
    $effect             = ( $effect ) ? ' cs-iconbox-effect' : '';
    $position           = ( $align == 'left' || $align == 'right' ) ?  true : false;
    $target             = ( $target ) ? ' target="'. $target .'"' : '';
    $title_color        = ( $title_color ) ? 'color:'. $title_color .';' : '';
    $title_heading      = ( $title_size == 'custom' ) ? 'h4' : $title_size;
    $custom_title_size  = ( $title_size == 'custom' && $custom_title_size ) ? 'font-size:'. $custom_title_size .'px;' : '';
    $title_style        = ( $title_color || $custom_title_size ) ? ' style="'. $title_color . $custom_title_size .'"' : '';

    // element animation
    $animation        = ( $animation ) ? ' cs-animation '. $animation : '';
    $animation_data   = ( $animation && $animation_delay ) ? ' data-delay="'. $animation_delay .'"' : '';
    $animation_data   = ( $animation && $animation_duration ) ? $animation_data . ' data-duration="'. $animation_duration .'"' : $animation_data;

    // begin output
    $output   = '<div'. $id .' class="cs-iconbox cs-iconbox-'. $align . $effect . $animation . $class .'"'. $animation_data . $in_style .'>';
    $output  .= ( $link && ! $apply_link ) ? '<a href="'. $link .'"'. $target .' class="cs-box-link">' : '';
    $output  .= '<div class="cs-iconbox-header">';

      // icon
      if( $icon ) {
        $icon_content    = '<div class="cs-iconbox-icon">';
        $icon_content   .= cs_icon( array(
          'icon'            => $icon,
          'size'            => $icon_size,
          'type'            => $icon_type,
          'shape'           => $icon_shape,
          'color'           => $icon_color,
          'border'          => $icon_border,
          'background'      => $icon_background,
          'custom_size'     => $custom_icon_size,
          'custom_spacing'  => $custom_icon_spacing,
          'border_width'    => $icon_border_width,
          'border_style'    => $icon_border_style,
        ) );
        $icon_content   .= '</div>';
      }

      $output   .= ( $icon && $align != 'heading-right' ) ? $icon_content : '';
      $output   .= ( $position ) ? '</div>' : ''; // end cs-iconbox-header
      $output   .= ( $position ) ? '<div class="cs-iconbox-block">' : '';

      // title
      if( $title ) {
        $output   .= '<div class="cs-iconbox-title">';
        $output   .= '<'. $title_heading .' class="cs-iconbox-heading"'. $title_style .'>';
        $output   .= ( $link && $apply_link ) ? '<a href="'. $link .'"'. $target .'>' : '';
        $output   .= $title;
        $output   .= ( $link && $apply_link ) ? '</a>' : '';
        $output   .= '</'. $title_heading .'>';
        $output   .= '</div>';
      }

    $output   .= ( $icon && $align == 'heading-right' ) ? $icon_content : '';
    $output   .= ( !$position ) ? '</div>' : ''; // end cs-iconbox-header

    $output   .= '<div class="cs-iconbox-text">';
    $output   .= cs_set_wpautop( $content );
    $output   .= '</div>';
    $output   .= ( $position ) ? '</div>' : ''; // end cs-iconbox-block

    $output   .= ( $link && ! $apply_link ) ? '</a>' : '';
    $output   .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_iconbox', 'cs_iconbox');
}