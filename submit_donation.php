<?php
session_start();
require_once 'db.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'يجب تسجيل الدخول أولاً']);
    exit;
}

$user_id = $_SESSION['user_id'];
$city = $_POST['city'] ?? '';
$tree_type = $_POST['tree_type'] ?? '';

if (empty($city) || empty($tree_type)) {
    echo json_encode(['success' => false, 'message' => 'الرجاء تحديد المدينة ونوع الشجرة']);
    exit;
}

try {
    $stmt = $conn->prepare("INSERT INTO donations (user_id, city, tree_type, donated_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$user_id, $city, $tree_type]);

    echo json_encode(['success' => true, 'message' => 'تم التبرع بنجاح!']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'فشل في تسجيل التبرع']);
}
?>
