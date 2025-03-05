<?php
   $routes["default_controller"] = "home";
   $routes['san-pham'] = 'product/index';
   $routes['trang-chu'] = 'home/index';
   $routes['gioi-thieu'] = 'introduce/index';
   $routes['lien-he'] = 'contact/index';
   $routes['lien-he/gui-yeu-cau'] = 'contact/handleContactForm';
   $routes['gioi-thieu'] = 'introduce/index';

   $routes['thong-bao-ket-qua'] = "result/index";
   $routes['tin-tuc/(.+)'] = 'news/category/$1';

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
