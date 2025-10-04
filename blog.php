<?php
// blog.php - Blog page displaying articles from database

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
$sql = "SELECT id, title, author, publish_date, tags, excerpt, image FROM articles ORDER BY publish_date DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Blog - Sosoxewa Bibit Buah Makassar</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Blog edukasi bibit buah Sosoxewa UMKM" name="description">
        <meta content="Sosoxewa, Blog, Edukasi, Bibit Buah" name="keywords">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Jl. Baji Pamuji No.16</a></small>
                    </div>
                    <div class="top-link pe-2">
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6">Sosoxewa</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Catalog</a>
                            <a href="blog.php" class="nav-item nav-link active">Blog</a>
                            <a href="testimonial.php" class="nav-item nav-link">About</a>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

        <!-- Page Header Start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Blog Edukasi Bibit Buah</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active text-white">Blog</li>
            </ol>
        </div>
        <!-- Page Header End -->

        <!-- Blog Section Start -->
        <div class="container-fluid blog py-5">
            <div class="container py-5">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($article = $result->fetch_assoc()): ?>
                        <div class="row g-4 mb-4">
                            <div class="col-lg-4">
                                <div class="blog-img">
                                    <img src="<?php echo htmlspecialchars($article['image'] ?: 'img/vegetable-item-6.jpg'); ?>" class="img-fluid w-100 rounded" alt="<?php echo htmlspecialchars($article['title']); ?>">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="blog-content">
                                    <h4 class="mb-3"><?php echo htmlspecialchars($article['title']); ?></h4>
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="fas fa-user text-primary me-1"></i><?php echo htmlspecialchars($article['author']); ?></small>
                                        <small class="me-3"><i class="fas fa-calendar text-primary me-1"></i><?php echo htmlspecialchars($article['publish_date']); ?></small>
                                        <small><i class="fas fa-tags text-primary me-1"></i><?php echo htmlspecialchars($article['tags']); ?></small>
                                    </div>
                                    <p class="mb-3"><?php echo htmlspecialchars($article['excerpt']); ?></p>
                                    <a href="article.php?id=<?php echo $article['id']; ?>" class="btn border border-secondary rounded-pill py-2 px-4 text-primary">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="text-center">
                        <p>No articles found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Blog Section End -->

           <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <h1 class="text-primary mb-0">Sosoxewa</h1>
                                <p class="text-secondary mb-0">Bibit Buah Unggul</p>
                            </a>
                        </div>

                    </div>
                </div>
               
            </div>
        </div>
        <!-- Footer End -->

      

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

</html>
