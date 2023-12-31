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
                        <h4>Request</h4>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">


                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>School ID</th>
                                    <th>SKU</th>
                                    <th>Item Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once 'config.php';

                                $query = "SELECT * FROM request";
                                $result = mysqli_query($connection, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $reservationId = $row['id'];
                                        $userName = $row['userName'];
                                        $schoolID = $row['schoolID'];
                                        $sku = $row['sku'];
                                        $productImage = $row['image'];
                                        $productName = $row['product_name'];
                                        $date = $row['date'];
                                        $status = $row['status'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $userName; ?>
                                            </td>
                                            <td>
                                                <?php echo $schoolID; ?>
                                            </td>
                                            <td>
                                                <?php echo $sku; ?>
                                            </td>
                                            <td class="productimgname">
                                                <a href="javascript:void(0);" class="product-img">
                                                    <img src="<?php echo $productImage; ?>" alt="product">
                                                </a>
                                                <a href="javascript:void(0);">
                                                    <?php echo $productName; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $date; ?>
                                            </td>
                                            <td>
                                                <span class="badges bg-lightgreen">Requested</span>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan=" 6">No reservation data found
                                        </td>
                                    </tr>
                                    <?php
                                }

                                mysqli_close($connection);
                                ?>
                            </tbody>
                        </table>


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