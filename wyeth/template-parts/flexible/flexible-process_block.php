<?php
  // Field Definitions
  $title         = get_sub_field('title');
  $process_steps = get_sub_field('process_steps');
  $watermark = get_sub_field('watermark');

  if($watermark) {
    $w_class = ' watermark watermark--'.$watermark[0]['watermark'].' watermark--'.$watermark[0]['size'].' watermark--alt';
    $w_style = 'background-position: '.$watermark[0]['watermark_x'].'% '.$watermark[0]['watermark_y'].'%;';
  } else {
    $w_class = '';
    $w_style = '';
  }
?>
<div class="processBlock<?= $w_class ?>" style="<?= $w_style ?>">
  <div class="row column">
    <h2><?= $title ?></h2>
    <div class="processBlock_wrap clearfix">
      <?php foreach($process_steps as $key=>$step): ?><div class="processBlock_item">
        <div class="processBlock_inner">
          <div class="processBlock_number"><?= $key+1 ?></div>
          <h3 class="processBlock_title"><?= $step['step_content'] ?></h3>
        </div>
      </div><?php endforeach; ?>
    </div>
  </div>
</div>
