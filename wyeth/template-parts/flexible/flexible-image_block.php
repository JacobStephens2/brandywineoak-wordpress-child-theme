<?php
  // Field Definitions
  $large_image = get_sub_field('large_image');
  $small_image = get_sub_field('small_image');
?>
<div class="imageGrid">
  <div class="grid-x grid-margin-x">
    <div class="cell small-12 medium-6 large-7 show-for-medium imageGrid_large" style="background-image:url(<?= $large_image ?>)"></div>
    <div class="cell small-12 medium-6 large-5 imageGrid_small" style="background-image:url(<?= $small_image ?>)"></div>
  </div>
</div>
