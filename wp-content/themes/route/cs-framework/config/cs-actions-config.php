<?php
/**
 *
 * After Theme Supports
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_after_setup_theme' ) ) {
  function cs_after_setup_theme() {

    global $content_width;

    if ( ! isset( $content_width ) ) { $content_width = 1170; }

    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'video', 'audio', 'link', 'quote', 'status', 'chat' ) );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'custom-background' );
    add_theme_support( 'custom-header' );
    add_theme_support( 'bbpress' );

    remove_theme_support( 'custom-header' );

    $custom_image_sizes = cs_get_option( 'custom_image_sizes' );
    if( ! empty( $custom_image_sizes ) ) {
      foreach ( $custom_image_sizes as $size ) {
        $crop = ( ! empty( $size['crop'] ) ) ? true : false;
        add_image_size( sanitize_title( $size['name'] ), $size['size']['width'], $size['size']['height'], $crop );
      }
    }

    register_nav_menus( array(
      'primary'   => 'Main menu',
      'mobile'    => 'Mobile menu (optional)',
    ) );

    load_theme_textdomain( 'route', THEME_DIR . '/languages' );
  }
  add_action( 'after_setup_theme', 'cs_after_setup_theme' );
}

/**
 *
 * Post Love Ajax
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_post_love' ) ) {
  function cs_post_love() {

    if( isset( $_POST['id'] ) && wp_verify_nonce( $_POST['love_it_nonce'], 'love-it-nonce' ) ) {
      $post_id    = $_POST['id'];
      $love_count = get_post_meta( $post_id, '_love_count', true );
      $love_count = ( ! empty( $love_count ) ) ? ++$love_count : 1;
      update_post_meta( $post_id, '_love_count', $love_count );
      setcookie('route_love_'. $post_id, $post_id, time() + ( 86400 * 7 ), '/');
      echo 'loved';
    } else {
      echo 'error';
    }

    die();
  }
  add_action( 'wp_ajax_nopriv_post-love', 'cs_post_love' );
  add_action( 'wp_ajax_post-love', 'cs_post_love' );
}

/**
 *
 * Import Dump XML
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_import_dump' ) ) {
  function cs_import_dump() {

    echo '<div id="cs-install-result">';

    //
    // importing xml
    // -----------------------------------------------------------------------
    if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
      define( 'WP_LOAD_IMPORTERS', true );
    }

    if( ! class_exists( 'WP_Import' ) ) {
      require_once( FRAMEWORK_PLUGIN_DIR . '/wordpress-importer/wordpress-importer.php' );
    }

    $attachment = ( ! empty( $_POST['attachment'] ) ) ? true : false;

    ob_start();
    $wp_import = new WP_Import();
    $wp_import->fetch_attachments = $attachment;
    $wp_import->import( FRAMEWORK_DIR . '/config/dump/dump.xml' );
    $wp_import_result = ob_get_clean();

    //
    // setting menu
    // -----------------------------------------------------------------------
    $locations  = get_theme_mod('nav_menu_locations');
    $menus      = wp_get_nav_menus();

    if ( ! empty( $menus ) ) {
      foreach( $menus as $menu ) {
        if ( is_object( $menu ) && $menu->slug == 'main' ) {
          $locations['primary'] = $menu->term_id;
        }
      }
      set_theme_mod( 'nav_menu_locations', $locations );
    }

    //
    // setting custom menu fields
    // -----------------------------------------------------------------------
    $menu_items = wp_get_nav_menu_items('main');

    if ( ! empty( $menu_items ) ) {

      $menu_fields        = array(

        // HOME
        'Home Version 3'         => array( 'highlight' => 'one page',  'highlight_type' => 'danger' ),
        'Home Version 4'         => array( 'highlight' => 'portfolio',  'highlight_type' => 'info' ),
        'Home Version 5'         => array( 'highlight' => 'blog' ),

        // HEADERS
        'Header Version 1'       => array( 'content' => 'Left Logo - Right Menu Default' ),
        'Header Version 2'       => array( 'content' => 'Left Logo - Logo Below Menu' ),
        'Header Version 3'       => array( 'content' => 'Center Logo - Center Menu' ),
        'Header Version 4'       => array( 'content' => 'Transparency Header' ),
        'Header Version 5'       => array( 'content' => 'Fullscreen Slider - Below Header' ),
        'Header Version 6'       => array( 'content' => 'Fancy Header' ),
        'Header Version 7'       => array( 'content' => 'Video Header' ),

        // PORTFOLIO
        'Portfolio'              => array( 'mega' => 1, '' ),
        'Masonry with Ajax'      => array( 'highlight' => 'useful',  'highlight_type' => 'success' ),
        'Masonry with Load More' => array( 'highlight' => 'useful',  'highlight_type' => 'info' ),
        'Grid with Ajax'         => array( 'highlight' => 'useful',  'highlight_type' => 'success' ),
        'Grid with Load More'    => array( 'highlight' => 'useful',  'highlight_type' => 'info' ),

        // SHORTCODES
        'Shortcodes'             => array( 'mega' => 1, '' ),
        'Grid with Load More'    => array( 'highlight' => 'hot',  'highlight_type' => 'danger' ),
        'Icon Box'               => array( 'highlight' => 'useful',  'highlight_type' => 'success' ),
        'Icon Fancybox'          => array( 'highlight' => 'useful',  'highlight_type' => 'info' ),

      );

      if ( ! empty( $menu_fields ) ) {
        foreach ( $menu_items as $menu_key => $menu_item ) {
          foreach ( $menu_fields as $field_key => $field_data ) {
            if ( $field_key == $menu_item->title ) {
              foreach ( $field_data as $key => $value ) {
                update_post_meta( $menu_item->ID, '_menu_item_' . $key, $value );
              }
            }
          }
        }
      }
    }

    //
    // setting home-page
    // -----------------------------------------------------------------------
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', cs_get_id_by_slug( 'home' ) );

    echo '</div>';

    update_option( 'cs-installed', true );

    die();
  }
  add_action( 'wp_ajax_cs-import-dump', 'cs_import_dump' );
}

/**
 *
 * Ajax Pagination
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_ajax_pagination' ) ) {
  function cs_ajax_pagination() {

    $type       = ( ! empty( $_POST['post_type'] ) ) ? $_POST['post_type'] : 'post';
    $template   = ( ! empty( $_POST['template'] ) ) ? $_POST['template'] : 'default';
    $query_args = array(
      'paged'          => $_POST['paged'],
      'posts_per_page' => $_POST['posts_per_page'],
      'post_type'      => $type,
      'post_status'    => 'publish',
    );

    if( $type == 'portfolio' && ! empty( $_POST['cats'] ) ) {
      $query_args['tax_query'] = array(
        array(
          'taxonomy' => 'portfolio-category',
          'field'    => 'id',
          'terms'    => explode( ',', $_POST['cats'] )
        )
      );
    }

    if( $type == 'post' && ! empty( $_POST['cats'] ) ) {
      $query_args['cats'] = $cats;
    }

    query_posts( $query_args );

    while( have_posts() ) : the_post();

      if( $type == 'post' ){

        global $cs_blog_image_size, $cs_blog_column;

        $cs_blog_image_size = $_POST['size'];
        $cs_blog_column     = $_POST['columns'];

        if( $template != 'default' ) {

          $template = ( $template == 'grid' ) ? 'masonry' : $template;
          get_template_part( 'templates/page-blog', $template );

        } else {

          get_template_part( 'post-formats/content', get_post_format() );

        }

      } elseif( $type == 'portfolio' ) {

        $item_args  = array(
          'columns' => $_POST['columns'],
          'model'   => $_POST['model'],
          'love'    => $_POST['love'],
          'size'    => $_POST['size'],
        );
        cs_portfolio_item( $item_args );

      }

    endwhile;
    wp_reset_query();

    die();
  }
  add_action('wp_ajax_ajax-pagination', 'cs_ajax_pagination');
  add_action('wp_ajax_nopriv_ajax-pagination', 'cs_ajax_pagination');
}


/**
 *
 * Ajax Portfolio
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_ajax_portfolio' ) ) {
  function cs_ajax_portfolio() {

    global $post;

    if( isset( $_POST['id'] ) && is_numeric( $_POST['id'] ) ) {

      $post = get_post( $_POST['id'] );
      setup_postdata( $post );

      the_content();

      wp_reset_postdata();
    }

    die();
  }
  add_action('wp_ajax_ajax-portfolio', 'cs_ajax_portfolio');
  add_action('wp_ajax_nopriv_ajax-portfolio', 'cs_ajax_portfolio');
}

/**
 *
 * Post Format Content After
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_post_format_content_after' ) ) {
  function cs_post_format_content_after( $post = null ) {

    cs_link_pages();

    if ( is_single() ) {
    ?>
    <footer class="entry-footer">


    <?php the_tags( '<div class="entry-tags"><span class="tag-links">', ', ', '</span></div>' ); ?>

    <?php do_action( 'cs_single_content_after', $post ); ?>

    <?php if( cs_get_option( 'blog_single_author' ) !== false ): ?>
    <div class="entry-author" itemprop="author" itemscope itemtype="http://schema.org/Person">
      <div class="author-avatar" itemprop="image">
        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 70, '', esc_html( get_the_author_meta('display_name') ) ); ?>
      </div>
      <div class="author-info">
        <h2 class="author-title"><?php _e( 'About Author:' , 'route' ); ?> <span class="author-name" itemprop="name"><?php the_author(); ?></span></h2>
        <div class="author-description" itemprop="description"><?php the_author_meta('description'); ?></div>
      </div>
      <div class="clear"></div>
    </div><!-- /entry-author -->
    <?php endif; ?>

    <?php
      if( cs_get_option( 'blog_single_recents' ) !== false ):

        $single_recents = cs_get_option( 'single_recents' );
        $single_title   = cs_get_option( 'single_recents_title' );
        $type           = ( !empty( $single_recents ) ) ? $single_recents : 'random';
        $title          = ( !empty( $single_title ) ) ? $single_title : ucfirst( $type ) . ' Posts';
        $operation      =  true;

        $args = array(
          'post_type'           => 'post',
          'ignore_sticky_posts' => 1,
          'posts_per_page'      => 5,
        );

        switch ( $type ) {

          case 'commented':
            $args['orderby'] = 'comment_count';
          break;

          case 'random':
            $args['orderby'] = 'rand';
          break;

          case 'related':

            $tags   = wp_get_post_tags( $post->ID );
            $ids    = array();

            if( ! empty( $tags ) ) {
              foreach( $tags as $term ) {
                $ids[] = $term->term_id;
              }
            } else {
              $operation = false;
            }

            $args['tag__in']      = $ids;
            $args['post__not_in'] = array( $post->ID );
            $args['orderby']      = 'rand';

          break;

          case 'loved':

            $args['meta_key'] = '_love_count';
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'DESC';

          break;

          default:
            $args['orderby'] = 'date';
          break;

        }

        $q = new WP_Query( $args );

        if ( $q->have_posts() && $operation === true ) {
          echo '<div class="related-posts"><h2 class="related-title">'. $title .'</h2><ul>';

            while ( $q->have_posts() ) : $q->the_post();
            setup_postdata( $post );
            echo '<li><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">'. get_the_title() .'</a> <time datetime="'. esc_attr( get_the_date( 'c' ) ) .'">- '. esc_html( get_the_date() ) .'</time></li>';

            endwhile;

          echo '</ul></div>';
        }

        wp_reset_postdata();
        wp_reset_query();

      endif;
    ?><!-- entry-recents -->

    </footer><!-- /entry-footer -->
    <?php
    }
  }
  add_action( 'cs_post_format_content_after', 'cs_post_format_content_after' );
}

/**
 *
 * Contact Form7 Submit
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function wpcf7_submit_customize( $tag ) {

  $tag        = new WPCF7_Shortcode( $tag );
  $class      = wpcf7_form_controls_class( $tag->type );
  $atts       = array();
  $value      = isset( $tag->values[0] ) ? $tag->values[0] : '';
  $tag_class  = $tag->get_class_option();
  $class      = ( empty( $tag_class ) ) ? cs_get_button_class( array( 'size' => 'sm' ) ) .' '. $class : $class ;

  $atts['type']     = 'submit';
  $atts['value']    = ( empty( $value ) ) ? __( 'Send', 'contact-form-7' ) : $value;
  $atts['class']    = $tag->get_class_option( $class );
  $atts['id']       = $tag->get_id_option();
  $atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );

  $atts = wpcf7_format_atts( $atts );
  $html = sprintf( '<input %1$s />', $atts );

  return $html;
}

if( ! function_exists( 'wpcf7_init_customize' ) ) {
  function wpcf7_init_customize() {
    wpcf7_add_shortcode( 'submit', 'wpcf7_submit_customize' );
  }
  add_action( 'wpcf7_init', 'wpcf7_init_customize' );
}


/**
 *
 * Go Top
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_wp_footer' ) ) {
  function cs_wp_footer() {

    echo '<div id="cs-top" class="fa fa-chevron-up"></div>';

    // Google Analytics by Tracking Code
    if( cs_get_option( 'ga_position' ) !== true ) {
      cs_google_analytics();
    }

  }
  add_action( 'wp_footer', 'cs_wp_footer' );
}


/**
 *
 * Google Analytics by Tracking Code
 * @since 1.8.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_wp_head' ) ) {
  function cs_wp_head() {

    if( cs_get_option( 'ga_position' ) === true ) {
      cs_google_analytics();
    }

  }
  add_action( 'wp_head', 'cs_wp_head' );
}

/**
 *
 * Comments for Pages
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_page_comment_form' ) ) {
  function cs_page_comment_form() {

    if ( cs_get_option( 'page_comment' ) && ( comments_open() || '0' != get_comments_number() ) ){
      echo '<div id="cs-page-comments">';
        comments_template( '', true );
      echo '</div>';
    }

  }
  add_action( 'cs_page_end', 'cs_page_comment_form' );
}

/**
 *
 * Comments for Portfolio Items
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_portfolio_comment_form' ) ) {
  function cs_portfolio_comment_form() {

    if ( cs_get_option( 'portfolio_comment' ) && ( comments_open() || '0' != get_comments_number() ) ){
      echo '<div id="cs-portfolio-comments">';
      echo '<div class="container"><div class="row"><div class="col-md-12">';
      comments_template( '', true );
      echo '</div></div></div></div>';
    }

  }
  add_action( 'cs_portfolio_item_end', 'cs_portfolio_comment_form' );
}

/**
 *
 * Flush Rewrites for Custom Post Types
 * @since 1.6.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'route_flush_rewrites' ) ) {
  function route_flush_rewrites() {

    if( get_option( 'route_rewrite_flush' ) === false ) {
      global $wp_rewrite;
      $wp_rewrite->flush_rules();
      update_option( 'route_rewrite_flush', true );
    }

  }
  add_action( 'wp_loaded', 'route_flush_rewrites' );
}

/**
 *
 * OnePage site Link Attribute
 * @since 1.9.3
 * @version 1.0.0
 *
 */
