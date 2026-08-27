<?php
header('Content-Type: application/json; charset=utf-8');

function jsonInput(): array {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);
    return is_array($data) ? $data : $_POST;
}

function response(bool $success, string $message='', $data=null, int $code=200): void {
    http_response_code($code);
    echo json_encode([
        'success'=>$success,
        'message'=>$message,
        'data'=>$data
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
