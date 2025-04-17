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

if (!$post_id) {
    echo json_encode(['success' => false, 'message' => 'رقم المنشور غير موجود']);
    exit;
}

// تحقق من وجود إعجاب مسبق
$stmt = $conn->prepare("SELECT COUNT(*) FROM game_likes WHERE post_id = ? AND user_id = ?");
$stmt->execute([$post_id, $user_id]);
if ($stmt->fetchColumn() > 0) {
    echo json_encode(['success' => false, 'message' => 'لقد قمت بالإعجاب مسبقًا']);
    exit;
}

// تحقق من عدد قطرات المستخدم
$stmt = $conn->prepare("SELECT water_drops FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$current_drops = $stmt->fetchColumn();

if ($current_drops < 10) {
    echo json_encode(['success' => false, 'message' => 'لا تمتلك ما يكفي من القطرات']);
    exit;
}

// تحديث: إنقاص قطرات المستخدم
$conn->prepare("UPDATE users SET water_drops = water_drops - 10 WHERE id = ?")->execute([$user_id]);

// تحديث: إضافة إعجاب
$conn->prepare("INSERT INTO game_likes (post_id, user_id, liked_at) VALUES (?, ?, NOW())")->execute([$post_id, $user_id]);

// تحديث: زيادة قطرات صاحب المنشور
$conn->prepare("
    UPDATE users SET water_drops = water_drops + 10
    WHERE id = (SELECT user_id FROM game_posts WHERE id = ?)
")->execute([$post_id]);

echo json_encode(['success' => true]);
?>
