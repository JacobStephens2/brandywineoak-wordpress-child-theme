<?php
  // Field Definitions
  $style           = (get_sub_field('style') == 'navy') ? 'main' : 'alt';
  $title           = get_sub_field('title');
  $introduction    = get_sub_field('introduction');
  $main_content    = get_sub_field('main_content');
  $sidebar_content = get_sub_field('sidebar_content');
  $watermark       = get_sub_field('watermark');

  if($watermark) {
    $w_class = ' watermark watermark--'.$watermark[0]['watermark'].' watermark--'.$watermark[0]['size'].' watermark--'.$style;
    $w_style = 'background-position: '.$watermark[0]['watermark_x'].'% '.$watermark[0]['watermark_y'].'%;';
  } else {
    $w_class = '';
    $w_style = '';
  }
?>
<div class="contentBlock contentBlock--<?= $style ?><?= $w_class ?>" style="<?= $w_style ?>">
  <div class="row column">
    <h2><?= $title ?></h2>
    <div class="contentBlock_intro">
      <?= $introduction ?>
    </div>
    <div class="grid-x grid-margin-x grid-margin-y contentBlock_content">
      <div class="cell small-12 medium-7 large-8 contentBlock_contentMain">
        <?= $main_content ?>
      </div>
      <div class="cell small-12 medium-5 large-4 contentBlock_contentSidebar">
        <?= $sidebar_content ?>
      </div>
    </div>
  </div>
</div>
