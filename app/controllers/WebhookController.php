<?php

class WebhookController extends Controller
{
    private string $logFile;

    public function __construct() {
        $this->logFile = __DIR__ . '/git-webhook.log';
    }

    private function logMsg(string $msg): void {
        $time = date('Y-m-d H:i:s');
        file_put_contents($this->logFile, "[$time] $msg\n", FILE_APPEND);
    }

    public function git(): void {
        // Xác thực GitHub webhook nếu cần
        $secret = 'your_secret_here';
        $payload = file_get_contents('php://input');
        $headerSignature = $_SERVER['HTTP_X_HUB_SIGNATURE'] ?? '';

        if (!$headerSignature) {
            $this->logMsg('No signature');
            http_response_code(403);
            exit('No signature');
        }

        list($algo, $hash) = explode('=', $headerSignature, 2);
        $payloadHash = hash_hmac($algo, $payload, $secret);
        if (!hash_equals($hash, $payloadHash)) {
            $this->logMsg('Invalid signature');
            http_response_code(403);
            exit('Invalid signature');
        }

        $this->logMsg('Valid webhook received. Starting git pull...');

        // Chạy git pull
        $output = [];
        $returnVar = 0;
        // Chú ý đổi đường dẫn repo của bạn
        exec('cd /home/username/public_html && git reset --hard && git pull 2>&1', $output, $returnVar);

        foreach ($output as $line) {
            $this->logMsg($line);
        }

        if ($returnVar !== 0) {
            $this->logMsg("Git pull exited with code $returnVar");
            http_response_code(500);
            exit("Git pull failed. Check log.");
        }

        $this->logMsg('Git pull completed successfully.');
        echo "Git pull done.\n";
    }
}
