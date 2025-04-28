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
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo ASSET ?>/client/images/itravel_resize-1.png">
    <link rel="icon" type="image/png" href="<?php echo ASSET ?>/client/images/itravel_resize-1.png">
    <title>
        <?php echo $data['title'] ?? "Dashboard" ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo ASSET ?>/admin/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />

    <link href="<?php echo ASSET ?>/admin/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <script src="<?php echo ASSET ?>/admin/js/froala_editor.pkgd.min.js"></script>
    <!-- Flatpickr -->
    <link rel="stylesheet" href="<?php echo ASSET ?>/utils/flatpickr.min.css">
    <script src="<?php echo ASSET ?>/utils/flatpickr.min.js"></script>
    <script>
        const debounce = (fn, delay) => {
            let timeout;
            return (...args) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => fn.apply(this, args), delay);
            };
        };
    </script>
    <script src="<?php echo ASSET ?>/utils/jquery-3.6.0.min.js" defer></script>

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
            width: 100%;
            max-width: 100%;
            white-space: pre-wrap;
            word-break: break-word;
        }
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-dark position-absolute w-100"></div>
    <?php
    $sidebarPath = _DIR_ROOT . "/app/views/admin/blocks/sidebar.view.php";
    if (file_exists($sidebarPath)) {
        require_once $sidebarPath;
    }
    ?>
    <main class="main-content position-relative border-radius-lg ">
        <?php
        $headerPath = _DIR_ROOT . "/app/views/admin/blocks/header.view.php";
        if (file_exists($headerPath)) {
            require_once $headerPath;
        }
        ?>
        <div class="container-fluid py-4">
            <div class="row">
                <?php if (isset($data['page'])) {
                    $folder = _DIR_ROOT . "/app/views/admin/pages/" . $data['page'] . ".view.php";
                    if (file_exists($folder)) {
                        require_once $folder;
                    }
                } ?>
            </div>
        </div>

    </main>
    <!-- Overlay loading -->
    <style>
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
        }
    </style>
    <div id="loading-overlay">
        <div class="spinner-border text-success " role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <script>
        let iconNav = document.getElementById("iconNavbarSidenav");
        let mainContent = document.querySelector(".main-content");
        let sideNav = document.querySelector(".sidenav");
        iconNav.addEventListener("click", function(e) {
            mainContent.classList.toggle("ms-0");
            sideNav.classList.toggle("d-none");
        })
    </script>

    <script>
        function showImage(image, show) {
            let img = document.getElementById(`${image}`);
            if (img) {
                img.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const reader = new FileReader();
                    reader.onload = function() {
                        document.getElementById(`${show}`).src = reader.result;
                    }
                    if (file) {
                        reader.readAsDataURL(file);
                    }
                    document.getElementById(`${show}`).style.height = `100%`;
                    document.getElementById(`${show}`).style.width = `100%`;
                });
            }
        }

        showImage("image", "previewImage");
        showImage("imageCreateBlog", "previewImageBlog");
    </script>
    <!--   Core JS Files   -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const footerFunction = document.querySelector('.footer-function');
            const span = document.querySelector('.footer-text-content');
            const closeBtn = document.querySelector('.footer-btn');
            const tableBody = document.querySelector('.table-body');

            function countCheckedCheckboxes() {
                const checkboxes = tableBody.querySelectorAll('.input-checkbox');
                let checkedCount = 0;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        checkedCount += 1;
                    }
                });
                return checkedCount;
            }

            function updateFooterFunction() {
                const checkedCount = countCheckedCheckboxes();
                if (checkedCount > 0) {
                    footerFunction.classList.add("d-flex");
                    footerFunction.classList.remove("d-none")

                    span.textContent = `${checkedCount}`;
                } else {
                    footerFunction.classList.toggle("d-none")
                    footerFunction.classList.remove("d-flex")
                }
            }
            if (tableBody) {
                tableBody.addEventListener('change', function(e) {
                    if (e.target && e.target.matches('.input-checkbox')) {
                        updateFooterFunction();
                    }
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    const checkboxes = tableBody.querySelectorAll('.input-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    updateFooterFunction();
                });
            }
        });
    </script>
    <script src="<?php echo ASSET ?>/admin/js/core/popper.min.js"></script>
    <script src="<?php echo ASSET ?>/admin/js/core/bootstrap.min.js"></script>
    <script src="<?php echo ASSET ?>/admin/js/app.js"></script>

</body>

</html>