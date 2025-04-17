<?php
require_once 'db.php';

// جلب الإحصائيات من قاعدة البيانات
$stmt1 = $conn->query("SELECT COUNT(*) AS total_campaigns FROM campaigns");
$totalCampaigns = $stmt1->fetch()['total_campaigns'];

$stmt2 = $conn->query("SELECT COUNT(*) AS total_volunteers FROM volunteers");
$totalVolunteers = $stmt2->fetch()['total_volunteers'];

$stmt3 = $conn->query("SELECT COUNT(*) AS total_donations FROM donations");
$totalDonations = $stmt3->fetch()['total_donations'];
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>يلا نزرع</title>
    <link rel="stylesheet" href="css/style.css">
    <link id="theme-style" rel="stylesheet" href="css/light.css">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Allan:wght@400;700&family=Charmonman:wght@400;700&family=Fuggles&family=Pacifico&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Aref+Ruqaa&family=Lalezar&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<header class="headerr" dir='rtl' lang='ar'>
    <div class="logo-and-name">
        <div class="logo">
            <a href="homepage.php"><img src="photos/trees.png" alt="يلا نزرع Logo"></a>
        </div>
        <div>
            <a href="homepage.php" class="site-name">يلا نزرع</a>
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
        <a href="signup.php"><button class="sign-up-button-bar">تسجيل الدخول</button></a>
    </div>

    <div class="stting-icon" id="setting-icon">
        <i class="fa-solid fa-ellipsis-vertical setting-icon" style="color: black; font-size: 44px;"></i>
    </div>
</header>

<div id="sidebar" class="sidebar" dir='rtl' lang='ar'>
    <ul>
        <div class="useraccount">
            <i class="fa-solid fa-user-gear"><a href="profile.html" class="ps">الحساب</a></i>
        </div>
        <hr>
        <li><a href="#">الإشعارات</a></li>
    </ul>
    <div class="mode-icons">
        <i id="dark-mode-icon" class="fa-regular fa-moon" title="الوضع الداكن"></i>
        <i id="light-mode-icon" class="fa-solid fa-sun-plant-wilt" style="display: none;" title="الوضع الفاتح"></i>
    </div>
</div>

<main dir='rtl' lang='ar'>
    <div class="text-section">
        <p>لجعل الكوكب مكانًا أفضل ...</p>
        <a href="volunteers.html"><button class="volunteer-button">تطوّع</button></a>
    </div>
    <div class="images-section">
        <img src="photos/photo_1_2025-04-13_21-04-17.jpg" class="photo1">
        <img src="photos/photo_25_2025-04-13_21-04-18.jpg" class="photo2">
        <img src="photos/photo_13_2025-04-13_21-04-18.jpg" class="photo3">
        <img src="photos/photo_8_2025-04-13_21-04-18.jpg" class="photo4">
    </div>
</main>

<section class="statistics-section" dir="rtl" lang="ar">
    <h2 class="statistics-title">إحصائيات موقعنا</h2>
    <div class="stats-grid">
        <div class="stat-box">
            <i class="fa-solid fa-seedling"></i>
            <h3><?= $totalCampaigns ?></h3>
            <p>عدد الحملات</p>
        </div>
        <div class="stat-box">
            <i class="fa-solid fa-hand-holding-heart"></i>
            <h3><?= $totalVolunteers ?></h3>
            <p>عدد المتطوعين</p>
        </div>
        <div class="stat-box">
            <i class="fa-solid fa-droplet"></i>
            <h3><?= $totalDonations ?></h3>
            <p>عدد التبرعات</p>
        </div>
    </div>
</section>

<section class="volunteer-section">
    <div class="volunteer-message">انضم إلى عشرات الأشخاص المُتطوّعين لزراعة ملايين الأشجار.</div>
    <div class="image-gallery">
        <img src="photos/photo_27_2025-04-13_21-04-18.jpg" class="gallery-image">
        <img src="photos/photo_19_2025-04-13_21-04-18.jpg" class="gallery-image">
        <img src="photos/photo_15_2025-04-13_21-04-18.jpg" class="gallery-image">
    </div>
</section>

<section class="testimonial-section" dir='rtl'>
    <div class="testimonial-header">
        <h2>آراء متابعينا</h2>
        <p>اطلع على ما يقوله المستخدمون.</p>
    </div>
    <div class="testimonial-container">
        <button class="nav-button left-arrow">&#10094;</button>
        <div class="rating-box">
            <div class="palm-tree">🌴🌴🌴</div>
            <p class="user-comment">"لقد غيّر نظرتي إلى الاستدامة!"</p>
            <p class="user-name">- جون دو</p>
            <img src="photos/spider-man-marvel-3840x2160-11025.jpg" class="profile-pic">
        </div>
        <div class="rating-box">
            <div class="palm-tree">🌴🌴🌴🌴🌴</div>
            <p class="user-comment">"أحب أن أكون جزءًا من هذا المجتمع!"</p>
            <p class="user-name">- جين سميث</p>
            <img src="photos/sonic-the-hedgehog-3840x2160-11136.jpg" class="profile-pic">
        </div>
        <button class="nav-button right-arrow">&#10095;</button>
    </div>
</section>

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
            <h3>تابعنا عبر وسائل التواصل</h3>
            <ul>
                <li><a href="https://facebook.com">فيسبوك</a></li>
                <li><a href="https://twitter.com">تويتر</a></li>
                <li><a href="https://instagram.com">إنستغرام</a></li>
            </ul>
        </div>
    </div>
</section>

<footer>
    <p>&copy; 2025 يلا نزرع</p>
</footer>

<script src="js/scriptdarklightmode.js"></script>
<script src="js/scriptsidebar.js"></script>
<script src="js/scripthomepagescroll.js"></script>

</body>
</html>
