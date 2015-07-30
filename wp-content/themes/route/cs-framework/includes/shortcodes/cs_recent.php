<?php
/**
 *
 * CS Recent
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_recent' ) ) {
  function cs_recent( $atts, $content = '' ){

    extract( shortcode_atts( array(
      'id'            => '',
      'class'         => '',
      'type'          => 'post',
      'cats'          => '',
      'min'           => 1,
      'max'           => 4,
      'items_width'   => 225,
      'items_scroll'  => 1,
      'mousewheel'    => true,
      'swipe'         => true,
      'autoplay'      => true,
      'delay'         => 3,
      'padding'       => 1,
      'nav'           => 1,
      'nav_pos'       => 'center',
      'nav_bottom'    => false,
    ), $atts ) );

    $id         = ( $id ) ? ' id="'. $id .'"' : '';
    $class      = ( $class ) ? ' '. $class : '';
    $nav_fluid  = ( $nav_pos == 'fluid' ) ? ' fluid' : '';

    wp_enqueue_script( 'cs-caroufredsel' );

    // begin output
    $output   = '<div class="cs-recent cs-recent-'. $type .'">';

    $output  .= '<div class="cs-carousel" data-min="'. $min .'" data-max="'. $max .'" data-items-width="'. $items_width .'" data-items-scroll="'. $items_scroll .'" data-mousewheel="'. $mousewheel .'" data-swipe="'. $swipe .'" data-autoplay="'. $autoplay .'" data-delay="'. $delay .'">';

      $output  .= '<div class="cs-loader"></div>';
      $output  .= ( $nav && !$nav_bottom ) ? '<div class="cs-carousel-navigation'. $nav_fluid .' text-'. $nav_pos .'"><i class="cs-carousel-prev fa fa-chevron-left cs-icon-circle cs-icon-outlined cs-icon-gray cs-icon-xs"></i><i class="cs-carousel-next fa fa-chevron-right cs-icon-circle cs-icon-outlined cs-icon-gray cs-icon-xs"></i></div>' : '';
      $output  .= '<div class="cs-carousel-outer">';
      $output  .= ( $padding ) ? '<div class="cs-carousel-padding">' : '';

      $output  .= '<div class="cs-carousel-wrapper">';

      // get posts
      $args = array(
        'post_type'       => $type,
        'posts_per_page'  => 5,
        'offset'          => 1,
        //'category' => 1
      );
      $posts = get_posts( $args );
      foreach ( $posts as $post ) {
        setup_postdata( $post );
        $output  .= '<div class="cs-carousel-item"><figure><a href="'. get_permalink() .'">'. get_the_post_thumbnail( $post->ID, 'custom-image-size', true ) .'</a></figure></div>';
      }
      wp_reset_postdata();


      $output  .= '</div>';

      $output  .= ( $padding ) ? '</div>' : '';
      $output  .= '</div>';
      $output  .= ( $nav && $nav_bottom ) ? '<div class="cs-carousel-navigation text-'. $nav_pos .'"><i class="cs-carousel-prev fa fa-chevron-left cs-icon-circle cs-icon-outlined cs-icon-gray cs-icon-xs"></i><i class="cs-carousel-next fa fa-chevron-right cs-icon-circle cs-icon-outlined cs-icon-gray cs-icon-xs"></i></div>' : '';

    $output  .= '<div class="clear"></div>';
    $output  .= '</div>';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode('cs_recent', 'cs_recent');
}