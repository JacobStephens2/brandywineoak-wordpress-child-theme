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
  <style>
    article#post-1535 .entryBanner {
        height: 46vh;
    }
    article#post-1535 h1 {
        font-size: 4rem;
        position: relative;
        top: -0.1rem;
    }
    article#post-1535 h1 {
      font-size: 4rem;
      position: relative;
      top: 3.9rem;
      font-family: 'Baskerville','Gerogia', Serif;
      text-transform: initial;
	  font-weight: 400;
    }
    .core-content {
      max-width: 1300px;
      margin-left: auto;
      margin-right: auto;
      padding: 1.4rem;
    }
    input[type="text"] {
        color: black !important;
        text-transform: none !important;
        font-size: 1rem !important;
    }
    .entryBanner_content .row {
        top: 20vh;
    }
    @media (min-width: 937px) {
      .entryBanner_content .row {
          top: 34vh;
      }
	  article#post-1535 h1 {
		top: -4rem;
	  }
    }
    div.wpforms-container-full .wpforms-form textarea.wpforms-field-medium {
        height: 120px;
        color: black !important;
    }
    form#wpforms-form-1534 h2 {
        font-size: 1.7rem;
        margin-bottom: 0.4rem;
        margin-top: 0.4rem;
    }
    textarea.wpforms-field-medium {
        border-top: solid 2px rgb(178, 173, 150) !important;
    }
    div.wpforms-container-full .wpforms-form textarea.wpforms-field-medium {
        text-transform: none !important;
        font-size: 0.9rem !important;
    }
  </style>

  <?php include(locate_template('template-parts/shared/banner.php', false, false )); ?>

  <div class="entry-content">

    <div class="core-content">
      <p>Prior to setting a complimentary introductory conversation, we ask that you complete the questions below. They help you identify goals and help us put together an accurate proposal for you. Plan on about 10 - 15 minutes to answer these questions. After we receive your submission, we will contact you to schedule a meeting.</p>
      <p>Note: This is a secure form. Information submitted to us through this form is kept confidential. We do not ask for personal information such as date of birth or account details.</p>
      <?php echo do_shortcode('[wpforms id="1534"]'); ?>
    </div>

  </div>

<script>
  
var introElement = document.querySelector('#wpforms-1534-field_19-container');
var header = document.createElement('h2');
header.innerText = 'Basics';
introElement.prepend(header);

var introElement = document.querySelector('#wpforms-1534-field_23-container');
var header = document.createElement('h2');
header.innerText = 'Company Benefits';
introElement.prepend(header);

var introElement = document.querySelector('#wpforms-1534-field_24-container');
var header = document.createElement('h2');
header.innerText = 'Real Estate and Mortgages';
introElement.prepend(header);

var introElement = document.querySelector('#wpforms-1534-field_27-container');
var header = document.createElement('h2');
header.innerText = 'Investments';
introElement.prepend(header);

var introElement = document.querySelector('#wpforms-1534-field_33-container');
var header = document.createElement('h2');
header.innerText = 'Insurance';
introElement.prepend(header);

var introElement = document.querySelector('#wpforms-1534-field_37-container');
var header = document.createElement('h2');
header.innerText = 'Retirement Readiness';
introElement.prepend(header);

var introElement = document.querySelector('#wpforms-1534-field_41-container');
var header = document.createElement('h2');
header.innerText = 'Estate Planning';
introElement.prepend(header);

var introElement = document.querySelector('#wpforms-1534-field_44-container');
var header = document.createElement('h2');
header.innerText = 'Life Transition';
introElement.prepend(header);

var introElement = document.querySelector('#wpforms-1534-field_17-container');
var header = document.createElement('h2');
header.innerText = 'Tax Planning';
introElement.prepend(header);
	
var subTitle = document.createElement('div');
subTitle.innerText = "Please share any additional information related to your goals or areas where you are hoping we can assist.";
subTitle.classList.add("wpforms-field-description");
var otherGoalsLabel = document.createElement('label');
otherGoalsLabel.innerText = "Other Goals";
otherGoalsLabel.classList.add("wpforms-field-label");
var otherGoals = document.querySelector("#wpforms-1534-field_22-container");
otherGoals.prepend(subTitle);
otherGoals.prepend(otherGoalsLabel);

</script>

</article><!-- #post-<?php the_ID(); ?> -->

<?php
  endwhile; // End of the loop.
  get_footer();
