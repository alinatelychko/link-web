<?php
$secret = '6949b799a6561a8d43adba9e94c79d71530794bc'; // Встановіть у GitHub Webhook  
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? ''; // Використовуємо SHA-256
$payload = file_get_contents('php://input');

// Перевірка підпису
$hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);
if (!$signature || !hash_equals($hash, $signature)) {
    http_response_code(403);
    die('Unauthorized');
}

file_put_contents('deploy.log', date('Y-m-d H:i:s') . " Deploy started\n", FILE_APPEND);

// Виконуємо git pull
$output = shell_exec('cd /home/youruser/public_html && git pull origin main 2>&1');
file_put_contents('deploy.log', $output, FILE_APPEND);

http_response_code(200);
echo "Deployed successfully!";
?>