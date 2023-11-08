$(document).ready(function () {
  $(".return-link").click(function (e) {
    e.preventDefault();
    var returnID = $(this).data("return-id");
    var productID = $(this).data("product-id");

    $.ajax({
      url: "search.php",
      type: "POST",
      dataType: "json",
      data: { returnid: returnID, productid: productID },
      success: function (response) {
        if (response.status === "success") {
          location.reload();
        }
      },
    });
  });
});
