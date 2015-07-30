<?php
/**
 *
 * CS Gallery Shortcode Merged with RoyalSlider
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_post_gallery_html' ) ) {
  function cs_post_gallery_html( $gallery_html, $attr ) {
    if( isset( $attr['cstype'] ) ){
      switch ( $attr['cstype'] ) {
        case 'slideshow':
        case 'gallery_thumb':
        case 'gallery_nearby':
            $gallery_html = cs_gallery_royalslider( $attr );
          break;

        case 'gallery_lightbox':
            $gallery_html = cs_gallery_fancybox( $attr );
          break;

        default:
          break;
      }
    }
    return $gallery_html;
  }
  add_filter('post_gallery', 'cs_post_gallery_html', 10, 2);
}

if( ! function_exists( 'cs_gallery_royalslider' ) ) {
  function cs_gallery_royalslider( $attr ) {

    // get post
    $post = get_post();

    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( !empty( $attr['ids'] ) ) {
      if ( empty( $attr['orderby'] ) ) {
        $attr['orderby'] = 'post__in';
      }
    }

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
      $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
      if ( !$attr['orderby'] ) {
        unset( $attr['orderby'] );
      }
    }

    extract( shortcode_atts( array(
      'id'          => ( $post ) ? $post->ID : 0,
      'class'       => '',
      'order'       => 'ASC',
      'orderby'     => 'menu_order ID',
      'size'        => 'large',
      'include'     => '',
      'exclude'     => '',
      'autoplay'    => 5000,
      'scale'       => 'fill',
      'cstype'      => '',
      'width'       => 848,
      'height'      => 400,
      'orientation' => 'horizontal',
      'fullscreen'  => '',
      'loop'        => false,
      'transition'  => 'move',
    ), $attr, 'gallery' ));

    wp_enqueue_style( 'cs-royalslider' );
    wp_enqueue_script( 'cs-royalslider' );

    $id             = intval( $id );
    $slider_id      = uniqid();

    // set rs-slider class names
    $classes        = ( !empty( $class ) ) ? array( $class ) : array();
    $classes[]      = ( $cstype == 'gallery_thumb' || $cstype == 'gallery_nearby' ) ? 'rsDefault' : 'rsMinW';
    $classes[]      = ( $cstype == 'gallery_nearby' ) ? 'visibleNearby' : '';
    $classes[]      = ( $scale  == 'fill' ) ? 'rsFill' : '';

    // get attachments
    if ( !empty($include) ) {
      $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
      $attachments  = array();
      foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
      }
    } elseif ( !empty($exclude) ) {
      $attachments  = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
      $attachments  = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    // check if empty attachments
    if ( empty( $attachments ) ) { return ''; }

    // begin slider settings
    $slider_settings  = array(
      'slidesSpacing'         => 1,
      'arrowsNavAutoHide'     => false,
      'arrowsNavAutoHide'     => false,
      'autoScaleSlider'       => true,
      'keyboardNavEnabled'    => true,
      'imageScaleMode'        => $scale,
      'autoScaleSliderWidth'  => $width,
      'autoScaleSliderHeight' => $height,
      'transitionType'        => $transition,
      'loop'                  => $loop,
      'easeInOut'             => 'easeOutExpo',
      'easeOut'               => 'easeOutExpo',
    );

    // if autoplay isset
    if( $autoplay ){
      $slider_settings['autoplay'] = array(
        'enabled'     => true,
        'delay'       => $autoplay,
      );
    }

    // if gallery with thumbnail
    if( $cstype == 'gallery_thumb' ){
      $slider_settings['imageScalePadding'] = 1;
      $slider_settings['controlNavigation'] = 'thumbnails';
      $slider_settings['thumbs']            = array(
        'orientation' => $orientation,
        'spacing'     => 1,
        'firstMargin' => false,
      );
    }

    // if gallery with thumbnail
    if( ( $cstype == 'gallery_thumb' && $fullscreen !== 'false' ) || $fullscreen == 'true' ){
      $slider_settings['fullscreen'] = array(
        'enabled'     => true,
        'nativeFS'    => true,
      );
    }

    // Gallery visibleNearby
    if( $cstype == 'gallery_nearby' ){

      $slider_settings['imageScalePadding']   = 8;
      $slider_settings['addActiveClass']      = true;
      $slider_settings['arrowsNav']           = false;
      $slider_settings['controlNavigation']   = 'none';
      $slider_settings['fadeinLoadedSlide']   = false;
      $slider_settings['globalCaption']       = true;
      $slider_settings['globalCaptionInside'] = false;
      $slider_settings['imageScaleMode']      = ( !empty( $attr['scale'] ) ) ? $scale : 'fit-if-smaller';
      $slider_settings['loop']                = ( !empty( $attr['loop'] ) ) ? $loop : true;
      $slider_settings['visibleNearby']       = array(
        'enabled'               => true,
        'centerArea'            => 0.5,
        'center'                => true,
        'breakpoint'            => 650,
        'breakpointCenterArea'  => 0.64,
        'navigateByCenterClick' => true,
      );

    }

    // filter for slider_settings
    $slider_settings  = apply_filters( 'cs_gallery_slider_settings', $slider_settings, $id );

    $output     = '<div class="royalslider-token-'. $slider_id .' postSlider royalSlider '. join( ' ', array_filter( $classes ) ) .'">';
    foreach ( $attachments as $attachment_id => $attachment ) {

      $image    = wp_get_attachment_image_src( $attachment_id, $size );
      if( $cstype == 'gallery_thumb' ){
        $thumb  = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
        $thumb  = $thumb[0];
      }
      $thumb    = ( !empty( $thumb ) ) ? ' data-rsTmb="'. $thumb .'"': '';

      $expert   = ( trim( $attachment->post_excerpt ) ) ? '<span>'. wptexturize( $attachment->post_excerpt ) .'</span>' : '';
      $nearby   = ( $cstype == 'gallery_nearby' && trim( $attachment->post_title ) ) ? '<span class="rsGCaptionText">'. wptexturize( $attachment->post_title ) . $expert .'</span>' : '';

      $output  .= '<div class="rsContent">';
      $output  .= ( trim( $attachment->post_excerpt ) && $cstype !== 'gallery_nearby' ) ? '<div class="photoCaption">'. $expert .'</div>' : '';
      $output  .= '<a class="rsImg"'. $thumb .' href="'. $image[0] .'">'. $nearby .'</a>';
      $output  .= '</div>';

    }
    $output    .= '</div>';

    // royalSlider
    $output    .= '<script type="text/javascript">var csj=jQuery;csj.noConflict();';
    $output    .= 'csj(document).ready(function(){"use strict";csj(".royalslider-token-'. $slider_id .'").royalSlider('. json_encode( $slider_settings ) .');});';
    $output    .= '</script><!-- /post-royalslider -->';

    return $output;
  }
}

if( ! function_exists( 'cs_gallery_fancybox' ) ) {
  function cs_gallery_fancybox( $attr ) {

    $post = get_post();

    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( ! empty( $attr['ids'] ) ) {
      if ( empty( $attr['orderby'] ) ) {
        $attr['orderby'] = 'post__in';
      }
      $attr['include'] = $attr['ids'];
    }

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
      $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
      if ( !$attr['orderby'] ) {
        unset( $attr['orderby'] );
      }
    }

    extract(shortcode_atts(array(
      'order'      => 'ASC',
      'orderby'    => 'menu_order ID',
      'id'         => $post ? $post->ID : 0,
      'columns'    => 3,
      'size'       => 'thumbnail',
      'include'    => '',
      'exclude'    => '',
      'link'       => ''
    ), $attr, 'gallery'));

    $id     = intval($id);
    $uniqid = uniqid();

    if ( 'RAND' == $order ) { $orderby = 'none'; }

    if ( !empty($include) ) {
      $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

      $attachments = array();
      foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
      }
    } elseif ( !empty($exclude) ) {
      $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
      $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) ) { return ''; }

    $columns      = intval($columns);
    $itemwidth    = ( $columns > 0 ) ? floor( 100/$columns ) : 100;
    $float        = is_rtl() ? 'right' : 'left';
    $size_class   = sanitize_html_class( $size );
    $gallery_div  = "<div class='gallery-fancybox gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $output       = $gallery_div;
    $i = 0;

    foreach ( $attachments as $id => $attachment ) {

      $image     = wp_get_attachment_image( $id, $size, false );
      $output   .= "<dl class='gallery-item'>";
      $output   .= "<dt class='gallery-icon'><a href=". $attachment->guid ." rel='gallery-". $uniqid ."'>$image</a></dt>";
      $output   .= "</dl>";

      if ( $columns > 0 && ++$i % $columns == 0 ){
        $output .= '<div class="clear"></div>';
      }

    }

    $output .= '<div class="clear"></div>';
    $output .= "</div>\n";

    return $output;

  }
}