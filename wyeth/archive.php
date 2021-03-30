<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wyeth
 */

	get_header();

	if (is_post_type_archive()) {
		global $wp;
		$current_path = add_query_arg(array(),$wp->request);
		$current_page = get_page_by_path( $current_path );
	  $thumbnail = get_the_post_thumbnail_url($current_page->ID);
	}
  if(!$thumbnail)
    $thumbnail = '/wp-content/themes/intrepid/img/header_fpo.jpg';
?>

<header class="entry-header">
	<div class="row column">
		<?php if (is_post_type_archive()): ?>
		  <h1 class="basic-title"><span><?php post_type_archive_title(); ?></span></h1>
		  <?php get_template_part( 'template-parts/filters/filter', get_post_type() ); ?>
		<?php else: ?>
			<?php the_archive_title( '<h1 class="basic-title"><span>', '</span></h1>' ); ?>
		<?php endif; ?>
	</div>
</header>

<div class="entry-content">
  <div class="row column">
		<?php if ( have_posts() ) : ?>
			<div id="entries">
				<div id="entries_default">
					<div class="grid grid-x" data-equalizer>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'template-parts/listings/listing', get_post_type() ); ?>
						<?php endwhile; ?>
					</div>
					<div class="grid-x">
						<?php the_posts_pagination(['mid_size'=>2,'prev_text'=>'','next_text'=>'']) ?>
					</div>
				</div>
				<div id="entries_filtered"></div>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>