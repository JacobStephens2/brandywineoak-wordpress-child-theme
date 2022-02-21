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
    
    <div
      class="textSlideshow slick-initialized slick-slider slick-dotted"
      data-js-component="textSlideshow"
    >
      <div class="slick-list draggable">
        <div
          class="slick-track"
          style="
            opacity: 1;
            width: 5803px;
            transform: translate3d(-2487px, 0px, 0px);
          "
        >
          <div
            class="textSlideshow_slide slick-slide slick-current slick-active"
            data-slick-index="2"
            aria-hidden="false"
            tabindex="0"
            role="tabpanel"
            id="slick-slide02"
            aria-describedby="slick-slide-control02"
            style="width: 829px"
          >
            <p>
              Successful investing is singles and doubles, not home runs. Wealthy
              families hire our firm to manage their wealth responsibly and not
              swing for the fences.
            </p>
          </div>
          <div
            class="textSlideshow_slide slick-slide slick-cloned"
            data-slick-index="3"
            aria-hidden="true"
            tabindex="-1"
            style="width: 829px"
          >
            <p>
              We feel the more a family plans, the more the family will keep. In our
              experience it is far better to prepare than it is to repair.
            </p>
          </div>
          <div
            class="textSlideshow_slide slick-slide slick-cloned"
            data-slick-index="4"
            aria-hidden="true"
            tabindex="-1"
            style="width: 829px"
          >
            <p>
              The biggest void for families in investment advice is being
              intentional around their finances. The conversation in our view has to
              be around cash flow and lifestyle rather than short-term performance
              and market commentary.
            </p>
          </div>
          <div
            class="textSlideshow_slide slick-slide slick-cloned"
            data-slick-index="5"
            aria-hidden="true"
            tabindex="-1"
            style="width: 829px"
          >
            <p>
              Successful investing is singles and doubles, not home runs. Wealthy
              families hire our firm to manage their wealth responsibly and not
              swing for the fences.
            </p>
          </div>
        </div>
      </div>

      <ul class="slick-dots" role="tablist" style="">
        <li class="" role="presentation">
          <button
            type="button"
            role="tab"
            id="slick-slide-control00"
            aria-controls="slick-slide00"
            aria-label="1 of 3"
            tabindex="-1"
          >
            1
          </button>
        </li>
        <li role="presentation" class="">
          <button
            type="button"
            role="tab"
            id="slick-slide-control01"
            aria-controls="slick-slide01"
            aria-label="2 of 3"
            tabindex="-1"
          >
            2
          </button>
        </li>
        <li role="presentation" class="slick-active">
          <button
            type="button"
            role="tab"
            id="slick-slide-control02"
            aria-controls="slick-slide02"
            aria-label="3 of 3"
            tabindex="0"
            aria-selected="true"
          >
            3
          </button>
        </li>
      </ul>
    </div>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->

<?php
  endwhile; // End of the loop.
  get_footer();
