<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
  <meta name="description" content="POS - Bootstrap Admin Template" />
  <meta name="keywords"
    content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive" />
  <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
  <meta name="robots" content="noindex, nofollow" />
  <title>CPU enterprise</title>

  <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" /> -->

  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

  <link rel="stylesheet" href="assets/css/animate.css" />

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
        <div class="row">
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget">
              <div class="dash-widgetimg">
                <span><img src="assets/img/icons/dash1.svg" alt="img" /></span>
              </div>
              <div class="dash-widgetcontent">
                <h5>
                  <span class="counters" data-count="15">15</span>
                </h5>
                <h6>Daily Reservations</h6>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash1">
              <div class="dash-widgetimg">
                <span><img src="assets/img/icons/dash2.svg" alt="img" /></span>
              </div>
              <div class="dash-widgetcontent">
                <h5>
                  <?php
                  require_once 'config.php';

                  // Get the total number of rows in the inventory table
                  $query = "SELECT COUNT(*) AS total FROM inventory";
                  $result = mysqli_query($connection, $query);

                  if ($result) {
                    // Fetch the total row count
                    $row = mysqli_fetch_assoc($result);
                    $totalCount = $row['total'];

                    // Display the total count in an <h4> tag
                    ?>
                    <span class="counters" data-count="<?php echo $totalCount; ?>"></span>
                    <?php
                  } else {
                    echo "Error retrieving inventory count: " . mysqli_error($connection);
                  }
                  ?>

                </h5>
                <h6>Total Inventory</h6>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash2">
              <div class="dash-widgetimg">
                <span><img src="assets/img/icons/dash3.svg" alt="img" /></span>
              </div>
              <div class="dash-widgetcontent">
                <h5>
                  <span class="counters" data-count="120"></span>
                </h5>
                <h6>Daily Request</h6>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash3">
              <div class="dash-widgetimg">
                <span><img src="assets/img/icons/dash4.svg" alt="img" /></span>
              </div>
              <div class="dash-widgetcontent">
                <h5>
                  <span class="counters" data-count="540"></span>
                </h5>
                <h6>Daily Visistors</h6>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
              <div class="dash-counts">
                <?php
                require_once 'config.php';

                // Get the total number of rows in the inventory table
                $query = "SELECT COUNT(*) AS total FROM reservations";
                $result = mysqli_query($connection, $query);

                if ($result) {
                  // Fetch the total row count
                  $row = mysqli_fetch_assoc($result);
                  $totalCount = $row['total'];

                  ?>
                  <h4>
                    <?php echo $totalCount; ?>
                  </h4>
                  <?php
                } else {
                  echo "Error retrieving inventory count: " . mysqli_error($connection);
                }
                ?>
                <h5>Reservations</h5>
              </div>
              <div class="dash-imgs">
                <i data-feather="user-check"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
              <div class="dash-counts">
                <?php
                require_once 'config.php';

                // Get the total number of rows in the inventory table
                $query = "SELECT COUNT(*) AS total FROM inventory";
                $result = mysqli_query($connection, $query);

                if ($result) {
                  // Fetch the total row count
                  $row = mysqli_fetch_assoc($result);
                  $totalCount = $row['total'];

                  // Display the total count in an <h4> tag
                  ?>
                  <h4>
                    <?php echo $totalCount; ?>
                  </h4>
                  <?php
                } else {
                  echo "Error retrieving inventory count: " . mysqli_error($connection);
                }
                ?>
                <h5>Inventory</h5>
              </div>
              <div class="dash-imgs">
                <i data-feather="file-text"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count">
              <div class="dash-counts">
                <?php
                require_once 'config.php';

                // Get the total number of rows in the inventory table
                $query = "SELECT COUNT(*) AS total FROM users";
                $result = mysqli_query($connection, $query);

                if ($result) {
                  // Fetch the total row count
                  $row = mysqli_fetch_assoc($result);
                  $totalCount = $row['total'];

                  ?>
                  <h4>
                    <?php echo $totalCount; ?>
                  </h4>
                  <?php
                } else {
                  echo "Error retrieving inventory count: " . mysqli_error($connection);
                }
                ?>
                <h5>Users</h5>
              </div>
              <div class="dash-imgs">
                <i data-feather="user"></i>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-lg-7 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
              <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daily Logins</h5>
                <div class="graph-sets">
                  <ul>
                    <li>
                      <span>Reservations</span>
                    </li>
                    <li>
                      <span>Request</span>
                    </li>
                  </ul>
                  <div class="dropdown">
                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      2023
                      <img src="assets/img/icons/dropdown.svg" alt="img" class="ms-2" />
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <li>
                        <a href="javascript:void(0);" class="dropdown-item">2023</a>
                      </li>
                      <li>
                        <a href="javascript:void(0);" class="dropdown-item">2022</a>
                      </li>
                      <li>
                        <a href="javascript:void(0);" class="dropdown-item">2021</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="sales_charts"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
              <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Recently Item Added</h4>
                <div class="dropdown">
                  <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                    <i class="fa fa-ellipsis-v"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                      <a href="productlist.php" class="dropdown-item">Product List</a>
                    </li>
                    <li>
                      <a href="addproduct.php" class="dropdown-item">Product Add</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive dataview">
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th>sno</th>
                        <th>Products</th>
                        <th>on stock</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      require_once 'config.php';

                      // Retrieve the three most recent inventory entries added within the last five days
                      $query = "SELECT * FROM inventory LIMIT 3";
                      $result = mysqli_query($connection, $query);

                      if (mysqli_num_rows($result) > 0) {
                        $counter = 1;

                        while ($row = mysqli_fetch_assoc($result)) {
                          $productName = $row['product_name'];
                          $onStock = $row['on_stock'];
                          $image = $row['image'];

                          ?>
                          <tr>
                            <td>
                              <?php echo $counter; ?>
                            </td>
                            <td class="productimgname">
                              <a href="productlist.html" class="product-img">
                                <img src="<?php echo $image; ?>" alt="product" />
                              </a>
                              <a href="productlist.php">
                                <?php echo $productName; ?>
                              </a>
                            </td>
                            <td>
                              <?php echo $onStock; ?>
                            </td>
                          </tr>
                          <?php

                          $counter++;
                        }
                      } else {
                        ?>
                        <tr>
                          <td colspan="3">No inventory data found within the specified timeframe</td>
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
        <div class="card mb-0">
          <div class="card-body">
            <h4 class="card-title">Reservations</h4>
            <div class="table-responsive dataview">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>sno</th>
                    <th>SKU</th>
                    <th>Item</th>
                    <th>Customer name</th>
                    <th>SchoolID</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require_once 'config.php';

                  $query = "SELECT * FROM reservations";
                  $result = mysqli_query($connection, $query);

                  if (mysqli_num_rows($result) > 0) {
                    $rowCount = 1; // Initialize row count
                    while ($row = mysqli_fetch_assoc($result)) {
                      $sku = $row['sku'];
                      $productImage = $row['image'];
                      $productName = $row['product_name'];
                      $userName = $row['userName'];
                      $schoolID = $row['schoolID'];
                      $date = $row['date'];
                      ?>
                      <tr>
                        <td>
                          <?php echo $rowCount; ?>
                        </td>
                        <td><a href="javascript:void(0);">
                            <?php echo $sku; ?>
                          </a></td>
                        <td class="productimgname">
                          <a class="product-img" href="reservationAdmin.php">
                            <img src="<?php echo $productImage; ?>" alt="product" />
                          </a>
                          <a href="reservationAdmin.php">
                            <?php echo $productName; ?>
                          </a>
                        </td>
                        <td>
                          <?php echo $userName; ?>
                        </td>
                        <td>
                          <?php echo $schoolID; ?>
                        </td>
                        <td>
                          <?php echo $date; ?>
                        </td>
                      </tr>
                      <?php
                      $rowCount++; // Increment row count
                    }
                  } else {
                    echo "<tr><td colspan='6'>No reservation data found</td></tr>";
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

  <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
  <script src="assets/plugins/apexchart/chart-data.js"></script>

  <script src="assets/js/script.js"></script>
</body>

</html>