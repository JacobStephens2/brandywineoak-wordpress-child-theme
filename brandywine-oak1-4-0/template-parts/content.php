<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wyeth
 */

	$next_post     = get_next_post();
	$prev_post     = get_previous_post();
  $post_download = get_field('post_download');

  $watermark = get_field('watermark');
  if($watermark) {
    $w_class = ' watermark watermark--'.$watermark[0]['watermark'].' watermark--'.$watermark[0]['size'].' watermark--alt';
    $w_style = 'background-position: '.$watermark[0]['watermark_x'].'% '.$watermark[0]['watermark_y'].'%;';
  } else {
    $w_class = '';
    $w_style = '';
  }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header entry-header--news entry-header--post">
	  <div class="row column">
	    <div class="mockH1">News</div>
			<div class="articleTitle">
				<h1><?php the_title(); ?></h1>
				<div class="articleTitle_date"><?php the_date('F j, Y') ?></div>
			</div>
	  </div>
	</header><!-- .entry-header -->

  <div class="entry-content entry-content--post<?= $w_class ?>" style="<?= $w_style ?>">
  	<div class="row column">
      <?php if($post_download): ?>
    		<div class="hide-for-large mobileDownload">
    			<a href="<?= $post_download ?>" class="download">Download PDF</a>
    		</div>
      <?php endif; ?>
  		<div class="grid-x grid-margin-x">
  			<div class="cell small-12 large-8 content_main">
  				<?php the_content(); ?>
  			</div>
  			<div class="cell small-12 large-4 xlarge-3 xlarge-offset-1">
  				<div class="post-pagination">
  					<a href="/news/" class="btn">Back to All</a><div class="pagination_previous">
							<?php if($prev_post): ?>
								<a href="<?php the_permalink($prev_post->ID) ?>" class="articleActions_prev">Prev</a>
							<?php else: ?>
								<span class="articleActions_prev">Prev</span>
							<?php endif; ?>
						</div><div class="pagination_next">
							<?php if($next_post): ?>
								<a href="<?php the_permalink($next_post->ID) ?>" class="articleActions_next">Next</a>
							<?php else: ?>
								<span class="articleActions_next">Next</span>
							<?php endif; ?>
						</div>
  				</div>
          <?php if($post_download): ?>
    				<div class="show-for-large">
  	  				<a href="<?= $post_download ?>" class="download">Download PDF</a>
  	  			</div>
          <?php endif; ?>
  			</div>
  		</div>
	  </div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
