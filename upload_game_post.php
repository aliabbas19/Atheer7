<?php
session_start();
require_once 'db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'يجب تسجيل الدخول أولاً']);
    exit;
}

$userId = $_SESSION['user_id'];
$description = $_POST['description'] ?? '';

if (!isset($_FILES['image'])) {
    echo json_encode(['success' => false, 'message' => 'لم يتم رفع صورة']);
    exit;
}

$image = $_FILES['image'];
$imageName = time() . '_' . basename($image['name']);
$targetDir = "uploads/game_posts/";
$targetPath = $targetDir . $imageName;

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if (move_uploaded_file($image['tmp_name'], $targetPath)) {
    $stmt = $conn->prepare("INSERT INTO game_posts (user_id, image_path, description, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$userId, $targetPath, $description]);
    echo json_encode(['success' => true, 'message' => 'تم نشر المنشور بنجاح']);
} else {
    echo json_encode(['success' => false, 'message' => 'فشل في رفع الصورة']);
}
?>
