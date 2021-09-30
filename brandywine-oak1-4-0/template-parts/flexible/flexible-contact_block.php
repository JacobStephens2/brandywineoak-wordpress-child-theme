<?php
  // Field Definitions
  $title           = get_sub_field('title');
  $main_content    = get_sub_field('main_content');

?>
<div class="contentBlock--main">
  <div class="row column contact-block-title">
    <h2><?= $title ?></h2>
    <div class="grid-x grid-margin-x grid-margin-y contentBlock_content">
      <div class="cell small-12 medium-12 large-10 contentBlock_contentMain">
        <?= $main_content ?>
      </div>
    </div>
  </div>
</div>
