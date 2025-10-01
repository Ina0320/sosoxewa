<?php
// edit_article.php - Admin page to edit an existing blog article

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

// Get article ID from query parameter
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($article_id <= 0) {
    die("Invalid article ID.");
}

// Fetch article data for form
$sql = "SELECT * FROM articles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Article not found.");
}

$article = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $publish_date = $_POST['publish_date'] ?? '';
    $tags = $_POST['tags'] ?? '';
    $excerpt = $_POST['excerpt'] ?? '';
    $content = $_POST['content'] ?? '';
    $image = $_POST['image'] ?? '';

    $update_sql = "UPDATE articles SET title = ?, author = ?, publish_date = ?, tags = ?, excerpt = ?, content = ?, image = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssssi", $title, $author, $publish_date, $tags, $excerpt, $content, $image, $article_id);

    if ($update_stmt->execute()) {
        $message = "Article updated successfully.";
        // Refresh article data
        $article['title'] = $title;
        $article['author'] = $author;
        $article['publish_date'] = $publish_date;
        $article['tags'] = $tags;
        $article['excerpt'] = $excerpt;
        $article['content'] = $content;
        $article['image'] = $image;
    } else {
        $message = "Error: " . $update_stmt->error;
    }

    $update_stmt->close();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Article - Admin - Sosoxewa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Article</h2>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="post" action="edit_article.php?id=<?php echo $article_id; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($article['author']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="publish_date" class="form-label">Publish Date</label>
                <input type="date" class="form-control" id="publish_date" name="publish_date" value="<?php echo htmlspecialchars($article['publish_date']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags (comma separated)</label>
                <input type="text" class="form-control" id="tags" name="tags" value="<?php echo htmlspecialchars($article['tags']); ?>">
            </div>
            <div class="mb-3">
                <label for="excerpt" class="form-label">Excerpt</label>
                <textarea class="form-control" id="excerpt" name="excerpt" rows="3"><?php echo htmlspecialchars($article['excerpt']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="6" required><?php echo htmlspecialchars($article['content']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="text" class="form-control" id="image" name="image" value="<?php echo htmlspecialchars($article['image']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Article</button>
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
