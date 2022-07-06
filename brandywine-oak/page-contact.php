<?php
/**
 * Template Name: Contact Page
 * @package Brandywine Oak
 */

  get_header('special');
  while ( have_posts() ) : the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php include(locate_template('template-parts/shared/banner-contact.php', false, false )); ?>
  <div class="entry-content">
  </div>
</article><!-- #post-<?php the_ID(); ?> -->

<?php
  endwhile; // End of the loop.
  get_footer();
