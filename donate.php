<?php
session_start();
require_once 'db.php';

header('Content-Type: application/json');

// تحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'يجب تسجيل الدخول أولاً.'
    ]);
    exit;
}

// تحقق من البيانات
$city = $_POST['city'] ?? '';
$tree_type = $_POST['tree_type'] ?? '';

if (empty($city) || empty($tree_type)) {
    echo json_encode([
        'success' => false,
        'message' => 'يرجى اختيار المدينة ونوع الشجرة.'
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("INSERT INTO donations (user_id, city, tree_type, donated_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$user_id, $city, $tree_type]);

    echo json_encode([
        'success' => true,
        'message' => 'تم التبرع بنجاح.'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'حدث خطأ أثناء تسجيل التبرع.'
    ]);
}
?>
