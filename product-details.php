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
    <title>Product | Details</title>


    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/plugins/owlcarousel/owl.carousel.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Product Details</h4>
                        <h6>Full details of a product</h6>
                    </div>
                </div>
                <?php
                include 'config.php';

                // Check if product ID is provided
                if (isset($_GET['id'])) {
                    $productId = $_GET['id'];

                    // Retrieve the product details from the database
                    $sql = "SELECT * FROM inventory WHERE id = ?";
                    $stmt = mysqli_prepare($connection, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $productId);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    // Check if the product exists
                    if (mysqli_num_rows($result) > 0) {
                        $product = mysqli_fetch_assoc($result);
                    } else {
                        // Redirect back to the product list page if the product doesn't exist
                        header("Location: productlist.php");
                        exit();
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    // Redirect back to the product list page if no product ID is provided
                    header("Location: productlist.php");
                    exit();
                }
                ?>

                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="bar-code-view">
                                    <img src="assets/img/barcode1.png" alt="barcode">
                                    <a class="printimg">
                                        <img src="assets/img/icons/printer.svg" alt="print">
                                    </a>
                                </div>
                                <div class="productdetails">
                                    <ul class="product-bar">
                                        <li>
                                            <h4>
                                                Product name
                                            </h4>
                                            <h6>
                                                <?php echo $product['product_name']; ?>
                                            </h6>
                                        </li>
                                        <li>
                                            <h4>Product set</h4>
                                            <h6>
                                                <?php echo $product['category']; ?>
                                            </h6>
                                        </li>
                                        <li>
                                            <h4>SKU</h4>
                                            <h6>
                                                <?php echo $product['sku']; ?>
                                            </h6>
                                        </li>
                                        <li>
                                            <h4>on stock</h4>
                                            <h6>
                                                <?php echo $product['on_stock']; ?>
                                            </h6>
                                        </li>
                                        <li>
                                            <h4>Stock level</h4>
                                            <h6>
                                                <?php echo $product['minimum_quantity']; ?>
                                            </h6>
                                        </li>
                                        <li>
                                            <h4>Price</h4>
                                            <h6>
                                                <?php echo $product['price']; ?>
                                            </h6>
                                        </li>
                                        <li>
                                            <h4>Status</h4>
                                            <h6>
                                                <?php echo $product['status']; ?>
                                            </h6>
                                        </li>
                                        <li>
                                            <h4>Description</h4>
                                            <h6>
                                                <?php echo $product['description']; ?>
                                            </h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="slider-product-details">
                                    <div class="owl-carousel owl-theme product-slide">
                                        <div class="slider-product">
                                            <img style="margin:auto;" src="<?php echo $product['image']; ?>" alt="img">
                                            <h4>
                                                <?php echo $product['product_name']; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>