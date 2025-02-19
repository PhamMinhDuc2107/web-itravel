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

   $routes['cpanel/admin'] = 'admin/admin/index';
   $routes['cpanel/admin-update/(.+)'] = 'admin/admin/update/$1';
   $routes['cpanel/admin-update-post'] = 'admin/admin/updatePost';
   $routes['cpanel/admin-create'] = 'admin/admin/create';
   $routes['cpanel/admin-delete'] = 'admin/admin/delete';

   $routes['cpanel/category'] = 'admin/category/index';
   $routes['cpanel/category-update/(.+)'] = 'admin/category/update/$1';
   $routes['cpanel/category-update-post'] = 'admin/category/updatePost';
   $routes['cpanel/category-create'] = 'admin/category/create';
   $routes['cpanel/category-delete'] = 'admin/category/delete';
