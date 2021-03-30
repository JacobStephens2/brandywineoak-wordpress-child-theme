<?php
  // Field Definitions
  $title = get_sub_field('title');
  $grid_items = get_sub_field('grid_items');
  $watermark = get_sub_field('watermark');

  if($watermark) {
    $w_class = ' watermark watermark--'.$watermark[0]['watermark'].' watermark--'.$watermark[0]['size'].' watermark--alt';
    $w_style = 'background-position: '.$watermark[0]['watermark_x'].'% '.$watermark[0]['watermark_y'].'%;';
  } else {
    $w_class = '';
    $w_style = '';
  }
?>
<div class="logoBlocks<?= $w_class ?>" style="<?= $w_style ?>">
  <div class="row column">
    <h2><?= $title ?></h2>
    <div class="grid-x grid-margin-x">
      <?php foreach($grid_items as $grid_item): ?>
        <div class="cell small-12 medium-6 logoBlock_item expander" data-js-component="expander">
          <div class="logoBlock_title expander_title">
            <a href="<?= $grid_item['link'] ?>" target="_blank">
              <img src="<?= $grid_item['logo'] ?>" alt="<?= $grid_item['title'] ?>" style="width:<?= $grid_item['logo_width'] ?>%;">
            </a>
          </div>
          <div class="logoBlock_content expander_content">
            <?= $grid_item['content'] ?>
            <a href="<?= $grid_item['link'] ?>" class="logoBlock_link" target='_blank'>Partner Site</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
