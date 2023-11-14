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
    <title>Sign up</title>

    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="assets/img/cpulogo.png" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Create an Account</h3>
                            <h4>Continue where you left off</h4>
                        </div>
                        <form action="signupAuth.php" method="POST">
                            <div class="form-login">
                                <label>Full Name</label>
                                <div class="form-addons">
                                    <input type="text" name="name" placeholder="Enter your full name">
                                    <img src="assets/img/icons/users1.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>School ID</label>
                                <div class="form-addons">
                                    <input type="text" name="schoolID" placeholder="Enter your School ID">
                                    <img src="assets/img/icons/users1.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Mobile number</label>
                                <div class="form-addons">
                                    <input type="text" name="mobile_number" placeholder="Mobile number">
                                    <img src="assets/img/icons/users1.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="text" name="email" placeholder="Enter your email address">
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password" class="pass-input"
                                        placeholder="Enter your password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Register</button>
                            </div>
                        </form>
                        <div class="signinform text-center">
                            <h4>Already a user? <a href="index.php" class="hover-a">Sign in</a></h4>
                        </div>
                        <div class="form-sociallink">

                        </div>
                    </div>
                </div>
                <div class="login-img">
                    <img src="assets/img/login.jpg" alt="img">
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>