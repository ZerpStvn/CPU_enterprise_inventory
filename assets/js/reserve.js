$(document).ready(function () {
  $(".reserve-link").on("click", function () {
    var date = new Date();
    var day = date.getDay();
    var hours = date.getHours();

    if (day >= 1 && day <= 5 && hours >= 8 && hours < 16) {
      var productId = $(this).data("productid");
      var userName = '<?php echo $_SESSION["user_name"]; ?>';
      var schoolID = '<?php echo $_SESSION["schoolID"]; ?>';
      var userID = '<?php echo $_SESSION["user_id"]; ?>';

      $.ajax({
        type: "POST",
        url: "reserveAuth.php",
        data: {
          productId: productId,
          userName: userName,
          schoolID: schoolID,
          userID: userID,
        },
        success: function (response) {
          alert(response);
          location.reload();
        },
        error: function () {
          alert("Reservation failed. Please try again.");
        },
      });
    } else {
      alert(
        "Enterprise is closed. Please try again during business hours (M-F, 8 AM - 4 PM)."
      );
    }
  });
});
