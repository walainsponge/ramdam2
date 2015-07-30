<?php
/**
 *
 * CS Google Map Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_gmap' ) ) {
  function cs_gmap( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'                => '',
      'class'             => '',
      'in_style'          => '',
      'latitude'          => '',
      'longitude'         => '',
      'zoom'              => 15,
      'no_zoom'           => '',
      'no_scrollwheel'    => '',
      'map_type'          => 'roadmap',
      'markers'           => '',
      'marker_animation'  => '',
      'icon'              => '',
      'no_border'         => '',
      'height'            => '',
    ), $atts ) );

    $mapOptions = array();

    if( $markers ) {

      $marks    = array();
      $markers  = explode( '~', $markers );


      foreach ( $markers as $key => $map ) {
        $marker = explode( '|', $map );
        $marks[] = array(
          'lat'     => $marker[0],
          'lng'     => $marker[1],
          'content' => $marker[2],
        );
      }

      $mapOptions['markers'] = $marks;

    }

    $mapOptions['lat']          = $latitude;
    $mapOptions['lng']          = $longitude;
    $mapOptions['zoom']         = $zoom;
    $mapOptions['zoom_control'] = ( $no_zoom ) ? 0 : 1;
    $mapOptions['scrollwheel']  = ( $no_scrollwheel ) ? 0 : 1;
    $mapOptions['icon']         = $icon;

    if( $map_type ){
      $mapOptions['mapTypeId']    = $map_type;
    }

    wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array('cs-jquery-register'), null, true );

    $uniqid   = rand(0,999999);
    $id       = ( $id ) ? ' id="'. $id .'"' : '';
    $class    = ( $class ) ? ' '. $class : '';
    $in_style = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $style    = ( $height ) ? ' style="padding-bottom:0; height:'. $height .'px;"' : '';
    $border   = ( !$no_border ) ? ' cs-fluid-border' : '';

    // begin output
    $output   = '<div'. $id .' class="cs-gmap'. $border . $class .'" data-token="cs_gmap_'. $uniqid .'"'. $in_style .'>';
      $output  .= '<div class="cs-fluid-inner"'. $style .'>';
      $output  .= '<div id="cs_gmap_'. $uniqid .'" class="cs-gmap-canvas"></div>';
      $output  .= '</div>';
    $output  .= '</div>';
    // end output

    wp_localize_script( 'google-map', 'cs_gmap_'.$uniqid, $mapOptions );

    return $output;
  }
  add_shortcode('cs_gmap', 'cs_gmap');
}