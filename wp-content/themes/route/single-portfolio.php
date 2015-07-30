<?php
/**
 *
 * The Template for displaying all single posts.
 * @since 1.0.0
 * @version 1.3.0
 *
 */
get_header();
get_template_part( 'templates/page-header' );

$cs_post_meta    = get_post_meta( $post->ID, '_custom_page_options', true );
$cs_page_layout  = ( isset ( $cs_post_meta['sidebar'] ) ) ? $cs_post_meta['sidebar'] : 'right';
$cs_page_column  = ( $cs_page_layout == 'full' ) ? '12' : '9';
$vc_exclude      = cs_get_option( 'vc_exclude_shortcodes' );
$vc_exclude      = ( is_array( $vc_exclude ) ) ? $vc_exclude : array();
$cs_page_padding = ( ! in_array( 'vc_row', $vc_exclude ) ) ? 'md-padding ' : '';
?>
<div class="page-portfolio-detail">
<?php
if( ( $cs_page_layout == 'fluid' || isset( $cs_post_meta['section'] ) ) && ! in_array( 'vc_row', $vc_exclude ) ) {

  get_template_part('templates/page', 'section');

} else {
?>
<section class="main-content <?php echo $cs_page_padding; ?>page-layout-<?php echo $cs_page_layout; ?>">
  <div class="container">
    <div class="row">

      <?php cs_page_sidebar( 'left', $cs_page_layout ); ?>

      <div class="col-md-<?php echo $cs_page_column; ?>">
        <div class="page-content">
          <?php
            while ( have_posts() ) : the_post();
              the_content();
              cs_link_pages();
            endwhile;
          ?>
        </div>
      </div>

      <?php cs_page_sidebar( 'right', $cs_page_layout ); ?>

    </div>
  </div>
</section>
<?php } ?>

<?php
do_action( 'cs_portfolio_item_end' );
$portfolio_nav = cs_get_option( 'portfolio_nav' );

if( $portfolio_nav !== true ) {
  $cs_prev = get_previous_post( true, null, 'portfolio-category' );
  $cs_next = get_next_post( true, null, 'portfolio-category' );
?>
<nav class="nav-portfolio">
  <?php if( ! empty( $cs_prev ) ): ?>
  <a class="cs-prev" href="<?php echo get_permalink( $cs_prev->ID ); ?>">
    <i class="fa fa-chevron-left"></i>
    <span class="cs-wrap">
      <span class="cs-title"><?php echo $cs_prev->post_title; ?></span>
      <?php echo get_the_post_thumbnail( $cs_prev->ID, array(80,80) ); ?>
    </span>
  </a>
  <?php endif; ?>
  <?php if( ! empty( $cs_next ) ): ?>
  <a class="cs-next" href="<?php echo get_permalink( $cs_next->ID ); ?>">
    <i class="fa fa-chevron-right"></i>
    <span class="cs-wrap">
      <span class="cs-title"><?php echo $cs_next->post_title; ?></span>
      <?php echo get_the_post_thumbnail( $cs_next->ID, array(80,80) ); ?>
    </span>
  </a>
  <?php endif; ?>
</nav>
<?php } ?>
</div>
<!-- /page-portfolio-detail -->
<?php
get_footer();