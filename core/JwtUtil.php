<?php

require_once _DIR_ROOT. '/vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class JwtUtil
{
   private $secretKey;

   function __construct() {
      $this->secretKey = $_ENV["JWT_SECRET_KEY"] ?? "notkey";
      if ($this->secretKey === "notkey") {
         die("Please check your JWT secret key in .env");
      }
   }

   public function encode(array $payload, $exp = 3600) {
      $payload['iat'] = time();
      $payload['exp'] = time() + $exp;
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

   public function isTokenExpired(string $jwt): bool {
      $decoded = $this->decode($jwt);
      if (!$decoded) return true;

      return $decoded->exp < time();
   }

   public function generatePayload(array $user, int $remember) {
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

   public function checkAuth(string $nameToken) {
      $token = $_COOKIE[$nameToken] ?? null;
      if (!$token || $this->isTokenExpired($token)) {
         return false;
      }
      return $this->decode($token);
   }
}
