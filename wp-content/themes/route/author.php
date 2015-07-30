<?php
/**
 *
 * The template for displaying author archive pages.
 * @since 1.0.0
 * @version 1.1.0
 *
 */
get_header(); ?>
<section id="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12 md-padding">
        <h1 class="page-title"><?php printf( __( 'All posts by %s', 'route' ), get_the_author() ); ?></h1>
        <?php echo cs_breadcrumb(); ?>
      </div>
    </div>
  </div>
</section><!-- /page-header -->
<?php get_template_part( 'templates/page', 'loop' ); ?>
<?php get_footer();