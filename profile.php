<?php
session_start();
require_once 'db.php';

// إذا لم يكن المستخدم مسجل دخول، يحوّله إلى صفحة تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// جلب بيانات المستخدم من قاعدة البيانات
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>يلا نزرع</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to the CSS file -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=nature_people">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Allan:wght@400;700&family=Charmonman:wght@400;700&family=Fuggles&family=Pacifico&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link id="theme-style" rel="stylesheet" href="css/light.css">
</head>

<body> 

<header class="headerr" dir='rtl' lang='ar'>
    <div class="logo-and-name">
        <div class="logo">
            <a href="homepage.html"><img src="photos/trees.png" alt="يلا نزرع Logo"></a>
        </div>
        <div>
            <a href="homepage.html" class="site-name">يلا نزرع</a>
        </div>
    </div>

    <div class="bar">
        <nav class="navbar">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="#">مُساهمة المجتمع</a>
                    <ul class="dropdown">
                        <li><a href="donations.html">التّبرعات</a></li>
                        <li><a href="volunteers.html">التّطوّع</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#">المُجتمع</a>
                    <ul class="dropdown">
                        <li><a href="game.html">اللّعبة</a></li>
                        <li><a href="#about-us">مَن نحن !؟</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#">حملات التّشجير</a>
                    <ul class="dropdown">
                        <li><a href="mapy.html">الخريطة</a></li>
                        <li><a href="currentcampaign.html">الحملات الحاليّة</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <div class="auth-buttons">
        <div class="search-container">
            <input type="text" class="search-box" placeholder="ابحث هنا...">
            <button class="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form method="POST" action="logout.php">
                <button class="sign-up-button-bar" type="submit">تسجيل الخروج</button>
            </form>
        <?php else: ?>
            <a href="signup.php"><button class="sign-up-button-bar">تسجيل الدخول</button></a>
        <?php endif; ?>
    </div>

    <div class="stting-icon" id="setting-icon">
        <i class="fa-solid fa-ellipsis-vertical setting-icon" style="color: black; font-size: 44px;"></i>
    </div>
</header>

<div id="sidebar" class="sidebar" dir='rtl' lang='ar'>
    <ul>
        <div class="useraccount">
            <i class="fa-solid fa-user-gear" style="color: black; font-size: 24px; cursor: pointer;">
                <a href="profile.php" class="ps">الحساب</a>
            </i>
        </div>
        <hr>
        <li><a href="#">الإشعارات</a></li>
    </ul>

    <div class="mode-icons">
        <i id="dark-mode-icon" class="fa-regular fa-moon" style="color: black; font-size: 24px; cursor: pointer;" title="الوضع الليلي"></i>
        <i id="light-mode-icon" class="fa-solid fa-sun-plant-wilt" style="color: black; font-size: 24px; cursor: pointer; display: none;" title="الوضع الفاتح"></i>
    </div>
</div>

<section class="profile-section">
    <div class="profile-container">

        <div class="im-name">
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <div id="imagePreview">
                        <?php if ($user['avatar_path']): ?>
                            <img src="<?= htmlspecialchars($user['avatar_path']) ?>" alt="الصورة الشخصية" style="width: 100px; height: 100px; border-radius: 50%;">
                        <?php else: ?>
                            <img src="photos/default-avatar.png" alt="الصورة الافتراضية" style="width: 100px; height: 100px; border-radius: 50%;">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="profile-name"><?= htmlspecialchars($user['full_name']) ?></div>
        </div>

        <div class="profile-stats" dir='rtl' lang='ar'>
            <div class="profile-stats-value"><div>عدد الأشجار:</div><div>4</div></div>
            <div class="profile-stats-value"><div>المتابعون:</div><div>44</div></div>
            <div class="profile-stats-value"><div>يتابع:</div><div>77</div></div>
        </div>

        <button class="update-profile-button">تحديث الملف الشخصي</button>
    </div>
</section>

<section class="about-us-section" id="about-us" dir="rtl" lang="ar">
    <h2>عنّا</h2>
    <div class="about-content">
        <div class="about-item"><h3>مهمّتنا</h3><p>مهمتنا هي جعل العالم مكانًا أكثر اخضرارًا من خلال الممارسات المستدامة والمشاركة المجتمعية.</p></div>
        <div class="about-item"><h3>تعرّف أكثر على فريقنا</h3><p>فريقنا ملتزم بتعزيز المبادرات الخضراء وتشجيع المشاركة المجتمعية.</p></div>
        <div class="about-item"><h3>ابقَ على اطلاع بأخبارنا</h3><p>اتصل بنا لأي استفسارات أو للبقاء على اطلاع بأحدث أخبارنا.</p></div>
        <div class="about-item">
            <h3>تابعنا عبر وسائل التواصل الاجتماعي</h3>
            <ul>
                <li><a href="https://www.facebook.com" target="_blank">فيسبوك</a></li>
                <li><a href="https://twitter.com" target="_blank">تويتر</a></li>
                <li><a href="https://www.linkedin.com" target="_blank">لينكد إن</a></li>
                <li><a href="https://www.instagram.com" target="_blank">إنستغرام</a></li>
            </ul>
        </div>
        <div class="about-item"><h3>الدمج</h3><ul><li><a href="#">المنتج</a></li><li><a href="#">التطوّع</a></li><li><a href="#">التسعير</a></li></ul></div>
        <div class="about-item"><h3>الشؤون القانونية</h3><ul><li><a href="#">سياسة الخصوصية</a></li><li><a href="#">شروط الخدمة</a></li></ul></div>
    </div>
</section>

<script src="js/scriptdarklightmode.js"></script>
<script src="js/scriptsidebar.js"></script>
<footer><p>&copy; CopyRight</p></footer>

</body>
</html>
