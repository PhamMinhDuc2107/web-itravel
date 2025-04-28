<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

const _DIR_ROOT = __DIR__;


if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
   $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
   $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}
$folder = basename(_DIR_ROOT);
$web_root = $web_root . "/" . $folder;
define("_WEB_ROOT", $web_root);
$assets = $web_root . "/public/assets";
define("ASSET", $assets);
$upload = $web_root . "/public/uploads";
define("UPLOAD", $upload);


$router_path = scandir("routers");
if (!empty($router_path)) {
   foreach ($router_path as $file) {
      if ($file != "." && $file != ".." && file_exists("routers/" . $file)) {
         require_once("routers/" . $file);
      }
   }
}
require_once "core/Session.php";
require_once "core/Util.php";
require_once "core/Response.php";

//load route class
require_once "core/Route.php";
// load app
require_once "app/App.php";
require_once 'core/Connection.php';
require_once "core/Database.php";
require_once "core/Model.php";
require_once "core/JwtUtil.php";
require_once "core/RedisService.php";
//load base controller
require_once "core/Request.php";

require_once "core/Controller.php";
