<?php
/**
 * Template Name: Privacy Policy Page
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wyeth
 */

  get_header();
  while ( have_posts() ) : the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header entry-header--news">
    <div class="row column">
      <h1>Privacy Policy</h1>
    </div>
  </header><!-- .entry-header -->

  <div class="entry-content entry-content--post">
    <div class="row column">
      <div class="grid-x grid-margin-x">
        <div class="cell small-12 large-8 content_main">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->

<?php
  endwhile; // End of the loop.
  get_footer();
