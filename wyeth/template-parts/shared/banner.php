<?php
  $banner       = get_the_post_thumbnail_url();
  $introduction = get_field('page_introduction');
?>
<header class="entry-header entryBanner">
  <div class="entryBanner_banner" style="background-image:url(<?= $banner ?>);"></div>
  <div class="entryBanner_content">
    <div class="row column">
      <?php the_title( '<h1 class="entry-title entryBanner_title">', '</h1>' ); ?>
      <?php if($introduction): ?>
        <div class="entryIntro"><?= get_field('page_introduction') ?></div>
      <?php endif; ?>
    </div>
  </div>
  <div class="entryBanner_nav">
    <a href="#" class="entryBanner_more" data-js-component="bannerScroll"><span>More</span></a>
  </div>
</header><!-- .entry-header -->
