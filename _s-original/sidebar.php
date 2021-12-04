<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package _sSs
 */

if ( ! is_active_sidebar( 'sidebar-default' ) ) {
  return;
}
?>

<div id="sidebar" class="widget-area small-12 large-4 cell" role="complementary">
  <?php dynamic_sidebar( 'sidebar-default' ); ?>
</div><!-- #sidebar -->
