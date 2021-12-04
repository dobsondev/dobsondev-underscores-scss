<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _sSs
 */

get_header(); ?>

  <div id="index-primary" class="site-primary">
    <div class="grid-container">
      <div class="grid-x grid-padding-x">

        <main id="index-main" class="site-main small-12 large-8 cell" role="main">

        <?php if ( have_posts() ) : ?>

          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>

            <?php
              /* Include the Post-Format-specific template for the content.
               * If you want to override this in a child theme, then include a file
               * called content-___.php (where ___ is the Post Format name) and that will be used instead.
               */
              get_template_part( 'template-parts/content', get_post_format() );
            ?>

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

        </main><!-- #index-main -->
        <?php get_sidebar(); ?>

      </div><!-- .grid-x grid-padding-x -->
    </div><!-- .grid-container -->
  </div><!-- #index-primary -->

<?php get_footer(); ?>
