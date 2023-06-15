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
  <title>Edit</title>

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
            <h4>Product Edit Category</h4>
            <h6>Edit a product Category</h6>
          </div>
        </div>

        <?php
        include 'config.php';

        if (isset($_GET['id'])) {
          $categoryId = $_GET['id'];

          $sql = "SELECT * FROM category WHERE id = $categoryId";
          $result = mysqli_query($connection, $sql);

          if ($result && mysqli_num_rows($result) > 0) {
            $category = mysqli_fetch_assoc($result);
            $categoryName = $category['category_name'];
            $categoryCode = $category['category_code'];
            $description = $category['description'];
          } else {
            echo "Category not found";
            exit();
          }
        } else {
          echo "Category ID not provided";
          exit();
        }
        ?>

        <form class="card" action="updatecategory.php" method="POST">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" name="category_name" value="<?= $categoryName ?>" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                  <label>Category Code</label>
                  <input type="text" name="category_code" value="<?= $categoryCode ?>" />
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description"><?= $description ?></textarea>
                </div>
              </div>

              <!-- Add any other form fields here -->

              <div class="col-lg-12">
                <input type="hidden" name="category_id" value="<?= $categoryId ?>">
                <button type="submit" class="btn btn-submit me-2">Submit</button>
                <a href="categorylist.php" class="btn btn-cancel">Cancel</a>
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