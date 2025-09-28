<?php

class WebhookController extends Controller
{
    private string $logDir;

    public function __construct() {
        $this->logDir = '/home/ukjmczll/public_html/storage/logs';
        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0755, true);
        }
    }

    private function logMsg(string $msg): void {
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $logFile = $this->logDir . "/git-webhook-$date.log";
        file_put_contents($logFile, "[$time] $msg\n", FILE_APPEND);
    }

    public function git(): void {
        $secret = $_ENV['SERECT_KEY_GIT_HOOK'] ?? '';
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

        $repoPath = '/home/ukjmczll/public_html'; 

        // 1. Git reset & pull
        $output = [];
        $returnVar = 0;
        exec("cd $repoPath && git reset --hard && git pull 2>&1", $output, $returnVar);
        foreach ($output as $line) $this->logMsg($line);
        if ($returnVar !== 0) {
            $this->logMsg("Git pull exited with code $returnVar");
            http_response_code(500);
            exit("Git pull failed. Check log.");
        }

        // 2. Composer install
        $this->logMsg('Running composer install...');
        $output = [];
        $returnVar = 0;
        exec("cd $repoPath && composer install --no-dev --optimize-autoloader 2>&1", $output, $returnVar);
        foreach ($output as $line) $this->logMsg($line);
        if ($returnVar !== 0) {
            $this->logMsg("Composer install exited with code $returnVar");
            http_response_code(500);
            exit("Composer install failed. Check log.");
        }

        $this->logMsg('Git pull & composer install completed successfully.');
        echo "Deployment done.\n";
    }
}
