<?php
/**
 * The template for displaying the our team page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wyeth
 */

  get_header();
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
?>

<script>

const teamImg = document.createElement("img")

teamImg.src = "https://brandywineoak.com/wp-content/uploads/2022/01/brandywine-oak-team-photo-jan-17-2022-scaled.jpg"

teamImg.style.paddingRight = "1rem";

const headerText = document.querySelector('.contentBlock_intro');

headerText.append(teamImg);

</script>
