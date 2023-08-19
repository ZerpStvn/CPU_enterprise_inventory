<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="POS - Bootstrap Admin Template" />
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Restock</title>

    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" /> -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="assets/css/animate.css" />

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css" />

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Re stock</h4>
                        <h6>Update Product Stock</h6>
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

                <form class="card" action="productupdate.php?id=<?php echo $productId; ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input readonly type="text" name="product_name"
                                        value="<?php echo $product['product_name']; ?>" />
                                </div>
                            </div>


                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" readonly name="sku" value="<?php echo $product['sku']; ?>" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Stock level</label>
                                    <input type="text" name="minimum_quantity"
                                        value="<?php echo $product['minimum_quantity']; ?>" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>On Stock</label>
                                    <input type="text" name="on_stock" value="<?php echo $product['on_stock']; ?>" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" readonly
                                        name="description"><?php echo $product['description']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" readonly value="<?php echo $product['price']; ?>" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="select" name="status">
                                        <option <?php echo ($product['status'] == 'Closed') ? 'selected' : ''; ?>>Closed
                                        </option>
                                        <option <?php echo ($product['status'] == 'Open') ? 'selected' : ''; ?>>Open
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-lg-12">
                <div class="form-group">
                  <label>Product Image</label>
                  <div class="image-upload">
                    <input type="file" id="imageFile" name="imageFile" accept="image/*" />
                    <div class="image-uploads">
                      <img src="assets/img/icons/upload.svg" alt="img" />
                      <h4>Drag and drop a file to upload</h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="product-list">
                  <ul class="row" id="uploadedImage"></ul>
                </div>
              </div> -->
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-submit me-2">Restock</button>
                                <a href="productlist.php" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>