<?php
/**
 *
 * CS Testimonials
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_testimonials' ) ) {
  function cs_testimonials( $atts, $content = '', $id = '' ){

    global $cs_testimonials;
    $cs_testimonials = array();

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'in_style'      => '',
      'cite'          => '',
    ), $atts ) );

    do_shortcode( $content );

    // is not empty clients
    if( empty( $cs_testimonials ) ) { return; }

    wp_enqueue_style( 'cs-royalslider' );
    wp_enqueue_script( 'cs-royalslider' );

    $id             = ( $id ) ? ' id="'. $id .'"' : '';
    $class          = ( $class ) ? ' '. $class : '';
    $in_style       = ( $in_style ) ? ' style="'. $in_style .'"' : '';

    // begin output
    $output   = '<div'. $id .' class="royalSlider testimonialSlider'. $class .'"'. $in_style .'>';

    foreach ( $cs_testimonials as $key => $testimonial ) {

      $author   = ( !empty( $testimonial['atts']['author'] ) ) ? $testimonial['atts']['author'] : '';
      $slogan   = ( !empty( $testimonial['atts']['slogan'] ) ) ? ' <small>'. $testimonial['atts']['slogan'] .'</small>' : '';
      $avatar   = ( !empty( $testimonial['atts']['avatar'] ) ) ? $testimonial['atts']['avatar'] : '';

      $output  .= '<div class="cs-testimonial-content">';
      $output  .= '<div class="cs-testimonial-text">'. do_shortcode( $testimonial['content'] ) .'</div>';
      $output  .= ( $avatar ) ? '<div class="cs-testimonial-avatar"><img src="'. $avatar .'" alt="'. $author .'"/></div>' : '';
      $output  .= ( $author || $slogan ) ? '<div class="cs-testimonial-author">'. $author . $slogan .'</div>' : '';
      $output  .= '</div>';
    }

    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_testimonials', 'cs_testimonials');
}


/**
 *
 * CS Testimonial
 * @version 1.0.0
 * @since 1.0.0
 *
 */
if( ! function_exists( 'cs_testimonial' ) ) {
  function cs_testimonial( $atts, $content = '', $id = '' ) {
    global $cs_testimonials;
    $cs_testimonials[]  = array( 'atts' => $atts, 'content' => $content );
    return;
  }
  add_shortcode('cs_testimonial', 'cs_testimonial');
}