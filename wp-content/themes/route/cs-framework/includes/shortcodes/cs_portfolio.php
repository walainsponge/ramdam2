<?php
/**
 *
 * CS Portfolio
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_portfolio' ) ) {
  function cs_portfolio( $atts, $content = '', $id = '' ){

    global $wp_query, $paged, $post;

    $defaults = array(
      'id'                  => '',
      'class'               => '',
      'cats'                => 0,
      'style'               => 'default',
      'columns'             => 3,
      'layout'              => 'masonry',
      'no_love'             => '',
      'limit'               => 9,
      'nav'                 => 'paging',
      'model'               => 'default',
      'size'                => 'large',
      'no_filter'           => '',
      'filter_align'        => 'center',
      'filter_shape'        => 'pill',
      'filter_color'        => '',
      'filter_hover_color'  => '',
      'filter_border_width' => '',
    );

    extract( shortcode_atts( $defaults, $atts ) );

    $is_row = ( $style == 'default' ) ? ' row' : '';
    $love   = ( $no_love ) ? false : true;

    if( is_front_page() || is_home() ){
      $paged = ( get_query_var('paged') ) ? intval( get_query_var('paged') ) : intval( get_query_var('page') );
    } else {
      $paged = intval( get_query_var('paged') );
    }

    // Query
    $args = array(
      'posts_per_page'  => $limit,
      'post_type'       => 'portfolio',
      'paged'           => $paged,
      'post_status'     => 'publish',
    );

    if( $cats ) {
      $args['tax_query'] = array(
        array(
          'taxonomy'  => 'portfolio-category',
          'field'     => 'id',
          'terms'     => explode( ',', $cats )
        )
      );
    }

    $tmp_query  = $wp_query;
    $wp_query   = new WP_Query( $args );

    ob_start();
    if( have_posts() ) :

    echo '<div class="portfolio-loop portfolio-'. $style .' portfolio-model-'. $model .'">';

      // custom colors
      $portfolio_class  = '';
      $loader_class     = '';
      if ( $filter_color || $filter_hover_color || $filter_border_width ) {

        $custom_style     = '';
        $portfolio_uniqid = uniqid();

        if ( $filter_hover_color ) {
          $custom_style .= '.portfolio-'. $portfolio_uniqid .' a:hover,';
          $custom_style .= '.portfolio-'. $portfolio_uniqid .' a.active{';
          $custom_style .= 'color:'. $filter_hover_color .'!important;';
          $custom_style .= 'border-color:'. $filter_hover_color .'!important;';
          $custom_style .= '}';
        }

        if ( $filter_color || $filter_border_width ) {
          $custom_style .= '.portfolio-'. $portfolio_uniqid .' a{';
          $custom_style .= ( $filter_color ) ? 'color:'. $filter_color .'!important;border-color:'. $filter_color .'!important;' : '';
          $custom_style .= ( $filter_border_width ) ? 'border-width:'. cs_esc_string( $filter_border_width ) .'px!important;' : '';
          $custom_style .= '}';

          if( $model == 'ajax' ) {
            $custom_style .= '.loader-'. $portfolio_uniqid .'{';
            $custom_style .= ( $filter_color ) ? 'background-color:'. $filter_color .'!important;' : '';
            $custom_style .= '}';
          }
        }

        // add inline style
        cs_add_inline_style( $custom_style );

        $portfolio_class  = ' portfolio-'. $portfolio_uniqid;
        $loader_class     = ' loader-'. $portfolio_uniqid;
      }

      // isotope-container
      echo '<div class="isotope-container">';
      echo '<div class="isotope-loading cs-loader'. $loader_class .'"></div>';

        if( $model == 'ajax' ) {

          // enqueue styles
          wp_enqueue_style( 'cs-royalslider' );
          wp_enqueue_script( 'cs-royalslider' );

          echo '<div class="ajax-portfolio-container">';
            echo '<div class="ajax-portfolio-wrapper">';
              echo '<div class="ajax-control'. $portfolio_class .'"><a href="#" class="ajax-close fa fa-times"></a></div>';
              echo '<div class="container ajax-content"></div>';
            echo '</div>';
          echo '</div>';
        }

        // isotope-wrapper
        echo '<div class="isotope-wrapper">';

        // isotope-filter
        if ( ! $no_filter ) {

          $filter_args = array(
            'echo'     => 0,
            'title_li' => '',
            'style'    => 'none',
            'taxonomy' => 'portfolio-category',
            'walker'   => new Walker_Portfolio_List_Categories(),
          );

          if( $cats ) {

            $exp_cats = explode(',', $cats );
            $new_cats = array();

            foreach ( $exp_cats as $cat_value ) {
              $has_children = get_term_children( $cat_value, 'portfolio-category' );
              if( ! empty( $has_children ) ) {
                $new_cats[] = implode( ',', $has_children );
              } else {
                $new_cats[] = $cat_value;
              }
            }

            $filter_args['include'] = implode( ',', $new_cats );

          }

          $filter_args = wp_parse_args( $args, $filter_args );

          echo '<div class="container">';
          echo '<div class="isotope-filter isotope-filter-'. $filter_shape .' text-'. $filter_align . $portfolio_class .'">';
          echo '<a href="#" data-filter="*" class="active">'. __( 'All', 'route' ) .'</a>';
          echo wp_list_categories( $filter_args );
          echo '</div>';
          echo '</div>';
        }


        // isotope-portfolio
        echo '<div class="isotope-portfolio isotope-loop'. $is_row .'" data-layout="'. $layout .'">';

          while( have_posts() ) : the_post();

            $item_args = array(
              'columns' => $columns,
              'model'   => $model,
              'love'    => $love,
              'size'    => $size,
            );
            cs_portfolio_item( $item_args );

          endwhile;

        echo '</div>'; // isotope-portfolio

        // portfolio-pagination
        if( $nav != 'hide' ) {
          $nav_args = array(
            'isotope'         => 1,
            'post_type'       => 'portfolio',
            'nav'             => $nav,
            'posts_per_page'  => $limit,
            'columns'         => $columns,
            'model'           => $model,
            'love'            => $love,
            'size'            => $size,
            'cats'            => $cats,
          );
          cs_paging_nav( $nav_args );
        }

        echo '<div class="clear"></div>'; // isotope-wrapper
        echo '</div>'; // isotope-wrapper

      echo '</div>'; // isotope-container
    echo '</div>';

    else:
      echo '<span class="fa fa-warning-sign"></span> nothing any portfolio item.';
    endif;

    wp_reset_query();
    wp_reset_postdata();
    $wp_query = $tmp_query;

    $output = ob_get_clean();

    return $output;

  }
  add_shortcode('cs_portfolio', 'cs_portfolio');
  add_shortcode('vc_portfolio', 'cs_portfolio');
}