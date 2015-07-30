<?php
/**
 *
 * CS Iconbox Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_fancybox' ) ) {
  function cs_fancybox( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'                  => '',
      'class'               => '',
      'in_style'            => '',

      'box_background'      => 'accent',
      'box_type'            => 'bgcolor',
      'box_border'          => '',
      'box_border_width'    => '',
      'box_border_style'    => '',
      'box_text_color'      => '',
      'box_title_color'     => '',
      'box_rounded'         => '',

      // icons
      'icon_color'          => 'accent',
      'icon'                => '',
      'icon_size'           => 'sm',
      'icon_type'           => 'bgcolor',
      'icon_shape'          => 'square',
      'icon_border'         => '',
      'icon_border_width'   => '',
      'icon_border_style'   => '',
      'icon_background'     => '',
      'icon_position'       => 'tc',

      // title
      'title'               => '',
      'title_size'          => 'h4',
      'custom_title_size'   => '',

      // link
      'link'                => '',
      'target'              => '',
    ), $atts ) );

    if ( function_exists( 'vc_parse_multi_attribute' ) ) {
      $parse_args   = vc_parse_multi_attribute( $link );
      $link         = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : $link;
      $target       = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : $target;
    }

    $custom_css         = '';
    $id                 = ( $id ) ? ' id="'. $id .'"' : '';
    $class              = ( $class ) ? ' '. $class : '';
    $box_size           = ( $icon && $icon_size ) ? ' cs-fancybox-'. $icon_size : '';
    $box_rounded        = ( $box_rounded ) ? ' cs-fancybox-rounded' : '';
    $target             = ( $target ) ? ' target="'. $target .'"' : '';
    $title_heading      = ( $title_size == 'custom' ) ? 'h4' : $title_size;
    $custom_title_size  = ( $title_size == 'custom' && $custom_title_size ) ? 'font-size:'. $custom_title_size .'px;' : '';
    $title_color        = ( $box_title_color ) ? 'color:'. $box_title_color .';' : '';
    $title_style        = ( $title_color || $custom_title_size ) ? ' style="'. $title_color . $custom_title_size .'"' : '';


    // custom box
    $custom_css       .= ( $box_border_width )  ? 'border-width:'. $box_border_width . 'px;' : '';
    $custom_css       .= ( $box_border_style )  ? 'border-style:'. $box_border_style . ';' : '';

    if( $box_background != 'accent' || $box_border || $box_text_color ){
      $custom_css     .= ( $box_text_color )  ? 'color:'. $box_text_color . ';' : '';
      $custom_css     .= ( $box_background != 'accent' ) ? 'background-color:'. $box_background . ';' : '';
      $custom_css     .= ( $box_border ) ? 'border-color:'. $box_border . ';' : '';
      $box_background  = 'custom';
    }

    $in_style = ( $custom_css || $in_style ) ? ' style="'. $custom_css . $in_style .'"' : '';

    // begin output
    $output   = ( $link ) ? '<a href="'. $link .'"'. $target .' class="cs-box-link">' : '';
    $output  .= '<div'. $id .' class="cs-fancybox cs-fancybox-'. $box_background . ' cs-fancybox-'. $box_type .' cs-fancybox-'. $icon_position . $box_size . $box_rounded . $class .'"'. $in_style .'>';

      // icon
      if( $icon ) {
        $output  .= cs_icon( array(
          'holder'        => 'div',
          'icon'          => $icon,
          'size'          => $icon_size,
          'type'          => $icon_type,
          'shape'         => $icon_shape,
          'color'         => $icon_color,
          'border'        => $icon_border,
          'background'    => $icon_background,
          'border_width'  => $icon_border_width,
          'border_style'  => $icon_border_style,
        ) );
      }

      // title
      if( $title ) {
        $output  .= '<'. $title_heading .' class="cs-fancybox-heading"'. $title_style .'>'. $title .'</'. $title_heading .'>';
      }

      $output  .= '<div class="cs-fancybox-text">';
      $output  .= cs_set_wpautop( $content );
      $output  .= '</div>';

    $output  .= '</div>';
    $output  .= ( $link ) ? '</a>' : '';
    // end output

    return $output;
  }
  add_shortcode('cs_fancybox', 'cs_fancybox');
}