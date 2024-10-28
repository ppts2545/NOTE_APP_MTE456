<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note-taking App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file here -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Note-taking App</h1>

        <form action="add_note.php" method="post" class="mb-4">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="priority">Priority Level:</label>
                <select id="priority" name="priority" class="form-control">
                    <option value="Low">Low</option>
                    <option value="Medium" selected>Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>

        <h2>Your Notes</h2>
        <div class="list-group">
            <?php
            require 'db.php';

            $stmt = $pdo->query("SELECT * FROM notes ORDER BY created_at DESC");
            while ($note = $stmt->fetch()) {
                $color = match($note['priority_level']) {
                    'High' => 'red',
                    'Medium' => 'yellow',
                    'Low' => 'green',
                    default => 'grey',
                };
                echo "<div class='list-group-item' style='border-left: 5px solid $color;'>";
                echo "<h5>" . htmlspecialchars($note['title']) . "</h5>";
                echo "<p>Content: " . htmlspecialchars($note['content']) . "</p>";
                echo "<p><strong>Priority:</strong> " . htmlspecialchars($note['priority_level']) . "</p>";
                echo "<p><strong>Deadline:</strong> " . htmlspecialchars($note['deadline']) . "</p>";
                echo "<p><strong>Status:</strong> " . htmlspecialchars($note['status']) . "</p>";
                echo "<p class='text-muted'>Created at: " . htmlspecialchars($note['created_at']) . "</p>";
                echo "<button class='btn btn-warning btn-sm' onclick=\"location.href='edit_note.php?id=" . $note['id'] . "'\">Edit</button>";
                echo "<button class='btn btn-danger btn-sm' onclick=\"deleteNote(" . $note['id'] . ")\">Delete</button>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <script>
    function deleteNote(id) {
        if (confirm("Are you sure you want to delete this note?")) {
            window.location.href = "delete_note.php?id=" + id;
        }
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>