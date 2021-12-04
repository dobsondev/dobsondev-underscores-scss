<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _sSs
 */

get_header(); ?>

  <div id="page-primary" class="site-primary">
    <div class="grid-container">
      <div class="grid-x grid-padding-x">

        <main id="page-main" class="site-main small-12 large-8 cell" role="main">

          <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
              </header><!-- .entry-header -->

              <div class="entry-content">
                <?php the_content(); ?>
                <?php
                  wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_sSs' ),
                    'after'  => '</div>',
                  ) );
                ?>
              </div><!-- .entry-content -->

              <footer class="entry-footer">
                <?php edit_post_link( esc_html__( 'Edit', '_sSs' ), '<span class="edit-link">', '</span>' ); ?>
              </footer><!-- .entry-footer -->
            </article><!-- #post-## -->

          <?php endwhile; // end of the loop. ?>

        </main><!-- #page-main -->
        <?php get_sidebar(); ?>

      </div><!-- .grid-x grid-padding-x -->
    </div><!-- .grid-container -->
  </div><!-- #page-primary -->

<?php get_footer(); ?>
