$(document).ready(function () {
  $(".stock-open").click(function () {
    var targetSelector = $(this).data("target");
    $(targetSelector).toggleClass("activestock");
  });
  $(".stock-in-form").hide();
  $(".stock-in-out").hide();
  $(".stock-in-button").click(function () {
    $(".stock-in-button").hide();
    $(".stock-out-button").hide();
    $(".stock-in-out").hide();
    $(".form-stock-h4").hide();
    $(".stock-in-form").show();
  });
  $(".stock-out-button").click(function () {
    $(".stock-in-button").hide();
    $(".stock-out-button").hide();
    $(".stock-in-form").hide();
    $(".form-stock-h4").hide();
    $(".stock-in-out").show();
  });
});
