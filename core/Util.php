<?php

class Util
{

   public static function generateCsrfToken()
   {
      if (Session::get('csrf_token') === null) {
         $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
      }
      return $_SESSION['csrf_token'];
   }
   public static function translateTransportation($value)
   {
      $map = [
         'flight' => 'Máy bay',
         'bus'    => 'Xe buýt',
         'train'  => 'Tàu hỏa',
         'car'    => 'Ô tô',
         "ship" => "Tàu thuỷ"
      ];

      $arr = explode(',', $value);
      $translated = array_map(function ($item) use ($map) {
         return $map[trim($item)] ?? $item;
      }, $arr);

      return implode(', ', $translated);
   }
   public static function renderTransportationIcons($transportation)
   {
      if ($transportation === '') {
         return "";
      }
      $transportArray = explode(',', $transportation);
      $icons = [
         'flight' => '<i class="fas fa-plane" title="Máy bay"></i>',
         'bus'    => '<i class="fas fa-bus" title="Xe buýt"></i>',
         'car'    => '<i class="fas fa-car" title="Ô tô"></i>',
         'train'  => '<i class="fas fa-train" title="Tàu hỏa"></i>',
         "ship" => '<i class="fas fa-ship" title="Tàu thuỷ"></i>',
      ];

      $output = '';

      foreach ($transportArray as $t) {
         $key = trim($t);
         if (isset($icons[$key])) {
            $output .= $icons[$key] . ' ';
         }
      }

      return $output;
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

      if (!empty($params) && is_array($params)) {
         $query = parse_url($fullUrl, PHP_URL_QUERY);
         $fullUrl .= $query ? '&' . http_build_query($params) : '?' . http_build_query($params);
      }

      if (!headers_sent()) {
         header("Location: " . $fullUrl);
         exit();
      }
      echo "<script>window.location.href = '{$fullUrl}';</script>";
      exit();
   }


