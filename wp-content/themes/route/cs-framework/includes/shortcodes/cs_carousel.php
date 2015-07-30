<?php
/**
 *
 * CS Carousel
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_carousel' ) ) {
  function cs_carousel( $atts, $content = '' ) {

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'in_style'      => '',
      'min'           => 1,
      'max'           => 4,
      'items_width'   => 225,
      'items_scroll'  => 1,
      'delay'         => 3,
      'no_mousewheel' => 0,
      'no_swipe'      => 0,
      'no_autoplay'   => 0,
      'no_padding'    => 0,
      'no_nav'        => 0,
      'nav_pos'       => 'center',
      'nav_bottom'    => '',
    ), $atts ) );

    $id         = ( $id ) ? ' id="'. $id .'"' : '';
    $class      = ( $class ) ? ' '. $class : '';
    $in_style   = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $nav_fluid  = ( $nav_pos == 'fluid' ) ? ' fluid' : '';

    wp_enqueue_script( 'cs-caroufredsel' );

      // begin output
    $output   = '';

    $output  .= '<div'. $id .' class="cs-carousel'. $class .'" data-min="'. $min .'" data-max="'. $max .'" data-items-width="'. $items_width .'" data-items-scroll="'. $items_scroll .'" data-no-mousewheel="'. $no_mousewheel .'" data-no-swipe="'. $no_swipe .'" data-no-autoplay="'. $no_autoplay .'" data-delay="'. $delay .'"'. $in_style .'>';

      $output  .= '<div class="cs-loader"></div>';
      $output  .= ( ! $no_nav && ! $nav_bottom ) ? '<div class="cs-carousel-navigation'. $nav_fluid .' text-'. $nav_pos .'"><i class="cs-carousel-prev fa fa-arrow-circle-o-left"></i><i class="cs-carousel-next fa fa-arrow-circle-o-right"></i></div>' : '';
      $output  .= '<div class="cs-carousel-outer">';
      $output  .= ( ! $no_padding ) ? '<div class="cs-carousel-padding">' : '';

      $output  .= '<div class="cs-carousel-wrapper">';
      $output  .= do_shortcode( $content );
      $output  .= '</div>';

      $output  .= ( ! $no_padding ) ? '</div>' : '';
      $output  .= '</div>';
      $output  .= ( ! $no_nav && $nav_bottom ) ? '<div class="cs-carousel-navigation text-'. $nav_pos .'"><i class="cs-carousel-prev fa fa-chevron-left cs-icon-circle cs-icon-outlined cs-icon-gray cs-icon-xs"></i><i class="cs-carousel-next fa fa-chevron-right cs-icon-circle cs-icon-outlined cs-icon-gray cs-icon-xs"></i></div>' : '';

    $output  .= '<div class="clear"></div>';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_carousel', 'cs_carousel');
}

/**
 *
 * CS Carousel Item
 * @version 1.0.0
 * @since 1.0.0
 *
 */
if( ! function_exists( 'cs_carousel_item' ) ) {
  function cs_carousel_item( $atts, $content = '' ){
    return '<div class="cs-carousel-item">'. do_shortcode( $content ) . '</div>';
  }
  add_shortcode('cs_carousel_item', 'cs_carousel_item');
}