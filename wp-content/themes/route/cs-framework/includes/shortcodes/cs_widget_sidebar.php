<?php
/**
 *
 * CS Widget Sidebar
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_widget_sidebar' ) ) {
  function cs_widget_sidebar( $atts ) {

    extract( shortcode_atts( array(
      'id'          => 'sidebar',
      'class'       => '',
      'sidebar_id'  => '',
    ), $atts ) );

    // check for sidebar id
    if ( ! $sidebar_id ) { return null; }

    $id     = ( $id ) ? ' id="'. $id .'"' : '';
    $class  = ( $class ) ? ' class="'. $class .'"' : '';

    ob_start();
    echo '<aside'. $id . $class .'>';
    dynamic_sidebar($sidebar_id);
    echo '</aside>';
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;
  }
  add_shortcode('cs_widget_sidebar', 'cs_widget_sidebar');
}