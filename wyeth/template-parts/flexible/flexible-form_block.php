<?php
  // Field Definitions
  $code      = get_sub_field('form_shortcode');
  $watermark = get_sub_field('watermark');

  if($watermark) {
    $w_class = ' watermark watermark--'.$watermark[0]['watermark'].' watermark--'.$watermark[0]['size'].' watermark--main';
    $w_style = 'background-position: '.$watermark[0]['watermark_x'].'% '.$watermark[0]['watermark_y'].'%;';
  } else {
    $w_class = '';
    $w_style = '';
  }
?>
<div class="contentBlock contentBlock--form contentBlock--main<?= $w_class ?>" style="<?= $w_style ?>">
  <div class="row column">
    <h2>Required fields are identified with an asterisk (*).</h2>
    <?php
      if($code) {
        echo do_shortcode($code);
      }
    ?>
  </div>
</div>
