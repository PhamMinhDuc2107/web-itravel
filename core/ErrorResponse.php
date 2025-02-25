<?php

class ErrorResponse
{

   public static function get(string $message, string $type = "error"): string
   {
      return json_encode([
         'msg' => $message,
         'type' => $type,
      ]);
   }

   public static function badRequest(string $message): string
   {
      return self::get($message, "error");
   }

   public static function unauthorized(string $message): string
   {
      return self::get($message, "error");
   }

   public static function forbidden(string $message, array $data = []): string
   {
      return self::get($message, "error");
   }

   public static function notFound(string $message): string
   {
      return self::get($message, "error");
   }

   public static function methodNotAllowed(string $message): string
   {
      return self::get($message, "error");
   }

   public static function internalServerError(string $message): string
   {
      return self::get($message, "error");
   }
}
