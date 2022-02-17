/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
  // Site title and description.
  wp.customize("blogname", function (value) {
    value.bind(function (to) {
      $(".site-title a").text(to);
    });
  });
  wp.customize("blogdescription", function (value) {
    value.bind(function (to) {
      $(".site-description").text(to);
    });
  });

  // Header text color.
  wp.customize("header_textcolor", function (value) {
    value.bind(function (to) {
      if ("blank" === to) {
        $(".site-title a, .site-description").css({
          clip: "rect(1px, 1px, 1px, 1px)",
          position: "absolute",
        });
      } else {
        $(".site-title a, .site-description").css({
          clip: "auto",
          position: "relative",
        });
        $(".site-title a, .site-description").css({
          color: to,
        });
      }
    });
  });

  // Primary color
  wp.customize("primary_color", function (value) {
    value.bind(function (to) {
      $(".navbar .navbar-nav.search-nav .search-toggle").css("background", to);
      $(
        ".wp-block-latest-posts__list.is-grid li .wp-block-latest-posts__post-excerpt .tenet-read-more .tenet-read-more-link",
      ).css("color", to);
    });
  });
  // Body Font Color - Color Control
  wp.customize("body_font_color", function (value) {
    value.bind(function (to) {
      $(
        "body,.footer-widget.widget_popular_post_widget ol li a, .widget.widget_popular_post_widget ol li a",
      ).css("color", to);
    });
  });

  // Title Font Color - Color Control
  wp.customize("title_font_color", function (value) {
    value.bind(function (to) {
      $("h1,h2,h3,h4,h5,h6").css("color", to);
    });
  });

  // Body Background Color - Color Control
  wp.customize("body_background_color", function (value) {
    value.bind(function (to) {
      $("body").css("backgroundColor", to);
    });
  });

  // Header Background Color - Color Control
  wp.customize("header_background_color", function (value) {
    value.bind(function (to) {
      $(".bg-header").css("backgroundColor", to);
    });
  });

  // Footer Background Color - Color Control
  wp.customize("footer_background_color", function (value) {
    value.bind(function (to) {
      $("#wrapper-footer-full").css("backgroundColor", to);
    });
  });

  // Socials Background Color - Color Control
  wp.customize("socials_background_color", function (value) {
    value.bind(function (to) {
      $(".site-footer .social-navbar-nav li a").css("backgroundColor", to);
    });
  });

  // Socials Font Color - Color Control
  wp.customize("socials_font_color", function (value) {
    value.bind(function (to) {
      $(".site-footer .social-navbar-nav li a").css("color", to);
    });
  });
})(jQuery);
