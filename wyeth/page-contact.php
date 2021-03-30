<?php
/**
 * Template Name: Contact Page
 * @package Wyeth
 */

  get_header();
  while ( have_posts() ) : the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php include(locate_template('template-parts/shared/banner-contact.php', false, false )); ?>
  <div class="entry-content">
    <?php
      if( have_rows('page_content') ) {
        while ( have_rows('page_content') ) {
          the_row();
          include(locate_template( 'template-parts/flexible/flexible-'.get_row_layout().'.php', false, false ));
        }
      }
    ?>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->

<?php
  endwhile; // End of the loop.
  get_footer();
