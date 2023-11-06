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
    <?php
    session_start();

    // Access the user information from session variables
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $user_role = $_SESSION['user_role'];
    $schoolID = $_SESSION['schoolID'];
    ?>
    <div class="header">
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'student'): ?>
            <div class="header-left active">
                <a href="student-productlist.php" class="logo">
                    <img src="assets/img/cpulogo.png" alt="" />
                </a>
                <a id="toggle_btn" href="javascript:void(0);"> </a>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <div class="header-left active">
                <a href="home.php" class="logo">
                    <img src="assets/img/cpulogo.png" alt="" />
                </a>
                <a id="toggle_btn" href="javascript:void(0);"> </a>
            </div>

        <?php endif; ?>

        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>


        <ul class="nav user-menu">
            <li class="nav-item">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                    <form action="#">
                        <div class="searchinputs">
                            <input type="text" placeholder="Search Here ..." />
                            <div class="search-addon">
                                <span><img src="assets/img/icons/closes.svg" alt="img" /></span>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                <li class="nav-item dropdown">
                    <?php
                    include 'config.php';
                    // Query to fetch notifications from the notification table
                    $query = "SELECT * FROM notification";
                    $result = mysqli_query($connection, $query);



                    // Check if there are notifications
                    if (mysqli_num_rows($result) > 0) {
                        ?>
                        <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <img src="assets/img/icons/notification-bing.svg" alt="img" />
                            <span class="badge rounded-pill">

                            </span>
                        </a>
                        <div class="dropdown-menu notifications">
                            <div class="topnav-dropdown-header">
                                <span class="notification-title">Notifications</span>
                                <!-- <a href="javascript:void(0)" class="clear-noti"> Clear All </a> -->
                            </div>
                            <div class="noti-content">
                                <ul class="notification-list">
                                    <div class="noti-content">
                                        <ul class="notification-list">
                                            <li class="notification-message">
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $notification_id = $row['id'];
                                                    $status = $row['status'];

                                                    // Fetch user name based on user_id from the users table
                                                    $user_query = "SELECT name FROM users WHERE id = ?";
                                                    $user_stmt = mysqli_prepare($connection, $user_query);
                                                    mysqli_stmt_bind_param($user_stmt, "i", $row['user_id']);
                                                    mysqli_stmt_execute($user_stmt);
                                                    $user_result = mysqli_stmt_get_result($user_stmt);
                                                    $user_data = mysqli_fetch_assoc($user_result);
                                                    $user_name = $user_data['name'];

                                                    // Fetch product name based on productid from the inventory table
                                                    $product_query = "SELECT sku FROM inventory WHERE id = ?";
                                                    $product_stmt = mysqli_prepare($connection, $product_query);
                                                    mysqli_stmt_bind_param($product_stmt, "i", $row['productid']);
                                                    mysqli_stmt_execute($product_stmt);
                                                    $product_result = mysqli_stmt_get_result($product_stmt);
                                                    $product_data = mysqli_fetch_assoc($product_result);
                                                    $product_name = $product_data['sku'];
                                                    ?>
                                                    <?php if ($status == "request") { ?>
                                                        <a href="adminRequest.php">

                                                            <div class="media d-flex">
                                                                <span class="avatar flex-shrink-0">
                                                                    <img alt="" src="assets/img/avart.jpg">
                                                                </span>
                                                                <div class="media-body flex-grow-1">

                                                                    <p class="noti-details"><span class="noti-title">
                                                                            <?php echo $user_data['name'] ?>
                                                                        </span>

                                                                        has sent a request <span class="noti-title">for
                                                                            restocking</span>

                                                                    </p>

                                                                    </p>

                                                                </div>
                                                            </div>


                                                            <?php
                                                    }
                                                    ?>
                                                    </a>
                                                <?php } ?>
                                                <?php if ($status == "reserve") { ?>
                                                    <a href="reservationAdmin.php">

                                                        <div class="media d-flex">
                                                            <span class="avatar flex-shrink-0">
                                                                <img alt="" src="assets/img/avart.jpg">
                                                            </span>
                                                            <div class="media-body flex-grow-1">

                                                                <p class="noti-details"><span class="noti-title">
                                                                        <?php echo $user_data['name'] ?>
                                                                    </span>

                                                                    has sent a Reservation <span class="noti-title">for
                                                                        SKU
                                                                        <?php echo $product_name ?>
                                                                    </span>

                                                                </p>

                                                                </p>

                                                            </div>
                                                        </div>


                                                        <?php
                                                }
                                                ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </ul>
                            </div>

                            <?php
                    } else {
                        // No notifications
                        ?>
                            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                <img src="assets/img/icons/notification-bing.svg" alt="img" />
                                <span class="badge rounded-pill">0</span>
                            </a>
                            <?php
                    }
                    ?>



                        <!-- <div class="topnav-dropdown-footer">
                            <a href="activities.php">View all Notifications</a>
                        </div> -->
                    </div>
                </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'student'): ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <img src="assets/img/icons/notification-bing.svg" alt="img" />
                        <span class="badge rounded-pill">
                        </span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <!-- <a href="javascript:void(0)" class="clear-noti"> Clear All </a> -->
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">

                                    <?php
                                    include 'config.php';


                                    if (isset($_SESSION['user_id'])) {
                                        $user_id = $_SESSION['user_id'];

                                        $user_query = "SELECT * FROM users WHERE id = ?";
                                        $user_stmt = mysqli_prepare($connection, $user_query);
                                        mysqli_stmt_bind_param($user_stmt, "i", $user_id);
                                        mysqli_stmt_execute($user_stmt);
                                        $user_result = mysqli_stmt_get_result($user_stmt);


                                        $user_data = mysqli_fetch_assoc($user_result);

                                        $count_query = "SELECT COUNT(*) as notification_count FROM notification WHERE user_id = ?";
                                        $count_stmt = mysqli_prepare($connection, $count_query);
                                        mysqli_stmt_bind_param($count_stmt, "i", $user_id);
                                        mysqli_stmt_execute($count_stmt);
                                        $count_result = mysqli_stmt_get_result($count_stmt);
                                        $notification_count = mysqli_fetch_assoc($count_result)['notification_count'];


                                        mysqli_stmt_close($count_stmt);

                                        $query = "SELECT * FROM notification WHERE user_id = ? ";
                                        $stmt = mysqli_prepare($connection, $query);
                                        mysqli_stmt_bind_param($stmt, "i", $user_id);
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);

                                        // Check if there are notifications for the user
                                        if (mysqli_num_rows($user_result) > 0) {

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $notification_id = $row['id'];
                                                $status = $row['status'];

                                                // You can customize the content of each notification here
                                                $notification_content = "Notification Content"; // Replace with your actual content
                                                ?>
                                                <?php if ($status == "restock") { ?>

                                                    <a href="requestStudent.php">
                                                        <div class="media d-flex">
                                                            <span class="avatar flex-shrink-0">
                                                                <img alt="" src="assets/img/avart.jpg">
                                                            </span>
                                                            <div class="media-body flex-grow-1">
                                                                <p class="noti-details"><span class="noti-title">
                                                                        <?php echo $user_data['name'] ?>
                                                                    </span>

                                                                    Your item <span class="noti-title">request has been restocked</span>

                                                                </p>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                <?php } ?>
                                                <?php

                                            }

                                        } else {
                                            // No notifications for the user
                                            echo "<p>No notifications found.</p>";
                                        }

                                        mysqli_stmt_close($stmt);
                                        mysqli_stmt_close($user_stmt);
                                    } else {

                                        exit();
                                    }
                                    ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endif; ?>


            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-img"><img src="assets/img/avart.jpg" alt="" />
                        <span class="status online"></span></span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilename">

                        <div class="profileset">
                            <span class="user-img"><a href="profile.php?user_id=<?php echo $user_id; ?>"><img
                                        src="assets/img/avart.jpg" alt="" /></a>
                                <span class="status online"></span></span>
                            <div class="profilesets">
                                <h6 style="font-size:10px;">
                                    <?php echo $user_name; ?>
                                </h6>
                                <p style="font-size:10px;">
                                    <?php echo $user_role; ?>
                                </P>
                            </div>
                        </div>
                        <hr class="m-0" />
                        <!-- <a class="dropdown-item" href="profile.php">
                            <i class="me-2" data-feather="user"></i> My Profile</a> -->
                        <a class="dropdown-item" href="profile.php?user_id=<?php echo $user_id; ?>"><i class="me-2"
                                data-feather="settings"></i>Profile</a>
                        <hr class="m-0" />
                        <a class="dropdown-item logout pb-0" href="logout.php"><img src="assets/img/icons/log-out.svg"
                                class="me-2" alt="img" />Logout</a>
                    </div>
                </div>
            </li>
        </ul>

        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php?user_id=<?php echo $user_id; ?>">My Profile</a>
                <a class=" dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
    </div>