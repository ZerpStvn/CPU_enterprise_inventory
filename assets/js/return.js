$(document).ready(function () {
  $(".return-link").click(function (e) {
    e.preventDefault();
    var returnID = $(this).data("return-id");
    var productID = $(this).data("product-id");
    var qnty = $("#qnty_" + returnID).val();

    $.ajax({
      url: "search.php",
      type: "POST",
      dataType: "json",
      data: { returnid: returnID, productid: productID, qnty: qnty },
      success: function (response) {
        if (response.status === "success") {
          location.reload();
        }
      },
    });
  });
});
