<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _sSs
 */

get_header(); ?>

  <div id="archive-primary" class="site-primary">
    <div class="grid-container">
      <div class="grid-x grid-padding-x">

        <main id="archive-main" class="site-main small-12 large-8 cell" role="main">

        <?php if ( have_posts() ) : ?>

          <header class="page-header">
            <?php
              the_archive_title( '<h1 class="page-title">', '</h1>' );
              the_archive_description( '<div class="taxonomy-description">', '</div>' );
            ?>
          </header><!-- .page-header -->

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

        </main><!-- #archive-main -->
        <?php get_sidebar(); ?>

      </div><!-- .grid-x grid-padding-x -->
    </div><!-- .grid-container -->
  </div><!-- #archive-primary -->

<?php get_footer(); ?>
