$(document).ready(function () {
  $(".reserve-link").on("click", function () {
    var date = new Date();
    var day = date.getDay();
    var hours = date.getHours();

    var productId = $(this).data("productid");
    var userName = '<?php echo $_SESSION["user_name"]; ?>';
    var schoolID = '<?php echo $_SESSION["schoolID"]; ?>';
    var userID = '<?php echo $_SESSION["user_id"]; ?>';
    var qnty = $("#qnty_" + productId).val();
    var onstock = $("#onstock_" + productId).val();

    var enteredQuantity = parseInt(qnty);
    if (isNaN(enteredQuantity) || enteredQuantity < 0) {
      swal("Enter a valid Quantity", "CPU ENTERPRISE", "error");
    } else if (enteredQuantity > onstock) {
      swal("Entered Quantity exceeds on stock", "CPU ENTERPRISE", "error");
    } else {
      $.ajax({
        type: "POST",
        url: "reserveAuth.php",
        data: {
          productId: productId,
          userName: userName,
          schoolID: schoolID,
          userID: userID,
          qnty: qnty,
        },
        success: function () {
          swal("Reservation Sent", "CPU ENTERPRISE", "success").then(
            function () {
              location.reload();
            }
          );
        },
        error: function () {
          swal(
            "Reservation failed. Please try again.",
            "CPU ENTERPRISE",
            "error"
          );
        },
      });
    }
  });
});
