<?php
  // Field Definitions
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
<div class="textBlocks<?= $w_class ?>" style="<?= $w_style ?>">
  <div class="row column">
  <div class="row column">
    <div class="grid-x grid-margin-x">
      <?php foreach($grid_items as $grid_item): ?>
        <?php if($grid_item['image']): ?>
          <div class="cell small-12 medium-6 textBlock_item textBlock_item--image">
            <div class="textBlock_image" style="background-image:url(<?= $grid_item['image'] ?>)"></div>
          </div>
        <?php else: ?>
          <div class="cell small-12 medium-6 textBlock_item expander" data-js-component="expander">
            <h3 class="textBlock_title expander_title"><?= $grid_item['title'] ?></h3>
            <div class="textBlock_content expander_content">
              <?= $grid_item['content'] ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