if( ! function_exists( 'route_nav_menu_link_attributes' ) ) {
  function route_nav_menu_link_attributes( $atts ) {

    $template = basename( get_page_template() );

    if ( $template != 'page-one-page.php' && ! is_front_page() && substr( $atts['href'], 0, 1 ) == '#' && strlen( $atts['href'] ) > 1 ) {
      $atts['href'] = home_url( '/' ) . $atts['href'];
    }

    return $atts;

  }
  add_action( 'nav_menu_link_attributes', 'route_nav_menu_link_attributes' );
}

/**
 *
 * Flush Rewrites for Portfolio Slug
 * @since 2.1.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'route_flush_cs_framework_save' ) ) {
  function route_flush_cs_framework_save( $request ) {
    delete_option( 'route_rewrite_flush' );
    return $request;
  }
  add_action('cs_framework_save', 'route_flush_cs_framework_save');
}

/**
 *
 * Switch Theme Flush Rewrite
 * @since 2.1.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_switch_theme' ) ) {
  function cs_switch_theme() {
    delete_option( 'route_rewrite_flush' );
  }
  add_action('switch_theme', 'cs_switch_theme', 10, 2);
}

/**
 *
 * Maintenance Mode
 * @since 2.3.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_maintenance_mode' ) ) {
  function cs_maintenance_mode(){

    $maintenance = cs_get_option( 'maintenance' );

    if ( ! empty( $maintenance ) && ! is_user_logged_in() ) {
      get_template_part('templates/page', 'maintenance');
      exit;
    }

  }
  add_action( 'wp', 'cs_maintenance_mode', 1 );
}


/**
 *
 * Custom New Font Family
 * @since 2.3.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_new_font_family' ) ) {
  function cs_new_font_family( $db_value ) {

    $fonts = cs_get_option( 'font_family' );

    if ( ! empty( $fonts ) ) {

      echo '<optgroup label="Your Custom Fonts">';
      foreach ( $fonts as $key => $value ) {
        echo '<option value="'. $value['name'] .'" data-type="customfonts"'. selected( $value['name'], $db_value, true ) .'>'. $value['name'] .'</option>';
      }
      echo '</optgroup>';

    }

  }
  add_action( 'cs_font_family', 'cs_new_font_family' );
}