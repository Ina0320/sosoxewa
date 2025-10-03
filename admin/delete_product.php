<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include '../db_connect.php';

// Get product ID from query parameter
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id <= 0) {
    die("Invalid product ID.");
}

// Fetch the product to get the image path
$sql = "SELECT image FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    $conn->close();
    die("Product not found.");
}

$image_path = $product['image'];

// Delete product from database
$sql = "DELETE FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);

if ($stmt->execute()) {
    // Delete the image file if it exists
    if (!empty($image_path) && file_exists("../" . $image_path)) {
        unlink("../" . $image_path);
    }
    $stmt->close();
    $conn->close();
    header("Location: dashboard.php?msg=Product+deleted+successfully");
    exit;
} else {
    $error = "Error deleting product: " . $stmt->error;
    $stmt->close();
    $conn->close();
    die($error);
}
?>
