<?php
session_start();
require_once 'db.php';

// جلب الحملات من قاعدة البيانات
$stmt = $conn->prepare("SELECT * FROM campaigns ORDER BY created_at DESC");
$stmt->execute();
$campaigns = $stmt->fetchAll(PDO::FETCH_ASSOC);

// تحقق من حالة تسجيل الدخول
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>الحملات الحالية - يلا نزرع</title>
    <link rel="stylesheet" href="css/style.css">
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
                <li class="nav-item"><a href="#">مُساهمة المجتمع</a>
                    <ul class="dropdown">
                        <li><a href="donations.html">التّبرعات</a></li>
                        <li><a href="volunteers.html">التّطوّع</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="#">المُجتمع</a>
                    <ul class="dropdown">
                        <li><a href="game.html">اللّعبة</a></li>
                        <li><a href="#about-us">مَن نحن !؟</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="#">حملات التّشجير</a>
                    <ul class="dropdown">
                        <li><a href="mapy.html">الخريطة</a></li>
                        <li><a href="currentcampaign.php">الحملات الحاليّة</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <div class="auth-buttons">
        <div class="search-container">
            <input type="text" class="search-box" placeholder="ابحث هنا...">
            <button class="search-button">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <?php if ($isLoggedIn): ?>
            <form action="logout.php" method="post" style="display:inline;">
                <button type="submit" class="sign-up-button-bar">تسجيل الخروج</button>
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
            <i class="fa-solid fa-user-gear" style="color: black; font-size: 24px;">
                <a href="profile.php" class="ps">الحساب</a>
            </i>
        </div>
        <hr>
        <li><a href="#">الإشعارات</a></li>
    </ul>
    <div class="mode-icons">
        <i id="dark-mode-icon" class="fa-regular fa-moon" style="font-size: 24px;"></i>
        <i id="light-mode-icon" class="fa-solid fa-sun-plant-wilt" style="font-size: 24px; display: none;"></i>
    </div>
</div>

<section class="current-campaign" dir="rtl" lang="ar">
    <div class="current-campaign-container">
        <div class="left-side-cc">
            <div class="search-box">
                <div class="campaign-message">
                    هل ترغب في إنشاء حملة الآن؟
                    <a href="createcampaign.html" class="make-campaign-link">إنشاء حملة</a>
                </div>
            </div>
        </div>

        <div class="center-cc">
            <div id="campaign-container">
                <div class="currentcampaginsbox">
                    <?php foreach ($campaigns as $campaign): ?>
                        <div class="campaignbox">
                            <div class="campaign-content">
                                <img src="<?= htmlspecialchars($campaign['image_path']) ?>" class="campaign-image" alt="صورة الحملة">
                                <div class="campaign-details">
                                    <p class="campaign-description"><?= htmlspecialchars($campaign['description']) ?></p>
                                    <p class="location">الموقع: <?= htmlspecialchars($campaign['city']) ?> - <?= htmlspecialchars($campaign['area']) ?></p>
                                    <hr>
                                    <div class="comment-content">
                                        <?php if ($isLoggedIn): ?>
                                            <form action="register_campaign.php" method="post">
                                                <input type="hidden" name="campaign_id" value="<?= $campaign['id'] ?>">
                                                <button type="submit" class="registration-button">تسجيل</button>
                                            </form>
                                        <?php else: ?>
                                            <p>يجب <a href="signup.php">تسجيل الدخول</a> للتسجيل في الحملة.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($campaigns)): ?>
                        <p>لا توجد حملات حالياً.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="right-side-cc">
            <div class="map-box">
                <div class="map-box-content">
                    <div class="map-box-button">
                        <a href="mapy.html"><button class="view-map">عرض الخريطة</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- قسم من نحن + الفوتر كامل بدون حذف -->
<section class="about-us-section" id="about-us" dir="rtl" lang="ar">
    <h2>عنّا</h2>
    <div class="about-content">
        <div class="about-item">
            <h3>مهمّتنا</h3>
            <p>مهمتنا هي جعل العالم مكانًا أكثر اخضرارًا من خلال الممارسات المستدامة والمشاركة المجتمعية.</p>
        </div>
        <div class="about-item">
            <h3>تعرّف أكثر على فريقنا</h3>
            <p>فريقنا ملتزم بتعزيز المبادرات الخضراء وتشجيع المشاركة المجتمعية.</p>
        </div>
        <div class="about-item">
            <h3>ابقَ على اطلاع بأخبارنا</h3>
            <p>اتصل بنا لأي استفسارات أو للبقاء على اطلاع بأحدث أخبارنا.</p>
        </div>
        <div class="about-item">
            <h3>تابعنا عبر وسائل التواصل الاجتماعي</h3>
            <ul>
                <li><a href="https://www.facebook.com" target="_blank">فيسبوك</a></li>
                <li><a href="https://twitter.com" target="_blank">تويتر</a></li>
                <li><a href="https://www.linkedin.com" target="_blank">لينكد إن</a></li>
                <li><a href="https://www.instagram.com" target="_blank">إنستغرام</a></li>
            </ul>
        </div>
        <div class="about-item">
            <h3>الدمج</h3>
            <ul>
                <li><a href="#">المنتج</a></li>
                <li><a href="#">التطوّع</a></li>
                <li><a href="#">التسعير</a></li>
            </ul>
        </div>
        <div class="about-item">
            <h3>الشؤون القانونية</h3>
            <ul>
                <li><a href="#">سياسة الخصوصية</a></li>
                <li><a href="#">شروط الخدمة</a></li>
            </ul>
        </div>
    </div>
</section>

<footer>
    <p>&copy; CopyRight</p>
</footer>

<script src="js/scriptdarklightmode.js"></script>
<script src="js/scriptsidebar.js"></script>
<script src="js/scriptcc.js"></script>
<div id="toast" class="toast">تم التسجيل بالفعل في الحملة</div>


</body>
</html>
