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

  get_header('special');
  while ( have_posts() ) : the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php include(locate_template('template-parts/shared/banner.php', false, false )); ?>

  <div class="entry-content">

    <section id="typical-client">

      <style>
        @media (min-width: 685px) {
            .qualities {
                display: flex;
                gap: 2.1rem;
            }
        }

        .qualities p:before {
            content: "";
            display: block;
            margin: 0 auto 1.25rem;
            width: 3.0517578125rem;
            height: 3.0517578125rem;
            background-image: url(https://brandywineoak.15eastcreative.com/wp-content/uploads/2022/02/circle-check-brandywine-oak.png);
            background-size: 100% auto;
            background-position: center;
            background-repeat: no-repeat;
        }

        .dark {
            background-color: hsl(218deg 35% 24%);
            color: white;
        }

        #typical-client h2+p {
            font-size: 1.3rem;
        }

        .dark h2 {
            color: white;
        }

        #typical-client section {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding: 4rem 1rem 2.6rem;
        }

        #typical-client p {
            max-width: 90ch;
        }

        #typical-client h2 {
            font-size: 2.6rem;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        #typical-client a {
            color: white;
            text-decoration: underline;
        }

        #typical-client button {
            background-color: white;
            padding: 1.1rem;
            margin-top: 0.7rem;
            transition: 0.3s;
            margin-bottom: 1.8rem;
        }

        #typical-client button:hover {
            transform: scale(1.05);
        }

        #typical-client button:active {
            background-color: hsl(0deg 6% 83%);
        }

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
            font-family: "Gotham A", "Gotham B", "Arial", Sans-Serif;
            animation-duration: 15s;
            animation-iteration-count: infinite;
        }

        .carousel p:nth-of-type(1) {
            animation-name: fadeinandout1;
        }

        .carousel p:nth-of-type(2) {
            animation-name: fadeinandout2;
        }

        .carousel p:nth-of-type(3) {
            animation-name: fadeinandout3;
        }

        @keyframes fadeinandout1 {
            0% {
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            23% {
                opacity: 1;
            }

            33% {
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
        }

        @keyframes fadeinandout2 {
            0% {
                opacity: 0;
            }

            33% {
                opacity: 0;
            }

            43% {
                opacity: 1;
            }

            56% {
                opacity: 1;
            }

            66% {
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
        }

        @keyframes fadeinandout3 {
            0% {
                opacity: 0;
            }

            66% {
                opacity: 0;
            }

            76% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
        section#carousel {
            padding-bottom: 8rem;
        }
        td {
            padding: 0.2rem 1.3rem 0.2rem 0.2rem;
        }
        thead {
          font-weight: bold;
        }
      </style>

      <section>
        <h2>Who is a typical Brandywine Oak Private Wealth&nbsp;client?</h2>
        <p>
          Our typical client is someone age 50+ with $2.5 million of investable liquid assets, 
          who personally achieved financial success from years of hard work, 
          sacrifice, and a high savings rate throughout their professional career.
        </p>
        <div class="qualities">
          <p>Prefer to delegate to an expert so you can go out and enjoy&nbsp;retirement</p>
          <p>Want to know your spouse will be in not just good, but great&nbsp;hands</p>
          <p>Value having a “certainty of outcome” over “beating the&nbsp;market”</p>
        </div>
      </section>

      <div class="dark">
        <section>
          <h2>Getting Started</h2>
          <p>
            Our services start by completing a set of online
            <a href="/pre-meeting">Pre-Meeting Questions</a>. Once we 
            receive your completed questionnaire, we will reach out to 
            schedule an 15-minute introductory phone call.
          </p>
          <a href="/pre-meeting">
            <button>Start Pre-Meeting Questions</button>
          </a>
        </section>
      </div>

      <section style="padding-bottom: 4.4rem;">
        <h2>How We Charge</h2>
        <img src="/wp-content/uploads/2023/09/fee-schedule.png" 
          alt="Brandywine Oak Private Wealth Fee Schedule"
        >
      </section>

    </section>

    <section class="dark" id="carousel">
      <div class="carousel">
        <p>
          Successful investing is singles and doubles, not home runs. Wealthy
          families hire our firm to manage their wealth responsibly and not
          swing for the fences.
        </p>
        <p>
          We feel the more a family plans, the more the family will keep. In our
          experience it is far better to prepare than it is to repair.
        </p>
        <p>
          Investments are generally a matter of opinion around what the market may or may not do. Taxes are a matter of fact; not a tip from some stockbroker.
        </p>
      </div>
    </section>
    <!-- End of Carousel -->

    </div>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->

<?php
  endwhile; // End of the loop.
  get_footer();
