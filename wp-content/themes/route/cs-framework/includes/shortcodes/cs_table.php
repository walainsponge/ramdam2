<?php
/**
 *
 * CS Table
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_table' ) ) {
  function cs_table( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'          => '',
      'class'       => '',
      'in_style'    => '',
      'striped'     => '',
      'bordered'    => '',
      'hover'       => '',
      'condensed'   => '',
      'responsive'  => '',
    ), $atts ) );

    $id         = ( $id ) ? ' id="'. $id .'"' : '';
    $class      = ( $class ) ? ' '. $class : '';
    $in_style   = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $striped    = ( $striped ) ? ' cs-table-striped' : '';
    $bordered   = ( $bordered ) ? ' cs-table-bordered' : '';
    $hover      = ( $hover ) ? ' cs-table-hover' : '';
    $condensed  = ( $condensed ) ? ' cs-table-condensed' : '';
    $content    = str_replace( '<table', '<table'. $id .' class="cs-table'. $striped . $bordered . $hover . $condensed . $class .'"'. $in_style, $content );

    // begin output
    $output   = '';
    $output  .= ( $responsive ) ? '<div class="cs-table-responsive">' : '';
    $output  .= cs_set_wpautop( $content );
    $output  .= ( $responsive ) ? '</div>' : '';
    // end output

    return $output;
  }
  add_shortcode('cs_table', 'cs_table');
}