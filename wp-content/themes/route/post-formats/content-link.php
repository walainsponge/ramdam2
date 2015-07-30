<?php
/**
 *
 * The template for displaying posts in the Image post format
 * @since 1.0
 * @version 1.2.0
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <?php
    $cs_format  = post_format_link_helper( get_the_content(), get_the_title() );
    $cs_title   = $cs_format['title'];

    // if has post thumbnail, add link for thumbnail
    if( has_post_thumbnail() ) {
      $cs_link = cs_get_link_attributes( $cs_title );
      cs_post_thumbnail( $cs_link );
    }
  ?>

  <header class="entry-header">

    <?php echo $cs_title; ?>

    <div class="entry-meta">
      <?php cs_posted_on(); ?>
    </div>

  </header><!-- /entry-header -->

  <?php if ( ! is_single() && has_excerpt() ) : ?>
  <div class="entry-summary"><?php the_excerpt(); ?></div><!-- /entry-summary -->
  <?php else : ?>
  <div class="entry-content"><?php the_content( __( 'Read More', 'route' ) ); ?></div><!-- /entry-content -->
  <?php endif; ?>

  <?php do_action( 'cs_post_format_content_after', $post ); ?>

</article><!-- /post-link -->