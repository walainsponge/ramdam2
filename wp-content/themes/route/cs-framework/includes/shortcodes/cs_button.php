<?php
/**
 *
 * CS Button
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_button' ) ) {
  function cs_button( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
      'id'                => '',
      'class'             => '',
      'title'             => '',
      'href'              => '#',
      'target'            => '',

      // models
      'type'              => 'flat',
      'shape'             => 'square',
      'size'              => 'sm',
      'color'             => 'accent',
      'icon'              => '',

      // utilities
      'align'             => '',
      'block'             => '',
      'textshadow'        => '',
      'no_uppercase'      => '',
      'no_bold'           => '',
      'no_transition'     => '',

      // customize
      'bgcolor'           => '',
      'bghovercolor'      => '',
      'textcolor'         => '',
      'texthovercolor'    => '',
      'bordercolor'       => '',
      'borderhovercolor'  => '',
      'in_style'          => '',
      'in_style_hover'    => '',

      // animation
      'animation'           => '',
      'animation_delay'     => '',
      'animation_duration'  => '',
    ), $atts ) );

    if ( function_exists( 'vc_parse_multi_attribute' ) ) {
      $parse_args     = vc_parse_multi_attribute( $href );
      $href           = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : $href;
      $title          = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : $title;
      $target         = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : $target;
    }

    $id               = ( $id ) ? ' id="'. $id .'"' : '';
    $class            = ( $class ) ? ' '. $class : '';
    $target           = ( $target ) ? ' target="'. $target .'"' : '';
    $title            = ( $title ) ? ' title="'. cs_htmlentities( $title ) .'"' : '';
    $align_block      = ( $block ) ? ' cs-btn-block' : '';
    $align            = ( $align ) ? ' text-'.$align : '';
    $textshadow       = ( $textshadow ) ? ' cs-btn-shadow' : '';
    $no_uppercase     = ( $no_uppercase ) ? ' cs-btn-no-uppercase' : '';
    $no_bold          = ( $no_bold ) ? ' cs-btn-no-bold' : '';
    $no_transition    = ( $no_transition ) ? ' cs-btn-no-transition' : '';
    $icon             = ( $icon ) ? '<i class="'. cs_icon_class( $icon ) . '"></i>' : '';
    $uniqid_class     = '';
    $customize        = ( $bgcolor || $textcolor || $bordercolor || $bghovercolor || $texthovercolor || $borderhovercolor ) ? true : false;

    // element animation
    $animation        = ( $animation ) ? ' cs-animation '. $animation : '';
    $animation_data   = ( $animation && $animation_delay ) ? ' data-delay="'. $animation_delay .'"' : '';
    $animation_data   = ( $animation && $animation_duration ) ? $animation_data . ' data-duration="'. $animation_duration .'"' : $animation_data;

    // custom color
    if ( $customize || $in_style || $in_style_hover ){

      $uniqid        = uniqid();
      $custom_style  = '';

      if ( $bgcolor || $textcolor || $bordercolor || $in_style ) {
        $custom_style .= '.cs-btn-custom-'. $uniqid .'{';
        $custom_style .= ( $bgcolor ) ? 'background-color:'. $bgcolor .';' : '';
        $custom_style .= ( $textcolor ) ? 'color:'. $textcolor .'!important;' : '';
        $custom_style .= ( $bordercolor ) ? 'border-color:'. $bordercolor .';' : '';
        $custom_style .= ( $in_style ) ? $in_style : '';
        $custom_style .= ( $type == '3d' && $bgcolor )  ? 'box-shadow:0 0.3em 0 '. cs_brightness( $bgcolor, -0.7901 ) : '';
        $custom_style .= '}';
      }

      // hover colors
      if ( $bghovercolor || $texthovercolor || $borderhovercolor || $in_style_hover ) {
        $custom_style .= '.cs-btn-custom-'. $uniqid .':hover{';
        $custom_style .= ( $bghovercolor ) ? 'background-color:'. $bghovercolor .';' : '';
        $custom_style .= ( $texthovercolor ) ? 'color:'. $texthovercolor .'!important;' : '';
        $custom_style .= ( $borderhovercolor ) ? 'border-color:'. $borderhovercolor .';' : '';
        $custom_style .= ( $in_style_hover ) ? $in_style_hover : '';
        $custom_style .= '}';
      }

      // add inline style
      cs_add_inline_style( $custom_style );

      $uniqid_class  = ' cs-btn-custom-'. $uniqid;
      $color         = ( $customize ) ? 'own' : $color;
      $type          = ( $type != '3d' && $customize ) ? 'custom' : $type;

    }

    // begin output
    $output   = '';
    $output  .= ( $align ) ? '<div class="cs-btn-align'. $align . $align_block .'">' : '';
    $output  .= '<a'. $id .' href="'. $href .'" class="cs-btn cs-btn-'. $type .' cs-btn-'. $shape .' cs-btn-'. $type . '-'. $color .' cs-btn-'. $size . $no_uppercase . $no_bold . $no_transition . $textshadow . $align_block . $uniqid_class . $animation . $class .'"'. $animation_data . $target . $title .'>';
    $output  .= $icon;
    $output  .= do_shortcode( $content );
    $output  .= '</a>';
    $output  .= ( $align ) ? '</div>' : '';
    // end output

    return $output;
  }
  add_shortcode('cs_button', 'cs_button');


  /**
   *
   * CS Button Group
   * @version 1.0.0
   * @since 1.0.0
   *
   */
  function cs_button_group( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
      'id'                => '',
      'class'             => '',
    ), $atts ) );

    // begin output
    $output   = '<div class="cs-btn-group">';
    $output  .= do_shortcode( $content );
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_button_group', 'cs_button_group');
}