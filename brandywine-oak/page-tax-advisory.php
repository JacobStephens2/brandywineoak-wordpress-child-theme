<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wyeth
 */

  get_template_part( 'template-parts/header-tax-advisory', 'page' );
  while ( have_posts() ) : the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php include(locate_template('template-parts/shared/banner.php', false, false )); ?>
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
