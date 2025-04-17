<?php
session_start();
require_once 'db.php';

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];

// تحقق من رصيد الماء
$stmt = $conn->prepare("SELECT water_drops FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$water = $stmt->fetchColumn();

if ($water < 10) {
    header("Location: game.php?error=not-enough");
    exit();
}

// تحقق من عدم الضغط المكرر
$stmt = $conn->prepare("SELECT * FROM game_likes WHERE user_id = ? AND post_id = ?");
$stmt->execute([$user_id, $post_id]);
if ($stmt->rowCount() === 0) {
    $conn->prepare("INSERT INTO game_likes (post_id, user_id, liked_at) VALUES (?, ?, NOW())")->execute([$post_id, $user_id]);
    $conn->prepare("UPDATE users SET water_drops = water_drops - 10 WHERE id = ?")->execute([$user_id]);
}

header("Location: game.php");
