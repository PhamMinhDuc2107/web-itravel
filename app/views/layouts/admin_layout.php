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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
               $folder = _DIR_ROOT."/app/views/admin/pages/".$data['page'].".view.php";
               if (file_exists($folder)) {
                  require_once $folder;
               }else {
                  require_once _DIR_ROOT."/app/views/admin/pages/404/404.view.php";
               }
           }?>
        </div>
    </div>

</main>
<!--   Core JS Files   -->
<script src="<?php echo ASSET?>/admin/js/core/popper.min.js"></script>

<script src="<?php echo ASSET?>/admin/js/core/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const footerFunction = document.querySelector('.footer-function');
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const span = document.querySelector('.footer-text-content');
        const closeBtn= document.querySelector('.footer-btn');
        function toggleFooterFunction() {
            let checkedCount = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });

            if (checkedCount > 0){
                footerFunction.style.display = 'flex';
                span.textContent = `${checkedCount}`;
            }else{
                footerFunction.style.display = 'none';
            }
        }
        if(footerFunction && checkboxes) {
            toggleFooterFunction();

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', toggleFooterFunction);
            });
        }
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                checkboxes.forEach(checkbox => checkbox.checked = false);
                toggleFooterFunction()
            })
        }
    });
</script>
</body>

</html>