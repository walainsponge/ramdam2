<?php
/**
 *
 * CS Clients
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_clients' ) ) {
  function cs_clients( $atts, $content = '', $id = '' ){

    global $cs_clients;
    $cs_clients = array();

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'in_style'      => '',
      'type'          => '',
      'columns'       => 4,
      'effect'        => '',
      'border_color'  => '',
    ), $atts ) );

    do_shortcode( $content );

    // is not empty clients
    if( empty( $cs_clients ) ) { return; }

    $id           = ( $id ) ? ' id="'. $id .'"' : '';
    $class        = ( $class ) ? ' '. $class : '';
    $in_style     = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $effect       = ( ! $effect ) ? ' cs-client-effect' : '';
    $border_color = ( $border_color ) ? 'border-color:'. $border_color .';' : '';

    $row_num  = 0;
    $end_row  = ceil( count( $cs_clients ) / $columns );
    $el_width = ( 100 / $columns );

    // begin output
    $output    = '<ul'. $id .' class="cs-client cs-client-col-'. $columns . $effect . $class .'"'. $in_style .'>';

    foreach( $cs_clients as $key => $client ){

      // calc
      $last_child   = ( ( $key + 1 ) % $columns ) ? '' : 'last-child';
      $line_row     = ( $key % $columns ) ? '' : $row_num++;
      $end_of_row   = ( $row_num == $end_row ) ? ' last-row' : '';
      $output      .= '<li class="'. $last_child . $end_of_row .'" style="width:'. $el_width .'%;'. $border_color .'">';
      $output      .= '<figure>';
      $output      .= ( $client['link'] ) ? '<a href="'. $client['link'] .'" target="'. $client['target'] .'">' : '';
      $output      .= '<img src="'. $client['image'] .'" alt="'. $client['title'] .'" />';
      $output      .= ( $client['link'] ) ? '</a>' : '';
      $output      .= '</figure>';
      $output      .= '</li>';

    }

    $output   .= '</ul>';
    // end output

    return $output;
  }
  add_shortcode('cs_clients', 'cs_clients');
}


/**
 *
 * CS Client
 * @version 1.0.0
 * @since 1.0.0
 *
 */
if( ! function_exists( 'cs_client' ) ) {
  function cs_client( $atts ){

    global $cs_clients;

    extract( shortcode_atts( array(
      'link'    => '',
      'title'   => '',
      'target'  => '',
      'image'   => '',
    ), $atts ) );

    if ( function_exists( 'vc_parse_multi_attribute' ) ) {
      $parse_args   = vc_parse_multi_attribute( $link );
      $link         = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : $link;
      $title        = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : $title;
      $target       = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : $target;
    }

    $cs_clients[] = array(
      'link'    => $link,
      'target'  => $target,
      'title'   => $title,
      'image'   => $image,
    );

    return;

  }
  add_shortcode('cs_client', 'cs_client');
}