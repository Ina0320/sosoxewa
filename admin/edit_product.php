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

// Fetch product
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    header("Location: dashboard.php");
    exit();
}
$product = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';
    $category = $_POST['category'] ?? '';
    $image = $product['image'];

    // Validate price
    if (!is_numeric($price)) {
        $error = "Price must be a number.";
    } else {
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
            $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ?, category = ? WHERE id = ?");
            $stmt->bind_param("ssdssi", $name, $description, $price, $image, $category, $id);
            if ($stmt->execute()) {
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Error updating product.";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - Sosoxewa</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Product</h2>
    <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($product['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (leave blank to keep current)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <img src="../<?= htmlspecialchars($product['image']) ?>" width="100" alt="Current Image">
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
