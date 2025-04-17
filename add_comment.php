<?php
session_start();
require_once 'db.php';

if (!isset($_POST['comment'], $_POST['post_id'])) exit;

$comment = $_POST['comment'];
$post_id = $_POST['post_id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("INSERT INTO game_comments (post_id, user_id, comment, commented_at) VALUES (?, ?, ?, NOW())");
$stmt->execute([$post_id, $user_id, $comment]);

header("Location: game.php#post-$post_id");
