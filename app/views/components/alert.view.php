<?php

if (!function_exists('render_flash_alerts')) {
    function render_flash_alerts() {
        $flashes = \FlashMessage::all(); 

        if (empty($flashes)) return;


        echo '<div id="flash-container" aria-live="polite" aria-atomic="true">';
        foreach ($flashes as $key => $items) {
            foreach ($items as $flash) {
                $type = htmlspecialchars($flash['type'] ?? 'info');
                $msg  = $flash['message'];

                if (is_string($msg)) {
                    $decoded = json_decode($msg, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $msg = $decoded;
                    }
                }

                $content = '';
                if (is_array($msg)) {
                    $list = [];
                    foreach ($msg as $k => $v) {
                        if (is_array($v)) {
                            foreach ($v as $m) $list[] = $m;
                        } else {
                            $list[] = $v;
                        }
                    }
                    $content = '<ul class="flash-list">';
                    foreach ($list as $li) {
                        $content .= '<li>' . htmlspecialchars($li) . '</li>';
                    }
                    $content .= '</ul>';
                } else {
                    $content = '<div class="flash-text">'. htmlspecialchars((string)$msg) .'</div>';
                }

                // alert element
                echo <<<HTML
<div id="">
    <div class="flash-alert flash-{$type}" role="alert" data-flash-type="{$type}" tabindex="0">
  <div class="flash-body">
    <div class="flash-icon" aria-hidden="true"></div>
    <div class="flash-content">{$content}</div>
    <button class="flash-close" aria-label="Close notification">&times;</button>
  </div>
</div>
</div>
HTML;
            }
        }
        echo '</div>';
    }
}
