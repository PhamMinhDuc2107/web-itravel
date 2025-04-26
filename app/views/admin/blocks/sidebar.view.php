<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?php echo _DIR_ROOT ?>/dashboard">
            <img src="<?php echo ASSET ?>/client/images/itravel_resize-1.png" width="30px" height="30px"
                class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold"><?php echo $data['heading'] ?? "Dashboard" ?></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo _WEB_ROOT ?>/dashboard">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-display text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT ?>/dashboard/admin">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user-tie text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý Admin</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT ?>/dashboard/banner">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-images text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý Banner</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Thông tin đặt hàng</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT . '/dashboard/booking' ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cart-shopping text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý đặt tour</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT . '/dashboard/consultation' ?>">
                    <div class="" style="padding:0 10px 0 5px;">
                        <i class="fa-solid fa-message  text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Khách hàng cần tư vấn</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Tour</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT . '/dashboard/tour' ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-box text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý tour</span>
                </a>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT . '/dashboard/category' ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-list text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý danh mục tour</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT . '/dashboard/location' ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-map text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý điểm đến tour</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT . '/dashboard/tourItinerary' ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-plane-departure  text-dark text-sm opacity-10"></i>

                    </div>
                    <span class="nav-link-text ms-1">Quản lý hành trính tour</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT . '/dashboard/tourNote' ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-list text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Những điều cần lưu ý</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Khách sạn</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT . '/dashboard/hotel' ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-hotel text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý khách sạn</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Tin tức</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT . '/dashboard/blog' ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-newspaper text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý tin tức</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT . '/dashboard/blogCategory' ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-list text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Danh mục tin tức</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Tài khoản</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-address-card text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo _WEB_ROOT ?>/dashboard/logout">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-right-from-bracket text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>