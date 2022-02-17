jQuery(document).ready(function () {
  jQuery(".controls#tenet-img-container li img").click(function () {
    jQuery(this)
      .closest("ul")
      .find(".tenet-radio-img-selected")
      .removeClass("tenet-radio-img-selected");
    jQuery(this).addClass("tenet-radio-img-selected");
  });
  jQuery(
    "#customize-control-tenet_color_palette .controls#tenet-img-container .tenet-radio-img-img",
  ).click(function () {
    changeSocialIconColors(
      jQuery(this).prev("input").attr("value").replace("palette", ""),
    );
  });

  function changeSocialIconColors($paletteColor) {
    jQuery(
      "#customize-control-tenet_socials_settings_type .tenet-radio-img-img",
    ).each(function () {
      if (
        jQuery(this).hasClass("socials-type-3") ||
        jQuery(this).hasClass("socials-type-4")
      ) {
        // console.log(jQuery(this).attr("class"));
        $oldImageSrc = jQuery(this).attr("src");
        $newName = changeName($oldImageSrc, $paletteColor);
        jQuery(this).attr("src", $newName);
      }
    });
  }

  function changeName($oldString, $addedString) {
    $oldString = $oldString
      .replace("-tenet", "")
      .replace("-melon", "")
      .replace("-desert", "");
    return (
      $oldString.substring(0, $oldString.lastIndexOf(".")) +
      $addedString +
      $oldString.substring($oldString.lastIndexOf("."))
    );
  }
  //Load correct social icon colors
  jQuery(
    "#customize-control-tenet_color_palette .controls#tenet-img-container li input",
  ).each(function () {
    if (jQuery(this).prop("checked")) {
      changeSocialIconColors(jQuery(this).attr("value").replace("palette", ""));
    }
  });
});
