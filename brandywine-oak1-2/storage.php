<!-- from bottom of page-home.php of child theme -->
<div id="video-box">
  <div class="snapshot-desktop">
     <div class="video-thumb"><a href="#" onclick="lightbox_open();"><img src="<?php echo get_template_directory_uri(); ?>/img/video_thumbnail.png"></a></div>
     <div class="video-message"><p>Learn more about Brandywine Oak from our founders</p></div> 
  </div>
  <div class="snapshot-mobile"><a href="#" onclick="lightbox_open();"><img src="<?php echo get_template_directory_uri(); ?>/img/video_link.png"></a></div>
</div><!--/ video snapshot -->
<div id="main-video">
   <span class="close-window" onclick="lightbox_close();">X</span>
    <video id="video-content" width="100%" controls>
    <source src="<?php echo get_site_url(); ?>/wp-content/uploads/2019/12/BrandyWineOak_191029.mp4" type="video/mp4">
    </video>
</div>

<div id="video-box-2">
  <div class="snapshot-desktop">
     <!-- <div class="video-thumb"><a href="#" onclick="lightbox_open();"><img src="<?php echo get_template_directory_uri(); ?>/img/video_thumbnail.png"></a></div> -->
     <div class="video-message">
      <p>
      <ul>
      <!-- // Define our WP Query Parameters -->
      <?php $the_query = new WP_Query( 'posts_per_page=1' ); ?>
      
      <!-- // Start our WP Query -->
      <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
      
      <!-- // Display the Post Title with Hyperlink -->
      <p><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
      
      <!-- // Display the Post Excerpt -->
      <!-- <li><?php the_excerpt(__('(more…)')); ?></li> -->
      
      <!-- // Repeat the process and reset once it hits the limit -->
      <?php 
      endwhile;
      wp_reset_postdata();
      ?>
      </ul>
      </p>
     </div> 
  </div>

  <div class="snapshot-mobile"><a href="#" onclick="lightbox_open();"><img src="<?php echo get_template_directory_uri(); ?>/img/video_link.png"></a></div>
</div>

<!--/ video snapshot -->
<div id="main-video">
   <span class="close-window" onclick="lightbox_close();">X</span>
    <video id="video-content" width="100%" controls>
    <source src="<?php echo get_site_url(); ?>/wp-content/uploads/2019/12/BrandyWineOak_191029.mp4" type="video/mp4">
    </video>
</div>