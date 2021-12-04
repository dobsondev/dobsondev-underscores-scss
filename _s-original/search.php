<?php
/**
 * The template for displaying search results pages.
 *
 * @package _sSs
 */

get_header(); ?>

  <div id="search-primary" class="site-primary">
    <div class="grid-container">
      <div class="grid-x grid-padding-x">

        <main id="search-main" class="site-main small-12 large-8 cell" role="main">

        <?php if ( have_posts() ) : ?>

          <header class="page-header">
            <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', '_sSs' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
          </header><!-- .page-header -->

          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <header class="entry-header">
                <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

                <?php if ( 'post' == get_post_type() ) : ?>
                <div class="entry-meta">
                  <?php _sSs_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php endif; ?>
              </header><!-- .entry-header -->

              <div class="entry-summary">
                <?php the_excerpt(); ?>
              </div><!-- .entry-summary -->

              <footer class="entry-footer">
                <?php _sSs_entry_footer(); ?>
              </footer><!-- .entry-footer -->
            </article><!-- #post-## -->

          <?php endwhile; ?>

          <?php numeric_posts_navigation(); ?>

        <?php else : ?>

          <section class="no-results not-found">
            <header class="page-header">
              <h1 class="page-title"><?php esc_html_e( 'Nothing Found', '_sSs' ); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
              <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                <p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', '_sSs' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

              <?php elseif ( is_search() ) : ?>

                <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', '_sSs' ); ?></p>
                <?php get_search_form(); ?>

              <?php else : ?>

                <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', '_sSs' ); ?></p>
                <?php get_search_form(); ?>

              <?php endif; ?>
            </div><!-- .page-content -->
          </section><!-- .no-results -->

        <?php endif; ?>

        </main><!-- #search-main -->
        <?php get_sidebar(); ?>

      </div><!-- .grid-x grid-padding-x -->
    </div><!-- .grid-container -->
  </div><!-- #search-primary -->

<?php get_footer(); ?>
