$(document).ready(function () {
  $(".return-link").click(function (e) {
    e.preventDefault();
    var returnID = $(this).data("return-id");
    var link = $(this);
    alert(returnID);
    $.ajax({
      url: "search.php",
      type: "POST",
      dataType: "json",
      data: { returnid: returnID },
      success: function (response) {
        if (response.status === "success") {
          location.reload();
        }
      },
    });
  });
});
