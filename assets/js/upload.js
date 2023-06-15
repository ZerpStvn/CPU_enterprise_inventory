$(document).ready(function () {
  $(".status-toggle").click(function () {
    var userId = $(this).data("user-id");
    var currentStatus = $(this).data("current-status");

    $.ajax({
      url: "userStatusupdate.php",
      method: "POST",
      data: {
        userId: userId,
        currentStatus: currentStatus,
      },
      success: function (response) {
        // Update the status text
        $(this).text(response);
        location.reload();
        // Update the status class
        if (response === "Active") {
          $(this).removeClass("bg-lightred").addClass("bg-lightgreen");
        } else {
          $(this).removeClass("bg-lightgreen").addClass("bg-lightred");
        }

        // Update the data-current-status attribute
        $(this).data("current-status", response);
      },
    });
  });
});
