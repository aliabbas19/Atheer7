<?php
session_start();
require_once 'db.php'; // يحتوي على الاتصال بقاعدة البيانات

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// استرجاع عدد قطرات الماء الخاصة بالمستخدم
$stmt = $conn->prepare("SELECT water_drops FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user_water_drops = $stmt->fetchColumn();

// التحقق من زيادة القطرات يوميًا (بشكل مبسط)
$last_login = $_SESSION['last_login'] ?? null;
$today = date('Y-m-d');
if ($last_login !== $today) {
    $conn->prepare("UPDATE users SET water_drops = water_drops + 10 WHERE id = ?")->execute([$user_id]);
    $_SESSION['last_login'] = $today;
    $user_water_drops += 10;
}

// استرجاع المنشورات
$posts_stmt = $conn->query("
    SELECT game_posts.*, users.full_name, users.avatar_path,
        (SELECT COUNT(*) FROM game_likes WHERE game_likes.post_id = game_posts.id) AS like_count,
        (SELECT COUNT(*) FROM game_comments WHERE game_comments.post_id = game_posts.id) AS comment_count
    FROM game_posts
    JOIN users ON users.id = game_posts.user_id
    ORDER BY game_posts.created_at DESC
");
$posts = $posts_stmt->fetchAll(PDO::FETCH_ASSOC);

// استرجاع أعلى 3 منشورات هذا الأسبوع
$top_stmt = $conn->query("
    SELECT game_posts.id, users.full_name, users.avatar_path,
           COUNT(game_likes.id) * 10 AS total_drops
    FROM game_posts
    JOIN users ON users.id = game_posts.user_id
    LEFT JOIN game_likes ON game_likes.post_id = game_posts.id
    WHERE game_posts.created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    GROUP BY game_posts.id
    ORDER BY total_drops DESC
    LIMIT 3
");
$top_posts = $top_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>اللعبة - يلا نزرع</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .user-water-drop { font-weight: bold; margin-bottom: 15px; }
        .comment { margin: 5px 0; border-bottom: 1px solid #ccc; }
        .comment-input-area { margin-top: 10px; }
        .top-water-drop-content { display: flex; align-items: center; }
        .top-water-drop-content img { width: 30px; height: 30px; border-radius: 50%; margin-left: 5px; }
    </style>
</head>
<body>
    <div class="user-water-drop">
        قطرات الماء: <?= $user_water_drops ?>
    </div>

    <form action="upload_post.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <input type="text" name="description" placeholder="وصف الصورة..." required>
        <button type="submit">نشر</button>
    </form>

    <hr>

    <div class="games-box">
        <?php foreach ($posts as $post): ?>
            <div class="game-box" id="post-<?= $post['id'] ?>">
                <div>
                    <img src="<?= $post['image_path'] ?>" class="game-image" alt="post">
                    <p><?= htmlspecialchars($post['description']) ?></p>
                </div>
                <div>
                    <form action="like_post.php" method="POST" style="display:inline;">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <button type="submit" class="likes">
                            <i class="fa-solid fa-droplet"></i> <?= $post['like_count'] * 10 ?>
                        </button>
                    </form>
                </div>
                <div>
                    <form action="add_comment.php" method="POST">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <input type="text" name="comment" placeholder="أضف تعليقك..." required>
                        <button type="submit">إرسال</button>
                    </form>
                </div>
                <div>
                    <strong>التعليقات (<?= $post['comment_count'] ?>)</strong><br>
                    <?php
                    $comment_stmt = $conn->prepare("
                        SELECT comment, users.full_name FROM game_comments
                        JOIN users ON users.id = game_comments.user_id
                        WHERE post_id = ?
                        ORDER BY commented_at DESC
                    ");
                    $comment_stmt->execute([$post['id']]);
                    foreach ($comment_stmt->fetchAll() as $comment): ?>
                        <div class="comment"><?= htmlspecialchars($comment['full_name']) ?>: <?= htmlspecialchars($comment['comment']) ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="topwaterdropbox">
        <h3>أعلى نقاط المياه هذا الأسبوع</h3>
        <?php foreach ($top_posts as $top): ?>
            <div class="top-water-drop">
                <div class="top-water-drop-content">
                    <img src="<?= $top['avatar_path'] ?>" alt="user">
                    <a href="#post-<?= $top['id'] ?>"><?= htmlspecialchars($top['full_name']) ?></a>
                </div>
                <span><?= $top['total_drops'] ?> قطرات</span>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
