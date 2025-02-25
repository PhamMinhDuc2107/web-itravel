<?php

class Util
{
   public static function setBaseModel($model) {
      if (Request::has("page", "get")) {
         $page = (int)htmlspecialchars(Request::input("page"));
         $model->setOffset($page);
      }
      if (Request::has("limit", "get")) {
         $limit = (int)htmlspecialchars(Request::input("limit")) ?? 10;
         $model->setLimit($limit);
      }
      if (Request::has("sortBy", "get") ) {
         $order = htmlspecialchars(Request::input("sortBy"));
         $model->setOrderBy($order);
      }
      if (Request::has("sortCol", "get") ) {
         $orderCol = htmlspecialchars(Request::input("sortCol"));
         $model->setColOrderBy($orderCol);
      }
   }
   public static function generateCsrfToken()
   {
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

   public static function redirect($url, $params = [])
   {
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

   public static function formatTimeFull($time)
   {
      return date('Y-m-d H:i:s', $time);
   }
   static function generateSlug($string):string {
      $string = mb_strtolower($string, 'UTF-8');
      $string = str_replace(
         ['à', 'á', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ',
            'è', 'é', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ',
            'ì', 'í', 'ỉ', 'ĩ', 'ị',
            'ò', 'ó', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ',
            'ù', 'ú', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự',
            'ỳ', 'ý', 'ỷ', 'ỹ', 'ỵ',
            'đ'],
         ['a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
            'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
            'i', 'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
            'y', 'y', 'y', 'y', 'y',
            'd'],
         $string
      );

      $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
      $string = preg_replace('/\s+/', '-', trim($string));
      return $string;
   }



   public static function printArr($arr)
   {
      echo "<pre>";
      print_r($arr);
      echo "</pre>";
   }
   public static function removeEmptyValues(array $arr):array {
      foreach ($arr as $key => $value) {
         if (empty($value)) {
            unset($arr[$key]);
         }
      }
      return $arr;
   }
   public static function loadError($type = '404', $arr = [])
   {
      $folder = "app/errors/" . $type . ".php";
      if (file_exists($folder)) {
         require_once $folder;
      }
   }


   public static function buildPageUrl($newPage): string
   {
      $queryParams = $_GET ?? [];
      $queryParams['page'] = max(1, intval($newPage));
      return '?' . htmlspecialchars(http_build_query($queryParams), ENT_QUOTES, 'UTF-8');
   }
   public static function buildLimitUrl($newLimit): string
   {
      $queryParams = $_GET ?? [];
      $queryParams['limit'] = max(1, intval($newLimit));
      $queryParams['page'] = 1;
      return '?' . htmlspecialchars(http_build_query($queryParams), ENT_QUOTES, 'UTF-8');
   }

   public static function buildOrderByUrl($order = "asc"): string
   {
      $isAllowed = ["asc", "desc"];
      if (!in_array($order, $isAllowed)) {
         $order = "asc";
      }
      $queryParams = $_GET ?? [];
      $queryParams['sortBy'] = $order;

      return '?' . htmlspecialchars(http_build_query($queryParams), ENT_QUOTES, 'UTF-8');
   }
   public static function buildOrderColByUrl($col="id"): string
   {
      $isAllowedColumn = ['id',"name","title","username", "slug"];
      if (!in_array($col, $isAllowedColumn)) {
         $col = "id";
      }
      $queryParams = $_GET ?? [];
      $queryParams['sortCol'] = $col;

      return '?' . htmlspecialchars(http_build_query($queryParams), ENT_QUOTES, 'UTF-8');
   }
   public static function checkImage(string $fileName,array $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'],int $maxSize = 5 * 1024 * 1024): array {
      $file = Request::file($fileName);
      if (!$file|| $file['error'] !== UPLOAD_ERR_OK ) {
            return ['success' => false, 'msg' => 'Lỗi tải file lên.'];
      }
      if ($file['size'] > $maxSize) {
         return ['success' => false, 'msg' => 'File quá lớn.'];
      } 

      $fileInfo = pathinfo($file['name']);
      $fileExtension = strtolower($fileInfo['extension']);
      if (!in_array($fileExtension, $allowedTypes)) {
         return ['success' => false, 'msg' => 'Loại file không được hỗ trợ.'];
      }
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime = finfo_file($finfo, $file['tmp_name']);
      finfo_close($finfo);

      if (strpos($mime, 'image/') === false) {
         return ['success' => false, 'msg' => 'File không phải là ảnh.'];
      }

      return ['success' => true, 'msg' => 'File hợp lệ.'];
   }
   public static function generateUniqueImageName($fileName):string {
      $fileInfo = pathinfo($fileName);
      $uniqueName = md5(uniqid(rand(), true)) . '.' . $fileInfo['extension'];
      return $uniqueName;
   }
   public static function createImagePath($fileName, $destination):array {
      $file = Request::file($fileName);
      $checkImg = Util::checkImage($fileName);
      if (!$checkImg['success']) {
         return ['msg' => $checkImg['msg'], 'type' => "error"];
      }
      $newFileName = self::generateUniqueImageName($file['name']);
      $destinationPath = rtrim($destination, '/') . '/' . $newFileName;
      return ['success' => true, 'name' => $destinationPath];
   }
   public static function uploadImage($file, $destination): array
   {
      $file = Request::file($file);
      $path = _DIR_ROOT.$destination;
      if (move_uploaded_file($file['tmp_name'], $path)) {
         return ['success' => true, 'msg' => 'Tải file lên thành công.'];
      } else {
         return ['success' => false, 'msg' => 'Lỗi khi di chuyển file.'];
      }
   }
   public static function deleteImage($filePath): array
   {
      if (file_exists($filePath)) {
         if (unlink($filePath)) {
            return ['success'=>true, "msg" => "Xóa ảnh thành công"];
         } else {
            return ['success'=>false, "msg" => "Xóa ảnh không thành công"];

         }
      } else {
         return ['success'=>false, "msg" => "file ảnh không tồn tại"];
      }
   }
}
