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
    <title>Profile</title>



    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

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
                        <h4>Profile</h4>
                        <h6>User Profile</h6>
                    </div>
                </div>
                <?php
                include 'config.php';

                // Check if product ID is provided
                if (isset($_GET['user_id'])) {
                    $user_id = $_GET['user_id'];

                    // Retrieve the product details from the database
                    $sql = "SELECT * FROM users WHERE id = ?";
                    $stmt = mysqli_prepare($connection, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    // Check if the product exists
                    if (mysqli_num_rows($result) > 0) {
                        $userdata = mysqli_fetch_assoc($result);
                    } else {
                        // Redirect back to the product list page if the product doesn't exist
                        header("Location: adminRequest.php");
                        exit();
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    // Redirect back to the product list page if no product ID is provided
                    header("Location: adminRequest.php");
                    exit();
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="profile-set">
                            <div class="profile-head">
                            </div>
                            <div class="profile-top">
                                <div class="profile-content">
                                    <div class="profile-contentimg">
                                        <img src="assets/img/avart.jpg" alt="img" id="blah">
                                        <div class="profileupload">
                                            <!-- <input type="file" id="imgInp">
                                            <a href="javascript:void(0);"><img src="assets/img/icons/edit-set.svg"
                                                    alt="img"></a> -->
                                        </div>
                                    </div>
                                    <div class="profile-contentname">
                                        <h2>
                                            <?php echo $userdata['name'] ?>
                                        </h2>
                                        <h4>Updates Your Photo and Personal Details.</h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <form action="updateprofile.php" method="post" class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="<?php echo $userdata['name'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" value="<?php echo $userdata['role'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" value="<?php echo $userdata['email'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" value="<?php echo $userdata['mobile_number'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" value="<?php echo $userdata['status'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class=" pass-input"
                                            value="<?php echo $userdata['password'] ?>">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                <input type="submit" class="btn btn-submit me-2">Update</input>
                                <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                            </div> -->
                        </form>
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
</body>

</html>