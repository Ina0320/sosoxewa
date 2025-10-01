<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include '../db_connect.php';

$id = intval($_GET['id'] ?? 0);
if ($id == 0) {
    header("Location: dashboard.php");
    exit();
}

// Fetch testimonial
$stmt = $conn->prepare("SELECT * FROM testimonials WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    header("Location: dashboard.php");
    exit();
}
$testimonial = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_name = $_POST['client_name'] ?? '';
    $profession = $_POST['profession'] ?? '';
    $testimonial_text = $_POST['testimonial_text'] ?? '';
    $rating = intval($_POST['rating'] ?? 5);
    $image = $testimonial['image'];

    // Validate rating
    if ($rating < 1 || $rating > 5) {
        $rating = 5;
    }

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
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
        $stmt = $conn->prepare("UPDATE testimonials SET client_name = ?, profession = ?, testimonial_text = ?, rating = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssdsi", $client_name, $profession, $testimonial_text, $rating, $image, $id);
        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error updating testimonial.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Testimonial - Sosoxewa</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Testimonial</h2>
    <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" class="form-control" id="client_name" name="client_name" value="<?= htmlspecialchars($testimonial['client_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="profession" class="form-label">Profession</label>
            <input type="text" class="form-control" id="profession" name="profession" value="<?= htmlspecialchars($testimonial['profession']) ?>">
        </div>
        <div class="mb-3">
            <label for="testimonial_text" class="form-label">Testimonial Text</label>
            <textarea class="form-control" id="testimonial_text" name="testimonial_text" required><?= htmlspecialchars($testimonial['testimonial_text']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select class="form-control" id="rating" name="rating">
                <option value="1" <?= $testimonial['rating'] == 1 ? 'selected' : '' ?>>1 Star</option>
                <option value="2" <?= $testimonial['rating'] == 2 ? 'selected' : '' ?>>2 Stars</option>
                <option value="3" <?= $testimonial['rating'] == 3 ? 'selected' : '' ?>>3 Stars</option>
                <option value="4" <?= $testimonial['rating'] == 4 ? 'selected' : '' ?>>4 Stars</option>
                <option value="5" <?= $testimonial['rating'] == 5 ? 'selected' : '' ?>>5 Stars</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (leave blank to keep current)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <?php if (!empty($testimonial['image'])): ?>
                <img src="../<?= htmlspecialchars($testimonial['image']) ?>" width="100" alt="Current Image">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update Testimonial</button>
    </form>
</div>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
