<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class AdminLogger
{
   private static $logger;

   public static function getLogger(): Logger
   {
      if (empty(self::$logger)) {
         $logDir = __DIR__ . '/../logs';
         if (!is_dir($logDir) && !mkdir($logDir, 0755, true)) {
            throw new \Exception("Không thể tạo thư mục logs tại: " . $logDir);
         }

         self::$logger = new Logger('admin_log');
         $handler = new StreamHandler($logDir . '/admin.log', Logger::DEBUG);

         $formatter = new LineFormatter(
            "[%datetime%] %channel%.%level_name%: %message% %context%\n",
            "Y-m-d H:i:s",
            true,
            true
         );
         $handler->setFormatter($formatter);
         self::$logger->pushHandler($handler);
      }

      return self::$logger;
   }
}
