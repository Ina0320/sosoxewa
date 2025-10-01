<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_name = $_POST['client_name'] ?? '';
    $profession = $_POST['profession'] ?? '';
    $testimonial_text = $_POST['testimonial_text'] ?? '';
    $rating = intval($_POST['rating'] ?? 5);
    $image = '';

    // Validate rating
    if ($rating < 1 || $rating > 5) {
        $rating = 5;
    }

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = "uploads/" . basename($_FILES["image"]["name"]);
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        } else {
            $error = "File is not an image.";
        }
    }

    if (empty($error)) {
        $stmt = $conn->prepare("INSERT INTO testimonials (client_name, profession, testimonial_text, rating, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssds", $client_name, $profession, $testimonial_text, $rating, $image);
        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error adding testimonial.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Testimonial - Sosoxewa</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Testimonial</h2>
    <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" class="form-control" id="client_name" name="client_name" required>
        </div>
        <div class="mb-3">
            <label for="profession" class="form-label">Profession</label>
            <input type="text" class="form-control" id="profession" name="profession">
        </div>
        <div class="mb-3">
            <label for="testimonial_text" class="form-label">Testimonial Text</label>
            <textarea class="form-control" id="testimonial_text" name="testimonial_text" required></textarea>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select class="form-control" id="rating" name="rating">
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5" selected>5 Stars</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Add Testimonial</button>
    </form>
</div>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
