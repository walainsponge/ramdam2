<?php
/**
 *
 * CS Border
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_border' ) ) {
  function cs_border( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'    => '',
      'class' => '',
    ), $atts ) );

    return '<div class="cs-fluid-border">' . $content . '</div>';
  }
  add_shortcode('cs_border', 'cs_border');
}