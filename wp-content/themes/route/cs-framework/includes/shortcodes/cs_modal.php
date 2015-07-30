<?php
/**
 *
 * CS Modal
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_modal' ) ) {
  function cs_modal( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'      => '',
      'class'   => '',
      'title'   => '',
      'center'  => '',
      'size'    => 'lg',
    ), $atts ) );

    $center    = ( $center ) ? ' modal-center': '';
    $output    = '<div id="'. $id .'" class="bs-modal modal fade'. $center . $class .'" tabindex="-1" role="dialog" aria-hidden="true" data-selector=".'. $id .'">';
    $output   .= '<div class="modal-dialog modal-'. $size .'">';
    $output   .= '<div class="modal-content">';

    // title
    if( $title ) {
      $output   .= '<div class="modal-header">';
      $output   .= '<div class="fa fa-times"  data-dismiss="modal"></div>';
      $output   .= '<h4 class="modal-title">'. $title .'</h4>';
      $output   .= '</div>';
    }

    // body
    $output   .= '<div class="modal-body">'. cs_set_wpautop( $content ) . '</div>';
    $output   .= '</div>';
    $output   .= '</div>';
    $output   .= '</div>';

    return $output;
  }
  add_shortcode('cs_modal', 'cs_modal');
}