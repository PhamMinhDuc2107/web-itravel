<?php
class Connection {
   private static $instance = null, $con = null;
   private static function connect() {
      try {
         if (!isset($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USERNAME'])) {
            die("Database configuration error! Please check your .env file.");
         }
         $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
         self::$con = new PDO($dsn, $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"] ?? "");
         self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         self::$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
         self::$con->exec("SET NAMES utf8");
      } catch (Exception $e) {
         $mess = $e->getMessage();
         if (preg_match("/Access denied for user/", $mess)) {
            die("Database connection error!");
         }
         if (preg_match("/Unknown database/", $mess)) {
            die("Database not found");
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
