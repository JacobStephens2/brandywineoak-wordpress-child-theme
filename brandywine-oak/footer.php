<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wyeth
 */
  $watermark = get_field('footer_watermark',$post->ID);
  if($watermark) {
    $w_class = ' watermark watermark--'.$watermark[0]['watermark'].' watermark--'.$watermark[0]['size'].' watermark--alt';
    $w_style = 'background-position: '.$watermark[0]['watermark_x'].'% '.$watermark[0]['watermark_y'].'%;';
  } else {
    $w_class = '';
    $w_style = '';
  }
?>
      </main><!-- #main -->
    </div><!-- #primary -->
	</div><!-- #content -->

	<footer class="globalFooter<?= $w_class ?>" style="<?= $w_style ?><?= (is_front_page() ? 'background-color: #283854;' : '') ?>">
    <div class="row column">
      <div class="grid-x">
        <?php if(is_front_page()): ?>
          <style>
            .disclosure{color: #b2ad96;}
            .disclosure a{color: #b2ad96;}
            .disclosure a:hover{color: #fff;}
            .legalMenu a{color: #b2ad96;}
            .legalMenu a:hover{color: #fff;}
          </style>
          <div class="disclosure" ><?= get_field('home_disclosure','options') ?></div>
        <?php endif; ?>
        <div class="cell small-12 medium-6 small-order-1 medium-order-2">
          <nav class="legalNav">
            <ul class="legalMenu">

              <li><a href="https://www.linkedin.com/company/brandywine-oak-private-wealth/" target="_blank" >LinkedIn</a></li>
              <li><a href="https://brokercheck.finra.org/" target="_blank" >BrokerCheck</a></li>
              <li><a href="/privacy-policy">Privacy Policy</a></li>

              <!-- Link to Form CRS on homepage only -->
              <?php 
                if( is_front_page()) {
                  ?>
                  <li>
                    <a href='/wp-content/uploads/2023/09/Brandywine-Oak-Form-CRS-September-2023.pdf'>
                      Form CRS
                    </a>
                  </li>
                  <?php
                }
              ?>

              <!-- show disclosure in footer -->
              <?php get_field('disclosure_download', 'options') ?>         
                <li><a href="<?= get_field('disclosure_download','options') ?>">Disclosure</a></li>

              <!-- Next -->
              <?php
                wp_nav_menu( array(
                  'container'      => '',
                  'items_wrap'     => '%3$s',
                  'menu_class'     => 'legalMenu',
                  'theme_location' => 'legal',
                ) );
              ?>
            </ul>
          </nav>
        </div>
        <div class="cell small-12 medium-6 medium-order-1 small-order-2">
			<p style="<?= (is_front_page() ? 'color: #b2ad96;' : '') ?>">&copy; Brandywine Oak Private Wealth <?= date('Y') ?>. All rights reserved.</p>
        </div>
      </div>
    </div>
	</footer>

</div><!-- #page -->


<?php wp_footer(); ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>