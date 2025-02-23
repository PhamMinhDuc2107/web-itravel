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

    <link href="<?php echo ASSET?>/admin/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <script src="<?php echo ASSET?>/admin/js/froala_editor.pkgd.min.js"></script>
    <style>
        .pagination {
            display: flex;
            justify-content: end;
            align-items: center;
            gap: 2px;
            margin-bottom: unset;
            margin-right: 5px;
            .page-item {
                .page-link {
                    width: 100%;
                    border-radius: 8px !important;
                    margin-left: unset;
                    height: 30px;
                    width: 30px;
                }
            }
        }
        .page-item.disabled {
            opacity: 0.5;
        }
        .page-item.active .page-link {
            color: #fff;
        }
        .hiddenText {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            width:100%;
            max-width: 100%;
            white-space: pre-wrap;
            word-break: break-word;
        }

    </style>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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