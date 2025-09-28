<?php

class FlashMessage
{
    protected static int $defaultExpire = 60; // giây mặc định

    protected static function init(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['_flash'])) {
            $_SESSION['_flash'] = [];
        }
    }

    /**
     * Đặt flash message
     */
    public static function set(string $key, string|array $message, string $type = 'info', int $expire = null): void
    {
        self::init();

        $_SESSION['_flash'][$key][] = [
            'message' => $message,
            'type'    => $type,
            'expire'  => time() + ($expire ?? self::$defaultExpire),
        ];
    }

    /**
     * Lấy flash message theo key
     */
    public static function get(string $key): ?array
    {
        self::init();

        if (!isset($_SESSION['_flash'][$key])) {
            return null;
        }

        $flashes = $_SESSION['_flash'][$key];
        $valid = [];

        foreach ($flashes as $index => $flash) {
            if ($flash['expire'] >= time()) {
                $valid[] = $flash;
            }
            unset($_SESSION['_flash'][$key][$index]); // xoá sau khi lấy
        }

        if (empty($valid)) {
            unset($_SESSION['_flash'][$key]);
            return null;
        }

        return $valid;
    }

    /**
     * Lấy tất cả flash messages
     */
    public static function all(): array
    {
        self::init();

        $all = $_SESSION['_flash'] ?? [];
        $_SESSION['_flash'] = []; // clear hết sau khi đọc

        return $all;
    }

    /**
     * Kiểm tra tồn tại flash theo key
     */
    public static function has(string $key): bool
    {
        self::init();
        return !empty($_SESSION['_flash'][$key]);
    }
    public static function render(string $key): void
   {
      $flashes = self::get($key);

      if (!$flashes) return;

      foreach ($flashes as $flash) {
         $type = htmlspecialchars($flash['type']);
         echo "<div class='alert alert-{$type}'>";
         
         if (is_array($flash['message'])) {
               foreach ($flash['message'] as $field => $msgs) {
                  foreach ($msgs as $msg) {
                     echo "<p>" . htmlspecialchars($msg) . "</p>";
                  }
               }
         } else {
               echo htmlspecialchars($flash['message']);
         }

         echo "</div>";
      }
   }

    /**
     * Shortcut cho success
     */
    public static function success(string $key, string $message, int $expire = null): void
    {
        self::set($key, $message, 'success', $expire);
    }

    /**
     * Shortcut cho error
     */
    public static function error(string $key, string|array $message, int $expire = null): void
    {
        self::set($key, $message, 'error', $expire);
    }

    /**
     * Shortcut cho warning
     */
    public static function warning(string $key, string $message, int $expire = null): void
    {
        self::set($key, $message, 'warning', $expire);
    }

    /**
     * Shortcut cho info
     */
    public static function info(string $key, string $message, int $expire = null): void
    {
        self::set($key, $message, 'info', $expire);
    }
}
