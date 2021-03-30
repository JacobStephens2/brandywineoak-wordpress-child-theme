<div class="small-12 cell postCard">
  <div class="postCard_inner">
    <div class="postCard_meta"><?= get_the_date( 'F j, Y' ) ?></div>
    <h2 class="postCard_title">
      <a href="<?php the_permalink() ?>">
        <?php the_title() ?>
      </a>
    </h2>
  </div>
</div>