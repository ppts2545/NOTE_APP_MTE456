<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    $stmt = $pdo->prepare("UPDATE notes SET title = ?, content = ?, priority_level = ?, deadline = ? WHERE id = ?");
    $stmt->execute([$title, $content, $priority, $deadline, $id]);

    header("Location: index.php"); // Redirect back to the main page
    exit();
}
?>