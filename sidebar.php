<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <li class="">
                        <a href="home.php"><img src="assets/img/icons/dashboard.svg" alt="img" /><span>
                                Dashboard</span>
                        </a>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img" /><span>
                                Inventory</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="productlist.php">Product List</a></li>
                            <li><a href="addproduct.php">Add Product</a></li>
                            <li><a href="categorylist.php">Category List</a></li>
                            <li><a href="addcategory.php">Add Category</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/quotation1.svg" alt="img" /><span>
                                Reservation</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="reservationAdmin.php">Reservation List</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="adminRequest.php"><img src="assets/img/icons/eye1.svg" alt="img" /><span>
                                Request</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="userlist.php"><img src="assets/img/icons/users1.svg" alt="img" /><span>
                                Students</span>
                        </a>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img" /><span>
                                Users</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="newuser.php">New User </a></li>
                            <li><a href="userlists.php">Users List</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/settings.svg" alt="img" /><span>
                                Settings</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="#">General Settings</a></li>
                            <li><a href="#">Email Settings</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'student'): ?>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/quotation1.svg" alt="img" /><span>
                                Reservation</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="reservationStudent.php">Product</a></li>
                            <li><a href="reservationStudentRecod.php">Reservation Record</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="requestStudent.php"><img src="assets/img/icons/users1.svg" alt="img" /><span>
                                Request</span>
                        </a>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/settings.svg" alt="img" /><span>
                                Settings</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="#">General Settings</a></li>
                            <li><a href="#">Email Settings</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>