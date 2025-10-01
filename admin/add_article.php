<?php
// add_article.php - Admin page to add a new blog article

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sosoxewa_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $publish_date = $_POST['publish_date'] ?? '';
    $tags = $_POST['tags'] ?? '';
    $excerpt = $_POST['excerpt'] ?? '';
    $content = $_POST['content'] ?? '';

    // Handle image upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = basename($_FILES['image']['name']);
        $target_file = $upload_dir . time() . '_' . $filename;
        if (move_uploaded_file($tmp_name, $target_file)) {
            // Store relative path for database
            $image_path = 'uploads/' . time() . '_' . $filename;
        } else {
            $message = "Failed to upload image.";
        }
    }

    $sql = "INSERT INTO articles (title, author, publish_date, tags, excerpt, content, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $title, $author, $publish_date, $tags, $excerpt, $content, $image_path);

    if ($stmt->execute()) {
        $message = "Article added successfully.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Article - Admin - Sosoxewa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Add New Article</h2>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="post" action="add_article.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="mb-3">
                <label for="publish_date" class="form-label">Publish Date</label>
                <input type="date" class="form-control" id="publish_date" name="publish_date" required>
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags (comma separated)</label>
                <input type="text" class="form-control" id="tags" name="tags">
            </div>
            <div class="mb-3">
                <label for="excerpt" class="form-label">Excerpt</label>
                <textarea class="form-control" id="excerpt" name="excerpt" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="6" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Add Article</button>
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
