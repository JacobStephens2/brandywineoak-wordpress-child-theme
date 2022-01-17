<?php
/**
 * The template for displaying the our tax advisory team page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wyeth
 */

  get_template_part( 'template-parts/header-tax-advisory-navy-bar', 'page' );
  while ( have_posts() ) : the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-content">
    <?php
      if( have_rows('page_content') ) {
          the_row();
          include(locate_template( 'template-parts/flexible/flexible-tax_team_grid.php', false, false ));
      }
    ?>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->

<?php
  endwhile; // End of the loop.
  get_footer();
