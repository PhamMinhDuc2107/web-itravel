<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once __DIR__ . '/vendor/autoload.php';
function loadEnv()
{
   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
   $dotenv->load();
}
loadEnv();
$app_env  = $_ENV['APP_ENV'] ?? 'local';


const _DIR_ROOT = __DIR__;
define("_WEB_ROOT", ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/" . basename(_DIR_ROOT));

define("ASSET", _WEB_ROOT . "/public/assets");
define("UPLOAD", _WEB_ROOT . "/public/uploads");
// load core, app, routers
spl_autoload_register(function ($class) {
   $paths = ['core', 'logger'];
   foreach ($paths as $path) {
      $file = __DIR__ . "/$path/" . $class . ".php";
      if (file_exists($file)) {
         require_once $file;
      }
   }
});
// require mailer
require_once __DIR__ . "/mailer/MailerInterface.php";
require_once __DIR__ . "/mailer/Mailable.php";
require_once __DIR__ . "/mailer/Mailer.php";
require_once __DIR__ . "/mailer/OrderMail.php";

// check AppEnv
if($app_env === 'maintenance') {
   Util::loadError('503', "503");
}
// load routers
require_once __DIR__ . "/routers/routers.php";
// load app
require_once __DIR__ . "/app/App.php";


