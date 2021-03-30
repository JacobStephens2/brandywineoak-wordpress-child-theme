document.documentElement.className = "_has_js"
var WYETH = WYETH || {};

(function (window, $, APP) {

  // Scope Globals
  // ---------------------------------------------
  var $document = $(document),
      $window   = $(window),
      $body     = $('body');

  // Helpers
  // ---------------------------------------------
  APP.helpers = {
    initComponents : function ($elem) {
      $elem.find('[data-js-component]').each(function() {
        var $this      = $(this),
            components = $this.data('js-component').split(' '),
            componentName,
            component,
            i = 0, len = components.length;
        for (i, len; i < len; i++)  {
          componentName = components[i];
          if (APP.pageComponents.hasOwnProperty(componentName)) {
            component = APP.pageComponents[componentName];
            if (typeof component === 'function') {
              component($this, componentName);
            } else if (typeof component === 'object') {
              if (component.hasOwnProperty('init')) {
                component.init($this, componentName);
              }
            }
          }
        }
      });
    },
  };

  // Templates
  // ---------------------------------------------
  APP.tmpl = {

    // Youtube Lightbox Template
    // ---------------------------------------------
    // youtube : function(var) {
    //   return 'html' + var;
    // },
  }

  // Page Components
  // <elem data-js-component="<component name>">
  // ---------------------------------------------
  APP.pageComponents = {

    // Global Navigation
    // ---------------------------------------------
    globalNav : function($elem, component) {
      var $parentLis = $elem.find('nav > ul > li').has('ul');
      $parentLis.prepend('<a href="#" class="globalNav_expander"></a>');

      $elem.on('click','.globalNav_expander', function() {
        var $parentLi = $(this).parent('li'),
            $subUl = $parentLi.find('> ul');

        $parentLis.each(function() {
          if($(this).hasClass('_is_active')) {
            $(this).find('> ul').slideUp('fast');
            $(this).removeClass('_is_active');
          }
        })

        if($subUl.is(':hidden')) {
          $subUl.slideDown('fast');
          $parentLi.addClass('_is_active');
        } else {
          $subUl.slideUp('fast');
          $parentLi.removeClass('_is_active');
        }

        return false;
      });

      $parentLis.each(function() {
        var $activeChildren = $(this).find('.current-menu-item');

        if($activeChildren.length) {
          $(this).addClass('current-menu-item');
        }
      });
    },

    // Sticky Header
    // ---------------------------------------------
    stickyHeader : function($elem, component) {
      var $content_block = $('.entry-content');

      if($content_block.length) {
        var content_offset = $content_block.offset(),
            contentY       = content_offset.top,
            scrollLocation = window.pageYOffset;

        if(scrollLocation > 0) {
          $elem.addClass('_scrolling');
        } else {
          $elem.removeClass('_scrolling');
        }

        if(scrollLocation > contentY) {
          $elem.addClass('_solid');
        } else {
          $elem.removeClass('_solid');
        }

        $(window).scroll(function() {
          content_offset = $content_block.offset(),
          contentY       = content_offset.top,
          scrollLocation = window.pageYOffset;

          if(scrollLocation > contentY) {
            if(! $elem.hasClass('_solid')) {
              $elem.addClass('_solid');
            }
          } else {
            if($elem.hasClass('_solid')) {
              $elem.removeClass('_solid');
            }
          }
          if(scrollLocation > 0) {
            if(! $elem.hasClass('_scrolling')) {
              $elem.addClass('_scrolling');
            }
          } else {
            if($elem.hasClass('_scrolling')) {
              $elem.removeClass('_scrolling');
            }
          }
        });
      }
    },

    // Text Slideshow
    // ---------------------------------------------
    textSlideshow : function($elem, component) {
      $elem.slick({
        arrows: false,
        autoplaySpeed: 10000,
        autoplay: true,
        dots: true,
        infinite: true,
        slidesToScroll: 1,
        slidesToShow: 1,
        speed: 500,
      });
    },

    // Expander
    // ---------------------------------------------
    expander : function($elem, component) {
      var $title   = $elem.find('.expander_title'),
          $content = $elem.find('.expander_content');

      $title.click(function() {
        if($elem.hasClass('_is_open')) {
          $elem.removeClass('_is_open');
          $content.slideUp(250);
        } else {
          $('.expander').not($elem).each(function() {
            $(this).removeClass('_is_open').find('.expander_content').slideUp(250);
          });
          $elem.addClass('_is_open');
          $content.slideDown(250);
        }

        if (window.matchMedia('(max-width: 639px)').matches) {
          return false;
        }
      });
    },

    // Banner Scroll
    // ---------------------------------------------
    bannerScroll : function($elem, component) {
      $elem.click(function() {
        var $target        = $('.entry-content'),
            scrollLocation = ($target.length) ? $target.offset().top + 10 : 0;

        $('html,body').animate({
          scrollTop: scrollLocation
        }, 350);

        return false;
      });
    },

    // Banner Animate
    // ---------------------------------------------
    bannerAnimate : function($elem, component) {
      var $wrapper = $elem.parents('.entryBanner'),
          $paths   = $wrapper.find('path:not(defs path)');

      $wrapper.addClass('_animating');

      if (navigator.userAgent.indexOf("Edge") > -1 ||
          navigator.appName == 'Microsoft Internet Explorer' ||
          !!(navigator.userAgent.match(/Trident/) ||
          navigator.userAgent.match(/rv:11/)) ||
          (typeof $.browser !== "undefined" && $.browser.msie == 1)
      ) { } else {
        $paths.each(function(i, e) {
          var length = e.getTotalLength();
          // Clear any previous transition
          e.style.transition = e.style.WebkitTransition =
            'none';
          // Set up the starting positions
          e.style.strokeDasharray = length + ' ' + length;
          e.style.strokeDashoffset = length;
          // Trigger a layout so styles are calculated & the browser
          // picks up the starting position before animating
          e.getBoundingClientRect();
          // Define our transition
          e.style.transition = e.style.WebkitTransition =
            'stroke-dashoffset 1s ease-in-out';
          // Go!
          setTimeout(function() {
            e.style.strokeDashoffset = '0';
          }, ((150 * i) + 2000));
        });
      }
    },

    // Home Scroll
    // ---------------------------------------------
    homeScroll : function($elem, component) {
      var step          = 1,
          preventScroll = true,
          $button       = $elem.find('.entryBanner_more'),
          $banner       = $elem.find('.entryBanner_content'),
          $slideshow    = $elem.find('.textSlideshow_block'),
          $footer       = $('.globalFooter');

      window.onbeforeunload = function(){ window.scrollTo(0,0); }

      $window.scroll(function() {
        if(window.pageYOffset <= 0) {
          if(step != 1) {
            step = 1;
            $banner.fadeIn(250);
            $slideshow.animate({
              opacity: 0,
            }, 250, function() {
              preventScroll = true;
            });
          }
        } else {
          if(step != 2) {
            step = 2;
            preventScroll = true;
            $banner.fadeOut(250);
            $slideshow.animate({
              opacity: 1,
            }, 250, function() {
              preventScroll = false;
            });
          }
        }
      });

      $window.bind('wheel', function(evt) {
        var delta = evt.originalEvent.deltaY;

        if(preventScroll) {
          evt.preventDefault();
        }

        if (!$(this).data('flag')) {
          var self = this;
          $(this).data('timeout', window.setTimeout(function() {
            $(self).data('flag', false);
          }, 1000));
          $(this).data('flag', true);

          // Back from Step 2
          if(delta < 0 && step == 2) {
            content_offset = $footer.offset();
            contentY       = content_offset.top;
            scrollLocation = window.pageYOffset + $window.height();
            if(scrollLocation <= contentY) {
              step = 1;
              $banner.fadeIn(250);
              $slideshow.animate({
                opacity: 0,
              }, 250, function() {
                preventScroll = true;
              });
            }

          // Forward from Step 1
          } else if(delta > 0 && step == 1) {
            step = 2;
            preventScroll = true;
            $banner.fadeOut(250);
            $slideshow.delay(500).animate({
              opacity: 1,
            }, 250, function() {
              preventScroll = false;
            });
          }
        }
      });

      $button.click(function() {
        if(step == 1) {
          step = 2;
          preventScroll = true;
          $banner.fadeOut(250);
          $slideshow.delay(500).animate({
            opacity: 1,
          }, 250, function() {
            preventScroll = false;
          });
        } else {
          footScroll = $footer.offset().top;
          $('html,body').animate({
            scrollTop: footScroll
          }, 350);
        }
        return false;
      });

    },
  };


  // Document Ready
  // ---------------------------------------------
  $(function () {
    // Init Page Components
    $document.foundation();
    APP.helpers.initComponents($body);
  });

} (window, jQuery, WYETH, undefined));
