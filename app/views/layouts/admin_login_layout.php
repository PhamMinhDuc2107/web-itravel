<!--
=========================================================
* Argon Dashboard 3 - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo ASSET?>/admin/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo ASSET?>/admin/img/favicon.png">
    <title>
        Login
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo ASSET?>/admin/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="">
<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">Sign In</h4>
                                <p class="mb-0">Enter your email and password to sign in</p>
                                <span class="text-danger text-center"><?php echo Request::has("invalid", "get") ? htmlspecialchars(Request::input("invalid")) :"" ?></span>
                            </div>
                            <div class="card-body">
                                <form role="form" method="post" action="<?php echo _WEB_ROOT?>/cpanel/login-post">
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-lg" placeholder="Username"  name="username">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control form-control-lg" placeholder="Password"  name="password">
                                    </div>
                                    <?php echo Session::get("csrf_token")?>
                                    <input type="hidden" name="csrf_token" value="<?php echo Session::get("csrf_token")?>">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden">
                            <span class="mask bg-gradient-primary opacity-6"></span>
                            <h4 class="mt-5 text-white font-weight-bolder position-relative">"Welcome to Dashboard Itravel"</h4>
                            <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?php echo ASSET?>/admin/js/core/bootstrap.min.js"></script>
</body>

</html>