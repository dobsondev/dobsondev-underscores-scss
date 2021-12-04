<?php
/**
 * The template for displaying all single posts.
 *
 * @package _sSs
 */

get_header(); ?>

  <div id="single-primary" class="site-primary">
    <div class="grid-container">
      <div class="grid-x grid-padding-x">

        <main id="single-main" class="site-main small-12 large-8 cell" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
              <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

              <div class="entry-meta">
                <?php _sSs_posted_on(); ?>
              </div><!-- .entry-meta -->
            </header><!-- .entry-header -->

            <div class="entry-content">
              <?php the_content(); ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
              <?php _sSs_entry_footer(); ?>
            </footer><!-- .entry-footer -->
          </article><!-- #post-## -->

          <?php the_post_navigation(); ?>

        <?php endwhile; // end of the loop. ?>

        </main><!-- #single-main -->
        <?php get_sidebar(); ?>

      </div><!-- .grid-x grid-padding-x -->
    </div><!-- .grid-container -->
  </div><!-- #single-primary -->

<?php get_footer(); ?>
