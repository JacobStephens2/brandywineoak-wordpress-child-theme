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
          color: #B2AD96;
        }
        .dark h2 {
          color: #B2AD96;
        }
        #typical-client section {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding: 4rem 1rem 2.6rem;
        }
        #typical-client p {
          max-width: 80ch;
        }
        #typical-client h2 {
            font-size: .8125rem;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        #typical-client a {
            color: #B2AD96;
            text-decoration: underline;
        }   
        #typical-client button {
            background-color: #B2AD96;
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
        .dark p {
            color: #B2AD96;
        }
      </style>
		
      <div class="dark">
        <section>
          <div class="row column">
              <h2>TAX ADVISORY SERVICES </h2>
              <div class="contentBlock_intro">
                <p>Tax laws are complicated and constantly changing. Brandywine Oak’s Private Tax Advisory team of professionals is here to help make sense of the everchanging landscape. If not properly planned for, unnecessary taxes can erode your hard-earned savings and investments.</p>
                <p>At Brandywine Oak Private Tax Advisory, we believe the best way to serve families is to continuously collaborate with your wealth advisor to consider the tax impact of all financial decisions. Using your family wealth plan as a guide, we employ a wide variety of tax planning strategies, so you keep more of what you have earned.</p>
              </div>
              <div class="grid-x grid-margin-x grid-margin-y contentBlock_content">
                <div class="cell small-12 medium-7 large-8 contentBlock_contentMain">
                  <h2 class="subhead first">Tax Preparation Services</h2>
                  <p class="tax-paragraph">Our experienced team of tax professionals work alongside your wealth advisor to prepare and file your annual tax returns. We are well-versed in preparing a variety of returns&nbsp;including:</p>
                  <ul>
                  <li>Individual</li>
                  <li>Fiduciary</li>
                  <li>Gift Tax</li>
                  <li>Partnership</li>
                  <li>Corporate</li>
                  </ul>
                  <p class="tax-paragraph">Our tax professionals can also provide the following&nbsp;services:</p>
                  <ul>
                  <li>Entity Selection</li>
                  <li>Audit Defense &amp; Tax&nbsp;Controversy</li>
                  <li>Tax Scenario Analysis</li>
                  <li>Business Transaction Planning</li>
                  <li>State Residency &amp; Domicile&nbsp;Planning</li>
                  </ul>
                </div>
                <div class="cell small-12 medium-5 large-4 contentBlock_contentSidebar">
                  <p>Christopher Smith leads our Private Tax Advisory business and specializes in the tax complexities of navigating significant&nbsp;wealth</p>
                  <h2 class="subhead tax-education">Education/Experience:</h2>
                  <ul>
                  <li>Certified Public Accountant&nbsp;(CPA)</li>
                  <li>Member of AICPA</li>
                  <li>Member of DSCPA</li>
                  <li>In-depth experience working alongside Brandywine Oak wealth advisors for over a&nbsp;decade</li>
                  </ul>
                </div>
              </div>
            </div>
        </section>
      </div>

		
    </section>

    <section id="carousel">
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
