<?php
/**
 *
 * VC Row
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_row' ) ) {
  function cs_row( $atts, $content = '', $key = '' ){

    $row_padding = ( $key != 'vc_row_inner' ) ? 'md-padding' : '';

    $defaults = array(
      'id'                 => '',
      'class'              => '',
      'in_style'           => '',

      // background
      'bgcolor'            => '',
      'background'         => '',
      'repeat'             => '',
      'position'           => '',
      'attachment'         => '',
      'cover'              => 0,
      'parallax'           => 0,
      'speed'              => 0.4,

      // overlay
      'overlay'            => 0,
      'overlay_color'      => '#000',
      'overlay_opacity'    => 0.5,

      // padding
      'padding'            => $row_padding,
      'top'                => '',
      'bottom'             => '',

      // Extras
      'text_color'         => '',
      'fluid'              => 0,
      'mp4'                => '',
      'ogv'                => '',
      'webm'               => '',
      'flv'                => '',
      'loop'               => 0,
      'muted'              => 0,
      'shadow'             => 0,
    );
    extract( shortcode_atts( $defaults, $atts ) );

    // ID - CLASS
    $id                     = ( $id ) ? ' id="'. $id. '"' : '';
    $class                  = ( $class ) ? ' '. $class : '';
    $padding_class          = ( $padding ) ? ' '. $padding : '';
    $section_class          = ( $overlay || $mp4 || $ogv || $webm ) ? ' cs-parallax' : '';
    $is_fluid               = ( $fluid ) ? '-fluid' : '';
    $cover_class            = ( $cover ) ? ' cs-section-cover-bg' : '';
    $shadow_class           = ( $shadow ) ? ' cs-section-shadow' : '';
    $section_parallax       = ( $parallax ) ? ' parallax' : '';
    $section_parallax_speed = ( $parallax ) ? ' data-parallax-speed="'. $speed .'"' : '';
    $cs_text_white          = ( $text_color == "#ffffff" ) ? ' cs-text-white' : '';

    if ( is_numeric( $background ) ){
      $image_src  = wp_get_attachment_image_src( $background, 'full' );
      $background = $image_src[0];
    }

    // section background
    $background_image       = ( $background ) ? 'background-image: url(' . $background . ');' : '';
    $background_repeat      = ( $background && ! empty( $repeat ) ) ? ' background-repeat: ' . $repeat . ';' : '';
    $background_position    = ( $background && ! empty( $position ) ) ? ' background-position: ' . $position . ';' : '';
    $background_attachment  = ( $parallax ) ? 'fixed' : $attachment;
    $background_attachment  = ( $background && ! empty( $background_attachment ) ) ? ' background-attachment: ' . $background_attachment . ';' : '';
    $background_color       = ( $bgcolor ) ? ' background-color: ' . $bgcolor . ';' : '';
    $background_style       = ( $background ) ? $background_image . $background_repeat . $background_position . $background_attachment : '';

    $section_text_color     = ( $text_color ) ? ' color: ' . $text_color . ';' : '';
    $section_padding        = ( $padding == 'custom-padding' ) ? ' padding-top: '. cs_validpx( $top ) .'; padding-bottom:' . cs_validpx( $bottom ) .';' : '';
    $section_style          = ( $background || $bgcolor || $section_padding || $section_text_color || $in_style ) ? ' style="'. $background_style . $background_color . $section_padding . $section_text_color . $in_style .'"' : '';
    $overlay_style          = ( $overlay ) ? ' style="background-color:'. cs_hex2rgba($overlay_color, $overlay_opacity) . ';"' : '';

    $output  = '<section'. $id .' class="cs-section'. $section_class . $padding_class . $section_parallax . $shadow_class . $cover_class . $cs_text_white . $class .'"'. $section_style . $section_parallax_speed .'>';

    $output .= '<div class="container'. $is_fluid .'">';
    $output .= '<div class="row">';
    $output .= ( $key == 'cs_row' && !$fluid ) ? '<div class="col-md-12">' : '';
    $output .= do_shortcode( $content );
    $output .= ( $key == 'cs_row' && !$fluid ) ? '</div>' : '';
    $output .= '</div>';
    $output .= '</div>';

    $output .= ( $overlay ) ? '<div class="section-overlay"'. $overlay_style .'></div>' : '';

    // video section
    if( $mp4 || $ogv || $webm ){

      wp_enqueue_style( 'mediaelement' );
      wp_enqueue_script( 'mediaelement' );

      $muted   = ( $muted ) ? ' muted' : '';
      $loop    = ( $loop ) ? ' loop' : '';
      $poster  = ( $background ) ? ' poster="'. cs_blank_png() .'"' : '';

      $output .= '<div class="video-section-wrap">';
      $output .= '<div class="video-wrap">';
      $output .= '<video width="1920" height="1080" autoplay'. $muted . $loop . $poster .'>';
      $output .= ( $mp4 ) ? '<source type="video/mp4" src="'. $mp4 .'"></source>' : '';
      $output .= ( $ogv ) ? '<source type="video/ogv" src="'. $ogv .'"></source>' : '';
      $output .= ( $webm ) ? '<source type="video/webm" src="'. $webm .'"></source>' : '';
      $output .= ( $flv ) ? '<source type="video/flv" src="'. $flv .'"></source>' : '';
      $output .= '</video>';
      $output .= '</div>';
      $output .= '</div>';

    }

    $output .= '</section>';

    return $output;
  }
  add_shortcode( 'vc_row', 'cs_row' );
  add_shortcode( 'vc_row_inner', 'cs_row' );
}