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
    <title>CPU enterprise</title>

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

    <div class="main-wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>User List</h4>
                        <h6>Manage your User</h6>
                    </div>
                    <div class="page-btn">
                        <a href="newuser.html" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img">Add
                            User</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th>
                                <th>name </th>
                                <th>Phone</th>
                                <th>School ID</th>
                                <th>Role</th>
                                <th>Created On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once 'config.php';

                            // Fetch users' data from the database excluding those with the role "student"
                            $query = "SELECT * FROM users WHERE role != 'student'";
                            $result = mysqli_query($connection, $query);

                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                                // Iterate through each row and populate the HTML table
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $userId = $row['id'];
                                    $name = $row['name'];
                                    $phone = $row['mobile_number'];
                                    $schoolID = $row['schoolID'];
                                    $role = $row['role'];
                                    $createdOn = $row['datecreated'];
                                    $status = $row['status'];
                                    ?>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <?php echo $name; ?>
                                        </td>
                                        <td>
                                            <?php echo $phone; ?>
                                        </td>
                                        <td>
                                            <?php echo $schoolID; ?>
                                        </td>
                                        <td>
                                            <?php echo $role; ?>
                                        </td>
                                        <td>
                                            <?php echo $createdOn; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $statusClass = ($status == 'Active') ? 'bg-lightgreen' : 'bg-lightred';
                                            ?>

                                            <span style="cursor:pointer;"
                                                class="badges status-toggle <?php echo $statusClass ?>"
                                                data-user-id="<?php echo $userId ?>"
                                                data-current-status="<?php echo $status ?>">
                                                <?php echo $status; ?>
                                            </span>
                                        </td>


                                        <td>
                                            <a class="me-3" href="newuseredit.html">
                                                <img src="assets/img/icons/edit.svg" alt="img">
                                            </a>
                                            <a class="me-3" href="userlistdelete.php?id=<?= $userId ?>">
                                                <img src="assets/img/icons/delete.svg" alt="img">
                                            </a>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                // No users found in the database with a role other than "student"
                                ?>
                                <tr>
                                    <td colspan="8">No users found</td>
                                </tr>
                                <?php
                            }

                            // Close the database connection
                            mysqli_close($connection);
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="assets/js/upload.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>