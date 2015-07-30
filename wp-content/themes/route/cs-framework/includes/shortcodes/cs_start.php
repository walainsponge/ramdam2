<?php
/**
 *
 * CS Start for One-Page
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_start' ) ) {
  function cs_start( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'        => '',
      'class'     => '',
      'in_style'  => '',
      'target'    => '',
    ), $atts ) );

    $id       = ( $id ) ? ' id="'. $id .'"' : '';
    $class    = ( $class ) ? ' '. $class : '';
    $in_style = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $target   = ( $target ) ? ' data-target="'. $target .'"' : '';

    return '<div'.$id.' class="cs-start cs-start-icon fa fa-chevron-down'. $class .'"'. $target . $in_style .'></div>';
  }
  add_shortcode('cs_start', 'cs_start');
}