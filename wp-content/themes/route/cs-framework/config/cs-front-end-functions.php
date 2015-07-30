<?php
/**
 *
 * Top Bar
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_top_bar' ) ) {
  function cs_top_bar() {

    $options = cs_get_post_meta();

    $out     = '';

    if ( ( cs_get_option( 'top_bar' ) && empty( $options['disable_top_bar'] ) && ( cs_get_option( 'top_left' ) || cs_get_option( 'top_right' ) ) && empty( $options['header_transparent'] ) ) || ( ! empty( $options['header_transparent'] ) && ! empty( $options['top_bar_transparent'] ) ) ) {
      $out .= '<div id="top-bar">';
      $out .= '<div class="container">';
      $out .= cs_top_bar_modules( 'left' );
      $out .= cs_top_bar_modules( 'right' );
      $out .= '</div>';
      $out .= '</div><!-- /top-bar -->';
    }

    return $out;
  }
}

/**
 *
 * Top Bar Modules
 * @since 1.0.0
 * @version 1.4.0
 *
 */
if( ! function_exists('cs_top_bar_modules') ) {
  function cs_top_bar_modules( $area ) {

    $output    = '';
    $top_left  = cs_get_option( 'top_left' );
    $top_right = cs_get_option( 'top_right' );
    $modules   = ( $area == 'right' ) ? $top_right : $top_left;
    $column    = ( empty( $top_left ) || empty( $top_right ) ) ? 12 : 6;

    if( ! empty( $modules ) ) {

      $output  .= '<div class="cs-top-'. $area .'">';

      foreach ( $modules as $key => $module ) {

        $out   = '';
        $out  .= '<div class="cs-top-module cs-module-'. $module['module'] .'">';

        switch ( $module['module'] ) {

          // module text
          // ----------------------------------------------
          case 'text':
            $out  .= ( ! empty( $module['icon'] ) ) ? '<i class="'. cs_icon_class( $module['icon'] ) .'"></i>' : '';
            $out  .= cs_multilang_value( $module['text'] );
          break;

          // module link
          // ----------------------------------------------
          case 'link':
            $target  = ( ! empty( $module['target'] ) ) ? ' target="'. $module['target'] .'"' : '';
            $out    .= '<a href="'. cs_multilang_value( $module['link'] ) .'"'. $target .'>';
            $out    .= ( ! empty( $module['icon'] ) ) ? '<i class="'. cs_icon_class( $module['icon'] ) .'"></i>' : '';
            $out    .= cs_multilang_value( $module['text'] );
            $out    .= '</a>';
          break;

          // module social
          // ----------------------------------------------
          case 'social':
            $target  = ( ! empty( $module['target'] ) ) ? ' target="'. $module['target'] .'"' : '';
            $out    .= '<a href="'. cs_multilang_value( $module['link'] ) .'"'. $target .' class="'. cs_icon_class( $module['icon'] ) .'"></a>';
          break;

          // module modal
          // ----------------------------------------------
          case 'modal':
            $out  .= '<div class="cs-top-modal">';
            $out  .= '<a href="#" class="cs-open-modal">';
            $out  .= ( ! empty( $module['icon'] ) ) ? '<i class="'. cs_icon_class( $module['icon'] ) .'"></i>' : '';
            $out  .= cs_multilang_value( $module['text'] );
            $out  .= '<i class="cs-down fa fa-angle-down"></i></a>';
            $out  .= '<div class="cs-modal-content">'. do_shortcode( cs_multilang_value( $module['content'] ) ) .'</div>';
            $out  .= '</div>';
          break;

          // module search
          // ----------------------------------------------
          case 'search':
            $out  .= '<div class="cs-top-modal">';
            $out  .= '<a href="#" class="cs-open-modal"><i class="cs-in fa fa-search"></i>'. __( 'Search', 'route' ) . '</a>';
            $out  .= '<div class="cs-modal-content">'. get_search_form( false ) .'</div>';
            $out  .= '</div>';
          break;

          // module wp login
          // ----------------------------------------------
          case 'wplogin':

            if ( is_user_logged_in() ) {
              $out  .= '<a href="'. wp_logout_url() .'"><i class="cs-in fa fa-power-off"></i>'. __( 'Log Out' ) . '</a>';
            } else {
              $login_form = wp_login_form( array( 'echo' => false, 'redirect' => admin_url() ) );
              $login_form = str_replace( 'button-primary', cs_get_button_class( array( 'size' => 'xxs' ) ), $login_form );
              $out  .= '<div class="cs-top-modal">';
              $out  .= '<a href="#" class="cs-open-modal"><i class="cs-in fa fa-user"></i>'. __( 'Log In' ) . '</a>';
              $out  .= '<div class="cs-modal-content cs-login-form">';
              $out  .= $login_form;
              $out  .= '</div>';
              $out  .= '</div>';
            }

          break;

          // module woocommerce login
          // ----------------------------------------------
          case 'woologin':

            if( is_woocommerce_activated() ) {

              if ( is_user_logged_in() ) {
                $out  .= '<a href="'. get_permalink( wc_get_page_id( 'myaccount' ) ) .'"><i class="cs-in fa fa-user"></i>'. __( 'My Account', 'woocommerce' ) . '</a>';
                $out  .= ' / ';
                $out  .= '<a href="'. wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) .'"><i class="cs-in fa fa-power-off"></i>'. __( 'Logout', 'woocommerce' ) . '</a>';
              } else {
                $login_form = wp_login_form( array( 'echo' => false ) );
                $login_form = str_replace( 'button-primary', cs_get_button_class( array( 'size' => 'xxs' ) ), $login_form );
                $out  .= '<div class="cs-top-modal">';
                $out  .= '<a href="#" class="cs-open-modal"><i class="cs-in fa fa-user"></i>'. __( 'Login', 'woocommerce' ) . '</a>';
                $out  .= '<div class="cs-modal-content">';
                $out  .= $login_form;
                $out  .= '<p class="cs-modal-lost-password">';
                $out  .= ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) ? '<a href="'. get_permalink( wc_get_page_id( 'myaccount' ) ) .'">'. __( 'Register', 'woocommerce' ) .'</a> - ' : '';
                $out  .= '<a href="'. wc_lostpassword_url() .'">'. __( 'Lost your password?', 'woocommerce' ) .'</a>';
                $out  .= '</p>';
                $out  .= '</div>';
                $out  .= '</div>';
              }

            }

          break;

          // module woocommerce cart count
          // ----------------------------------------------
          case 'woocount':

            if( is_woocommerce_activated() ) {
              $out  .= '<a href="'. WC()->cart->get_cart_url() .'"><i class="fa fa-shopping-cart"></i><span class="cs-cart-count">'. WC()->cart->cart_contents_count .'</span></a>';
            }

          break;

          // module woocommerce cart price
          // ----------------------------------------------
          case 'wooprice':

            if( is_woocommerce_activated() ) {
              $out  .= '<a href="'. WC()->cart->get_cart_url() .'"><i class="cs-in fa fa-shopping-cart"></i><span class="cs-cart-contents">'. sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'woothemes' ), WC()->cart->cart_contents_count ) . WC()->cart->get_cart_total() .'</span></a>';
            }

          break;

          // module woocommerce mini cart
          // ----------------------------------------------
          case 'woominicart':

            if( is_woocommerce_activated() ) {

              // Get mini cart
              ob_start();
              woocommerce_mini_cart();
              $mini_cart = ob_get_clean();

              $out  .= '<div class="cs-top-modal">';
              $out  .= '<a href="#" class="cs-open-modal"><i class="cs-in fa fa-shopping-cart"></i>'. __( 'Cart', 'woocommerce' ) . '<span class="cs-cart-count">'. WC()->cart->cart_contents_count .'</span></a>';
              $out  .= '<div class="cs-modal-content woocommerce"><div class="cs-mini-cart">'. $mini_cart .'</div></div>';
              $out  .= '</div>';

            }

          break;

          // module module wpml
          // ----------------------------------------------
          case 'wpml':

            if ( is_wpml_activated() ) {

              global $sitepress;
              $sitepress_settings = $sitepress->get_settings();
              $icl_get_languages  = icl_get_languages();

              if ( ! empty( $icl_get_languages ) ) {

                $out  .= '<div class="cs-top-modal cs-lang-top-modal">';

                // current language
                $out  .= '<a href="#" class="cs-open-modal">';
                foreach ( $icl_get_languages as $id => $current_lang ) {
                  if ( $current_lang['active'] ) {
                    $out  .= ( $sitepress_settings['icl_lso_flags'] ) ? '<img src="'. $current_lang['country_flag_url'] .'" alt="'. $current_lang['language_code'] .'" />' : '<i class="cs-in fa fa-globe"></i>';
                    $out  .= ( ( $sitepress_settings['icl_lso_native_lang'] ) ? $current_lang['native_name'] : $current_lang['translated_name'] );
                    $out  .= '<i class="cs-down fa fa-angle-down"></i>';
                  }
                }
                $out  .= '</a>';

                // list languages
                $out  .= '<div class="cs-modal-content">';
                $out  .= '<ul>';
                foreach ( $icl_get_languages as $id => $language ) {
                  if ( ! $language['active'] ) {
                    $name  = ( ! $language['active'] && $language['translated_name'] != $language['native_name'] ) ? ' ('. $language['translated_name'] .')' : '';
                    $out  .= '<li>';
                    $out  .= '<a href="'. $language['url'] .'">';
                    $out  .= ( $sitepress_settings['icl_lso_flags'] ) ? '<img src="'. $language['country_flag_url'] .'" alt="'. $language['language_code'] .'" />': '';
                    $out  .= ( $sitepress_settings['icl_lso_native_lang'] && $sitepress_settings['icl_lso_display_lang'] ) ? $language['native_name'] . $name : '';
                    $out  .= ( ! $sitepress_settings['icl_lso_native_lang'] && $sitepress_settings['icl_lso_display_lang'] ) ? $language['translated_name'] : '';
                    $out  .= ( $sitepress_settings['icl_lso_native_lang'] && ! $sitepress_settings['icl_lso_display_lang'] ) ? $language['native_name'] : '';
                    $out  .= '</a>';
                    $out  .= '</li>';
                  }
                }
                $out  .= '</ul>';
                $out  .= '</div>';
                $out  .= '</div>';
              }

            } else {
              $out  .= 'WPML is not activated';
            }

          break;

          // module module qtranslate
          // ----------------------------------------------
          case 'qtranslate':

            if( is_qtranslate_activated() ) {

              global $q_config;
              $q_languages  = qtrans_getSortedLanguages();

              if( ! empty( $q_languages ) ) {

                $q_current    = $q_config['language'];
                $q_image      = trailingslashit( WP_CONTENT_URL ) . $q_config['flag_location'];
                $url          = ( is_404() ) ? home_url( '/' ) : '';

                $out  .= '<div class="cs-top-modal cs-lang-top-modal">';

                // current language
                $out  .= '<a href="#" class="cs-open-modal">';
                $out  .= '<img src="'. $q_image . $q_config['flag'][$q_current] .'" alt="'. $q_config['language_name'][$q_current] .'" />';
                $out  .= $q_config['language_name'][$q_current];
                $out  .= '<i class="cs-down fa fa-angle-down"></i>';
                $out  .= '</a>';

                // list languages
                $out  .= '<div class="cs-modal-content">';
                $out  .= '<ul>';
                foreach ( $q_languages as $id => $language ) {
                  if( $language != $q_current ) {
                    $out  .= '<li>';
                    $out  .= '<a href="'. qtrans_convertURL( $url, $language ) .'">';
                    $out  .= '<img src="'. $q_image . $q_config['flag'][$language] .'" alt="'. $q_config['language_name'][$language] .'" />';
                    $out  .= $q_config['language_name'][$language];
                    $out  .= '</a>';
                    $out  .= '</li>';
                  }
                }
                $out  .= '</ul>';
                $out  .= '</div>';
                $out  .= '</div>';

              } else {
                $out  .= 'qTranslate is not activated';
              }

            }

          break;

          // module module polylang
          // ----------------------------------------------
          case 'polylang':

            if( is_polylang_activated() ) {

              global $polylang;

              $languages  = $polylang->model->get_languages_list();
              $curlang    = $polylang->curlang;

              if( ! empty( $languages ) ) {

                $out  .= '<div class="cs-top-modal cs-lang-top-modal">';

                // current language
                $out  .= '<a href="#" class="cs-open-modal">';
                $out  .= $curlang->flag . $curlang->name;
                $out  .= '<i class="cs-down fa fa-angle-down"></i>';
                $out  .= '</a>';

                // list languages
                $out  .= '<div class="cs-modal-content">';
                $out  .= '<ul>';

                foreach ( $languages as $language ) {

                  $url    = $polylang->links->get_translation_url( $language );
                  $url    = ( empty( $url ) ) ? $polylang->links->get_home_url( $language ) : $url;

                  if( $language->slug !== $curlang->slug ) {
                    $out  .= '<li>';
                    $out  .= '<a href="'. $url .'">';
                    $out  .= $language->flag;
                    $out  .= $language->name;
                    $out  .= '</a>';
                    $out  .= '</li>';
                  }

                }

                $out  .= '</ul>';
                $out  .= '</div>';
                $out  .= '</div>';

              } else {
                $out  .= 'Polylang is not activated';
              }

            }

          break;

          default:

            ob_start();
              do_action( 'cs_top_bar_module', $module['module'] );
            $out  .= ob_get_clean();

          break;

        }

        $out  .= '</div>';

        $output .= ( ! empty( $module['check'] ) && is_user_logged_in() ) ? '' : $out;

      }

      $output .= '</div>';

    }


    return $output;
  }
}

