<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Brandywine Oak
 */

get_header( 'special' ); 

?>

<header class="entry-header entry-header--news">
  <div class="row column">
    <h1>News</h1>
  </div>
</header><!-- .entry-header -->

<div class="entry-content">
  <div class="row column">
		<?php if ( have_posts() ) : ?>
			<div class="grid-x">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/listings/listing', get_post_type() ); ?>
				<?php endwhile; ?>
			</div>
			<div id="pagination">
				<div class="pagination_previous">
					<?php
						if(!get_previous_posts_link()) {
							echo '<span>Previous Page</span>' ;
						} else {
							previous_posts_link('Previous Page');
						}
					?>
				</div><?php the_posts_pagination(); ?><div class="pagination_next">
					<?php
						if(!get_next_posts_link()) {
							echo '<span>Next Page</span>' ;
						} else {
							next_posts_link('Next Page');
						}
					?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
