<?php

class Request
{

   public static function method(): string
   {
      return $_SERVER['REQUEST_METHOD'] ?? 'GET';
   }


   public static function has(string $key, string $type = 'post'): bool
   {
      $type = strtolower($type);
      switch ($type) {
         case 'post':
            return isset($_POST[$key]);
         case 'get':
            return isset($_GET[$key]);
         case 'file':
            return isset($_FILES[$key]);
         default:
            return false;
      }
   }

   public static function input(string $key, $default = null)
   {
      return $_POST[$key] ?? $_GET[$key] ?? $default;
   }


   public static function all(string $type = 'post'): array
   {
      $type = strtolower($type);

      return match ($type) {
         'get'  => $_GET,
         'post' => $_POST,
         'file' => $_FILES,
         default => [],
      };
   }



   public static function file(string $key)
   {
      return $_FILES[$key] ?? null;
   }

   public static function url(): string
   {
      return $_SERVER['REQUEST_URI'] ?? '/';
   }


   public static function isAjax(): bool
   {
      return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
   }


   public static function isMethod(string $method): bool
   {
      return strtoupper($method) === self::method();
   }
}