/**
 *
 * Breadcrumb
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_breadcrumb' ) ) {
  function cs_breadcrumb() {

    $out    = '';
    if ( function_exists( 'bcn_display' ) ) {
      $out .= '<div class="cs-breadcrumb">';
      $out .= '<div class="cs-inner">';
      $out .= bcn_display( true );
      $out .= '</div>';
      $out .= '</div>';
    }

    return $out;
  }
}

/**
 *
 * Blog Post Meta
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if ( ! function_exists( 'cs_posted_on' ) ) {
  function cs_posted_on() {

    global $post;

    if ( is_sticky() && is_home() && ! is_paged() ) {
      echo '<span class="entry-featured">' . __( 'Sticky', 'route' ) . '</span>';
    }

    $post_format = get_post_format();
    if( $post_format ) {
      echo '<span class="entry-format-'. $post_format .'">';
      echo '<a href="'. esc_url( get_post_format_link( $post_format ) ) .'">'. get_post_format_string( $post_format ) .'</a>';
      echo '</span>';
    }

    printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="entry-author-link"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
      esc_url( get_permalink() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      get_the_author()
    );

    if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && route_categorized_blog() ) {
      echo '<span class="entry-cat-links">'. get_the_category_list( ', ' ) .'</span>';
    }

    if ( ! is_search() ) {

      if ( ! post_password_required() && ( comments_open() || get_comments_number() ) )  {
        echo '<span class="entry-comments-link">';
        comments_popup_link( __( 'Leave a comment', 'route' ), __( '1 Comment', 'route' ), __( '% Comments', 'route' ) );
        echo '</span>';
      }


      $live_id    = get_the_ID();
      $love_count = get_post_meta( $live_id, '_love_count', true );
      $love_count = ( !empty( $love_count ) ) ? $love_count : 0;
      $is_loved   = ( isset( $_COOKIE['route_love_'. $live_id] ) ) ? ' entry-loved' : '';

      echo '<span class="entry-love">';
      echo '<a href="#" class="entry-love-it'. $is_loved .'" data-post-id="'. $live_id .'"><span class="love-count">'. $love_count .'</span></a>';
      echo '</span>';

    }

    edit_post_link( __( 'Edit', 'route' ), '<span class="entry-edit-link">', '</span>' );
  }
}

/**
 *
 * Post Navigation
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if ( ! function_exists( 'cs_post_nav' ) ) {
  function cs_post_nav() {

    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ( empty( $next ) && empty( $previous ) ) || cs_get_option( 'blog_single_navigation' ) === false ) { return; }
    ?>
    <nav class="post-navigation" role="navigation">
      <div class="nav-previous"><?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i> '. __( 'Previous Post', 'route' ) .'<br /><strong>%title</strong>' ); ?></div>
      <div class="nav-next"><?php next_post_link( '%link', __( 'Next Post', 'route' ) .' <i class="fa fa-angle-right"></i><br /><strong>%title</strong>' ); ?></div>
      <div class="clear"></div>
    </nav>
    <?php
  }
}

/**
 *
 * Post Thumbnail
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_post_thumbnail' ) ) {
  function cs_post_thumbnail( $link = '' ) {

    if ( post_password_required() || ! has_post_thumbnail() ) { return; }

    global $cs_blog_image_size;

    $size         = ( empty( $cs_blog_image_size ) ) ? cs_get_option( 'blog_image_size' ) : $cs_blog_image_size;
    $link         = ( empty( $link ) ) ? get_permalink() : $link;


    if ( is_singular() ) {

      if ( cs_get_option( 'blog_single_image_show' ) ) {
        echo '<div class="entry-image">';
        the_post_thumbnail( cs_get_option( 'blog_single_image_size' ) );
        echo '</div><!-- entry-image -->';
      }

    } else {

      echo '<div class="entry-image">';
      echo '<a href="'. $link .'" class="post-thumbnail">';
      the_post_thumbnail( $size );
      echo '<span class="entry-image-overlay"></span>';
      echo '</a>';
      echo '</div><!-- entry-image -->';

    }


  }
}

/**
 *
 * Page Featured Image
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_page_featured_image' ) ) {
  function cs_page_featured_image() {

    if ( post_password_required() || ! has_post_thumbnail() ) { return; }

    $size = apply_filters( 'cs_page_featured_image_size', 'full' );

    echo '<div class="entry-image">';
    the_post_thumbnail( $size );
    echo '</div><!-- entry-image -->';

  }
}

/**
 *
 * Pagination
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_paging_nav' ) ) {
  function cs_paging_nav( $args = array() ) {

    if( ! empty( $args['wp_query'] ) ){
      $wp_query       = $args['wp_query'];
      $max_num_pages  = $wp_query->max_num_pages;
    } else if( ! empty( $args['query'] ) ){
      $max_num_query  = new WP_Query( $args['query'] );
      $max_num_pages  = $max_num_query->max_num_pages;
      wp_reset_query();
    } else {
      $max_num_pages  = $GLOBALS['wp_query']->max_num_pages;
    }

    $template = cs_get_option( 'blog_layout' );
    $defaults = array(
      'nav'             => cs_get_option( 'blog_pagination' ),
      'template'        => cs_get_option( 'blog_layout' ),
      'posts_per_page'  => get_option( 'posts_per_page' ),
      'size'            => cs_get_option( 'blog_image_size' ),
      'columns'         => cs_get_option( 'blog_column' ),
      'max_pages'       => $max_num_pages,
      'post_type'       => 'post',
      'isotope'         => ( $template == 'default' || $template == 'medium' || $template == 'small' ) ? '0' : '1',
    );

    $args = wp_parse_args( $args, $defaults );

    if ( $max_num_pages < 2 || $args['nav'] == 'hide' ) { return; }

    if( $args['nav'] == 'load' ) {

      wp_enqueue_style( 'cs-royalslider' );
      wp_enqueue_script( 'cs-royalslider' );

      $uniqid     = uniqid();
      $output     = '<div class="ajax-pagination">';
      $output    .= '<a href="#" class="ajax-load-more '. cs_get_button_class( array( 'size' => 'xxs' ) ) .'" data-token="'. $uniqid .'">';
      $output    .= __( 'Load More', 'route' );
      $output    .= '<span class="cs-loader"></span>';
      $output    .= '</a>';
      $output    .= '</div>';

      unset( $args['query'] );
      wp_localize_script( 'cs-jquery-register', 'cs_load_more_' . $uniqid, $args );

      echo $output;

    } else {

      if( is_front_page() || is_home() ){
        $paged = ( get_query_var('paged') ) ? intval( get_query_var('paged') ) : intval( get_query_var('page') );
      } else {
        $paged = intval( get_query_var('paged') );
      }

      $paged        = $paged ? $paged : 1;
      $pagenum_link = html_entity_decode( get_pagenum_link() );
      $query_args   = array();
      $url_parts    = explode( '?', $pagenum_link );

      if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
      }

      $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
      $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

      $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
      $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

      $links = paginate_links( array(
        'base'      => $pagenum_link,
        'format'    => $format,
        'total'     => $max_num_pages,
        'current'   => $paged,
        'mid_size'  => 1,
        'type'      => 'array',
        'add_args'  => array_map( 'urlencode', $query_args ),
        'prev_text' => __( 'Previous', 'route' ),
        'next_text' => __( 'Next', 'route' ),
      ) );

      if ( $links ) {
      ?>
      <div class="clear"></div>
      <nav class="pagination page-pagination">
        <div class="pagination-shadow">
        <?php
          foreach ($links as $link) {
            echo $link;
          }
        ?>
        </div>
      </nav>
      <?php
      }

    }
  }
}

/**
 *
 * Portfolio Item
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_portfolio_item' ) ) {
  function cs_portfolio_item( $item_args ) {

    global $post;

    $post_id        = get_the_ID();
    $post_options   = get_post_meta( $post_id, '_custom_page_options', true );
    $custom_layout  = apply_filters( 'cs_custom_portfolio_item', '', $item_args );

    if ( ! empty( $custom_layout ) ) {
      echo $custom_layout;
      return;
    }

    $item_terms     = get_the_terms( $post_id, 'portfolio-category' );
    $item_class     = array();
    $item_cats      = array();

    if( ! empty( $item_terms ) ) {
      foreach ( $item_terms as $item_term ) {
        $item_class[] = $item_term->slug;
        $item_cats[]  = $item_term->name;
      }
    }

    $item_class     = ' '. implode( ' ', $item_class );
    $item_cats      = ' '. implode( ' &bull; ', $item_cats );

    extract( $item_args );

    echo '<div class="isotope-item cs-fade '. cs_get_bootstrap( $columns ) . $item_class .'">';
    echo '<div class="portfolio-item">';

    $large_image_url         = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
    $thumb_image_url         = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
    $lightbox_image          = ( ! empty( $post_options['custom_lightbox_link'] ) ) ? $post_options['custom_lightbox_link'] : $large_image_url[0];
    $lightbox_thumb          = ( ! empty( $post_options['custom_thumbnail'] ) ) ? $post_options['custom_thumbnail'] : $thumb_image_url[0];
    $custom_item_link        = ( ! empty( $post_options['custom_item_link'] ) ) ? $post_options['custom_item_link'] : get_permalink();
    $custom_item_link_target = ( ! empty( $post_options['custom_item_link_target'] ) ) ? ' target="_blank"' : '';
    $item_ajax_load_class    = ( empty( $post_options['custom_item_link'] ) ) ? ' item-ajax-load' : '';

    echo '<div class="portfolio-item-info">';

      switch ( $model ) {
        case 'ajax':
          echo '<a href="'. $custom_item_link .'" class="portfolio-item-hover'. $item_ajax_load_class .'" data-post-id="'. get_the_ID() .'"'. $custom_item_link_target .'>';
          echo '<span class="portfolio-item-block">';
          echo '<span class="item-icon item-icon-wrapper"><i class="fa fa-level-up"></i></span>';
          echo '<span class="portfolio-item-title">'. get_the_title() .'</span>';
          echo '<span class="portfolio-item-categories">'.  $item_cats .'</span>';
          echo '</span>';
          echo '</a>';
        break;

        case 'gallery':
          echo '<a href="'. $lightbox_image .'" title="'. get_the_title() .'" class="portfolio-item-hover fancybox-thumb" data-thumbnail="'. $lightbox_thumb .'" data-fancybox-group="portfolio" data-post-id="'. get_the_ID() .'">';
          echo '<span class="portfolio-item-block">';
          echo '<span class="item-icon item-icon-wrapper"><i class="fa fa-camera"></i></span>';
          echo '<span class="portfolio-item-title">'. get_the_title() .'</span>';
          echo ( !empty( $item_cats ) ) ? '<span class="portfolio-item-categories">'.  $item_cats .'</span>' : '';
          echo '</span>';
          echo '</a>';
        break;

        case 'text':
          echo '<div class="portfolio-item-hover">';
          echo '<div class="portfolio-item-block">';
          echo '<div class="item-icon-wrapper">';
          echo '<a href="'. $custom_item_link .'" class="item-icon"'. $custom_item_link_target .'><i class="fa fa-chain"></i></a>';
          echo '<a href="'. $lightbox_image .'" title="'. get_the_title() .'" class="item-icon fancybox-thumb" data-thumbnail="'. $lightbox_thumb .'" data-fancybox-group="portfolio"><i class="fa fa-search"></i></a>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        break;

        default:
          echo '<div class="portfolio-item-hover">';
          echo '<div class="portfolio-item-block">';
          echo '<div class="item-icon-wrapper">';
          echo '<a href="'. $custom_item_link .'" class="item-icon"'. $custom_item_link_target .'><i class="fa fa-chain"></i></a>';
          echo '<a href="'. $lightbox_image .'" title="'. get_the_title() .'" class="item-icon fancybox-thumb" data-thumbnail="'. $lightbox_thumb .'" data-fancybox-group="portfolio"><i class="fa fa-search"></i></a>';

          if( $love ){
            $love_count = get_post_meta( $post_id, '_love_count', true );
            $love_count = ( !empty( $love_count ) ) ? $love_count : 0;
            $is_loved   = ( isset( $_COOKIE['route_love_'. $post_id] ) ) ? ' entry-loved' : '';
            echo '<a href="#" class="item-icon entry-love-it'. $is_loved .'" data-post-id="'. $post_id .'">';
            echo '<i class="fa fa-heart"></i>';
            echo '<span class="love-count">'. $love_count .'</span>';
            echo '</a>';
          }

          echo '</div>';
          echo '<h3 class="portfolio-item-title">'. get_the_title() .'</h3>';
          echo '<span class="portfolio-item-categories">'.  $item_cats .'</span>';
          echo '</div>';
          echo '</div>';
        break;
      }

      echo '</div>';

      // post thumbnail
      if( ! empty( $post_options['custom_thumbnail'] ) ) {
        echo '<img src="'. $post_options['custom_thumbnail'] .'" alt="'. get_the_title() .'" />';
      } else {
        the_post_thumbnail( $size );
      }

      echo '</div>';

      if( $model == 'text' ) {

        echo '<div class="portfolio-item-description">';

        if( $love ) {
          $love_count = get_post_meta( $post_id, '_love_count', true );
          $love_count = ( !empty( $love_count ) ) ? $love_count : 0;
          $is_loved   = ( isset( $_COOKIE['route_love_'. $post_id] ) ) ? ' entry-loved' : '';

          echo '<div class="item-love-it">';
          echo '<a href="#" class="entry-love-it'. $is_loved .'" data-post-id="'. $post_id .'">';
          echo '<span class="fa fa-heart"></span> <span class="love-count">'. $love_count .'</span>';
          echo '</a>';
          echo '</div>';
        }

        echo '<h4 class="item-title"><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
        echo '<div class="item-date">'. get_the_date() .'</div>';

        echo ( !empty( $post->post_excerpt ) ) ? '<div class="item-excerpt"><p>'. do_shortcode( $post->post_excerpt ) .'</p></div>' : '';

        echo '</div>';

      }

    echo '</div>';

  }
}

/**
 *
 * Link Pages
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('cs_link_pages') ) {
  function cs_link_pages( $args = '' ) {


    $defaults = array(
      'title'             => '<span class="pagination-title">' . __( 'Pages', 'route' ) . '</span>',
      'before'            => '<div class="page-pagination">',
      'after'             => '</div>',
      'link_before'       => '',
      'link_after'        => '',
      'next_or_number'    => 'number',
      'separator'         => '',
      'nextpagelink'      => __( 'Next', 'route' ),
      'previouspagelink'  => __( 'Previous', 'route' ),
      'pagelink'          => '%',
      'echo'              => 1
    );

    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );

    ob_start();
    wp_link_pages();
    $pages = ob_get_clean();

    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more;

    $output = '';

    if ( $multipage ) {

      if ( 'number' == $next_or_number ) {
        $output .= $before;
        $output .= $title;
        for ( $i = 1; $i <= $numpages; $i++ ) {
          $link = $link_before . str_replace( '%', $i, $pagelink ) . $link_after;

          $output .= ( $i == $page ) ? '<span class="current">' : '</span>';

          if ( $i != $page ) {
            $link = _wp_link_page( $i ) . $link . '</a>';
          }

          $link = apply_filters( 'wp_link_pages_link', $link, $i );
          $output .= $separator . $link;
        }
        $output .= $after;
      } elseif ( $more ) {
        $output .= $before;
        $i = $page - 1;
        if ( $i ) {
          $link = _wp_link_page( $i ) . $link_before . $previouspagelink . $link_after . '</a>';
          $link = apply_filters( 'wp_link_pages_link', $link, $i );
          $output .= $separator . $link;
        }
        $i = $page + 1;
        if ( $i <= $numpages ) {
          $link = _wp_link_page( $i ) . $link_before . $nextpagelink . $link_after . '</a>';
          $link = apply_filters( 'wp_link_pages_link', $link, $i );
          $output .= $separator . $link;
        }
        $output .= $after;
      }

    }

    $output = apply_filters( 'wp_link_pages', $output, $args );

    if ( $echo ) {
      echo $output;
    }

    return $output;
  }
}

/**
 *
 * Page Sidebar
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_page_sidebar' ) ) {
  function cs_page_sidebar( $base = 'right', $layout = 'right' ) {
    if ( $base == $layout ) {
      echo '<div class="col-md-3 cs-sidebar-clear">';
      echo '<div class="page-sidebar sidebar-'. $base .'">';
      get_sidebar();
      echo '</div>';
      echo '</div>';
    }
  }
}

/**
 *
 * Site Logo
 * @since 1.0.0
 * @version 1.3.0
 *
 */
