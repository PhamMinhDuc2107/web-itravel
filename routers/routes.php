<?php
   $routes["default_controller"] = "home";
   $routes['san-pham'] = 'product/index';
   $routes['trang-chu'] = 'home/index';
   // (.+) => trả về $1
   // .+-(\d+) => trả về số trong dãy đáy tin-tuc/asdmaskdjksad-1 => 1
   $routes['tin-tuc/(.+)'] = 'news/category/$1';

   $routes['cpanel'] = 'admin/dashboard/index';
   $routes['cpanel/login'] = 'admin/dashboard/login';
   $routes['cpanel/login-post'] = 'admin/dashboard/loginPost';
   $routes['cpanel/logout'] = 'admin/dashboard/logout';

   $adminModules = ['admin', 'category', 'blog', 'blogCategory','location',"tour"];
   foreach ($adminModules as $module) {
      $routes["cpanel/$module"] = "admin/$module/index";
      $routes["cpanel/$module-update/(.+)"] = "admin/$module/update/$1";
      $routes["cpanel/$module-update-post"] = "admin/$module/updatePost";
      $routes["cpanel/$module-create"] = "admin/$module/create";
      $routes["cpanel/$module-delete"] = "admin/$module/delete";
   }
