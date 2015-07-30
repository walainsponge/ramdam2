<?php
/**
 *
 * Search form.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
?>
<div class="cs-search-form">
  <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
    <input type="text" placeholder="<?php _e( 'Search', 'route' ); ?>" name="s" class="cs-search" />
    <button type="submit" class="fa fa-search"></button>
    <?php do_action( 'cs_search_hidden_fields' ); ?>
  </form>
</div>