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

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>
    <?php
    session_start();
    ?>
    <div class="main-wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Product</h4>
                        <h6>Reserve your item</h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-top">
                            <div class="search-set">
                                <div class="search-path">
                                    <a class="btn btn-filter" id="filter_search">
                                        <img src="assets/img/icons/filter.svg" alt="img">
                                        <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                    </a>
                                </div>
                                <div class="search-input">
                                    <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                            alt="img"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card" id="filter_inputs">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="form-group">
                                            <input type="text" class="datetimepicker cal-icon"
                                                placeholder="Choose Date">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter Reference ">
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Choose Customer</option>
                                                <option>Customer1</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Choose Status</option>
                                                <option>Inprogress</option>
                                                <option>Complete</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                        <div class="form-group">
                                            <a class="btn btn-filters ms-auto"><img
                                                    src="assets/img/icons/search-whites.svg" alt="img"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table  datanew">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>On stock</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once 'config.php';

                                    // Fetch inventory data from the database
                                    $query = "SELECT * FROM inventory WHERE status = 'Open'";
                                    $result = mysqli_query($connection, $query);

                                    // Check if there are any rows returned
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $userID = $_SESSION['user_id'];
                                            // Extract the data from each row and display it in the table
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
                                            $requestQuery = "SELECT * FROM requests WHERE productid = '$productId' AND userID = '$userID'";
                                            $requestResult = mysqli_query($connection, $requestQuery);

                                            if (mysqli_num_rows($reservationResult) > 0) {
                                                // User has already reserved this product
                                                ?>
                                                <tr>
                                                    <td class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img">
                                                            <img src="<?php echo $image; ?>" alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">
                                                            <?php echo $productName; ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php echo $sku; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $category; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $description; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $onStock; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($onStock > 0) { ?>
                                                            <a style="color:white" class="badges bg-lightgreen">On Stock</a>
                                                        <?php } else { ?>
                                                            <span class="badges bg-lightred">Out of Stock</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><a style="color:white" href="reservationStudentRecod.php"
                                                            class="badges bg-lightyellow">Reserved</a></td>
                                                </tr>
                                                <?php
                                            } else {
                                                // User has not reserved this product
                                                ?>
                                                <tr>
                                                    <td class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img">
                                                            <img src="<?php echo $image; ?>" alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">
                                                            <?php echo $productName; ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php echo $sku; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $category; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $description; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $onStock; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($onStock > 0) { ?>
                                                            <a style="color:white" class="badges bg-lightgreen">On Stock</a>
                                                        <?php } else { ?>
                                                            <span class="badges bg-lightred">Out of Stock</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($onStock > 0) { ?>
                                                            <a style="color:white" class="badges bg-lightyellow reserve-link"
                                                                data-productid="<?php echo $productId; ?>">Reserve</a>
                                                        <?php } else { ?>
                                                            <a style="color:white" class="badges bg-lightgreen request-link"
                                                                data-productid="<?php echo $productId; ?>">Send request</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    } else {
                                        // No inventory data found in the database
                                        ?>
                                        <tr>
                                            <td colspan="7">No inventory data found</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


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