   public static function formatTimeFull($time)
   {
      return date('Y-m-d H:i:s', $time);
   }
   function generateCode($length = 15)
   {
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
         $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
   }
   public static function generateSlug(string $string, bool $checkExists = false): string
   {
      $map = [
         'à' => 'a',
         'á' => 'a',
         'ả' => 'a',
         'ã' => 'a',
         'ạ' => 'a',
         'ă' => 'a',
         'ắ' => 'a',
         'ằ' => 'a',
         'ẳ' => 'a',
         'ẵ' => 'a',
         'ặ' => 'a',
         'â' => 'a',
         'ấ' => 'a',
         'ầ' => 'a',
         'ẩ' => 'a',
         'ẫ' => 'a',
         'ậ' => 'a',
         'è' => 'e',
         'é' => 'e',
         'ẻ' => 'e',
         'ẽ' => 'e',
         'ẹ' => 'e',
         'ê' => 'e',
         'ế' => 'e',
         'ề' => 'e',
         'ể' => 'e',
         'ễ' => 'e',
         'ệ' => 'e',
         'ì' => 'i',
         'í' => 'i',
         'ỉ' => 'i',
         'ĩ' => 'i',
         'ị' => 'i',
         'ò' => 'o',
         'ó' => 'o',
         'ỏ' => 'o',
         'õ' => 'o',
         'ọ' => 'o',
         'ô' => 'o',
         'ố' => 'o',
         'ồ' => 'o',
         'ổ' => 'o',
         'ỗ' => 'o',
         'ộ' => 'o',
         'ơ' => 'o',
         'ớ' => 'o',
         'ờ' => 'o',
         'ở' => 'o',
         'ỡ' => 'o',
         'ợ' => 'o',
         'ù' => 'u',
         'ú' => 'u',
         'ủ' => 'u',
         'ũ' => 'u',
         'ụ' => 'u',
         'ư' => 'u',
         'ứ' => 'u',
         'ừ' => 'u',
         'ử' => 'u',
         'ữ' => 'u',
         'ự' => 'u',
         'ỳ' => 'y',
         'ý' => 'y',
         'ỷ' => 'y',
         'ỹ' => 'y',
         'ỵ' => 'y',
         'đ' => 'd',
         'À' => 'A',
         'Á' => 'A',
         'Ả' => 'A',
         'Ã' => 'A',
         'Ạ' => 'A',
         'Ă' => 'A',
         'Ắ' => 'A',
         'Ằ' => 'A',
         'Ẳ' => 'A',
         'Ẵ' => 'A',
         'Ặ' => 'A',
         'Â' => 'A',
         'Ấ' => 'A',
         'Ầ' => 'A',
         'Ẩ' => 'A',
         'Ẫ' => 'A',
         'Ậ' => 'A',
         'È' => 'E',
         'É' => 'E',
         'Ẻ' => 'E',
         'Ẽ' => 'E',
         'Ẹ' => 'E',
         'Ê' => 'E',
         'Ế' => 'E',
         'Ề' => 'E',
         'Ể' => 'E',
         'Ễ' => 'E',
         'Ệ' => 'E',
         'Ì' => 'I',
         'Í' => 'I',
         'Ỉ' => 'I',
         'Ĩ' => 'I',
         'Ị' => 'I',
         'Ò' => 'O',
         'Ó' => 'O',
         'Ỏ' => 'O',
         'Õ' => 'O',
         'Ọ' => 'O',
         'Ô' => 'O',
         'Ố' => 'O',
         'Ồ' => 'O',
         'Ổ' => 'O',
         'Ỗ' => 'O',
         'Ộ' => 'O',
         'Ơ' => 'O',
         'Ớ' => 'O',
         'Ờ' => 'O',
         'Ở' => 'O',
         'Ỡ' => 'O',
         'Ợ' => 'O',
         'Ù' => 'U',
         'Ú' => 'U',
         'Ủ' => 'U',
         'Ũ' => 'U',
         'Ụ' => 'U',
         'Ư' => 'U',
         'Ứ' => 'U',
         'Ừ' => 'U',
         'Ử' => 'U',
         'Ữ' => 'U',
         'Ự' => 'U',
         'Ỳ' => 'Y',
         'Ý' => 'Y',
         'Ỷ' => 'Y',
         'Ỹ' => 'Y',
         'Ỵ' => 'Y',
         'Đ' => 'D'
      ];

      $string = strtr($string, $map);
      $string = strtolower($string);

      $string = preg_replace('/[^a-z0-9\s-]/', '', $string);

      $slug = preg_replace('/\s+/', '-', trim($string));
      $slug = trim($slug, '-');

      $originalSlug = $slug;
      $i = 1;
      while ($checkExists) {
         $slug = $originalSlug . '-' . $i;
         $i++;
      }

      return $slug;
   }

