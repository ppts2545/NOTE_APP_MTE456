<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM notes WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php"); // Redirect back to the main page
exit();
?>