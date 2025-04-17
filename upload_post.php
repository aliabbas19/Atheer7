<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) exit;

$description = $_POST['description'];
$image_name = "uploads/" . time() . "_" . basename($_FILES['image']['name']);
move_uploaded_file($_FILES['image']['tmp_name'], $image_name);

$stmt = $conn->prepare("INSERT INTO game_posts (user_id, image_path, description, created_at) VALUES (?, ?, ?, NOW())");
$stmt->execute([$_SESSION['user_id'], $image_name, $description]);

header("Location: game.php");
exit();
