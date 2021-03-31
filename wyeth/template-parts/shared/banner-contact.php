<?php
  // Field Definitions
  $address = get_field('address','options');
  $extra = get_field('extra','options');
  $email   = get_field('email','options');
  $phone   = get_field('phone','options');
  $team_list   = get_field('team_list','options');
  $banner  = get_the_post_thumbnail_url();
?>
<header class="entry-header entryBanner">
  <div class="entryBanner_banner" style="background-image:url(<?= $banner ?>);"></div>
  <div class="entryBanner_content">
    <div class="row column">
      <?php the_title( '<h1 class="entry-title entryBanner_title">', '</h1>' ); ?>
      <div class="entryIntro">Brandywine Oak Private Wealth</div>
      <div class="contact" style="display: flex;">
        <?php if($address): ?>
          <div class="contact_block">
            <?= $address; ?>
            <?php if($extra): ?>
              <div class="sub_contact_block">
                <?= $extra; ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <div class="contact_block">
          <?php if($phone): ?>
            P: <?= $phone ?><br>
          <?php endif; ?>
          <?php if($email): ?>
            E: <a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a> <br>
          <?php endif; ?>
          <?php if($team_list): ?>
            <a href="<?php echo antispambot( $team_list ); ?>">Full Team Contact List</a> <br>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="entryBanner_nav">
    <a href="#" class="entryBanner_more" data-js-component="bannerScroll"><span>More</span></a>
  </div>
</header><!-- .entry-header -->
