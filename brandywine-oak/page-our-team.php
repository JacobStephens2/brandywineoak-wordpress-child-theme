<?php
/**
 * The template for displaying the our team page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wyeth
 */

  get_header('special');
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

<style>
  img#AliAndMike {
      height: min(95vw, 485px);
      margin-top: 0.8rem;
      margin-left: .9375rem;
  }
</style>

<script>
  // Add picture of Ali and Mike below paragraph on Our Team page
  let p = document.querySelector('.cell.small-12.medium-7.large-8.contentBlock_contentMain');
  let img = document.createElement('img');
  img.src = 'https://brandywineoak.com/wp-content/uploads/2022/07/Alison-and-Michael-Hi-Res-scaled.jpg';
  img.id = 'AliAndMike';
  p.after(img);
</script>

<?php
  endwhile; // End of the loop.
  get_footer();
?>
