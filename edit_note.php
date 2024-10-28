<?php
require 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ?");
$stmt->execute([$id]);
$note = $stmt->fetch();

if (!$note) {
    die("Note not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Note</h1>
        
        <form action="update_note.php" method="post">
            <input type="hidden" name="id" value="<?php echo $note['id']; ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($note['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" class="form-control"><?php echo htmlspecialchars($note['content']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="priority">Priority Level:</label>
                <select id="priority" name="priority" class="form-control">
                    <option value="Low" <?php echo $note['priority_level'] === 'Low' ? 'selected' : ''; ?>>Low</option>
                    <option value="Medium" <?php echo $note['priority_level'] === 'Medium' ? 'selected' : ''; ?>>Medium</option>
                    <option value="High" <?php echo $note['priority_level'] === 'High' ? 'selected' : ''; ?>>High</option>
                </select>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline" class="form-control" value="<?php echo $note['deadline']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Note</button>
        </form>
    </div>
</body>
</html>