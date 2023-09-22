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
  <title>Inventory | Product</title>

  <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" /> -->

  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

  <link rel="stylesheet" href="assets/css/animate.css" />

  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css" />

  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css" />

  <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css" />
  <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />

  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/restock.css">
</head>

<body>
  <div id="global-loader">
    <div class="whirly-loader"></div>
  </div>

  <div class="main-wrapper">
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>

    <div class="page-wrapper">
      <?php
      include 'config.php';

      // Fetch inventory data from the database
      $sql = "SELECT * FROM inventory";
      $result = mysqli_query($connection, $sql);

      ?>


      <div class="content">
        <div class="page-header">
          <div class="page-title">
            <h4>Product List</h4>
            <h6>Manage your products</h6>
          </div>
          <div class="page-btn">
            <a href="addproduct.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img"
                class="me-1" />Add New Product</a>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="table-top">
              <div class="search-set">
                <div class="search-path">
                  <a class="btn btn-filter" id="filter_search">
                    <img src="assets/img/icons/filter.svg" alt="img" />
                    <span><img src="assets/img/icons/closes.svg" alt="img" /></span>
                  </a>
                </div>
                <div class="search-input">
                  <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img" /></a>
                </div>
              </div>
              <div class="wordset">
                <ul>
                  <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg"
                        alt="img" /></a>
                  </li>
                  <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                        src="assets/img/icons/excel.svg" alt="img" /></a>
                  </li>
                  <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                        src="assets/img/icons/printer.svg" alt="img" /></a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="card mb-0" id="filter_inputs">
              <div class="card-body pb-0">
                <div class="row">
                  <div class="col-lg-12 col-sm-12">
                    <div class="row">
                      <div class="col-lg col-sm-6 col-12">
                        <div class="form-group">
                          <select class="select">
                            <option>Choose Product</option>
                            <option>Macbook pro</option>
                            <option>Orange</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg col-sm-6 col-12">
                        <div class="form-group">
                          <select class="select">
                            <option>Choose Category</option>
                            <option>Computers</option>
                            <option>Fruits</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg col-sm-6 col-12">
                        <div class="form-group">
                          <select class="select">
                            <option>Choose Sub Category</option>
                            <option>Computer</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg col-sm-6 col-12">
                        <div class="form-group">
                          <select class="select">
                            <option>Brand</option>
                            <option>N/D</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg col-sm-6 col-12">
                        <div class="form-group">
                          <select class="select">
                            <option>Price</option>
                            <option>150.00</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-1 col-sm-6 col-12">
                        <div class="form-group">
                          <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg"
                              alt="img" /></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table datanew">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Stocks</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $productId = $row['id'];
                      $productName = $row['product_name'];
                      $sku = $row['sku'];
                      $category = $row['category'];
                      $minimumQuantity = $row['minimum_quantity'];
                      $onStock = $row['on_stock'];
                      $status = $row['status'];
                      $image = $row['image'];

                      ?>
                      <div class="restock-value restock-value-<?php echo $productId; ?>">
                        <div class="inputcontainer">
                          <h4 class="form-stock-h4" style="text-align:center; font-size:28px">Select Option</h4>
                          <div style="display:flex;">
                            <button class="btn btn-submit me-2 stock-in-button" data-product-id="<?php echo $productId; ?>"
                              data-on-stock="<?php echo $onStock; ?>">Stock in</button>
                            <button class="btn btn-submit me-2 stock-out-button" data-product-id="<?php echo $productId; ?>"
                              data-on-stock="<?php echo $onStock; ?>">Stock out</button>
                          </div>
                          <div class="stock-in-form" data-product-id="<?php echo $productId; ?>"
                            data-on-stock="<?php echo $onStock; ?>">
                            <form class="cardformstock" action="updatestock.php" method="POST" id="restockid">
                              <input type="hidden" name="id" id="product_id" value="<?php echo $productId; ?>">
                              <input type="hidden" name="current_stock" id="current_stock" value="<?php echo $onStock; ?>">
                              <label style="font-size:24px">STOCK AVAILABILITY</label>
                              <input type="text" name="on_stock" id="on_stock" placeholder="Stock value"
                                style="height: 50px; width: 80%; padding-left:10px" />

                              <div>
                                <button type="submit" class="btn btn-submit me-2" id="stock-in-button">Submit</button>
                                <a href="productlist.php" id="stock-cancel" class="btn btn-submit me-2">Cancel</a>
                              </div>
                            </form>
                          </div>
                          <div class="stock-in-out" data-product-id="<?php echo $productId; ?>"
                            data-on-stock="<?php echo $onStock; ?>">
                            <form class="cardformstock" action="stockout.php" method="POST" id="restockid">
                              <input type="hidden" name="id" id="product_id" value="<?php echo $productId; ?>">
                              <input type="hidden" name="current_stock" id="current_stock" value="<?php echo $onStock; ?>">
                              <label style="font-size:24px">STOCK AVAILABILITY</label>
                              <input type="text" name="on_stock" id="on_stock" placeholder="Stock value"
                                style="height: 50px; width: 80%; padding-left:10px" />

                              <div>
                                <button type="submit" class="btn btn-submit me-2" id="stock-in-button">Submit</button>
                                <a href="productlist.php" id="stock-cancel" class="btn btn-submit me-2">Cancel</a>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <tr>
                        <td class="productimgname">
                          <a href="javascript:void(0);" class="product-img">
                            <img src="<?php echo $image; ?>" alt="product" />
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
                          <?php echo $minimumQuantity; ?>
                        </td>
                        <td>
                          <?php echo $onStock; ?>
                        </td>
                        <td>
                          <?php echo $status; ?>
                        </td>
                        <td>
                          <a class="me-3" href="product-details.php?id=<?php echo $productId; ?>">
                            <img src="assets/img/icons/eye.svg" alt="img" />
                          </a>
                          <a class="me-3 stock-open" data-target=".restock-value-<?php echo $productId; ?>">
                            <img src="assets/img/icons/edit.svg" alt="img" />
                          </a>

                          <a class="confirm-text" href="productdelete.php?id=<?php echo $productId; ?>">
                            <img src="assets/img/icons/delete.svg" alt="img" />
                          </a>
                        </td>
                      </tr>

                      <?php
                    }
                  } else {
                    echo '<tr><td colspan="8">No records found.</td></tr>';
                  }

                  mysqli_free_result($result);
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

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/modalsotck.js"></script>
</body>

</html>