<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Product</title>

    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
    .cardproduct {

        width: 100%;
        display: flex;
        padding: 10px;

    }

    .section {
        width: 100%;
        border: 1px solid #ccc;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .imageproduct {
        width: 99%;
        height: 286px;
        object-fit: fill;
        background: wheat;

    }

    .contentproduct {
        padding: 0;
    }

    .stock {
        position: absolute;
        top: 10px;
        left: 5px;
        width: inherit;
        height: inherit;
        border-radius: 5px;
        color: white;
        padding: 0 10px 0 10px;
    }

    .button {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .button button {
        border: none;
        background-color: green;
        color: white;
        padding: 9px;
        border-radius: 7px
    }

    .button_reserve button {
        border: none;
        background-color: darkorange;
        color: white;
        padding: 9px;
        border-radius: 8px
    }
</style>

<body>


    <main class="page-wrapper main-wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product on stock</h4>
                    <h6>Reserve your item</h6>
                </div>
            </div>

            <div class="page-header">
                <?php
                require_once 'config.php';

                // Fetch inventory data from the database
                $query = "SELECT * FROM inventory WHERE status = 'Open'";
                $result = mysqli_query($connection, $query);

                // Check if there are any rows returned
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $userID = $_SESSION['user_id'];
                        $productId = $row['id'];
                        $productName = $row['product_name'];
                        $sku = $row['sku'];
                        $category = $row['category'];
                        $description = $row['description'];
                        $onStock = $row['on_stock'];
                        $image = $row['image'];

                        // Check if the current user has reserved this product
                        $reservationQuery = "SELECT * FROM reservations WHERE productid = '$productId' AND userID = '$userID'";
                        $reservationResult = mysqli_query($connection, $reservationQuery);

                        // Check if the current user has sent a request for this product
                        $requestQuery = "SELECT * FROM request WHERE productid = '$productId' AND userID = '$userID'";
                        $requestResult = mysqli_query($connection, $requestQuery);

                        if (mysqli_num_rows($reservationResult) > 0) {
                            // User has already reserved this product
                            ?>
                            <a style="color:black;" href="product-details.php?id=<?php echo $productId ?>">
                                <div class="cardproduct">

                                    <div class="section">
                                        <div class="stock"
                                            style="background-color: <?php echo ($onStock == 0) ? 'red' : 'green'; ?>;">
                                            Stocks
                                            <?php echo $onStock ?>
                                        </div>
                                        <img class="imageproduct" src="<?php echo $image; ?>" alt="product">
                                        <div class="contentproduct">
                                            <p>SKU:
                                                <?php echo $sku ?>
                                                <br />
                                                <?php echo $productName ?>
                                            </p>
                                            <div class="button button_reserve">
                                                <a style="color:white; margin-top: 20px; margin-right:4px"
                                                    href="product-details.php?id=<?php echo $productId ?>"
                                                    class="badges bg-lightgreen">View</a>
                                                <a style="color:white; margin-top: 20px;" href="reservationStudentRecod.php"
                                                    class="badges bg-lightyellow">Reserved</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <?php
                        } else {
                            // User has not reserved this product
                            ?>
                            <a href="product-details.php?id=<?php echo $productId ?>" style="color:black;">
                                <div class="cardproduct">
                                    <div class="section">
                                        <div class="stock"
                                            style="background-color: <?php echo ($onStock == 0) ? 'red' : 'green'; ?>;">
                                            Stocks
                                            <?php echo $onStock ?>
                                        </div>
                                        <img class="imageproduct" src="<?php echo $image; ?>" alt="product">
                                        <div class="contentproduct">
                                            <p style="padding-bottom:20px">SKU:
                                                <?php echo $sku ?>
                                                <br />
                                                <?php echo $productName ?>
                                            </p>
                                            <div class="button">
                                                <?php if ($onStock > 0) { ?>
                                                    <a style="color:white; margin-top: 0px; margin-right:4px"
                                                        href="product-details.php?id=<?php echo $productId ?>"
                                                        class="badges bg-lightgreen">View</a>
                                                    <a style="color:white" class="badges bg-lightgreen reserve-link"
                                                        data-productid="<?php echo $productId; ?>">Reserve</a>
                                                <?php } else { ?>
                                                    <?php if (mysqli_num_rows($requestResult) > 0) { ?>
                                                        <a style="color:white; margin-top: 0px; margin-right:4px"
                                                            href="product-details.php?id=<?php echo $productId ?>"
                                                            class="badges bg-lightgreen">View</a>
                                                        <a style="color:white" class="badges bg-lightyellow" href="requestStudent.php">View
                                                            Request</a>
                                                    <?php } else { ?>
                                                        <a style="color:white; margin-top: 0px; margin-right:4px"
                                                            href="product-details.php?id=<?php echo $productId ?>"
                                                            class="badges bg-lightgreen">View</a>
                                                        <a style="color:white" class="badges bg-lightred request-link"
                                                            data-productid="<?php echo $productId; ?>">Send Request</a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?php
                        }
                    }
                } else {
                    // No inventory data found in the database
                    ?>

                    <?php
                }
                ?>
            </div>
        </div>
    </main>
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="assets/js/request.js"></script>
    <script src="assets/js/reserve.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>