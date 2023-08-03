<?php
/**
 * Wyeth functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wyeth
 */

if ( ! function_exists( 'wyeth_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */

  function wyeth_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Wyeth, use a find and replace
     * to change 'wyeth' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'wyeth', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Excerpts on pages.
     *
     */
    add_post_type_support( 'page', 'excerpt' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
      'primary' => esc_html__( 'Primary', 'wyeth' ),
      'legal' => esc_html__( 'Legal', 'wyeth' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'wyeth_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support( 'custom-logo', array(
      'height'      => 250,
      'width'       => 250,
      'flex-width'  => true,
      'flex-height' => true,
    ) );
  }
endif;
add_action( 'after_setup_theme', 'wyeth_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wyeth_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'wyeth_content_width', 640 );
}
add_action( 'after_setup_theme', 'wyeth_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function wyeth_scripts() {
  wp_enqueue_style( 'wyeth-style', get_template_directory_uri() . '/app.css' );
  wp_enqueue_script( 'wyeth-jquery', get_template_directory_uri() . '/js/dist/scripts.js', array(), time(), true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'wyeth_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
  require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Register Custom Post Types
 */
function wyeth_create_post_types() {
  register_post_type( 'person',
    array(
      'labels' => array(
        'name' => __( 'People' ),
        'singular_name' => __( 'Person' )
      ),
      'menu_icon'=>'dashicons-groups',
      'public' => true,
      'publicly_queryable' => true,
      'hierarchical' => false,
      'has_archive' => false,
      'query_var' => true,
      'rewrite' => array(
         'slug' => 'about-our-firm/our-team',
         'with_front' => false
      ),
      'supports' => array( 'title', 'editor' ),
    )
  );
}
add_action( 'init', 'wyeth_create_post_types' );

/**
 * Nest all images in figure tag
 */
add_filter( 'image_send_to_editor',
  function( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
    if( current_theme_supports( 'html5' )  && ! $caption )
      $html = sprintf( '<figure>%s</figure>', $html ); // Modify to your needs!
      return $html;
  }
, 10, 8 );

function returnNull() {
  return null;
}

/**
 * Remove Search
 */
function wpb_filter_query( $query, $error = true ) {
  if ( is_search() ) {
    $query->is_search = false;
    $query->query_vars[s] = false;
    $query->query[s] = false;
    if ( $error == true )
      $query->is_404 = true;
    }
}

add_action( 'parse_query', 'wpb_filter_query' );
add_filter( 'get_search_form', 'returnNull' );

function remove_search_widget() {
  unregister_widget('WP_Widget_Search');
}
add_action( 'widgets_init', 'remove_search_widget' );



add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );
function add_current_nav_class($classes, $item) {

  // Getting the current post details
  global $post;

  // Getting the post type of the current post
  $current_post_type = get_post_type_object(get_post_type($post->ID));
  $current_post_slug = $current_post_type->name;

  // If the menu item URL contains the current post types slug add the current-menu-item class
  if ($item->title == "About Our Firm" && $current_post_slug == "person") {
    $classes[] = 'current-menu-item';
  }
  if ($item->title == "News" && $current_post_slug == "person") {
    if (($key = array_search('current_page_parent', $classes)) !== false) {
      unset($classes[$key]);
    }
  }

  // Return the corrected set of classes to be added to the menu item
  return $classes;

}



/**
 * Custom Fields
 */
if( function_exists('acf_add_local_field_group') ):

  // Home Content
  acf_add_local_field_group(array(
    'key' => 'group_5b4ea41e20ed4yyy',
    'title' => 'Home Content',
    'fields' => array(
      array(
        'key' => 'field_5b4ea455758efaaa',
        'label' => 'Page Introduction',
        'name' => 'page_introduction',
        'type' => 'textarea',
        'instructions' => 'Header introductory text.',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'new_lines' => '',
      ),
      array(
        'key' => 'field_subhead',
        'label' => 'Page Subhead',
        'name' => 'page_subhead',
        'type' => 'textarea',
        'instructions' => 'Header introductory text.',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'new_lines' => '',
      ),
      array(
        'key' => 'field_5b4ea60f758f1efrg',
        'label' => 'Learn More Link',
        'name' => 'learn_more_link',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      array(
        'key' => 'field_5b4ea9effe834yhy',
        'label' => 'Text Slideshow',
        'name' => 'text_slideshow',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => '',
        'min' => 0,
        'max' => 0,
        'layout' => 'table',
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_5b4ea9fbfe835454',
            'label' => 'Slide Text',
            'name' => 'slide_text',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
        ),
      ),
      array(
        'key' => 'field_5b569fc5a82echom',
        'label' => 'Footer Watermark',
        'name' => 'footer_watermark',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => '',
        'min' => 0,
        'max' => 1,
        'layout' => 'table',
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_5b569ffca82edhom',
            'label' => 'Watermark',
            'name' => 'watermark',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'th' => 'th',
              'w' => 'w',
              'wyeth' => 'wyeth',
              'y' => 'y',
              'bo' => 'bo',
              'ico' => 'ico'
            ),
            'default_value' => array(
              0 => 'th',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
          ),
          array(
            'key' => 'field_5b56a032a82eehom',
            'label' => 'Size',
            'name' => 'size',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'full' => 'full',
              'half' => 'half',
            ),
            'default_value' => array(
              0 => 'full',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
          ),
          array(
            'key' => 'field_5b56a05ea82efhom',
            'label' => 'X Position (Percent)',
            'name' => 'watermark_x',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
          ),
          array(
            'key' => 'field_5b56a07ea82f0hom',
            'label' => 'Y Position (Percent)',
            'name' => 'watermark_y',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-home.php',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
      0 => 'the_content',
      1 => 'discussion',
      2 => 'comments',
      3 => 'categories',
      4 => 'tags',
    ),
    'active' => 1,
    'description' => '',
  ));

  // Offsite Link Content
  acf_add_local_field_group(array(
    'key' => 'group_5b4ea41e20ed4xxx',
    'title' => 'Link Content',
    'fields' => array(
      array(
        'key' => 'field_5b4ecf7daa75cxxx',
        'label' => 'Offsite URL',
        'name' => 'offsite_url',
        'type' => 'url',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-offsite.php',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
      0 => 'the_content',
      1 => 'discussion',
      2 => 'comments',
      3 => 'categories',
      4 => 'tags',
    ),
    'active' => 1,
    'description' => '',
  ));

  // Page Content
  acf_add_local_field_group(array(
    'key' => 'group_5b4ea41e20ed4',
    'title' => 'Page Content',
    'fields' => array(
      array(
        'key' => 'field_5b4ea455758ef',
        'label' => 'Page Introduction',
        'name' => 'page_introduction',
        'type' => 'textarea',
        'instructions' => 'Header introductory text.',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 4,
        'new_lines' => '',
      ),
      array(
        'key' => 'field_5b569fc5a82ecfoo',
        'label' => 'Footer Watermark',
        'name' => 'footer_watermark',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => '',
        'min' => 0,
        'max' => 1,
        'layout' => 'table',
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_5b569ffca82edfoo',
            'label' => 'Watermark',
            'name' => 'watermark',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'th' => 'th',
              'w' => 'w',
              'wyeth' => 'wyeth',
              'y' => 'y',
              'bo' => 'bo',
              'ico' => 'ico'
            ),
            'default_value' => array(
              0 => 'th',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
          ),
          array(
            'key' => 'field_5b56a032a82eefoo',
            'label' => 'Size',
            'name' => 'size',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'full' => 'full',
              'half' => 'half',
            ),
            'default_value' => array(
              0 => 'full',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
          ),
          array(
            'key' => 'field_5b56a05ea82effoo',
            'label' => 'X Position (Percent)',
            'name' => 'watermark_x',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
          ),
          array(
            'key' => 'field_5b56a07ea82f0foo',
            'label' => 'Y Position (Percent)',
            'name' => 'watermark_y',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
          ),
        ),
      ),
      array(
        'key' => 'field_5b4ea5cf758f0',
        'label' => 'Page Content',
        'name' => 'page_content',
        'type' => 'flexible_content',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layouts' => array(
          '5b4ea5db9b1b7' => array(
            'key' => '5b4ea5db9b1b7',
            'name' => 'content_block',
            'label' => 'Content Block',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b4ea668758f3',
                'label' => 'Style',
                'name' => 'style',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'choices' => array(
                  'navy' => 'Navy',
                  'white' => 'White',
                ),
                'default_value' => array(
                  0 => 'Navy',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'return_format' => 'value',
                'placeholder' => '',
              ),
              array(
                'key' => 'field_5b4ea60f758f1',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
              ),
              array(
                'key' => 'field_5b4ea61f758f2',
                'label' => 'Introduction',
                'name' => 'introduction',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 0,
                'delay' => 0,
              ),
              array(
                'key' => 'field_5b4ea6a7758f4',
                'label' => 'Main Content',
                'name' => 'main_content',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
              ),
              array(
                'key' => 'field_5b4ea6cb758f5',
                'label' => 'Sidebar Content',
                'name' => 'sidebar_content',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
              ),
              array(
                'key' => 'field_5b569fc5a82ec',
                'label' => 'Watermark',
                'name' => 'watermark',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 1,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b569ffca82ed',
                    'label' => 'Watermark',
                    'name' => 'watermark',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'th' => 'th',
                      'w' => 'w',
                      'wyeth' => 'wyeth',
                      'y' => 'y',
                      'bo' => 'bo',
                      'ico' => 'ico'
                    ),
                    'default_value' => array(
                      0 => 'th',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a032a82ee',
                    'label' => 'Size',
                    'name' => 'size',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'full' => 'full',
                      'half' => 'half',
                    ),
                    'default_value' => array(
                      0 => 'full',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a05ea82ef',
                    'label' => 'X Position (Percent)',
                    'name' => 'watermark_x',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                  array(
                    'key' => 'field_5b56a07ea82f0',
                    'label' => 'Y Position (Percent)',
                    'name' => 'watermark_y',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                ),
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          '5b4ea9142ba2c' => array(
            'key' => '5b4ea9142ba2c',
            'name' => 'image_block',
            'label' => 'Image Block',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b4ea91d2ba2d',
                'label' => 'Large Image',
                'name' => 'large_image',
                'type' => 'image',
                'instructions' => 'Hidden on Mobile Screens 1000px x 650px @ 72dpi',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
              ),
              array(
                'key' => 'field_5b4ea9632ba2e',
                'label' => 'Small Image',
                'name' => 'small_image',
                'type' => 'image',
                'instructions' => '640px x 410px @ 72dpi',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          '5b4eaa7fab350' => array(
            'key' => '5b4eaa7fab350',
            'name' => 'form_block',
            'label' => 'Form Block',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b4eaa86ab351',
                'label' => 'Form Shortcode',
                'name' => 'form_shortcode',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
              ),
              array(
                'key' => 'field_5b569fc5a82ecform',
                'label' => 'Watermark',
                'name' => 'watermark',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 1,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b569ffca82edform',
                    'label' => 'Watermark',
                    'name' => 'watermark',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'th' => 'th',
                      'w' => 'w',
                      'wyeth' => 'wyeth',
                      'y' => 'y',
                      'bo' => 'bo',
                      'ico' => 'ico'
                    ),
                    'default_value' => array(
                      0 => 'th',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a032a82eeform',
                    'label' => 'Size',
                    'name' => 'size',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'full' => 'full',
                      'half' => 'half',
                    ),
                    'default_value' => array(
                      0 => 'full',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a05ea82efform',
                    'label' => 'X Position (Percent)',
                    'name' => 'watermark_x',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                  array(
                    'key' => 'field_5b56a07ea82f0form',
                    'label' => 'Y Position (Percent)',
                    'name' => 'watermark_y',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                ),
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          '5b4ea75f25fa8' => array(
            'key' => '5b4ea75f25fa8',
            'name' => 'logo_grid',
            'label' => 'Logo Grid',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b4ea77825fa9',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
              ),
              array(
                'key' => 'field_5b4ea79a25faa',
                'label' => 'Grid Items',
                'name' => 'grid_items',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b4ea7ca25fab',
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '33',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                  ),
                  array(
                    'key' => 'field_5b4ea7db25fac',
                    'label' => 'Logo',
                    'name' => 'logo',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '33',
                      'class' => '',
                      'id' => '',
                    ),
                    'return_format' => 'url',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                  ),
                  array(
                    'key' => 'field_5b4ec88f8e3f5',
                    'label' => 'Logo Width',
                    'name' => 'logo_width',
                    'type' => 'number',
                    'instructions' => 'As percent of container.',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '33',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                  array(
                    'key' => 'field_5b4ea80d25fad',
                    'label' => 'Link',
                    'name' => 'link',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '33',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                  ),
                  array(
                    'key' => 'field_5b4ea82725fae',
                    'label' => 'Content',
                    'name' => 'content',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '66',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
                  ),
                ),
              ),
              array(
                'key' => 'field_5b569fc5a82eclogo',
                'label' => 'Watermark',
                'name' => 'watermark',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 1,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b569ffca82edlogo',
                    'label' => 'Watermark',
                    'name' => 'watermark',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'th' => 'th',
                      'w' => 'w',
                      'wyeth' => 'wyeth',
                      'y' => 'y',
                      'bo' => 'bo',
                      'ico' => 'ico'
                    ),
                    'default_value' => array(
                      0 => 'th',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a032a82eelogo',
                    'label' => 'Size',
                    'name' => 'size',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'full' => 'full',
                      'half' => 'half',
                    ),
                    'default_value' => array(
                      0 => 'full',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a05ea82eflogo',
                    'label' => 'X Position (Percent)',
                    'name' => 'watermark_x',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                  array(
                    'key' => 'field_5b56a07ea82f0logo',
                    'label' => 'Y Position (Percent)',
                    'name' => 'watermark_y',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                ),
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          '5b4eaa1fbbc7e' => array(
            'key' => '5b4eaa1fbbc7e',
            'name' => 'map_block',
            'label' => 'Map Block',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b4eaa24bbc7f',
                'label' => 'Map Embed Code',
                'name' => 'map_embed_code',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 3,
                'new_lines' => '',
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          '5b4ea85970e42' => array(
            'key' => '5b4ea85970e42',
            'name' => 'process_block',
            'label' => 'Process Block',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b4ea86e70e43',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
              ),
              array(
                'key' => 'field_5b4ea87770e44',
                'label' => 'Process Steps',
                'name' => 'process_steps',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b4ea89470e45',
                    'label' => 'Step Content',
                    'name' => 'step_content',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                  ),
                ),
              ),
              array(
                'key' => 'field_5b569fc5a82ecpro',
                'label' => 'Watermark',
                'name' => 'watermark',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 1,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b569ffca82edpro',
                    'label' => 'Watermark',
                    'name' => 'watermark',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'th' => 'th',
                      'w' => 'w',
                      'wyeth' => 'wyeth',
                      'y' => 'y',
                      'bo' => 'bo',
                      'ico' => 'ico'
                    ),
                    'default_value' => array(
                      0 => 'th',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a032a82eepro',
                    'label' => 'Size',
                    'name' => 'size',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'full' => 'full',
                      'half' => 'half',
                    ),
                    'default_value' => array(
                      0 => 'full',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a05ea82efpro',
                    'label' => 'X Position (Percent)',
                    'name' => 'watermark_x',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                  array(
                    'key' => 'field_5b56a07ea82f0pro',
                    'label' => 'Y Position (Percent)',
                    'name' => 'watermark_y',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                ),
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          '5b4ea8ca0ea1c' => array(
            'key' => '5b4ea8ca0ea1c',
            'name' => 'team_grid',
            'label' => 'Team Grid',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b569fc5a82ecteam',
                'label' => 'Watermark',
                'name' => 'watermark',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 1,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b569ffca82edteam',
                    'label' => 'Watermark',
                    'name' => 'watermark',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'th' => 'th',
                      'w' => 'w',
                      'wyeth' => 'wyeth',
                      'y' => 'y',
                      'bo' => 'bo',
                      'ico' => 'ico'
                    ),
                    'default_value' => array(
                      0 => 'th',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a032a82eeteam',
                    'label' => 'Size',
                    'name' => 'size',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'full' => 'full',
                      'half' => 'half',
                    ),
                    'default_value' => array(
                      0 => 'full',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a05ea82efteam',
                    'label' => 'X Position (Percent)',
                    'name' => 'watermark_x',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                  array(
                    'key' => 'field_5b56a07ea82f0team',
                    'label' => 'Y Position (Percent)',
                    'name' => 'watermark_y',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                ),
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          '5b4eaaba20f4a' => array(
            'key' => '5b4eaaba20f4a',
            'name' => 'text_grid',
            'label' => 'Text Grid',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b4eaac520f4b',
                'label' => 'Grid Items',
                'name' => 'grid_items',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b4eaad620f4c',
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                  ),
                  array(
                    'key' => 'field_5b4eaaeb20f4d',
                    'label' => 'Content',
                    'name' => 'content',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
                  ),
                  array(
                    'key' => 'field_5b4ea91d2ba2dasdf',
                    'label' => 'Image',
                    'name' => 'image',
                    'type' => 'image',
                    'instructions' => 'Displays instead of content.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'return_format' => 'url',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                  ),
                ),
              ),
              array(
                'key' => 'field_5b569fc5a82ectext',
                'label' => 'Watermark',
                'name' => 'watermark',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 1,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b569ffca82edtext',
                    'label' => 'Watermark',
                    'name' => 'watermark',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'th' => 'th',
                      'w' => 'w',
                      'wyeth' => 'wyeth',
                      'y' => 'y',
                      'bo' => 'bo',
                      'ico' => 'ico'
                    ),
                    'default_value' => array(
                      0 => 'th',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a032a82eetext',
                    'label' => 'Size',
                    'name' => 'size',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'full' => 'full',
                      'half' => 'half',
                    ),
                    'default_value' => array(
                      0 => 'full',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a05ea82eftext',
                    'label' => 'X Position (Percent)',
                    'name' => 'watermark_x',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                  array(
                    'key' => 'field_5b56a07ea82f0text',
                    'label' => 'Y Position (Percent)',
                    'name' => 'watermark_y',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                ),
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          '5b4ea9cdfe833' => array(
            'key' => '5b4ea9cdfe833',
            'name' => 'text_slideshow',
            'label' => 'Text Slideshow',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b4ea9effe834',
                'label' => 'Slides',
                'name' => 'slides',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b4ea9fbfe835',
                    'label' => 'Slide Text',
                    'name' => 'slide_text',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                  ),
                ),
              ),
              array(
                'key' => 'field_5b569fc5a82ecsli',
                'label' => 'Watermark',
                'name' => 'watermark',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 1,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                  array(
                    'key' => 'field_5b569ffca82edsli',
                    'label' => 'Watermark',
                    'name' => 'watermark',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'th' => 'th',
                      'w' => 'w',
                      'wyeth' => 'wyeth',
                      'y' => 'y',
                      'bo' => 'bo',
                      'ico' => 'ico'
                    ),
                    'default_value' => array(
                      0 => 'th',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a032a82eesli',
                    'label' => 'Size',
                    'name' => 'size',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'choices' => array(
                      'full' => 'full',
                      'half' => 'half',
                    ),
                    'default_value' => array(
                      0 => 'full',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                  ),
                  array(
                    'key' => 'field_5b56a05ea82efsli',
                    'label' => 'X Position (Percent)',
                    'name' => 'watermark_x',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                  array(
                    'key' => 'field_5b56a07ea82f0sli',
                    'label' => 'Y Position (Percent)',
                    'name' => 'watermark_y',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                  ),
                ),
              ),
            ),
            'min' => '',
            'max' => '',
          ),
        ),
        'button_label' => 'Add Row',
        'min' => '',
        'max' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'default',
        ),
      ),
      array(
        array(
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-contact.php',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
      0 => 'the_content',
      1 => 'discussion',
      2 => 'comments',
      3 => 'categories',
      4 => 'tags',
    ),
    'active' => 1,
    'description' => '',
  ));

  // Person Fields
  acf_add_local_field_group(array(
    'key' => 'group_5b4eb64d08623',
    'title' => 'Person Content',
    'fields' => array(
      array(
        'key' => 'field_5b4eb6b18fa07',
        'label' => 'Person Name',
        'name' => 'person_name',
        'type' => 'text',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      array(
        'key' => 'field_5b4eb70c8fa09',
        'label' => 'Job Titles',
        'name' => 'job_titles',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => '',
        'min' => 0,
        'max' => 0,
        'layout' => 'table',
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_5b4eb7228fa0a',
            'label' => 'Text',
            'name' => 'text',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
        ),
      ),
      array(
        'key' => 'field_5b4eb6e98fa08',
        'label' => 'Person Credentials',
        'name' => 'person_credentials',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '33',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      array(
        'key' => 'field_5b4eb825ebfe0',
        'label' => 'Person Email',
        'name' => 'person_email',
        'type' => 'email',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '33',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
      ),
      array(
        'key' => 'field_5b4eb832ebfe1',
        'label' => 'Person LinkedIn',
        'name' => 'person_linkedin',
        'type' => 'url',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '33',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
      ),
      array(
        'key' => 'field_5b4eb801ebfdf',
        'label' => 'Person Image',
        'name' => 'person_image',
        'type' => 'image',
        'instructions' => 'Grid Image - 800px x 570px @72dpi',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_5b4eb801ebfdfport',
        'label' => 'Person Portrait Image',
        'name' => 'person_portrait_image',
        'type' => 'image',
        'instructions' => 'Bio Image - 700px x 1000px @72dpi',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_5b569fc5a82ecpers',
        'label' => 'Watermark',
        'name' => 'watermark',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => '',
        'min' => 0,
        'max' => 1,
        'layout' => 'table',
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_5b569ffca82edpers',
            'label' => 'Watermark',
            'name' => 'watermark',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'th' => 'th',
              'w' => 'w',
              'wyeth' => 'wyeth',
              'y' => 'y',
              'bo' => 'bo',
              'ico' => 'ico'
            ),
            'default_value' => array(
              0 => 'th',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
          ),
          array(
            'key' => 'field_5b56a032a82eepers',
            'label' => 'Size',
            'name' => 'size',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'full' => 'full',
              'half' => 'half',
            ),
            'default_value' => array(
              0 => 'full',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
          ),
          array(
            'key' => 'field_5b56a05ea82efpers',
            'label' => 'X Position (Percent)',
            'name' => 'watermark_x',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
          ),
          array(
            'key' => 'field_5b56a07ea82f0pers',
            'label' => 'Y Position (Percent)',
            'name' => 'watermark_y',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'person',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
      0 => 'discussion',
      1 => 'comments',
      2 => 'format',
      3 => 'categories',
      4 => 'tags',
    ),
    'active' => 1,
    'description' => '',
  ));

  // Post Content
  acf_add_local_field_group(array(
    'key' => 'group_5b4ec9d282572',
    'title' => 'Post Content',
    'fields' => array(
      array(
        'key' => 'field_5b4ec9dae847c',
        'label' => 'Post Download',
        'name' => 'post_download',
        'type' => 'file',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'library' => 'all',
        'min_size' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_5b569fc5a82ecpost',
        'label' => 'Watermark',
        'name' => 'watermark',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => '',
        'min' => 0,
        'max' => 1,
        'layout' => 'table',
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_5b569ffca82edpost',
            'label' => 'Watermark',
            'name' => 'watermark',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'th' => 'th',
              'w' => 'w',
              'wyeth' => 'wyeth',
              'y' => 'y',
              'bo' => 'bo',
              'ico' => 'ico'
            ),
            'default_value' => array(
              0 => 'th',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
          ),
          array(
            'key' => 'field_5b56a032a82eepost',
            'label' => 'Size',
            'name' => 'size',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'full' => 'full',
              'half' => 'half',
            ),
            'default_value' => array(
              0 => 'full',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
          ),
          array(
            'key' => 'field_5b56a05ea82efpost',
            'label' => 'X Position (Percent)',
            'name' => 'watermark_x',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
          ),
          array(
            'key' => 'field_5b56a07ea82f0post',
            'label' => 'Y Position (Percent)',
            'name' => 'watermark_y',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
  ));

  // Global Content
  acf_add_local_field_group(array(
    'key' => 'group_5b4ecf535b1e5',
    'title' => 'Global Content',
    'fields' => array(
      array(
        'key' => 'field_5b4ecf7daa75c',
        'label' => 'Twitter URL',
        'name' => 'twitter_url',
        'type' => 'url',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
      ),
      array(
        'key' => 'field_5b4ecf91aa75d',
        'label' => 'LinkedIn URL',
        'name' => 'linkedin_url',
        'type' => 'url',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
      ),
      array(
        'key' => 'field_5b4ecfaaaa75e',
        'label' => 'Address',
        'name' => 'address',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 2,
        'new_lines' => 'br',
      ),
      array(
        'key' => 'field_extra',
        'label' => 'Extra',
        'name' => 'extra',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 2,
        'new_lines' => 'br',
      ),
      array(
        'key' => 'field_extraline2',
        'label' => 'Extra Line 2',
        'name' => 'extraline2',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 2,
        'new_lines' => 'br',
      ),
      array(
        'key' => 'field_5b4ecfc6aa75f',
        'label' => 'Phone',
        'name' => 'phone',
        'type' => 'text',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      array(
        'key' => 'field_5b4ecfd0aa760',
        'label' => 'Email',
        'name' => 'email',
        'type' => 'email',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
      ),
      array(
        'key' => 'field_egegfileae847c',
        'label' => 'Full Team Contact List',
        'name' => 'team_list',
        'type' => 'file',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'library' => 'all',
        'min_size' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_5t5t5tea61f758f2',
        'label' => 'Home Disclosure',
        'name' => 'home_disclosure',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 0,
        'delay' => 0,
      ),
      array(
        'key' => 'field_egegegedae847c',
        'label' => 'Disclosure Download',
        'name' => 'disclosure_download',
        'type' => 'file',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'library' => 'all',
        'min_size' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options-global-content',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
  ));

  if( function_exists('acf_add_options_page') ) {
    $global_content = acf_add_options_page([
      'page_title'=>'Global Content',
      'menu_title'=>'Global Content',
      'position' => 25,
      'autoload'=>true,
      'icon_url'=>'dashicons-admin-site',
    ]);
  }

endif;

/**
 * Add styles to editor
 */
/*
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

function my_mce_before_init( $settings ) {
  $style_formats = array(
    array(
      'title' => 'Intro Paragraph',
      'selector' => 'p',
      'classes' => 'intro'
    ),
    array(
      'title' => 'Callout Header - Level 2',
      'selector' => 'h2',
      'classes' => 'header-small'
    ),
    array(
      'title' => 'Callout Header - Level 3',
      'selector' => 'h2',
      'classes' => 'header-highlight'
    ),
  );
  $settings['style_formats'] = json_encode( $style_formats );
  return $settings;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );
add_editor_style( 'css/custom-editor-style.css' );
*/
