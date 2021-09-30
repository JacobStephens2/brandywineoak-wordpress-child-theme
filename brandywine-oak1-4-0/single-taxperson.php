<?php
/**
 * The template for displaying all single team members
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wyeth
 */
get_template_part( 'template-parts/header-tax-advisory-navy-bar', 'page' );
while ( have_posts() ) : the_post();
    $image       = get_field('person_portrait_image');
    $name        = get_field('person_name');
    $credentials = get_field('person_credentials');
    $job_titles  = get_field('job_titles');
    $email       = get_field('person_email');
    $linkedin    = get_field('person_linkedin');

    $watermark = get_field('watermark');
    if($watermark) {
      $w_class = ' watermark watermark--'.$watermark[0]['watermark'].' watermark--'.$watermark[0]['size'].' watermark--alt';
      $w_style = 'background-position: '.$watermark[0]['watermark_x'].'% '.$watermark[0]['watermark_y'].'%;';
    } else {
      $w_class = '';
      $w_style = '';
    }

    $next_post     = get_next_post();
    $prev_post     = get_previous_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header bioBanner">
    <div class="bioBanner_content">
      <div class="row column">
        <div class="grid-x">
          <div class="cell small-12 medium-8">
            <h1 class="bioBanner_name">
              <?= $name; ?><?php if($credentials) echo ", ".$credentials; ?>
            </h1>
            <?php if($job_titles): ?>
              <div class="bioBanner_title">
                <?php
                  foreach($job_titles as $key=>$title) {
                    echo $title['text'];
                    if($key+1 < count($job_titles)) {
                      echo " | ";
                    }
                  }
                ?>
              </div>
            <?php endif; ?>
            <?php if($email || $linkedin): ?>
              <div class="bioBanner_meta">
                <?php if($email): ?>
                  <a href="mailto:<?php echo antispambot( $email ); ?>">
                    <?php echo antispambot( $email ); ?>
                  </a>
                <?php endif; ?>
                <?php if($email && $linkedin): ?>|<?php endif; ?>
                <?php if($linkedin): ?>
                  <a href="<?= $linkedin ?>" target="_blank">LinkedIn</a>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <div class="bioContent<?= $w_class ?>" style="<?= $w_style ?>">
      <div class="row column">
        <div class="grid-x grid-margin-x">
          <div class="cell small-12 large-8 xlarge-9">
            <div class="grid-x grid-margin-x">
              <div class="cell small-12 medium-5 large-5">
                <img src="<?= $image ?>" alt="<?= $name ?>" class="bioContent_photo">
              </div>
              <div class="cell small-12 medium-7 large-7 bioContent_text">
                <?php the_content() ?>
              </div>
            </div>
          </div>
          <div class="cell small-12 large-4 xlarge-3">

          <div class="post-pagination">
              <a href="/about-our-firm/our-tax-advisory-team" class="btn">Back to All</a><div class="pagination_previous">
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
          </div>

        </div>
      </div>
    </div>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->

<?php
  endwhile;
  get_footer();
?>