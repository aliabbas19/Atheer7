<?php
session_start();
require_once 'db.php'; // ملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من النموذج
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        // التحقق من وجود المستخدم
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // التحقق من كلمة المرور
        if ($user && password_verify($password, $user['password'])) {
            // حفظ البيانات في الجلسة
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['avatar'] = $user['avatar']; // لو عندك صورة في القاعدة

            // التوجيه إلى صفحة البروفايل
            header("Location:homepage.php");
            exit;
        } else {
            $_SESSION['login_error'] = "❌ البريد الإلكتروني أو كلمة المرور غير صحيحة.";
            header("Location: login.php");
            exit;
        }

    } catch (PDOException $e) {
        // في حال وجود خطأ في الاتصال أو الاستعلام
        $_SESSION['login_error'] = "⚠️ حدث خطأ أثناء تسجيل الدخول. الرجاء المحاولة لاحقًا.";
        header("Location: login.php");
        exit;
    }
}
?>
