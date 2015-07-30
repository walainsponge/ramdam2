<?php
/**
 *
 * CS Count Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_piechart' ) ) {
  function cs_piechart( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'in_style'      => '',
      'type'          => 'count',
      'icon'          => '',
      'text'          => '',
      'title'         => '',
      'percent'       => 100,
      'size'          => '',
      'line_width'    => 2,
      'prefix'        => '',
      'text_size'     => '',
      'title_size'    => '',
      'track_color'   => '',
      'text_color'    => '',
      'title_color'   => '',
      'bar_color'     => ( cs_get_option( 'skin' ) != 'default' ) ? cs_get_option( 'accent_color' ) : '#428bca',
    ), $atts ) );

    $id             = ( $id ) ? ' id="'. $id .'"' : '';
    $class          = ( $class ) ? ' '. $class : '';
    $in_style       = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $prefix         = ( $prefix ) ? '<span class="prefix">'. $prefix .'</span>' : '';
    $bar_color      = ( $bar_color ) ? ' data-bar-color="'. $bar_color .'"' : '';
    $track_color    = ( $track_color ) ? ' data-track-color="'. $track_color .'"' : '';
    $line_width     = ( $line_width ) ? ' data-line-width="'. $line_width .'"' : '';
    $data_size      = ( $size ) ? ' data-size="'. $size .'"': '';
    $size_style     = ( $size ) ? 'width:'. $size .'px;height:'. $size .'px;line-height:'. $size .'px;' : '';
    $text_size      = ( $text_size ) ? 'font-size:'. $text_size .'px;' : '';
    $text_color     = ( $text_color ) ? 'color:'. $text_color .';' : '';
    $text_style    = ( $size_style || $text_size || $text_color ) ? ' style="'. $size_style . $text_size . $text_color .'"': '';

    // title style
    $title_color    = ( $title_color ) ? 'color:'. $title_color .';' : '';
    $title_size     = ( $title_size ) ? 'font-size:'. $title_size .'px;' : '';
    $title_style    = ( $title_size || $title_color ) ? ' style="'. $title_size . $title_color .'"': '';

    $output    = '<div'. $id .' class="cs-piechart-wrap'. $class .'"'. $in_style .'>';

      $output     .= '<div class="cs-piechart" data-percent="'. $percent .'"'. $bar_color . $track_color . $line_width . $data_size . $text_style .'>';

        // text-type
        $output   .= '<h4 class="cs-piechart-text">';
        switch ( $type ) {
          case 'text':
            $output   .= $text;
            break;

          case 'icon':
            $icon_height  = ( $size ) ? ' style="line-height:'. $size .'px;"': '';
            $output   .= '<i class="'. cs_icon_class( $icon ) .'"'. $icon_height .'></i>';
            break;

          default:
            $output   .= '<span class="cs-piecount" data-to="'. $percent .'">'. $percent .'</span>'. $prefix;
            break;
        }
        $output   .= '</h4>';

      $output   .= '</div>';

      $output   .= ( $title ) ? '<h6 class="cs-piechart-title"'. $title_style .'>'. $title .'</h6>' : '';
      $output   .= ( $content ) ? '<div class="cs-piechart-content">'. $content .'</div>' : '';

    $output   .= '</div>';

    return $output;
  }
  add_shortcode('cs_piechart', 'cs_piechart');
}