if ( ! function_exists( 'cs_site_logo' ) ) {
  function cs_site_logo( $class = '' ) {

    $home_url     = home_url( '/' );
    $home_url     = ( is_qtranslate_activated() ) ? qtrans_convertURL( $home_url ) : $home_url;
    $header_style = cs_get_option( 'header_style' );
    $logo         = cs_get_option( 'logo' );
    $logo2x       = cs_get_option( 'logo2x' );
    $logo_class   = ( empty( $logo2x ) ) ? ' cs-logo1x' : '';
    $has_logo     = ( $logo || $logo2x ) ? true : false;
    $is_sticky    = ( $header_style == 'default' ) ? 'cs-sticky-item' : '';
    $class        = ( $class ) ? ' class="'. $class .'"' : '';

    $post_meta    = cs_get_post_meta();
    $logo1x_data  = '';
    $logo2x_data  = '';
    $link_size    = '';

    if( $header_style == 'default' && ! empty( $post_meta['header_transparent'] ) ) {

      $logo1x_alt    = cs_get_option( 'logo_alt' );
      $logo2x_alt    = cs_get_option( 'logo2x_alt' );

      if ( $logo1x_alt ) {
        $logo1x_data = ' data-alternative="'. $logo .'"';
        $logo        = $logo1x_alt;
      }

      if ( $logo2x_alt ) {
        $logo2x_data = ' data-alternative="'. $logo2x .'"';
        $logo2x      = $logo2x_alt;
      }

    }


    if( $logo2x ) {
      $logo_size  = @getimagesize( $logo );
      $link_size  = ( $logo_size ) ? ' style="max-width:'. $logo_size[0] . 'px;"' : '';
    }

    $output  = '<div id="site-logo"'. $class.'>';
    $output .= ( ! $has_logo ) ? '<h1 class="site-name '. $is_sticky .'">' : '';
    $output .= '<a href="'. $home_url .'" class="'. $is_sticky .'"'. $link_size .'>';
    $output .= ( $logo )   ? '<img class="cs-logo'. $logo_class .'" src="'. $logo .'" alt="'. get_bloginfo( 'name' ). '"'. $logo1x_data .'/>' : '';
    $output .= ( $logo2x ) ? '<img class="cs-logo2x" src="'. $logo2x .'" alt="'. get_bloginfo( 'name' ). '"'. $logo2x_data .'/>' : '';

    $output .= ( ! $has_logo ) ? cs_get_option( 'logo_text' ) : '';
    $output .= '</a>';
    $output .= ( ! $has_logo ) ? '</h1>' : '';
    $output .= '</div>';

    return $output;

  }
}


