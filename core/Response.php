<?php

class Response
{

   public static function get(string $message, string $type = "error"): array
   {
      return [
         'msg' => $message,
         'type' => $type,
      ];
   }
   public static function success(string $message): array
   {
      return self::get($message, "success");
   }

   public static function badRequest(string $message): array
   {
      return self::get($message, "error");
   }

   public static function unauthorized(string $message): array
   {
      return self::get($message, "error");
   }

   public static function forbidden(string $message): array
   {
      return self::get($message, "error");
   }

   public static function notFound(string $message): array
   {
      return self::get($message, "error");
   }

   public static function methodNotAllowed(string $message): array
   {
      return self::get($message, "error");
   }

   public static function internalServerError(string $message): array
   {
      return self::get($message, "error");
   }
}