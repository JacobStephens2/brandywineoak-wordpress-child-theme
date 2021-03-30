<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Wyeth
 */

get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header entryBanner">
    <div class="entryBanner_content">
      <div class="row column">
        <h1 class="entry-title entryBanner_title">404: Page Not Found</h1>
        <div class="entryIntro">The page you were looking for does not exist.</div>
      </div>
    </div>
  </header><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->


<?php
get_footer();
