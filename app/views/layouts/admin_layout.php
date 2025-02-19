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
        <?php echo $data['title'] ?? "Dashboard"?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo ASSET?>/admin/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
<div class="min-height-300 bg-dark position-absolute w-100"></div>
<?php
$sidebarPath = _DIR_ROOT."/app/views/admin/blocks/sidebar.view.php";
if (file_exists($sidebarPath)) {
   require_once $sidebarPath;
}
?>
<main class="main-content position-relative border-radius-lg ">
    <?php
        $headerPath = _DIR_ROOT."/app/views/admin/blocks/header.view.php";
        if (file_exists($headerPath)) {
            require_once $headerPath;
        }
    ?>
    <div class="container-fluid py-4">
        <div class="row">
           <?php if(isset($data['page'])) {
              require_once _DIR_ROOT."/app/views/admin/pages/".$data['page'].".view.php";
           }?>
        </div>
    </div>

</main>
<!--   Core JS Files   -->
<script src="<?php echo ASSET?>/admin/js/core/popper.min.js"></script>

<script src="<?php echo ASSET?>/admin/js/core/bootstrap.min.js"></script>

</body>

</html>