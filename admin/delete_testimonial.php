<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include '../db_connect.php';

// Get testimonial ID from query parameter
$testimonial_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($testimonial_id <= 0) {
    die("Invalid testimonial ID.");
}

// Fetch the testimonial to get the image path
$sql = "SELECT image FROM testimonials WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $testimonial_id);
$stmt->execute();
$result = $stmt->get_result();
$testimonial = $result->fetch_assoc();
$stmt->close();

if (!$testimonial) {
    $conn->close();
    die("Testimonial not found.");
}

$image_path = $testimonial['image'];

// Delete testimonial from database
$sql = "DELETE FROM testimonials WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $testimonial_id);

if ($stmt->execute()) {
    // Delete the image file if it exists
    if (!empty($image_path) && file_exists("../" . $image_path)) {
        unlink("../" . $image_path);
    }
    $stmt->close();
    $conn->close();
    header("Location: dashboard.php?msg=Testimonial+deleted+successfully");
    exit;
} else {
    $error = "Error deleting testimonial: " . $stmt->error;
    $stmt->close();
    $conn->close();
    die($error);
}
?>
