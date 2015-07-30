<?php
/**
 *
 * CS Team
 * @since 1.8.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_team' ) ) {
  function cs_team( $atts, $content = '' ){

    global $cs_team_columns;

    extract( shortcode_atts( array(
      'id'           => '',
      'class'        => '',
      'in_style'     => '',
    ), $atts ) );

    $id              = ( $id ) ? ' id="'. $id .'"' : '';
    $class           = ( $class ) ? ' '. $class : '';
    $in_style        = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    //$cs_team_columns = $columns;
    $regex      = cs_get_shortcode_regex( 'cs_team_member' );

    // count columns
    preg_match_all('/'. $regex .'/', $content, $count_list );
    $cs_team_columns = count( $count_list[0] );

    // begin output
    $output   = '';
    $output  .= '<div'. $id .' class="cs-team'. $class .'"'. $in_style .'>';
    $output  .= '<div class="container">';
    $output  .= '<div class="row">';
    $output  .= do_shortcode( $content );
    $output  .= '</div>';
    $output  .= '</div>';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_team', 'cs_team');
}

/**
 *
 * CS Team Member
 * @version 1.8.0
 * @since 1.0.0
 *
 */
if( ! function_exists( 'cs_team_member' ) ) {
  function cs_team_member( $atts, $content = '' ){
    global $cs_team_columns;

    extract( shortcode_atts( array(
      'image'         => '',
      'name'          => '',
      'role'          => '',
      'mail'          => '',
      'facebook'      => '',
      'twitter'       => '',
      'linkedin'      => '',
      'google_plus'   => '',
      'tumblr'        => '',
      'youtube'       => '',
      'vimeo'         => '',
      'extra_social'  => '',
    ), $atts ) );

    $output   = '';
    $output  .= '<div class="cs-team-member '. cs_get_bootstrap( $cs_team_columns ) .'">';
    $output  .= ( $image ) ? '<figure><img src="'. $image .'" alt="'. $name .'" /></figure>' : '';
    $output  .= ( $name ) ? '<h4>'. $name .'</h4>' : '';
    $output  .= ( $role ) ? '<h6>'. $role .'</h6>' : '';
    $output  .= ( $content ) ? '<div class="about">'. do_shortcode( $content ) .'</div>' : '';

    $output  .= '<div class="social">';

    $output  .= ( $mail ) ? '<a href="mailto:'. $mail .'" target="_blank" class="fa fa-envelope" data-toggle="tooltip" data-html="true" data-original-title="'. $name .'<br/>'. $mail .'""></a>' : '';
    $output  .= ( $facebook ) ? '<a href="'. $facebook .'" target="_blank" class="fa fa-facebook" data-toggle="tooltip" data-html="true" data-original-title="Facebook<br/>'. $name .'"></a>' : '';
    $output  .= ( $twitter ) ? '<a href="'. $twitter .'" target="_blank" class="fa fa-twitter" data-toggle="tooltip" data-html="true" data-original-title="Twitter<br/>'. $name .'"></a>' : '';
    $output  .= ( $linkedin ) ? '<a href="'. $linkedin .'" target="_blank" class="fa fa-linkedin" data-toggle="tooltip" data-html="true" data-original-title="Linkedin<br/>'. $name .'"></a>' : '';
    $output  .= ( $google_plus ) ? '<a href="'. $google_plus .'" target="_blank" class="fa fa-google-plus" data-toggle="tooltip" data-html="true" data-original-title="Google+<br/>'. $name .'"></a>' : '';
    $output  .= ( $tumblr ) ? '<a href="'. $tumblr .'" target="_blank" class="fa fa-tumblr" data-toggle="tooltip" data-html="true" data-original-title="Tumblr<br/>'. $name .'"></a>' : '';
    $output  .= ( $youtube ) ? '<a href="'. $youtube .'" target="_blank" class="fa fa-youtube" data-toggle="tooltip" data-html="true" data-original-title="Youtube<br/>'. $name .'"></a>' : '';
    $output  .= ( $vimeo ) ? '<a href="'. $vimeo .'" target="_blank" class="fa fa-vimeo-square" data-toggle="tooltip" data-html="true" data-original-title="Vimeo<br/>'. $name .'"></a>' : '';

    // Extra Social Networks
    if( $extra_social ) {
      $networks = explode( ',', $extra_social );
      if( ! empty( $networks ) ){
        foreach ($networks as $network) {
          $site = explode( '|', $network );
          if( ! empty( $site ) ){
            $output .= '<a href="'. $site[2] .'" target="_blank" class="'. $site[0] .'" data-toggle="tooltip" data-html="true" data-original-title="'. $site[1] .'<br/>'. $name .'"></a>';
          }
        }
      }
    }

    $output  .= '</div>';

    $output  .= '</div>';

    return $output;
  }
  add_shortcode('cs_team_member', 'cs_team_member');
}