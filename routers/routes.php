<?php
$routes["default_controller"] = "home";
$routes['trang-chu'] = 'home/index';
$routes['gioi-thieu'] = 'introduce/index';
$routes['lien-he'] = 'contact/index';
$routes['gioi-thieu'] = 'introduce/index';
$routes['du-lich'] = 'tour/index';
$routes['du-lich/([a-zA-Z0-9-]+)'] = 'tour/detail/$1';
$routes['du-lich/get-price'] = 'tour/getPrice';

$routes['tim-kiem'] = 'tour/search';
$routes['tim-kiem-tour-du-lich'] = 'tour/searchProductAjax';
$routes['tim-kiem-ajax'] = 'tour/searchProductAndBlogAjax';
$routes['(tour-trong-nuoc|tour-nuoc-ngoai|tour-cao-cap|tour-combo-gia-re)(?:/([a-zA-Z0-9-]+))?'] = 'tour/getToursByCategory/$1';
$routes['visa'] = 'visa/index';
$routes['ho-chieu'] = 'passport/index';
$routes['ve-may-bay'] = 'bookingFilght/index';
$routes['dat-phong-khach-san'] = 'hotel/index';
$routes['thue-xe-du-lich'] = 'bookingVehicle/index';
$routes['to-chuc-su-kien'] = 'bookingEvent/index';
$routes['can-cuoc-cong-dan'] = 'identityCard/index';

$routes['order-booking/(.+)'] = "booking/index/$1";
$routes['checkout'] = "booking/checkout";
$routes['checkout/thankyou'] = "result/index";

$routes['tin-tuc'] = 'blog/index';
$routes['tin-tuc/(.+)'] = 'blog/detail/$1';
$routes['thong-bao-ket-qua'] = "result/index";
$routes['lien-he-tu-van-([a-zA-Z0-9-]+)'] = 'ContactService/index/$1';
$routes['gui-thong-tin-lien-he'] = 'contact/handleContactForm';
$routes['404'] = "errors/NotFound/index";
$routes['500'] = "errors/InternalServer/index";





$routes['dashboard'] = 'admin/dashboard/index';
$routes['dashboard/login'] = 'admin/dashboard/login';
$routes['dashboard/login-post'] = 'admin/dashboard/loginPost';
$routes['dashboard/logout'] = 'admin/dashboard/logout';


$adminModules = ['admin', 'category', 'blog', 'blogCategory', 'location', "tour", "tourItinerary", 'booking', "consultation", "banner", "tourNote"];
foreach ($adminModules as $module) {
   $routes["dashboard/$module"] = "admin/$module/index";
   $routes["dashboard/$module-update/(.+)"] = "admin/$module/update/$1";
   $routes["dashboard/$module-update-post"] = "admin/$module/updatePost";
   $routes["dashboard/$module-create"] = "admin/$module/create";
   $routes["dashboard/$module-delete"] = "admin/$module/delete";
   $routes["dashboard/$module-search"] = "admin/$module/search";
}
$routes['dashboard/booking-export-data'] = 'admin/booking/exportBookingToExcel';
$routes['dashboard/consultation-export-excel'] = 'admin/consultation/exportConsultationToExcel';
