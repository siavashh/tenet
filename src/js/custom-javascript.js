(function ($) {
  /* Validation Events for changing response CSS classes */
  document.addEventListener(
    "wpcf7invalid",
    function () {
      setClasses($, "alert-danger");
    },
    false
  );
  document.addEventListener(
    "wpcf7spam",
    function () {
      setClasses($, "alert-warning");
    },
    false
  );
  document.addEventListener(
    "wpcf7mailfailed",
    function () {
      setClasses($, "alert-warning");
    },
    false
  );
  document.addEventListener(
    "wpcf7mailsent",
    function () {
      setClasses($, "alert-success");
    },
    false
  );

  $(".search-toggle").on("click", function () {
    $(".big-search").fadeToggle().toggleClass("visible");
    $(".big-search .search-toggle").toggleClass("show");

    const focusableElements = "#s, .searchscreen-nav a, button";
    const modal = document.querySelector(".big-search");

    const firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
    const inputField = modal.querySelectorAll("#s")[0];
    const focusableContent = modal.querySelectorAll(focusableElements);
    const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal
    $(inputField).trigger("focus");

    document.addEventListener("keydown", function (e) {
      let isTabPressed = e.key === "Tab" || e.keyCode === 9;

      if (!isTabPressed) {
        return;
      }

      if (e.shiftKey) {
        // if shift key pressed for shift + tab combination
        if (document.activeElement === firstFocusableElement) {
          lastFocusableElement.focus(); // add focus for the last focusable element
          e.preventDefault();
        }
      } else {
        // if tab key is pressed
        if (document.activeElement === lastFocusableElement) {
          // if focused has reached to last focusable element then focus first focusable element after pressing tab
          firstFocusableElement.focus(); // add focus for the first focusable element
          e.preventDefault();
        }
      }
    });

    // $("#searchform .field").trigger("focus");
  });

  $(".navbar-toggler").on("click", function () {
    $(".navbar-close").fadeToggle();
    $(".navbar-close").toggleClass("show");
    $("#main-nav .navbar-nav").fadeToggle().toggleClass("show");
    $(".body-cover").fadeToggle();

    const focusableElements =
      "#main-nav .navbar-collapse .menu-item a,#main-nav .navbar-close";
    const modal = document.querySelector("#main-nav");
    const firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
    const focusableContent = modal.querySelectorAll(focusableElements);
    const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal

    firstFocusableElement.focus();

    document.addEventListener("keydown", function (e) {
      let isTabPressed = e.key === "Tab" || e.keyCode === 9;

      if (!isTabPressed) {
        return;
      }

      if (e.shiftKey) {
        // if shift key pressed for shift + tab combination
        if (document.activeElement === firstFocusableElement) {
          lastFocusableElement.focus(); // add focus for the last focusable element
          e.preventDefault();
        }
      } else {
        // if tab key is pressed
        if (document.activeElement === lastFocusableElement) {
          // if focused has reached to last focusable element then focus first focusable element after pressing tab
          firstFocusableElement.focus(); // add focus for the first focusable element
          e.preventDefault();
        }
      }
    });
  });
  $(".navbar-close").on("click", function () {
    $(".navbar-toggler").trigger("click");
  });

  $(".show-comments a").on("click", function () {
    $(this).find("i").toggleClass("fa-rotate-180");
    $(".comments-area").slideToggle("slow");
    $([document.documentElement, document.body]).animate(
      {
        scrollTop: $(".comments-area").offset().top - 50,
      },
      1000
    );
  });
  $(".left-sidebar-toggle").on("click", function () {
    $("#left-sidebar").toggleClass("visible");
    $(".body-cover").fadeToggle();
  });
  $(document).on("keyup", function (e) {
    if (e.key == "Escape" && $(".big-search").hasClass("visible")) {
      $(".big-search").fadeToggle().removeClass("visible");
      $(".big-search .search-toggle").removeClass("show");
    }
  });
})(jQuery);

function setClasses($, alertClass) {
  $(".wpcf7-response-output")
    .removeClass(function (index, css) {
      return (css.match(/(^|\s)alert-\S+/g) || []).join(" ");
    })
    .addClass("alert")
    .addClass(alertClass);
}
