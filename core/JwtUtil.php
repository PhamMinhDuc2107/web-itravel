<?php

require_once _DIR_ROOT. '/vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class JwtUtil
{
   private $secretKey;

   function __construct() {
      $this->secretKey = $_ENV["ACCESS_TOKEN_JWT"] ?? "notkey";
      if ($this->secretKey === "notkey") {
         die("Please check your JWT secret key in .env");
      }
   }

   public function encode(array $payload) {
      return JWT::encode($payload, $this->secretKey, 'HS256');
   }

   public function decode($jwt) {
      try {
         return JWT::decode($jwt, new Key($this->secretKey, 'HS256'));
      } catch (ExpiredException $e) {
         error_log("JWT Expired: " . $e->getMessage());
         return false;
      } catch (\Exception $e) {
         error_log("JWT Decode Error: " . $e->getMessage());
         return false;
      }
   }



   public function generatePayload(array $user, int $remember) {
      return [
         'iss' => 'your_domain.com',
         'sub' => $user['id'],
         'iat' => time(),
         'exp' => $remember === 1 ? time() + (7 * 24 * 60 * 60) : time() + (24 * 60 * 60),
         'data' => [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
         ],
      ];
   }

   public function checkAuth(string $nameToken) {
      $token = $_COOKIE[$nameToken] ?? null;
      if (!$token) {
         return ['success' => false, 'msg' => 'Token không tồn tại'];
      }

      $decoded = $this->decode($token);
      if (!$decoded) {
         return ['success' => false, 'msg' => 'Token không hợp lệ'];
      }

      if ($this->isTokenExpired($decoded)) {
         return ['success' => false, 'msg' => 'Token hết hạn'];
      }

      return ['success' => true, 'payload' => $decoded];
   }

   private function isTokenExpired($decoded): bool {
      if (!isset($decoded->exp)) {
         return true;
      }

      return $decoded->exp < time();
   }
}
