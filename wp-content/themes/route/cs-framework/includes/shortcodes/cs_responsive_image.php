<?php
/**
 *
 * CS Responsive Single Image
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_responsive_image' ) ) {
  function cs_responsive_image( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
      'id'                  => '',
      'class'               => '',
      'in_style'            => '',
      'image'               => '',
      'size'                => 'full',
      'alignment'           => '',
      'border'              => '',
      'radius'              => '',
      'href'                => '',
      'target'              => '',
      'lightbox'            => '',
      'animation'           => '',
      'animation_delay'     => '',
      'animation_duration'  => '',
    ), $atts ) );


    $target     = ( $target && ! $lightbox ) ? ' target="'. $target .'"' : '';
    $lightbox   = ( $lightbox ) ? ' class="cs-responsive-img-link fancybox"' : '';
    $class      = ( $class ) ? ' '. $class : '';
    $border     = ( $border ) ? ' cs-fluid-border' : '';
    $radius     = ( $radius ) ? ' cs-radius' : '';
    $animation  = ( $animation ) ? ' cs-animation '. $animation : '';
    $attributes = array();

    if ( $id ) { $attributes['id'] = $id; }
    if ( $in_style ) { $attributes['style'] = $in_style; }
    if ( $animation && $animation_delay ) { $attributes['data-delay'] = $animation_delay; };
    if ( $animation && $animation_duration ) { $attributes['data-duration'] = $animation_duration; };
    if ( $alignment || $class || $animation || $border || $radius ) { $attributes['class'] = $alignment . $class . $animation . $border . $radius; };

    // begin output
    $output   = '';
    $output  .= ( $href ) ? '<a href="'. esc_url( $href ) .'"'. $target . $lightbox .'>' : '';
    $output  .= wp_get_attachment_image( $image, $size, false, $attributes );
    $output  .= ( $href ) ? '</a>' : '';
    // end output

    return $output;
  }
  add_shortcode('cs_responsive_image', 'cs_responsive_image');
}