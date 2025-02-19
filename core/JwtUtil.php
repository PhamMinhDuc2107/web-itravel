<?php

require_once _DIR_ROOT. '/vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtUtil
{
   private  $secretKey;
   function __construct(){
      $this->secretKey = $_ENV["JWT_SECRET_KET"] ?? "notkey";
      if ($this->secretKey == "notkey") {
         die("please check your JWT secret key");
      }
   }
   public  function encode(array $payload, $exp = 3600)
   {
      $payload['iat'] = time();
      $payload['exp'] = time() + $exp;
      return JWT::encode($payload, $this->secretKey, 'HS256');
   }

   public  function decode($jwt)
   {
      try {
         return JWT::decode($jwt, new Key( $this->secretKey, 'HS256'));
      } catch (\Exception $e) {
         return null;
      }
   }

   public  function generatePayload(array $user, int $remember)
   {
      return [
         'iss' => 'your_domain.com',
         'sub' => $user['id'],
         'iat' => time(),
         'exp' => $remember === 1 ? time() + (30 * 24 * 60 * 60) : time() + (24 * 60 * 60),
         'data' => [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
         ],
      ];
   }
   public  function checkAuth(string $nameToken) {
      $token = $_COOKIE[$nameToken] ?? null;
      if (!$token) {
         return false;
      }
      try {
         $decoded = $this->decode($token);
         if (!$decoded) {
            return false;
         }
         return $decoded;
      } catch (Exception $e) {
         return false;
      }
   }
}
