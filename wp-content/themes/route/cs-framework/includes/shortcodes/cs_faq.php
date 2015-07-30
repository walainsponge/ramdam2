<?php
/**
 *
 * CS FAQ
 * @since 1.0.0
 * @version 1.1.0
 *
 *
 */
if( ! function_exists( 'cs_faq' ) ) {
  function cs_faq( $atts, $content = '', $id = '' ) {

    global $cs_faqs;
    $cs_faqs = array();

    extract( shortcode_atts( array(
      'id'        => '',
      'class'     => '',
      'in_style'  => '',
    ), $atts ) );

    do_shortcode( $content );

    // is not empty clients
    if( empty( $cs_faqs ) ) { return; }

    $id       = ( $id ) ? ' id="'. $id .'"' : '';
    $class    = ( $class ) ? ' '. $class : '';
    $in_style = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $uniqid   = uniqid();

    // begin output
    $output   = '<div'. $id .' class="cs-faq'. $class .'"'. $in_style .'>';

    // filter
    $output  .= '<div class="cs-faq-filter">';
    $output  .= '<a href="#" data-filter="*" class="active">'. __( 'All', 'route' ) .'</a>';
    foreach ( $cs_faqs as $key => $faq ) {
      $output  .= '<a href="#" data-filter=".'. $uniqid .'-'. $key .'">'. $faq['atts']['title'] .'</a>';
    }
    $output  .= '</div>';

    // list
    $output  .= '<div class="cs-faq-isotope">';
    foreach ( $cs_faqs as $key => $faq ) {
      $output  .= '<div class="cs-faq-item '. $uniqid .'-'. $key .'">';
      $output  .= do_shortcode( $faq['content'] );
      $output  .= '</div>';
    }

    $output  .= '</div>';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_faq', 'cs_faq');
}


/**
 *
 * CS Tab
 * @version 1.0.0
 * @since 1.0.0
 *
 */
if( ! function_exists( 'cs_faq_block' ) ) {
  function cs_faq_block( $atts, $content = '', $id = '' ) {
    global $cs_faqs;
    $cs_faqs[]  = array( 'atts' => $atts, 'content' => $content );
    return;
  }
  add_shortcode('cs_faq_block', 'cs_faq_block');
}