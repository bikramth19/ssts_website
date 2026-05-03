<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../contact.php');
    exit;
}

$config = require __DIR__ . '/config/config.php';

function redirect_with_status(string $status): void {
    header('Location: ../contact.php?status=' . urlencode($status));
    exit;
}

$honeypot = trim($_POST['website'] ?? '');
if ($honeypot !== '') {
    redirect_with_status('success');
}

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$service = trim($_POST['service'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $phone === '' || $email === '' || $service === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect_with_status('invalid');
}

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $config['host'], $config['dbname'], $config['charset']);
    $pdo = new PDO($dsn, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $stmt = $pdo->prepare('INSERT INTO contact_enquiries (name, phone, email, service_interest, message, ip_address, user_agent) VALUES (:name, :phone, :email, :service_interest, :message, :ip_address, :user_agent)');
    $stmt->execute([
        ':name' => $name,
        ':phone' => $phone,
        ':email' => $email,
        ':service_interest' => $service,
        ':message' => $message,
        ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
    ]);

    redirect_with_status('success');
} catch (Throwable $e) {
    // In production, log $e->getMessage() to a secure log file.
    redirect_with_status('error');
}
