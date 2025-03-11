<?php
   $routes["default_controller"] = "home";
   $routes['trang-chu'] = 'home/index';
   $routes['gioi-thieu'] = 'introduce/index';
   $routes['lien-he'] = 'contact/index';
   $routes['lien-he/gui-yeu-cau'] = 'contact/handleContactForm';
   $routes['gioi-thieu'] = 'introduce/index';

   $routes['collections/all'] = 'tour/index';
   $routes['chuong-trinh/(.+)'] = 'tour/detail/$1';
   $routes['chuong-trinh/get-price'] = 'tour/getPrice';

   $routes['order-booking/(.+)'] = "booking/index/$1";
   $routes['checkout'] = "booking/checkout";

   $routes['tin-tuc'] = 'blog/index';
   $routes['tin-tuc/(.+)'] = 'blog/detail/$1';

   $routes['thong-bao-ket-qua'] = "result/index";

   $routes['dashboard'] = 'admin/dashboard/index';
   $routes['dashboard/login'] = 'admin/dashboard/login';
   $routes['dashboard/login-post'] = 'admin/dashboard/loginPost';
   $routes['dashboard/logout'] = 'admin/dashboard/logout';


   $adminModules = ['admin', 'category', 'blog', 'blogCategory','location',"tour","tourItinerary",'booking',"consultation","banner"];
   foreach ($adminModules as $module) {
      $routes["dashboard/$module"] = "admin/$module/index";
      $routes["dashboard/$module-update/(.+)"] = "admin/$module/update/$1";
      $routes["dashboard/$module-update-post"] = "admin/$module/updatePost";
      $routes["dashboard/$module-create"] = "admin/$module/create";
      $routes["dashboard/$module-delete"] = "admin/$module/delete";
      $routes["dashboard/$module-search"] = "admin/$module/search";
   }
   $routes['dashboard/booking-export-data']= 'admin/booking/exportBookingToExcel';
   $routes['dashboard/consultation-export-excel']= 'admin/consultation/exportConsultationToExcel';
