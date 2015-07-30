<?php
/**
 *
 * CS Tabs
 * @since 1.0.0
 * @version 1.1.0
 *
 *
 */
if( ! function_exists( 'cs_tabs' ) ) {
  function cs_tabs( $atts, $content = '', $id = '' ) {

    global $cs_tabs;
    $cs_tabs = array();

    extract( shortcode_atts( array(
      'id'        => '',
      'class'     => '',
      'type'      => 'default',
      'color'     => 'accent',
      'active'    => 1,
      'center'    => 0,
      'fit'       => 0,
    ), $atts ) );

    do_shortcode( $content );

    // is not empty clients
    if( empty( $cs_tabs ) ) { return; }

    $output       = '';
    $id           = ( $id ) ? ' id="'. $id .'"' : '';
    $class        = ( $class ) ? ' '. $class : '';
    $center       = ( $center ) ? ' text-center' : '';
    $fit          = ( $fit ) ? ' cs-tab-nav-fit' : '';
    $uniqtab      = uniqid();

    if( $color != 'accent' ){

      $uniqid  = uniqid();
      $output .= cs_css_compress( "<style type=\"text/css\">
      .cs-tab-{$uniqid} .cs-tab-nav ul li.active a:after {
        background-color: {$color};
      }
      .cs-tab-{$uniqid} .cs-tab-nav ul li a:hover,
      .cs-tab-{$uniqid} .cs-tab-nav ul li.active a {
        color: {$color};
      }
      </style>" );

      $color = $uniqid;
    }

    // begin output
    $output  .= '<div'. $id .' class="cs-tab cs-tab-'. $type . ' cs-tab-'. $color . $class .'">';

      // tab-navs
      $output  .= '<div class="cs-tab-nav bs-tab-nav'. $center . $fit .'">';
      $output  .= '<ul>';
      foreach( $cs_tabs as $key => $tab ){
        $title      = $tab['atts']['title'];
        $icon       = ( !empty( $tab['atts']['icon'] ) ) ? '<i class="'. cs_icon_class( $tab['atts']['icon'] ) .'"></i>': '';
        $active_nav = ( ( $key + 1 ) == $active ) ? ' class="active"' : '';
        $output    .= '<li'. $active_nav .'><a href="#'. $uniqtab .'-'. $key .'">'. $icon . $title . '</a></li>';
      }
      $output  .= '</ul>';
      $output  .= '</div>';

      // tab-contents
      $output  .= '<div class="cs-tab-contents">';
      foreach( $cs_tabs as $key => $tab ){
        $title           = $tab['atts']['title'];
        $active_content  = ( ( $key + 1 ) == $active ) ? ' active' : '';
        $output         .= '<div id="'. $uniqtab .'-'. $key .'" class="cs-tab-content'. $active_content .'">'. do_shortcode( $tab['content'] ) .'</div>';
      }
      $output  .= '</div>';

    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('vc_tabs', 'cs_tabs');
}


/**
 *
 * CS Tab
 * @version 1.0.0
 * @since 1.0.0
 *
 */
if( ! function_exists( 'cs_tab' ) ) {
  function cs_tab( $atts, $content = '', $id = '' ) {
    global $cs_tabs;
    $cs_tabs[]  = array( 'atts' => $atts, 'content' => $content );
    return;
  }
  add_shortcode('vc_tab', 'cs_tab');
}