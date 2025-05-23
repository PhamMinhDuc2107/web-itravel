<?php
class Connection {
   private static $instance = null, $con = null;
   private static function connect() {
      try {
         if (!isset($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USERNAME'])) {
           
         }
         $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
         self::$con = new PDO($dsn, $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"] ?? "");
         self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         self::$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
         self::$con->exec("SET NAMES utf8");
      } catch (Exception $e) {
         $mess = $e->getMessage();
         if (preg_match("/Access denied for user/", $mess)) {
            Util::loadError('500', 500);
         }
         if (preg_match("/Unknown database/", $mess)) {
            Util::loadError('500', 500);
         }
      }
   }

   public static function getInstance() {
      if (self::$instance === null) {
         self::connect();
         self::$instance = self::$con;
      }
      return self::$instance;
   }
}
