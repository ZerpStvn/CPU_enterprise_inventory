$(document).ready(function () {
  $(".request-link").on("click", function () {
    // Get the product ID and other necessary data
    var productId = $(this).data("productid");
    var userName = '<?php echo $_SESSION["user_name"]; ?>';
    var schoolID = '<?php echo $_SESSION["schoolID"]; ?>';
    var userID = '<?php echo $_SESSION["user_id"]; ?>';

    // Create an AJAX request
    $.ajax({
      type: "POST",
      url: "requestAuth.php",
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
        alert("Request failed. Please try again.");
      },
    });
  });
});
