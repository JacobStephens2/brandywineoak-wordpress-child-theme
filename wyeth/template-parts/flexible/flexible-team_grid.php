<?php
  // Field Definitions
  $watermark = get_sub_field('watermark');

  if($watermark) {
    $w_class = ' watermark watermark--'.$watermark[0]['watermark'].' watermark--'.$watermark[0]['size'].' watermark--alt';
    $w_style = 'background-position: '.$watermark[0]['watermark_x'].'% '.$watermark[0]['watermark_y'].'%;';
  } else {
    $w_class = '';
    $w_style = '';
  }
?>
<div class="teamGrid<?= $w_class ?>" style="<?= $w_style ?>">
  <div class="row column">
    <div class="grid-x grid-margin-x">
      <?php
        $args = array( 'post_type' => 'person', 'posts_per_page' => 1000 );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
          include(locate_template('template-parts/listings/listing-person.php', false, false ));
        endwhile;
        wp_reset_query();
      ?>
    </div>
  </div>
</div>
