<?php
/**
 *
 * The template for displaying archive pages.
 * @since 1.0.0
 * @version 1.1.0
 *
 */
get_header(); ?>
<section id="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12 md-padding">
        <h1 class="page-title">
          <?php
            if ( is_day() ) {
              printf( __( 'Daily Archives: %s', 'route' ), get_the_date() );
            } elseif ( is_month() ) {
              printf( __( 'Monthly Archives: %s', 'route' ), get_the_date( 'F Y' ) );
            } elseif ( is_year() ) {
              printf( __( 'Yearly Archives: %s', 'route' ), get_the_date( 'Y' ) );
            } else {
              _e( 'Archives', 'route' );
            }
          ?>
        </h1>
        <?php echo cs_breadcrumb(); ?>
      </div>
    </div>
  </div>
</section><!-- /page-header -->
<?php get_template_part( 'templates/page', 'loop' ); ?>
<?php get_footer();