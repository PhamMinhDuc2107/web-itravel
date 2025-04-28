<?php
require_once _DIR_ROOT . '/vendor/autoload.php';

use Predis\Client;

class RedisService
{
   private static $instance = null;
   private $redis;

   private function __construct()
   {
      $this->redis = new Client();
   }

   public static function getInstance()
   {
      if (self::$instance === null) {
         self::$instance = new self();
      }
      return self::$instance;
   }

   public function get($key)
   {
      return ($data = $this->redis->get($key)) !== false ? $data : null;
   }

   public function set($key, $value, $ttl = 3600)
   {
      $this->redis->set($key, $value, $ttl);
   }

   public function del($key)
   {
      $this->redis->del($key);
   }

   public function exists($key)
   {
      return $this->redis->exists($key);
   }
}