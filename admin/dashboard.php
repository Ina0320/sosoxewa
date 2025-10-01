<?php
// dashboard.php - Admin dashboard showing articles, products, and testimonials with management links

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sosoxewa_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch articles
$article_sql = "SELECT id, title, author, publish_date FROM articles ORDER BY publish_date DESC";
$article_result = $conn->query($article_sql);

// Fetch products
$product_sql = "SELECT id, name, category, price FROM products ORDER BY created_at DESC";
$product_result = $conn->query($product_sql);

// Fetch testimonials
$testimonial_sql = "SELECT id, client_name, profession, rating FROM testimonials ORDER BY created_at DESC";
$testimonial_result = $conn->query($testimonial_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard - Sosoxewa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Admin Dashboard</h2>

        <h3>Articles</h3>
        <a href="add_article.php" class="btn btn-success mb-3">Add New Article</a>
        <table class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publish Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($article_result && $article_result->num_rows > 0): ?>
                    <?php while ($row = $article_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['author']); ?></td>
                            <td><?php echo htmlspecialchars($row['publish_date']); ?></td>
                            <td>
                                <a href="edit_article.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_article.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this article?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr><td colspan="5">No articles found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Products</h3>
        <a href="add_product.php" class="btn btn-success mb-3">Add New Product</a>
        <table class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($product_result && $product_result->num_rows > 0): ?>
                    <?php while ($product = $product_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo htmlspecialchars($product['category']); ?></td>
                            <td><?php echo htmlspecialchars($product['price']); ?></td>
                            <td>
                                <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr><td colspan="5">No products found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Testimonials</h3>
        <a href="add_testimonial.php" class="btn btn-success mb-3">Add New Testimonial</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client Name</th>
                    <th>Profession</th>
                    <th>Rating</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($testimonial_result && $testimonial_result->num_rows > 0): ?>
                    <?php while ($testimonial = $testimonial_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $testimonial['id']; ?></td>
                            <td><?php echo htmlspecialchars($testimonial['client_name']); ?></td>
                            <td><?php echo htmlspecialchars($testimonial['profession']); ?></td>
                            <td><?php echo htmlspecialchars($testimonial['rating']); ?></td>
                            <td>
                                <a href="edit_testimonial.php?id=<?php echo $testimonial['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_testimonial.php?id=<?php echo $testimonial['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this testimonial?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr><td colspan="5">No testimonials found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>
