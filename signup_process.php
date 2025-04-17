<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $city = $_POST['city'];

    // رفع الصورة
    $avatar_path = "";
    if (!empty($_FILES['avatar']['name'])) {
        $avatar_name = time() . '_' . $_FILES['avatar']['name'];
        $target_dir = "uploads/avatars/";
        $target_file = $target_dir . basename($avatar_name);

        // تأكد أن المجلد موجود
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $avatar_path = $target_file;
        }
    }

    // التحقق من وجود الإيميل مسبقاً
    $checkStmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkStmt->execute([$email]);

    if ($checkStmt->rowCount() > 0) {
        $_SESSION['signup_error'] = "⚠️ هذا البريد مسجّل مسبقاً.";
        header("Location: signup.php");
        exit;
    }

    // حفظ البيانات في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, phone, country, city, avatar_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$full_name, $email, $password, $phone, $country, $city, $avatar_path]);

    $_SESSION['signup_success'] = "✅ تم إنشاء الحساب بنجاح. يمكنك تسجيل الدخول الآن.";
    header("Location: login.php");
    exit;
}
?>
