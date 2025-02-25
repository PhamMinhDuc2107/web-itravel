<?php

class ErrorResponse
{

   public static function get(string $message, string $type = "error"): array
   {
      return [
         'msg' => $message,
         'type' => $type,
      ];
   }

   public static function badRequest(string $message): array
   {
      return self::get($message, "error");
   }

   public static function unauthorized(string $message): array
   {
      return self::get($message, "error");
   }

   public static function forbidden(string $message, array $data = []): array
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
