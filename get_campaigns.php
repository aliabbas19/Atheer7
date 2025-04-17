<?php
include 'db.php';

$city = $_GET['city'] ?? '';

if (empty($city)) {
    echo json_encode([]);
    exit;
}

try {
    $stmt = $conn->prepare("SELECT * FROM campaigns WHERE city = ?");
    $stmt->execute([$city]);
    $campaigns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($campaigns, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode(['error' => 'حدث خطأ في جلب الحملات']);
}
?>
