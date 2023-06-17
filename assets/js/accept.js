$(document).ready(function () {
  $(".accept-link").click(function (e) {
    e.preventDefault();
    var reservationId = $(this).data("reservation-id");
    var link = $(this);

    $.ajax({
      url: "accept_reservation.php", // Replace with the file name that handles the status update
      type: "POST",
      dataType: "json",
      data: {acceptReservation: reservationId},
      success: function (response) {
        if (response.status === "success") {
          location.reload(); // Reload the page
        }
      },
    });
  });
});
