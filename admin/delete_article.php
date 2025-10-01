<?php
// delete_article.php - Admin page to delete a blog article

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sosoxewa_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get article ID from query parameter
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($article_id <= 0) {
    die("Invalid article ID.");
}

// Delete article from database
$sql = "DELETE FROM articles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $article_id);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: dashboard.php?msg=Article+deleted+successfully");
    exit;
} else {
    $error = "Error deleting article: " . $stmt->error;
    $stmt->close();
    $conn->close();
    die($error);
}
?>
