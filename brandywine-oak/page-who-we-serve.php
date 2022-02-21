<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wyeth
 */

  get_header();
  while ( have_posts() ) : the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php include(locate_template('template-parts/shared/banner.php', false, false )); ?>

  <div class="entry-content">
    <div class="contentBlock contentBlock--main" style="">
      <div class="row column">
        <h2>Our Solution</h2>
        <div class="contentBlock_intro">
          <p>
            Specializing in solutions for corporate executives, both active and
            retired, Brandywine Oak builds multi-generational relationships by
            helping wealthy families simplify their financial decision-making
            through comprehensive strategies that focus on intentional goals.
          </p>
        </div>
        <div class="grid-x grid-margin-x grid-margin-y contentBlock_content">
          <div class="cell small-12 medium-7 large-8 contentBlock_contentMain">
            <p>
              We will show you a &#8220;simple approach to a complex business&#8221; through
              the education necessary to alleviate any anxiety over financial
              decision-making, while enabling you to better experience the rewards
              of your wealth.
            </p>
            <p>
              Helping you to maximize your family&#8217;s enjoyment and financial
              well-being now and in the future is a critical part of our service.
            </p>
          </div>
          <div
            class="cell small-12 medium-5 large-4 contentBlock_contentSidebar"
          ></div>
        </div>
      </div>
    </div>

<style>
.carousel {
  display: grid;
}
.carousel p {
    font-size: 27px;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
    grid-column: 1;
    grid-row: 1;
    text-align: center;
    padding: 9rem 1rem 0;
    font-family: "Gotham A","Gotham B","Arial",Sans-Serif;
}
.slide-1 {
  animation-name: fadeinandout1;
  animation-duration: 15s;
  animation-iteration-count: infinite;
}
.slide-2 {
  animation-name: fadeinandout2;
  animation-duration: 15s;
  animation-iteration-count: infinite;
}
.slide-3 {
  animation-name: fadeinandout3;
  animation-duration: 15s;
  animation-iteration-count: infinite;
}
@keyframes fadeinandout1 {
  0% { opacity: 0; }
  10% { opacity: 1; }
  23% { opacity: 1; }
  33% { opacity: 0; }
  100% { opacity: 0; }
}
@keyframes fadeinandout2 {
  0% { opacity: 0; }
  33% { opacity: 0; }
  43% { opacity: 1; }
  56% { opacity: 1; }
  66% { opacity: 0; }
  100% { opacity: 0; }
}
@keyframes fadeinandout3 {
  0% { opacity: 0; }
  66% { opacity: 0; }
  76% { opacity: 1; }
  90% { opacity: 1; }
  100% { opacity: 0; }
}
</style>

    <div class="carousel">
      <p class="slide-1">
        Successful investing is singles and doubles, not home runs. Wealthy
        families hire our firm to manage their wealth responsibly and not
        swing for the fences.
      </p>
      <p class="slide-2">
        We feel the more a family plans, the more the family will keep. In our
        experience it is far better to prepare than it is to repair.
      </p>
      <p class="slide-3">
        The biggest void for families in investment advice is being
        intentional around their finances. The conversation in our view has to
        be around cash flow and lifestyle rather than short-term performance
        and market commentary.
      </p>
    </div>

    </div>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->

<?php
  endwhile; // End of the loop.
  get_footer();
