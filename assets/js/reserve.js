$(document).ready(function () {
  $(".reserve-link").on("click", function () {
    var date = new Date();
    var day = date.getDay();
    var hours = date.getHours();

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
      success: function () {
        swal("Reservation Sent", "CPU ENTERPRISE", "success").then(function () {
          location.reload();
        });

        // alert(response);
      },
      error: function () {
        alert("Reservation failed. Please try again.");
      },
    });
  });
});
