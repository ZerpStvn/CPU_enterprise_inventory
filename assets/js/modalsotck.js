$(document).ready(function () {
  $(".stock-open").click(function () {
    var targetSelector = $(this).data("target");
    $(targetSelector).toggleClass("activestock");
  });

  function updateStockInDatabase(productId, currentStock, userInput) {
    $.ajax({
      type: "POST",
      url: "updatestock.php",
      data: {id: productId, current_stock: currentStock, on_stock: userInput},
      success: function (response) {
        if (response === "success") {
          alert("Stock updated successfully.");
        } else {
          alert("Error updating stock.");
        }
      },
      error: function (error) {
        console.error("Error:", error);
        alert("An error occurred while updating stock.");
      },
    });
  }

  // Add an event listener to the Stock In button
  $("#stock-in-button").click(function (e) {
    e.preventDefault();

    var productId = $("#product_id").val();
    var currentStock = $("#current_stock").val();
    var userInput = $("#on_stock").val();

    // Check if the user input is a valid number
    if (isNaN(userInput)) {
      alert("Please enter a valid number for Stock In.");
      return;
    }

    // Call the function to update the stock in the database
    updateStockInDatabase(productId, currentStock, userInput);
  });
});
