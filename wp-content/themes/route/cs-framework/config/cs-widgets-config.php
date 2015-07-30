<?php
/**
 *
 * Shortcode Widget
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CS_Shortcode_Widget extends WP_Widget {

  function __construct() {
    $widget_ops   = array( 'classname' => 'cs_widget_shortcode', 'description' => 'Use Shortcodes in Widgets.' );
    $control_ops  = array( 'width' => 400, 'height' => 350 );
    parent::__construct( 'shortcode_cs_widget', '+ Add Shortcode', $widget_ops, $control_ops );
  }

  function widget( $args, $instance ) {

    extract($args);

    $title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
    $text   = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );

    echo $before_widget;

    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

    $content_widget = ( !empty( $instance['filter'] ) ) ? wpautop( $text ) : $text;
    echo '<div class="textwidget">'. do_shortcode( $content_widget ) .'</div><div class="clear"></div>';

    echo $after_widget;

  }

  function update( $new_instance, $old_instance ) {

    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);

    if ( current_user_can('unfiltered_html') ){
      $instance['text'] =  $new_instance['text'];
    } else {
      $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
    }

    $instance['filter'] = isset($new_instance['filter']);
    return $instance;

  }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
    $title    = strip_tags($instance['title']);
    $text   = esc_textarea($instance['text']);
  ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
    <p><a href="#" onmousedown="return false;" class="button button-primary shortcode-button" data-target="<?php echo $this->get_field_id('text'); ?>"><span class="dashicons dashicons-menu"></span> Quick Shortcode</a></p>
    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
    <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>">Automatically add paragraphs</label></p>
  <?php
  }
}


/**
 *
 * About Widget
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CS_About_Widget extends WP_Widget {

  function __construct() {
    $widget_ops   = array( 'classname' => 'cs_widget_about', 'description' => 'About us Widget.' );
    parent::__construct( 'about_cs_widget', '- About us', $widget_ops );
  }

  function widget( $args, $instance ) {

    extract( $args );

    $title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    echo $before_widget;

    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

    echo '<div class="textwidget">';

    echo '<p>';
    echo ( ! empty( $instance['img'] ) ) ? '<img src="'. $instance['img'] .'" class="footer-logo-left" alt="" />' : '';
    echo $instance['logo_text'];
    echo '</p>';

    echo '<p>';

    echo ( ! empty( $instance['address'] ) ) ? '<strong class="about-strong">'. $instance['address'] .'</strong> ' : '';
    echo ( ! empty( $instance['address_text'] ) ) ? $instance['address_text'] . '<br />' : '';

    echo ( ! empty( $instance['phone'] ) ) ? '<strong class="about-strong">'. $instance['phone'] .'</strong> ' : '';
    echo ( ! empty( $instance['phone_text'] ) ) ? $instance['phone_text'] . '<br />' : '';

    echo ( ! empty( $instance['empty'] ) ) ? '<strong class="about-strong">'. $instance['empty'] .'</strong> ' : '';
    echo ( ! empty( $instance['empty_text'] ) ) ? $instance['empty_text'] . '<br />' : '';

    echo ( ! empty( $instance['mail'] ) ) ? '<strong class="about-strong">'. $instance['mail'] .'</strong> ' : '';
    echo ( ! empty( $instance['mail_text'] ) ) ? '<a href="mailto:'. $instance['mail_text'] .'">'. $instance['mail_text'] . '</a><br />' : '';

    echo ( ! empty( $instance['web'] ) ) ? '<strong class="about-strong">'. $instance['web'] .'</strong> ' : '';
    echo ( ! empty( $instance['web_text'] ) ) ? '<a href="'. esc_url( $instance['web_url'] ) .'">'. $instance['web_text'] . '</a>' : '';

    echo '</p>';

    echo '</div><div class="clear"></div>';

    echo $after_widget;

  }

  function update( $new_instance, $old_instance ) {

    $instance                 = $old_instance;
    $instance['title']        = $new_instance['title'];
    $instance['img']          = $new_instance['img'];
    $instance['logo_text']    = $new_instance['logo_text'];
    $instance['address']      = $new_instance['address'];
    $instance['address_text'] = $new_instance['address_text'];
    $instance['phone']        = $new_instance['phone'];
    $instance['phone_text']   = $new_instance['phone_text'];
    $instance['empty']        = $new_instance['empty'];
    $instance['empty_text']   = $new_instance['empty_text'];
    $instance['mail']         = $new_instance['mail'];
    $instance['mail_text']    = $new_instance['mail_text'];
    $instance['web']          = $new_instance['web'];
    $instance['web_text']     = $new_instance['web_text'];
    $instance['web_url']      = $new_instance['web_url'];

    return $instance;

  }

  function form( $instance ) {

    $instance        = wp_parse_args( (array) $instance, array(
      'title'        => '',
      'img'          => '',
      'logo_text'    => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
      'address'      => 'Address:',
      'address_text' => '3060 Duncan Avenue<br />Garden City, NY 11530',
      'phone'        => 'Phone:',
      'phone_text'   => '0800 555 5555',
      'empty'        => '',
      'empty_text'   => '',
      'mail'         => 'E-Mail:',
      'mail_text'    => 'info@domain.com',
      'web'          => 'Web',
      'web_text'     => 'domain.com',
      'web_url'      => 'http://domain.com',
      )
    );

    $title           =  $instance['title'];
    $img             = $instance['img'];
    $logo_text       = $instance['logo_text'];
    $address         = $instance['address'];
    $address_text    = $instance['address_text'];
    $phone           = $instance['phone'];
    $phone_text      = $instance['phone_text'];
    $empty           = $instance['empty'];
    $empty_text      = $instance['empty_text'];
    $mail            = $instance['mail'];
    $mail_text       = $instance['mail_text'];
    $web             = $instance['web'];
    $web_text        = $instance['web_text'];
    $web_url         = $instance['web_url'];

    // WIDGET TITLE
    cs_get_field( array( 'id' => $this->get_field_name('title'), 'name' => $this->get_field_name('title'), 'type' => 'text', 'title' => 'Widget Title' ), $title );

    // IMAGE - TEXT
    cs_get_field( array( 'id' => $this->get_field_name('img'), 'name' => $this->get_field_name('img'), 'type' => 'upload', 'title' => 'About us - Logo' ), $img );
    cs_get_field( array( 'id' => $this->get_field_name('logo_text'), 'name' => $this->get_field_name('logo_text'), 'type' => 'textarea', 'title' => 'Logo Text' ), $logo_text );

    // ADDRESS
    cs_get_field( array( 'id' => $this->get_field_name('address'), 'name' => $this->get_field_name('address'), 'type' => 'text', 'title' => 'Address' ), $address );
    cs_get_field( array( 'id' => $this->get_field_name('address_text'), 'name' => $this->get_field_name('address_text'), 'type' => 'textarea', 'title' => 'Address Text' ), $address_text );

    // PHONE
    cs_get_field( array( 'id' => $this->get_field_name('phone'), 'name' => $this->get_field_name('phone'), 'type' => 'text', 'title' => 'Phone' ), $phone );
    cs_get_field( array( 'id' => $this->get_field_name('phone_text'), 'name' => $this->get_field_name('phone_text'), 'type' => 'text', 'title' => 'Phone Text' ), $phone_text );

    // EMPTY
    cs_get_field( array( 'id' => $this->get_field_name('empty'), 'name' => $this->get_field_name('empty'), 'type'  => 'text', 'title' => 'Empty' ), $empty );
    cs_get_field( array( 'id' => $this->get_field_name('empty_text'), 'name' => $this->get_field_name('empty_text'), 'type' => 'text', 'title' => 'Empty Text' ), $empty_text );

    // MAIL
    cs_get_field( array( 'id' => $this->get_field_name('mail'), 'name' => $this->get_field_name('mail'), 'type' => 'text', 'title' => 'E-Mail' ), $mail );
    cs_get_field( array( 'id' => $this->get_field_name('mail_text'), 'name' => $this->get_field_name('mail_text'), 'type' => 'text', 'title' => 'E-Mail Text' ), $mail_text );

    // WEB
    cs_get_field( array( 'id' => $this->get_field_name('web'), 'name' => $this->get_field_name('web'), 'type' => 'text', 'title' => 'Web' ), $web );
    cs_get_field( array( 'id' => $this->get_field_name('web_text'), 'name' => $this->get_field_name('web_text'), 'type' => 'text', 'title' => 'Web Text' ), $web_text );
    cs_get_field( array( 'id' => $this->get_field_name('web_url'), 'name' => $this->get_field_name('web_url'), 'type' => 'text', 'title' => 'Web URL' ), $web_url );

  }
}


/**
 *
 * Flickr Widget
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CS_Flickr_Widget extends WP_Widget {

  function __construct() {
    $widget_ops   = array( 'classname' => 'cs_widget_flickr', 'description' => 'Flickr Photo Stream Widget' );
    parent::__construct( 'flickr_cs_widget', '- Flickr Photo Stream', $widget_ops );
  }

  function widget( $args, $instance ) {

    extract( $args );

    $title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    echo $before_widget;

    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

    echo '<div class="cs_flickr_widget">';

    $source = ( $instance['type'] == 'set' ) ? 'source=user_set&set=' : 'source=user&user=';

    echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='. $instance['count'] .'&display='. $instance['ordering'] .'&size='. $instance['size'] .'&'. $source . $instance['flickr_id'] .'"></script>';

    echo '</div><div class="clear"></div>';

    echo $after_widget;

  }

  function update( $new_instance, $old_instance ) {

    $instance              = $old_instance;
    $instance['title']     = $new_instance['title'];
    $instance['type']      = $new_instance['type'];
    $instance['flickr_id'] = $new_instance['flickr_id'];
    $instance['count']     = $new_instance['count'];
    $instance['ordering']  = $new_instance['ordering'];
    $instance['size']      = $new_instance['size'];

    return $instance;

  }

  function form( $instance ) {

    $instance     = wp_parse_args( (array) $instance, array(
      'title'     => '',
      'type'      => 'user',
      'flickr_id' => '52617155@N08',
      'count'     => '9',
      'ordering'  => 'random',
      'size'      => 's',
      )
    );

    $title        =  $instance['title'];
    $type         = $instance['type'];
    $flickr_id    = $instance['flickr_id'];
    $count        = $instance['count'];
    $ordering     = $instance['ordering'];
    $size         = $instance['size'];

    // WIDGET TITLE
    cs_get_field( array( 'id' => $this->get_field_name('title'), 'name' => $this->get_field_name('title'), 'type' => 'text', 'title' => 'Widget Title' ), $title );

    // FIELDS
    cs_get_field( array( 'id' => $this->get_field_name('type'), 'name' => $this->get_field_name('type'), 'type' => 'select', 'title' => 'Type', 'options' => array( 'user' => 'user', 'set' => 'set' ) ), $type );
    cs_get_field( array( 'id' => $this->get_field_name('flickr_id'), 'name' => $this->get_field_name('flickr_id'), 'type' => 'text', 'title' => 'Flickr User ID', 'info' => 'Find your Flickr ID <a href="http://idgettr.com/" target="_blank">idGettr</a>' ), $flickr_id );
    cs_get_field( array( 'id' => $this->get_field_name('count'), 'name' => $this->get_field_name('count'), 'type' => 'text', 'title' => 'Count' ), $count );
    cs_get_field( array( 'id' => $this->get_field_name('ordering'), 'name' => $this->get_field_name('ordering'), 'type' => 'select', 'title' => 'Ordering your images', 'options' => array( 'latest' => 'Latest', 'random' => 'Random' ) ), $ordering );
    cs_get_field( array( 'id' => $this->get_field_name('size'), 'name' => $this->get_field_name('size'), 'type' => 'select', 'title' => 'Size of your images', 'options' => array( 's' => 'Small square box', 't' => 'Thumbnail size', 'm' => 'Medium size' ) ), $size );

  }
}


/**
 *
 * Portfolio Photos Widget
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CS_Portfolio_Photos_Widget extends WP_Widget {

  function __construct() {
    $widget_ops   = array( 'classname' => 'cs_widget_portfolio_photos', 'description' => 'Portfolio Photo Stream Widget' );
    parent::__construct( 'portfolio_photos_cs_widget', '- Portfolio Photo Stream', $widget_ops );
  }

  function widget( $args, $instance ) {

   global $wp_query, $paged, $post;

    extract( $args );

    $title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    echo $before_widget;

    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

    echo '<div class="cs_portfolio_widget">';

    // Query
    $args = array(
      'posts_per_page'  => $instance['limit'],
      'post_type'       => 'portfolio',
    );

    if( $instance['cats'] ) {
      $args['tax_query'] = array(
        array(
          'taxonomy'  => 'portfolio-category',
          'field'     => 'ids',
          'terms'     => explode( ',', $instance['cats'] )
        )
      );
    }

    $tmp_query  = $wp_query;
    $wp_query   = new WP_Query( $args );

    if( have_posts() ) :
      while( have_posts() ) : the_post();

        $image         = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
        $post_options  = get_post_meta( get_the_ID(), '_custom_page_options', true );
        $custom_link   = ( ! empty( $post_options['custom_item_link'] ) ) ? $post_options['custom_item_link'] : get_permalink();
        $custom_target = ( ! empty( $post_options['custom_item_link_target'] ) ) ? ' target="_blank"' : '';

        echo '<a href="'. $custom_link .'" data-toggle="tooltip" data-placement="top" data-title="'. get_the_title() .'" class="'. cs_get_bootstrap( $instance['columns'], 'xs', true ) .'"'. $custom_target .'><img src="'. $image[0] .'" alt="'. get_the_title() .'" /></a>';

      endwhile;
    endif;

    wp_reset_query();
    wp_reset_postdata();
    $wp_query = $tmp_query;

    echo '</div><div class="clear"></div>';

    echo $after_widget;

  }

  function update( $new_instance, $old_instance ) {

    $instance            = $old_instance;
    $instance['title']   = $new_instance['title'];
    $instance['cats']    = $new_instance['cats'];
    $instance['limit']   = $new_instance['limit'];
    $instance['columns'] = $new_instance['columns'];

    return $instance;

  }

  function form( $instance ) {

    $instance   = wp_parse_args( (array) $instance, array(
      'title'   => '',
      'cats'    => 0,
      'limit'   => 9,
      'columns' => 3,
      )
    );

    $title      = $instance['title'];
    $cats       = $instance['cats'];
    $limit      = $instance['limit'];
    $columns    = $instance['columns'];

    // WIDGET TITLE
    cs_get_field( array( 'id' => $this->get_field_name('title'), 'name' => $this->get_field_name('title'), 'type' => 'text', 'title' => 'Widget Title' ), $title );

    // FIELDS
    cs_get_field( array(
      'id'           => $this->get_field_name('cats'),
      'name'         => $this->get_field_name('cats'),
      'type'         => 'checkbox',
      'title'        => 'Categories (optional)',
      'options'      => 'categories',
      'query_args'   => array(
        'sort_order' => 'ASC',
        'taxonomy'   => 'portfolio-category',
        'hide_empty' => 0,
      ),
      'attributes'   => array(
        'multiple'   => 'multiple',
      ),
      'info'         => 'Default: All categories selected.'
    ), $cats );

    cs_get_field( array( 'id' => $this->get_field_name('limit'), 'name' => $this->get_field_name('limit'), 'type' => 'text', 'title' => 'Photo Limit' ), $limit );
    cs_get_field( array( 'id' => $this->get_field_name('columns'), 'name' => $this->get_field_name('columns'), 'type' => 'select', 'title' => 'Columns', 'options' => array( 2 => '2 Columns', 3 => '3 Columns', 4 => '4 Columns', 6 => '6 Columns' ) ), $columns );

  }
}


/**
 *
 * Blog Posts
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CS_Blog_Posts_Widget extends WP_Widget {

  function __construct() {
    $widget_ops   = array( 'classname' => 'cs_widget_custom_posts', 'description' => 'Recent, Popular, Related Blog Posts' );
    parent::__construct( 'blog_posts_cs_widget', '- Blog Posts', $widget_ops );
  }

  function widget( $args, $instance ) {

    global $wp_query, $paged, $post;

    extract( $args );

    $title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    echo $before_widget;

    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

    echo '<div class="cs_blog_posts_widget">';

    // Query
    $args = array(
      'posts_per_page'  => $instance['limit'],
      'post_type'  => 'post',
    );

    if( $instance['cats'] ) {
      $args['cat'] = $instance['cats'];
    }

    switch ( $instance['type'] ) {

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

    $tmp_query  = $wp_query;
    $wp_query   = new WP_Query( $args );

    if( have_posts() ) :

      $is_full = ( !empty( $instance['full_width_image'] ) ) ? true : false;
      $with_image = ( ! empty( $instance['display_image'] ) && ! $is_full ) ? 'cs-with-image' : '';
      $full_image    = ( $is_full ) ? ' cs-full-with-image' : '';
      $image_size = ( ! empty( $instance['image_size'] ) ) ? $instance['image_size'] : 'thumbnail';

      echo '<ul class="'. $with_image . $full_image .'">';
      while( have_posts() ) : the_post();

        $format = ( get_post_format() ) ? get_post_format() : 'standard';
        $image  = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size );
        $image  = ( ! empty( $image ) ) ? '<img src="'. $image[0] .'" alt="'. get_the_title() .'" />' : '<img src="'. THEME_URI .'/images/no-pictures/no-'. $format .'-picture.png" alt="No Video Picture" />';
        $image  = ( $instance['display_image'] ) ? $image : '';

        $categories = get_the_category();
        $post_cats  = array();

        if( ! empty( $categories ) ) {
          foreach($categories as $category) {
            $post_cats[] = $category->name;
          }
        }

        $post_cats = implode( ' &bull; ', $post_cats );

        echo '<li>';
        echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'">'. $image . get_the_title() .'</a>';
        echo ( $instance['display_date'] ) ?  '<span class="post-date"><i class="fa fa-clock-o"></i> '. get_the_date() .'</span>' : '';
        echo ( $instance['display_category'] ) ? '<span class="post-category"><i class="fa fa-folder-o"></i> '. $post_cats .'</span>' : '';
        echo '</li>';

      endwhile;
      echo '</ul>';

    endif;

    wp_reset_query();
    wp_reset_postdata();
    $wp_query = $tmp_query;

    echo '</div><div class="clear"></div>';

    echo $after_widget;

  }

  function update( $new_instance, $old_instance ) {

    $instance                     = $old_instance;
    $instance['title']            = $new_instance['title'];
    $instance['type']             = $new_instance['type'];
    $instance['cats']             = $new_instance['cats'];
    $instance['limit']            = $new_instance['limit'];
    $instance['display_image']    = $new_instance['display_image'];
    $instance['display_date']     = $new_instance['display_date'];
    $instance['display_category'] = $new_instance['display_category'];
    $instance['full_width_image'] = $new_instance['full_width_image'];
    $instance['image_size']       = $new_instance['image_size'];

    return $instance;

  }

  function form( $instance ) {

    $instance            = wp_parse_args( (array) $instance, array(
      'title'            => '',
      'type'             => 'random',
      'cats'             => 0,
      'limit'            => 5,
      'display_image'    => 1,
      'display_date'     => 1,
      'display_category' => 0,
      'full_width_image' => false,
      'image_size'       => 'thumbnail',
    ) );

    $title               = $instance['title'];
    $type                = $instance['type'];
    $cats                = $instance['cats'];
    $limit               = $instance['limit'];
    $display_image       = $instance['display_image'];
    $display_date        = $instance['display_date'];
    $display_category    = $instance['display_category'];
    $full_width_image    = $instance['full_width_image'];
    $image_size          = $instance['image_size'];

    // WIDGET TITLE
    cs_get_field( array( 'id' => $this->get_field_name('title'), 'name' => $this->get_field_name('title'), 'type' => 'text', 'title' => 'Widget Title' ), $title );
    cs_get_field( array( 'id' => $this->get_field_name('type'), 'name' => $this->get_field_name('type'), 'type' => 'select', 'title' => 'Type', 'options' => array( 'recent' => 'Recent Posts', 'related' => 'Related Posts', 'random' => 'Random Posts', 'commented' => 'Most Commented Posts', 'loved' => 'Most Loved Posts' ) ), $type );

    // FIELDS
    cs_get_field( array(
      'id'           => $this->get_field_name('cats'),
      'name'         => $this->get_field_name('cats'),
      'type'         => 'checkbox',
      'title'        => 'Categories (optional)',
      'options'      => 'categories',
      'query_args'   => array(
        'sort_order' => 'ASC',
        'taxonomy'   => 'category',
        'hide_empty' => 0,
      ),
      'attributes'   => array(
        'multiple'   => 'multiple',
      ),
      'info'         => 'Default: All categories selected.'
    ), $cats );

    cs_get_field( array( 'id' => $this->get_field_name('limit'), 'name' => $this->get_field_name('limit'), 'type' => 'text', 'title' => 'Number of posts to show' ), $limit );
    cs_get_field( array( 'id' => $this->get_field_name('image_size'), 'name' => $this->get_field_name('image_size'), 'type' => 'select', 'title' => 'Image Size', 'options' => cs_get_image_sizes( true, false ), 'default' => 'thumbnail' ), $image_size );
    cs_get_field( array( 'id' => $this->get_field_name('display_image'), 'name' => $this->get_field_name('display_image'), 'type' => 'on_off', 'label' => 'Display post image ?' ), $display_image );
    cs_get_field( array( 'id' => $this->get_field_name('full_width_image'), 'name' => $this->get_field_name('full_width_image'), 'type' => 'on_off', 'label' => 'Use 100% width image' ), $full_width_image );
    cs_get_field( array( 'id' => $this->get_field_name('display_date'), 'name' => $this->get_field_name('display_date'), 'type' => 'on_off', 'label' => 'Display post date ?' ), $display_date );
    cs_get_field( array( 'id' => $this->get_field_name('display_category'), 'name' => $this->get_field_name('display_category'), 'type' => 'on_off', 'label' => 'Display post category ?' ), $display_category );

  }
}


/**
 *
 * Portfolio Posts
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CS_Portfolio_Posts_Widget extends WP_Widget {

  function __construct() {
    $widget_ops   = array( 'classname' => 'cs_widget_custom_posts', 'description' => 'Recent, Popular, Related Portfolio Posts' );
    parent::__construct( 'portfolio_posts_cs_widget', '- Portfolio Posts', $widget_ops );
  }

  function widget( $args, $instance ) {

    global $wp_query, $paged, $post;

    extract( $args );

    $title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    echo $before_widget;

    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

    echo '<div class="cs_portfolio_posts_widget">';

    // Query
    $args = array(
      'posts_per_page'  => $instance['limit'],
      'post_type'       => 'portfolio',
    );

    if( $instance['cats'] ) {
      $args['tax_query'] = array(
        array(
          'taxonomy'  => 'portfolio-category',
          'field'     => 'ids',
          'terms'     => explode( ',', $instance['cats'] )
        )
      );
    }

    switch ( $instance['type'] ) {

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

    $tmp_query  = $wp_query;
    $wp_query   = new WP_Query( $args );

    if( have_posts() ) :

      $is_full    = ( !empty( $instance['full_width_image'] ) ) ? true : false;
      $with_image = ( ! empty( $instance['display_image'] ) && ! $is_full ) ? 'cs-with-image' : '';
      $full_image = ( $is_full ) ? ' cs-full-with-image' : '';
      $image_size = ( ! empty( $instance['image_size'] ) ) ? $instance['image_size'] : 'thumbnail';

      echo '<ul class="'. $with_image . $full_image .'">';
      while( have_posts() ) : the_post();

        $post_id      = get_the_ID();
        $item_cats    = '';
        $item_slugs   = array();
        $item_terms   = get_the_terms( $post->ID, 'portfolio-category' );
        $post_options = get_post_meta( $post->ID, '_custom_page_options', true );

        if( !empty( $item_terms ) ) {
          foreach ( $item_terms as $item_term ) {
            $item_cats    .= ' ' . strtolower( $item_term->slug );
            $item_slugs[]  = $item_term->name;
          }
        }

        $item_slugs    = implode( ' &bull; ', $item_slugs );
        $format        = ( get_post_format() ) ? get_post_format() : 'standard';
        $image         = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size );
        $image         = ( ! empty( $image ) ) ? '<img src="'. $image[0] .'" alt="'. get_the_title() .'" />' : '<img src="'. THEME_URI .'/images/no-pictures/no-'. $format .'-picture.png" alt="No Picture" />';
        $image         = ( $instance['display_image'] ) ? $image : '';
        $custom_link   = ( ! empty( $post_options['custom_item_link'] ) ) ? $post_options['custom_item_link'] : get_permalink();
        $custom_target = ( ! empty( $post_options['custom_item_link_target'] ) ) ? ' target="_blank"' : '';

        echo '<li>';
        echo '<a href="'. $custom_link .'" title="'. get_the_title() .'"'. $custom_target .'>'. $image . get_the_title() .'</a>';
        echo ( $instance['display_date'] ) ?  '<span class="post-date"><i class="fa fa-clock-o"></i> '. get_the_date() .'</span>' : '';
        echo ( $instance['display_category'] ) ? '<span class="post-category"><i class="fa fa-folder-o"></i> '. $item_slugs .'</span>' : '';
        echo '</li>';

      endwhile;
      echo '</ul>';

    endif;

    wp_reset_query();
    wp_reset_postdata();
    $wp_query = $tmp_query;

    echo '</div><div class="clear"></div>';

    echo $after_widget;

  }

  function update( $new_instance, $old_instance ) {

    $instance                     = $old_instance;
    $instance['title']            = $new_instance['title'];
    $instance['type']             = $new_instance['type'];
    $instance['cats']             = $new_instance['cats'];
    $instance['limit']            = $new_instance['limit'];
    $instance['display_image']    = $new_instance['display_image'];
    $instance['display_date']     = $new_instance['display_date'];
    $instance['display_category'] = $new_instance['display_category'];
    $instance['full_width_image'] = $new_instance['full_width_image'];
    $instance['image_size']       = $new_instance['image_size'];

    return $instance;

  }

  function form( $instance ) {

    $instance            = wp_parse_args( (array) $instance, array(
      'title'            => '',
      'type'             => 'random',
      'cats'             => 0,
      'limit'            => 5,
      'display_image'    => 1,
      'display_date'     => 1,
      'display_category' => 0,
      'full_width_image' => false,
      'image_size'       => 'thumbnail',
    ) );

    $title               = $instance['title'];
    $type                = $instance['type'];
    $cats                = $instance['cats'];
    $limit               = $instance['limit'];
    $display_image       = $instance['display_image'];
    $display_date        = $instance['display_date'];
    $display_category    = $instance['display_category'];
    $full_width_image    = $instance['full_width_image'];
    $image_size          = $instance['image_size'];

    // WIDGET TITLE
    cs_get_field( array( 'id' => $this->get_field_name('title'), 'name' => $this->get_field_name('title'), 'type' => 'text', 'title' => 'Widget Title' ), $title );
    cs_get_field( array( 'id' => $this->get_field_name('type'), 'name' => $this->get_field_name('type'), 'type' => 'select', 'title' => 'Type', 'options' => array( 'recent' => 'Recent Posts', 'related' => 'Related Posts', 'random' => 'Random Posts', 'commented' => 'Most Commented Posts', 'loved' => 'Most Loved Posts' ) ), $type );

    // FIELDS
    cs_get_field( array(
      'id'           => $this->get_field_name('cats'),
      'name'         => $this->get_field_name('cats'),
      'type'         => 'checkbox',
      'title'        => 'Portfolio Categories (optional)',
      'options'      => 'categories',
      'query_args'   => array(
        'sort_order' => 'ASC',
        'taxonomy'   => 'portfolio-category',
        'hide_empty' => 0,
      ),
      'attributes'   => array(
        'multiple'   => 'multiple',
      ),
      'info'         => 'Default: All categories selected.'
    ), $cats );

    cs_get_field( array( 'id' => $this->get_field_name('limit'), 'name' => $this->get_field_name('limit'), 'type' => 'text', 'title' => 'Number of posts to show:' ), $limit );
    cs_get_field( array( 'id' => $this->get_field_name('image_size'), 'name' => $this->get_field_name('image_size'), 'type' => 'select', 'title' => 'Image Size', 'options' => cs_get_image_sizes( true, false ), 'default' => 'thumbnail' ), $image_size );
    cs_get_field( array( 'id' => $this->get_field_name('display_image'), 'name' => $this->get_field_name('display_image'), 'type' => 'on_off', 'label' => 'Display post image ?' ), $display_image );
    cs_get_field( array( 'id' => $this->get_field_name('full_width_image'), 'name' => $this->get_field_name('full_width_image'), 'type' => 'on_off', 'label' => 'Use 100% width image' ), $full_width_image );
    cs_get_field( array( 'id' => $this->get_field_name('display_date'), 'name' => $this->get_field_name('display_date'), 'type' => 'on_off', 'label' => 'Display post date ?' ), $display_date );
    cs_get_field( array( 'id' => $this->get_field_name('display_category'), 'name' => $this->get_field_name('display_category'), 'type' => 'on_off', 'label' => 'Display post category ?' ), $display_category );

  }
}


/**
 *
 * CSFramework Widgets Config
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function custom_widgets_init(){
  register_widget( 'CS_Shortcode_Widget' );
  register_widget( 'CS_About_Widget' );
  register_widget( 'CS_Flickr_Widget' );
  register_widget( 'CS_Portfolio_Photos_Widget' );
  register_widget( 'CS_Blog_Posts_Widget' );
  register_widget( 'CS_Portfolio_Posts_Widget' );
}
add_action( 'widgets_init', 'custom_widgets_init', 2 );