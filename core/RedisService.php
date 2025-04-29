<?php
require_once _DIR_ROOT . '/vendor/autoload.php';

use Predis\Client;

class RedisService
{
   private static $instance = null;
   private $redis;

   private function __construct()
   {
      try {
         $this->redis = new Client([
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 6379,
         ]);
      } catch (\Exception $e) {
         error_log("Lỗi kết nối Redis: " . $e->getMessage());
         die("Không thể kết nối Redis");
      }
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
      $data = $this->redis->get($key);
      return $data ? json_decode($data, true) : null;
   }

   public function set($key, $value, $ttl = 3600)
   {
      $this->redis->setex($key, $ttl, json_encode($value));
   }

   public function del($key)
   {
      $this->redis->del([$key]);
   }

   public function exists($key)
   {
      return (bool) $this->redis->exists($key);
   }
}
