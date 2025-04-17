<?php
session_start();
require_once 'db.php'; // تأكد من وجود ملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // استلام البيانات من النموذج
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $city = trim($_POST['city']);
    $area = trim($_POST['area']);

    // التحقق من رفع الصورة
    $image_path = "";
    if (!empty($_FILES['campaign_image']['name'])) {
        $image_name = time() . '_' . basename($_FILES['campaign_image']['name']);
        $target_dir = "uploads/campaigns/";
        $target_path = $target_dir . $image_name;

        // إنشاء المجلد إذا لم يكن موجوداً
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['campaign_image']['tmp_name'], $target_path)) {
            $image_path = $target_path;
        } else {
            $_SESSION['campaign_error'] = "فشل رفع الصورة.";
            header("Location: createcampaign.html");
            exit;
        }
    }

    // إدخال البيانات في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO campaigns (title, description, city, area, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $city, $area, $image_path]);

    $_SESSION['campaign_success'] = "✅ تم إنشاء الحملة بنجاح.";
    header("Location: currentcampaign.php");
    exit;
}
?>