/**
 *
 * Site Menu
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_site_menu' ) ) {
  function cs_site_menu() {

    $output = '<nav id="site-nav" role="navigation">';
    ob_start();
    if ( has_nav_menu( 'primary' ) ) {
      wp_nav_menu( array( 'theme_location'  => 'primary' ) );
    } else {
      echo '<a href="'. admin_url('nav-menus.php') .'" class="cs-sticky-item">'. __( 'You can edit your menu content on the Menus screen in the Appearance section.', 'route' ) .'</a>';
    }
    $output .= ob_get_clean();
    $output .= '</nav>';

    return $output;
  }
}

/**
 *
 * Site Mobile Menu
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_site_mobile_menu' ) ) {
  function cs_site_mobile_menu() {

    ob_start();
    if ( has_nav_menu( 'mobile' ) ) {
      wp_nav_menu( array( 'theme_location' => 'mobile' ) );
    } else {
      wp_nav_menu( array( 'theme_location' => 'primary', 'mobile' => true ) );
    }
    $output = ob_get_clean();

    return $output;
  }
}

/**
 *
 * Mobile Icon
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_mobile_icon' ) ) {
  function cs_mobile_icon() {

    $output  = '<div id="cs-mobile-icon">';
    $output .= ( is_front_page() || is_page() || is_single() ) ? '<strong class="hidden-xs">'. get_the_title() .'</strong>' : '';
    $output .= '<span><i class="cs-one"></i><i class="cs-two"></i><i class="cs-three"></i></span>';
    $output .= '</div>';

    return $output;
  }
}



/**
 *
 * Site Mobile Multilanguage
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_site_mobile_languages' ) ) {
  function cs_site_mobile_languages(){

    $output = '';

    if ( is_wpml_activated() ) {

      global $sitepress;
      $sitepress_settings = $sitepress->get_settings();
      $icl_get_languages  = icl_get_languages();

      if ( !empty( $icl_get_languages ) ) {
        $output .= '<div id="mobile-languages">';

        foreach ( $icl_get_languages as $id => $language ) {

          $current     = ( $language['active'] ) ? ' class="cs-current"' : '';
          $translated  = ( ! $language['active'] && $language['translated_name'] != $language['native_name'] ) ? ' ('. $language['translated_name'] .')' : '';
          $output     .= '<a href="'. $language['url'] .'"'. $current .'>';
          $output     .= ( $sitepress_settings['icl_lso_flags'] ) ? '<img src="'. $language['country_flag_url'] .'" alt="'. $language['language_code'] .'" />': '';
          $output     .= ( $sitepress_settings['icl_lso_native_lang'] && $sitepress_settings['icl_lso_display_lang'] ) ? $language['native_name'] . $translated : '';
          $output     .= ( ! $sitepress_settings['icl_lso_native_lang'] && $sitepress_settings['icl_lso_display_lang'] ) ? $language['translated_name'] : '';
          $output     .= ( $sitepress_settings['icl_lso_native_lang'] && ! $sitepress_settings['icl_lso_display_lang'] ) ? $language['native_name'] : '';
          $output     .= '</a>';

        }

        $output .= '</div>';
        return $output;

      }

    } else if( is_polylang_activated() ) {

      global $polylang;

      $languages  = $polylang->model->get_languages_list();
      $curlang    = $polylang->curlang;

      if( ! empty( $languages ) ) {

        $output .= '<div id="mobile-languages">';

        foreach ( $languages as $language ) {

          $url = $polylang->links->get_translation_url( $language );
          $url = ( empty( $url ) ) ? $polylang->links->get_home_url( $language ) : $url;

          $current  = ( $language->slug === $curlang->slug ) ? ' class="cs-current"' : '';

          $output  .= '<a href="'. $url .'"'. $current .'>';
          $output  .= $language->flag;
          $output  .= $language->name;
          $output  .= '</a>';

        }

        $output .= '</div>';
        return $output;

      }

    } else if( is_qtranslate_activated() ) {

      global $q_config;
      $q_languages  = qtrans_getSortedLanguages();
      $q_current    = $q_config['language'];
      $q_image      = trailingslashit( WP_CONTENT_URL ) . $q_config['flag_location'];
      $url          = ( is_404() ) ? home_url( '/' ) : '';

      if( ! empty( $q_languages ) ) {

        $output .= '<div id="mobile-languages">';

        foreach ( $q_languages as $id => $language ) {

          $current  = ( $language == $q_current ) ? ' class="cs-current"' : '';
          $output  .= '<a href="'. qtrans_convertURL( $url, $language ) .'"'. $current .'>';
          $output  .= '<img src="'. $q_image . $q_config['flag'][$language] .'" alt="'. $q_config['language_name'][$language] .'" />';
          $output  .= $q_config['language_name'][$language];
          $output  .= '</a>';

        }

        $output .= '</div>';
        return $output;

      }

    }

    do_action( 'cs_site_languages' );

    return null;
  }
}

/**
 *
 * Global Button Class
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_get_button_class' ) ) {
  function cs_get_button_class( $args = array() ) {

    $defaults = array(
      'type'  => 'flat',
      'shape' => 'rounded',
      'size'  => 'xs',
      'color' => 'flat-accent',
    );

    $classes = array();
    $args = wp_parse_args( $args, $defaults );

    foreach ( $args as $key => $value ) {
      $classes[] = 'cs-btn-'.$value;
    }

    return 'cs-btn '. join(' ', $classes );
  }
}

/**
 *
 * Comment Form
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_comment_form' ) ) {
  function cs_comment_form() {
    ob_start();
    comment_form();
    $comment_form = ob_get_clean();
    $comment_form = str_replace( array( 'id="submit"', 'class="comment-form"' ), array( 'id="submit" class="'. cs_get_button_class() .'"', 'class="comment-form cs-comment-form"' ), $comment_form);
    return $comment_form;
  }
}

/**
 *
 * Footer Area
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_footer_area' ) ) {
  function cs_footer_area() {

    $options        = cs_get_post_meta();
    $disable_footer = cs_get_option( 'disable_footer' );
    if ( ! empty( $options['disable_footer'] ) || ! empty( $disable_footer ) ) { return; }

    $output   = '';

    $widgets  = cs_get_option( 'footer_widgets' );
    $before   = cs_get_option( 'footer_before' );
    $after    = cs_get_option( 'footer_after' );

    ob_start();
    dynamic_sidebar( 'footer-block-before' );
    $footer_block_before = ob_get_clean();

    if( ! empty( $footer_block_before ) ) {
      $output .= '<div id="cs-footer-block-before">';
      $output .= '<div class="container">';
      $output .= '<div class="row">';
      $output .= '<div class="col-md-12">';
      $output .= $footer_block_before;
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    }

    if( $widgets || $before || $after ) {

      $output .= '<footer id="colophon" class="site-footer" role="contentinfo">';
      $output .= '<div class="container">';
      $output .= '<div class="row">';

      if( $before ) {
        ob_start();
        dynamic_sidebar( 'footer-before' );
        $before  = ob_get_clean();
        $output .= '<div class="col-md-12">'. $before .'</div>';
      }

      if( $widgets ) {

        switch ( $widgets ) {
          case 1: $widget = array('piece' => 1, 'class' => 'col-md-12'); break;
          case 2: $widget = array('piece' => 2, 'class' => 'col-md-6'); break;
          case 3: $widget = array('piece' => 3, 'class' => 'col-md-4'); break;
          case 4: $widget = array('piece' => 4, 'class' => 'col-md-3'); break;
          case 5: $widget = array('piece' => 6, 'class' => 'col-md-2'); break;
          case 6: $widget = array('piece' => 3, 'class' => 'col-md-3', 'layout' => 'col-md-6', 'queue' => 1); break;
          case 7: $widget = array('piece' => 3, 'class' => 'col-md-3', 'layout' => 'col-md-6', 'queue' => 2); break;
          case 8: $widget = array('piece' => 3, 'class' => 'col-md-3', 'layout' => 'col-md-6', 'queue' => 3); break;
          case 9: $widget = array('piece' => 4, 'class' => 'col-md-2', 'layout' => 'col-md-6', 'queue' => 1); break;
          case 10:$widget = array('piece' => 4, 'class' => 'col-md-2', 'layout' => 'col-md-6', 'queue' => 4); break;
        }

        for( $i = 1; $i < $widget["piece"]+1; $i++ ) {

          $widget_class = ( isset( $widget["queue"] ) && $widget["queue"] == $i ) ? $widget["layout"] : $widget["class"];

          $output .= '<div class="'. $widget_class .'">';
          ob_start();
          dynamic_sidebar( 'footer-'. $i );
          $output .= ob_get_clean();
          $output .= '</div>';

        }

      }

      if( $after ) {
        ob_start();
        dynamic_sidebar( 'footer-after' );
        $after  = ob_get_clean();
        $output .= '<div class="col-md-12">'. $after .'</div>';
      }

      $output .= '</div>';
      $output .= '</div>';
      $output .= '</footer>';

    }

    ob_start();
    dynamic_sidebar( 'footer-block-after' );
    $footer_block_after = ob_get_clean();

    if( ! empty( $footer_block_after ) ) {
      $output .= '<div id="cs-footer-block-after">';
      $output .= '<div class="container">';
      $output .= '<div class="row">';
      $output .= '<div class="col-md-12">';
      $output .= $footer_block_after;
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    }

    $copyright          = cs_get_option( 'copyright_text' );
    $disable_copyright  = cs_get_option( 'disable_copyright' );

    if( $copyright && empty( $disable_copyright ) ) {

      $output .= '<div id="copyright">';
      $output .= '<div class="container">';
      $output .= '<div class="row">';
      $output .= '<div class="col-md-12">';
      $output .= do_shortcode( cs_multilang_value( $copyright ) );
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';

    }

    return $output;
  }
}

/**
 *
 * Custom Javascript
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_custom_js' ) ) {
  function cs_custom_js() {
    $custom_js = cs_get_option( 'custom_js' );
    if( $custom_js ) {
      return '<script type="text/javascript">'. $custom_js .'</script>';
    }
  }
}

/**
 *
 * Header Before
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_header_before' ) ) {
  function cs_header_before() {

    global $post;

    $post_id    = ( isset( $post ) ) ? $post->ID : false;
    $post_id    = ( is_front_page() ) ? get_option( 'page_on_front' ) : $post_id;

    if( ! $post_id ) { return; }

    $post_meta  = get_post_meta( $post_id, '_custom_page_options', true );
    return ( ! empty( $post_meta['header_before'] ) ) ? '<div id="header-before">'. do_shortcode( cs_multilang_value( $post_meta['header_before'] ) ) .'</div>' : '';

  }
}


/**
 *
 * Google Analytics by Tracking Code
 * @since 1.8.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_google_analytics' ) ) {
  function cs_google_analytics( $head = '' ) {

    $ga = cs_get_option( 'ga' );

    if( $ga ){

      ob_start();
      ?>
<!-- Google Analytics -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $ga; ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- End Google Analytics -->
      <?php

      echo ob_get_clean();

    }

  }
}