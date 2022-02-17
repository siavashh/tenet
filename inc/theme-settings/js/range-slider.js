//Do Stuff
jQuery(document).ready(function () {
  $selector = jQuery(".customize-control-range-slider .tenet-range-slider");
  $selector
    .next(".slider-value")
    .css("border-radius", $selector.val() + "px")
    .html($selector.val() + " px");
});

jQuery(document).on(
  "input change",
  ".customize-control-range-slider .tenet-range-slider",
  function () {
    jQuery(this)
      .next(".slider-value")
      .css("border-radius", jQuery(this).val() + "px")
      .html(jQuery(this).val() + " px");
  }
);

// .click(function () {
//   jQuery(this)
//     .closest("ul")
//     .find(".tenet-radio-img-selected")
//     .removeClass("tenet-radio-img-selected");
//   jQuery(this).addClass("tenet-radio-img-selected");
// });
