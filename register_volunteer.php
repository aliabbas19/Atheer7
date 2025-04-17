<?php
session_start();
include 'db.php';

// تحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    die("يجب تسجيل الدخول أولاً.");
}

// التحقق من campaign_id
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['campaign_id'])) {
    $userId = $_SESSION['user_id'];
    $campaignId = $_POST['campaign_id'];

    // التحقق من عدم تسجيل المستخدم مسبقاً
    $stmt = $conn->prepare("SELECT * FROM volunteers WHERE user_id = ? AND campaign_id = ?");
    $stmt->execute([$userId, $campaignId]);

    if ($stmt->rowCount() > 0) {
        echo "أنت مسجل بالفعل في هذه الحملة.";
        exit;
    }

    // إدخال التسجيل
    $stmt = $conn->prepare("INSERT INTO volunteers (user_id, campaign_id, joined_at) VALUES (?, ?, NOW())");
    if ($stmt->execute([$userId, $campaignId])) {
        echo "تم تسجيلك بنجاح في الحملة.";
    } else {
        echo "حدث خطأ أثناء التسجيل.";
    }
} else {
    echo "طلب غير صالح.";
}
?>
