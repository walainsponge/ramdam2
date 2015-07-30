<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
  $woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
  $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;

$even = '';

if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 ) { $even = ' first'; }
if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) { $even = ' last'; }

$bs_columns = cs_get_bootstrap( $woocommerce_loop['columns'] );

?>
<div class="product-category product <?php echo $bs_columns; ?><?php echo $even; ?>">

  <?php do_action( 'woocommerce_before_subcategory', $category ); ?>

  <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

    <?php
      /**
       * woocommerce_before_subcategory_title hook
       *
       * @hooked woocommerce_subcategory_thumbnail - 10
       */
      do_action( 'woocommerce_before_subcategory_title', $category );
    ?>
    <span class="product-category-name">
      <?php
        echo $category->name;
        if ( $category->count > 0 ) {
          echo apply_filters( 'woocommerce_subcategory_count_html', ' (' . $category->count . ')', $category );
        }
      ?>
    </span>
    <?php
      /**
       * woocommerce_after_subcategory_title hook
       */
      do_action( 'woocommerce_after_subcategory_title', $category );
    ?>

  </a>

  <?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>