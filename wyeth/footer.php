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
				
              <?php if(! is_front_page() && get_field('disclosure_download','options')): ?>
                <li><a href="<?= get_field('disclosure_download','options') ?>">Disclosure</a></li>
              <?php endif; ?>
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
</body>
</html>