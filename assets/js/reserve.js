$(document).ready(function () {
  $(".reserve-link").on("click", function () {
    var date = new Date(); // Get current date and time
    var day = date.getDay(); // Get the current day (0 for Sunday, 1 for Monday, etc.)
    var hours = date.getHours(); // Get the current hour

    // Check if the day is Monday to Friday and the time is between 8 AM and 4 PM
    if (day >= 1 && day <= 5 && hours >= 8 && hours < 16) {
      // Get the product ID and other necessary data
      var productId = $(this).data("productid");
      var userName = '<?php echo $_SESSION["user_name"]; ?>';
      var schoolID = '<?php echo $_SESSION["schoolID"]; ?>';
      var userID = '<?php echo $_SESSION["user_id"]; ?>';

      // Create an AJAX request
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
          // Reservation was successful
          alert(response);
          // Refresh the page to update the inventory
          location.reload();
        },
        error: function () {
          // Reservation failed
          alert("Reservation failed. Please try again.");
        },
      });
    } else {
      // Enterprise is closed
      alert(
        "Enterprise is closed. Please try again during business hours (M-F, 8 AM - 4 PM)."
      );
    }
  });
});
