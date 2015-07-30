<?php
/**
 *
 * CS Responsive Video
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_responsive_video' ) ) {
  function cs_responsive_video( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'        => '',
      'class'     => '',
      'in_style'  => '',
      'radio'     => '16:9',
      'no_border' => '',
      'mp4'       => '',
      'ogv'       => '',
      'webm'      => '',
      'poster'    => '',
      'loop'      => '',
      'autoplay'  => '',
    ), $atts ) );

    $id         = ( $id ) ? ' id="'. $id .'"' : '';
    $class      = ( $class ) ? ' '. $class : '';
    $in_style   = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $is_border  = ( !$no_border ) ? ' cs-fluid-border' : '';
    $radio      = ( $radio != '16:9' ) ? ' style="padding-bottom:'. cs_aspect_radio( $radio ) .'%;"' : '';

    if ( $content ) {

      if ( substr( $content, 0, 4) == 'http' ) {
        global $wp_embed;
        $content = ( isset( $wp_embed ) ) ? $wp_embed->autoembed( $content ) : $content;
      }

    } else if ( $mp4 || $ogv || $webm ) {

      $mp4      = ( $mp4 ) ? ' mp4="'. $mp4 .'"' : '';
      $ogv      = ( $ogv ) ? ' ogv="'. $ogv .'"' : '';
      $webm     = ( $webm ) ? ' webm="'. $webm .'"' : '';
      $poster   = ( $poster ) ? ' poster="'. $poster .'"' : '';
      $loop     = ( $loop ) ? ' loop="on"' : '';
      $autoplay     = ( $autoplay ) ? ' autoplay="on"' : '';
      $content  = '[video'. $mp4 . $ogv . $webm . $poster . $loop . $autoplay .'][/video]';

    }


    // begin output
    $output   = '<div'. $id .' class="cs-fluid'. $is_border . $class .'"'. $in_style .'>';
    $output  .= '<div class="cs-fluid-inner"'. $radio .'>';
    $output  .= do_shortcode( $content );
    $output  .= '</div>';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_responsive_video', 'cs_responsive_video');
}