<?php

class Util
{
   public static function generateCsrfToken() {
      if (Session::get('csrf_token') === null) {
         $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
      }
      return $_SESSION['csrf_token'];
   }
   public static function checkCsrfToken(): bool
   {
      if (in_array(Request::method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
         $token = Request::input("csrf_token") ?? "";
         $csrf_session = Session::get('csrf_token');

         if ($csrf_session === null || !hash_equals($csrf_session, $token)) {
            return false;
         }
         $csrf_token_new = Util::generateCsrfToken();
         Session::set('csrf_token', $csrf_token_new);
         return true;
      }
      return true;
   }

   public static function redirect($url, $params = []) {
      $fullUrl = _WEB_ROOT . '/' . ltrim($url, '/');

      if (!empty($params) && is_array($params) && filter_var($fullUrl, FILTER_VALIDATE_URL)) {
         $fullUrl .= (parse_url($fullUrl, PHP_URL_QUERY) ? '&' : '?') . http_build_query($params);
      }
      if (!headers_sent()) {
         header("Location: " . $fullUrl);
         exit();
      }
      echo "<script>window.location.href='" . $fullUrl . "';</script>";
      exit();
   }
   public static function formatTimeFull($time) {
      return date('Y-m-d H:i:s', $time);
   }
   public static function printArr($arr) {
      echo "<pre>";
      print_r($arr);
      echo "</pre>";
   }
}
