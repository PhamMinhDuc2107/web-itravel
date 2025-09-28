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
   $paths = ['core', 'logger',];
   foreach ($paths as $path) {
      $file = __DIR__ . "/$path/" . $class . ".php";
      if (file_exists($file)) {
         require_once $file;
      }
   }
});
spl_autoload_register(function ($class) {
    $directories = [
        __DIR__ . '/app/enums/',
        __DIR__ . '/app/requests/',
    ];

    foreach ($directories as $dir) {
        if (!is_dir($dir)) continue;

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir)
        );

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $filename = $file->getBasename('.php');

                if ($filename === $class) {
                    require_once $file->getPathname();
                    return;
                }
            }
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


