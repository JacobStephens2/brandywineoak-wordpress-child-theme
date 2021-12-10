<?php
  // Field Definitions
  $image       = get_field('person_image');
  $name        = get_field('person_name');
  $credentials = get_field('person_credentials');
  $job_titles  = get_field('job_titles');
?>
<div class="cell small-12 small-medium-10 small-medium-offset-1 large-6 large-offset-0 teamCard">
  <a href="<?= get_permalink() ?>" class="teamCard_link">
    <div class="grid-x grid-margin-x">
      <div class="cell small-4">
        <div class="teamCard_image" style="background-image:url(<?= $image ?>)"></div>
      </div>
      <div class="cell small-8 teamCard_content">
        <h3 class="teamCard_name"><?= $name ?><?php if($credentials) echo ", ".$credentials; ?></h3>
        <?php if($job_titles): ?>
          <div class="teamCard_title">
            <?php
              foreach($job_titles as $key=>$title) {
                echo $title['text'];
                if($key+1 < count($job_titles)) {
                  echo " | ";
                }
              }
            ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </a>
</div>
