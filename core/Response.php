<?php

class Response
{

   public static function get(string $message,array $data=[], string $type = "error"): array
   {
      return [
         'msg' => $message,
         'type' => $type,
         "data" => $data
      ];
   }
   public static function success(string $message,array $data =[]): array
   {
      return self::get($message,$data,"success");
   }

   public static function badRequest(string $message, array $data=[]): array
   {
      return self::get($message, $data,"error");
   }

   public static function unauthorized(string $message,array $data=[]): array
   {
      return self::get($message, $data,"error");
   }

   public static function forbidden(string $message,array $data=[]): array
   {
      return self::get($message,$data,"error");
   }

   public static function notFound(string $message,array $data=[]): array
   {
      return self::get($message, $data,"error");
   }

   public static function methodNotAllowed(string $message,array $data=[]): array
   {
      return self::get($message,$data, "error");
   }

   public static function internalServerError(string $message,array $data=[]): array
   {
      return self::get($message, $data,"error");
   }
   public static function error(string $message,array $data=[]): array
   {
      return self::get($message, $data,"error");
   }
}