<?php
/**
 *
 * CS Progress Shortcode
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_progress' ) ) {
  function cs_progress( $atts, $content = '', $id = '' ){

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'in_style'      => '',
      'title'         => '',
      'percentage'    => 100,
      'unit'          => '%',
      'height'        => '',
      'vertical'      => '',

      'bar_color'     => '',
      'bg_color'      => '',
      'text_color'    => '',
      'striped'       => '',
      'inside'        => '',
      'circle'        => '',
      'group'         => '',

    ), $atts ) );

    $id             = ( $id ) ? ' id="'. $id .'"' : '';
    $class          = ( $class ) ? ' '. $class : '';
    $striped        = ( $striped ) ? ' cs-progress-striped' : '';
    $circle         = ( $circle ) ? ' cs-circle' : '';
    $group          = ( $group ) ? ' data-group="1"' : '';
    $group_width    = ( $group && ! $vertical ) ? 'width:'. $percentage .'%;' : '';
    $in_style       = ( $group_width || $in_style ) ? ' style="'. $group_width . $in_style .'"' : '';
    $type           = ( $vertical ) ? 'vertical' : 'horizontal';
    $table_cell     = ( $group && $vertical ) ? ' cs-progress-table-cell' : '';
    $unit_space     = ( strlen( $unit ) > 1 ) ? ' ' : '';
    $height         = ( $height ) ? 'height:'. $height .'px;' : '';
    $bg_color       = ( $bg_color ) ? 'background-color:'. $bg_color .';' : '';
    $custom_bg      = ( $height || $bg_color ) ? ' style="'. $height . $bg_color .'"' : '';
    $custom_bar     = ( $bar_color ) ? ' style="background-color:'. $bar_color .'"' : '';
    $text_color     = ( $text_color ) ? ' style="color:'. $text_color .'"' : '';
    $number         = ( $unit ) ? '<div class="cs-progress-number"><span>0</span>'. $unit_space . $unit .'</div>' : '';

    // title wrap
    if( $title || $unit ) {
      $title_wrap   = '<div class="cs-progress-title-wrap"'. $text_color .'>';
      $title_wrap  .= ( $title ) ? '<div class="cs-progress-title">'. $title .'</div>' : '';
      $title_wrap  .= ( empty( $inside ) ) ? $number : '';
      $title_wrap  .= '<div class="clear"></div>';
      $title_wrap  .= '</div>';
    }

    // begin output
    $output   = '<div'. $id .' class="cs-progress cs-progress-'. $type . $table_cell . $class .'"'. $in_style .'>';
    $output  .= ( $type == 'horizontal' ) ? $title_wrap : '';
    $output  .= '<div class="cs-progress-bar-outer'. $circle .'"'. $custom_bg .'>';
    $output  .= '<div data-percentage="'. $percentage .'" data-type="'. $type .'"'. $group .' class="cs-progress-bar'. $striped .'"'. $custom_bar .'>';
    $output  .= ( $inside ) ? $number : '';
    $output  .= '</div>';
    $output  .= '</div>';
    $output  .= ( $type == 'vertical' ) ? $title_wrap : '';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_progress', 'cs_progress');
}


/**
 *
 * CS Progress Group Shortcode
 * @version 1.0.0
 * @since 1.0.0
 *
 */
if( ! function_exists( 'cs_progress_group' ) ) {
  function cs_progress_group( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
      'id'        => '',
      'class'     => '',
      'in_style'  => '',
    ), $atts ) );

    $id           = ( $id ) ? ' id="'. $id .'"' : '';
    $class        = ( $class ) ? ' '. $class : '';
    $in_style     = ( $in_style ) ? ' style="'. $in_style . '"' : '';

    return '<div'. $id .' class="cs-progress-group'. $class .'"'. $in_style .'><div class="cs-progress-wrap">'. do_shortcode( str_replace( 'progress', 'progress group="1"', $content ) ) .'</div><div class="clear"></div></div>';
  }
  add_shortcode('cs_progress_group', 'cs_progress_group');
}