<?php
session_start();
require_once 'db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'يجب تسجيل الدخول أولاً']);
    exit;
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'] ?? null;
$comment = trim($_POST['comment'] ?? '');

if (!$post_id || $comment === '') {
    echo json_encode(['success' => false, 'message' => 'يرجى كتابة تعليق صالح']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO game_comments (post_id, user_id, comment, commented_at) VALUES (?, ?, ?, NOW())");
$stmt->execute([$post_id, $user_id, $comment]);

echo json_encode(['success' => true]);
?>
