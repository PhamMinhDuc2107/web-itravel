<?php

require_once __DIR__ . '/vendor/autoload.php';

function loadEnv()
{
   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
   $dotenv->load();
}
loadEnv();

const _DIR_ROOT = __DIR__;
define("_WEB_ROOT", ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/" . basename(_DIR_ROOT));
define("ASSET", _WEB_ROOT . "/public/assets");
define("UPLOAD", _WEB_ROOT . "/public/uploads");

spl_autoload_register(function ($class) {
   $paths = ['core', 'app', 'routers', 'logger'];
   foreach ($paths as $path) {
      $file = __DIR__ . "/$path/" . $class . ".php";
      if (file_exists($file)) {
         require_once $file;
      }
   }
});

foreach (glob(__DIR__ . "/routers/*.php") as $file) {
   require_once $file;
}
require_once __DIR__ . '/logger/AppLogger.php';
