<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: signup.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$campaign_id = $_POST['campaign_id'];
$joined_at = date('Y-m-d H:i:s');

// تحقق إذا كان المستخدم مسجل بالفعل
$stmt = $conn->prepare("SELECT * FROM volunteers WHERE user_id = ? AND campaign_id = ?");
$stmt->execute([$user_id, $campaign_id]);

if ($stmt->rowCount() > 0) {
    echo "<script>alert('أنت مسجّل بالفعل في هذه الحملة'); window.history.back();</script>";
    exit;
}

// إذا غير مسجل، سجّله
$insertStmt = $conn->prepare("INSERT INTO volunteers (user_id, campaign_id, joined_at) VALUES (?, ?, ?)");
$insertStmt->execute([$user_id, $campaign_id, $joined_at]);

echo "<script>alert('تم تسجيلك في الحملة بنجاح'); window.location.href='currentcampaign.php';</script>";
exit;
?>
