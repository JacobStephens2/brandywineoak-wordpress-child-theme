<?php
  // Field Definitions
  $slides = get_sub_field('slides');
  $watermark = get_sub_field('watermark');

  if($watermark) {
    $w_class = ' watermark watermark--'.$watermark[0]['watermark'].' watermark--'.$watermark[0]['size'].' watermark--alt';
    $w_style = 'background-position: '.$watermark[0]['watermark_x'].'% '.$watermark[0]['watermark_y'].'%;';
  } else {
    $w_class = '';
    $w_style = '';
  }
?>
<div class="textSlideshow_block<?= $w_class ?>" style="<?= $w_style ?>">
  <div class="row column">
    <div class="textSlideshow" data-js-component="textSlideshow">
      <?php foreach($slides as $slide): ?>
        <div class="textSlideshow_slide">
          <p><?= $slide['slide_text']; ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
