<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    $stmt = $pdo->prepare("INSERT INTO notes (title, content, priority_level, deadline, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$title, $content, $priority, $deadline]);

    header("Location: index.php"); // Redirect back to the main page
    exit();
}
?>