   public static function printArr($arr)
   {
      echo "<pre>";
      print_r($arr);
      echo "</pre>";
   }
   public static function removeEmptyValues(array $arr): array
   {
      foreach ($arr as $key => $value) {
         if (empty($value)) {
            unset($arr[$key]);
         }
      }
      return $arr;
   }
   public static function generateBookingCode($prefix = "BK", $length = 8)
   {
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $code = '';

      for ($i = 0; $i < $length; $i++) {
         $code .= $characters[rand(0, strlen($characters) - 1)];
      }

      return $prefix . '-' . $code;
   }
   public static function loadError($type = '404', $statusCode = 404)
   {
      $folder = "app/errors/" . $type . ".php";
      if (file_exists($folder)) {
         require_once $folder;
         http_response_code($statusCode);
         exit();
      }
   }
   public static function formatDate($date, $format = "d-m-Y"): string
   {
      $date = new DateTime($date);
      $formattedDate = $date->format($format);
      return $formattedDate;
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
   public static function buildMonthUrl($month = null): string
   {
      $queryParams = $_GET ?? [];

      if ($month !== null) {
         $queryParams['month'] = $month;
      } else {
         unset($queryParams['month']);
      }

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
   public static function buildOrderColByUrl($col = "id"): string
   {
      $queryParams = $_GET ?? [];
      $queryParams['sortCol'] = $col;

      return '?' . htmlspecialchars(http_build_query($queryParams), ENT_QUOTES, 'UTF-8');
   }
   public static function buildUrlParams(array $params): string
   {
      $queryParams = [];
      foreach ($params as $key => $item) {
         $queryParams[$key] = $item;
      }
      return '?' . htmlspecialchars(http_build_query($queryParams), ENT_QUOTES, 'UTF-8');
   }
   public static function checkImage(array $file, array $allowedTypes = ['webp'], int $maxSize = 5 * 1024 * 1024): array
   {
      if (empty($file) || $file['error'] !== UPLOAD_ERR_OK) {
         return ['success' => false, 'msg' => 'Lỗi tải file lên.'];
      }
      if ($file['size'] > $maxSize) {
         return ['success' => false, 'msg' => 'File quá lớn.'];
      }

      $fileInfo = pathinfo($file['name']);
      $fileExtension = strtolower($fileInfo['extension']);
      if (!in_array($fileExtension, $allowedTypes)) {
         return ['success' => false, 'msg' => 'Loại file không được hỗ trợ.Chỉ hỗ trợ webp'];
      }
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime = finfo_file($finfo, $file['tmp_name']);
      finfo_close($finfo);

      if (strpos($mime, 'image/') === false) {
         return ['success' => false, 'msg' => 'File không phải là ảnh.'];
      }

      return ['success' => true, 'msg' => 'File hợp lệ.'];
   }
   public static function generateUniqueFileName(string $fileName): string
   {
      $fileInfo = pathinfo($fileName);
      $originalName = $fileInfo['filename'];
      $extension = isset($fileInfo['extension']) ? '.' . $fileInfo['extension'] : '';

      $uniqueId = md5(uniqid(rand(), true));
      return $originalName . '_' . $uniqueId . $extension;
   }
   public static function createImagePath(array $file, string $destination): array
   {
      $checkImg = Util::checkImage($file);
      if (!$checkImg['success']) {
         return ['msg' => $checkImg['msg'], 'type' => "error"];
      }
      $newFileName = self::generateUniqueFileName($file['name']);
      $destinationPath = rtrim($destination, '/') . '/' . $newFileName;
      return ['success' => true, 'name' => $destinationPath];
   }
   public static function uploadImage(array $file, string $destination): array
   {
      $path = _DIR_ROOT . $destination;
      if (move_uploaded_file($file['tmp_name'], $path)) {
         return ['success' => true, 'msg' => 'Tải file lên thành công.'];
      } else {
         return ['success' => false, 'msg' => 'Lỗi khi di chuyển file.'];
      }
   }
   public static function deleteImage($filePath): array
   {
      if (!file_exists($filePath)) {
         return ['success' => false, "msg" => "file ảnh không tồn tại"];
      }
      if (!unlink($filePath)) {
         return ['success' => false, "msg" => "Xóa ảnh không thành công"];
      }
      return ['success' => true, "msg" => "Xóa ảnh thành công"];
   }
   public static function convertListImgToArr(array $arr): array
   {
      $files = [];
      for ($i = 0; $i < count($arr['name']); $i++) {
         $files[] = [
            'name' => $arr['name'][$i],
            'type' => $arr['type'][$i],
            'tmp_name' => $arr['tmp_name'][$i],
            'error' => $arr['error'][$i],
            'size' => $arr['size'][$i]
         ];
      }
      return $files;
   }
   public static function removeUploadedImages($files)
   {
      foreach ($files['tmp_name'] as $tmpFile) {
         if (file_exists($tmpFile)) {
            unlink($tmpFile); // Xóa file tạm
         }
      }
   }
}
