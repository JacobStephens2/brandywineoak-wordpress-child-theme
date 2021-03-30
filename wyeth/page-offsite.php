<?php
/**
 * Template Name: Offsite Link
 * @package Wyeth
 */
  while ( have_posts() ) : the_post();
    $location = get_field('offsite_url');
    header('location:'.$location);
  endwhile;
?>
