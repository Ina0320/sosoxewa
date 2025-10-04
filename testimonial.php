<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Sosoxewa Bibit Buah Makassar - UMKM Bibit Buah Unggul</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

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
    <?php include 'db_connect.php'; ?>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
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
                            <a href="blog.php" class="nav-item nav-link">Blog</a>
                            <a href="testimonial.php" class="nav-item nav-link active">About</a>
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


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">About</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">About</li>
            </ol>
        </div>
        <!-- Single Page Header End -->

        <!-- About Section Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <img src="img/vegetable-website-template.jpg" alt="Sosoxewa UMKM" class="img-fluid rounded">
                    </div>
                    <div class="col-lg-6">
                        <h4 class="text-primary mb-3">About Sosoxewa</h4>
                        <h1 class="display-5 mb-4">UMKM Bibit Buah Unggul Makassar</h1>
                        <p class="mb-4">Sosoxewa is a leading UMKM specializing in high-quality fruit seedlings in Makassar. We are committed to providing superior seedlings to support local farmers and gardeners in cultivating healthy and productive fruit plants.</p>
                        <p class="mb-4">Our mission is to promote sustainable agriculture by offering the best seedlings, expert advice, and excellent customer service. We believe in the power of quality planting materials to improve yields and enhance the agricultural community.</p>
                        <a href="contact.html" class="btn btn-primary rounded-pill py-3 px-5">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Section End -->

        <!-- Tastimonial Start -->
        <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="testimonial-header text-center">
                    <h4 class="text-primary">Our Testimonial</h4>
                    <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                <?php
                $sql = "SELECT * FROM testimonials ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $name = htmlspecialchars($row['client_name']);
                        $profession = htmlspecialchars($row['profession']);
                        $testimonial = htmlspecialchars($row['testimonial_text']);
                        $image = !empty($row['image']) ? htmlspecialchars($row['image']) : 'img/testimonial-1.jpg';
                        $rating = (int)$row['rating'];

                        echo '<div class="testimonial-item img-border-radius bg-light rounded p-4">';
                        echo '<div class="position-relative">';
                        echo '<i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>';
                        echo '<div class="mb-4 pb-4 border-bottom border-secondary">';
                        echo '<p class="mb-0">' . $testimonial . '</p>';
                        echo '</div>';
                        echo '<div class="d-flex align-items-center flex-nowrap">';
                        echo '<div class="bg-secondary rounded">';
                        echo '<img src="' . $image . '" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="' . $name . '">';
                        echo '</div>';
                        echo '<div class="ms-4 d-block">';
                        echo '<h4 class="text-dark">' . $name . '</h4>';
                        echo '<p class="m-0 pb-3">' . $profession . '</p>';
                        echo '<div class="d-flex pe-5">';
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                                echo '<i class="fas fa-star text-primary"></i>';
                            } else {
                                echo '<i class="fas fa-star"></i>';
                            }
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // Default testimonials if none in database
                    for ($i = 0; $i < 3; $i++) {
                        echo '<div class="testimonial-item img-border-radius bg-light rounded p-4">';
                        echo '<div class="position-relative">';
                        echo '<i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>';
                        echo '<div class="mb-4 pb-4 border-bottom border-secondary">';
                        echo '<p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry\'s standard dummy text ever since the 1500s.</p>';
                        echo '</div>';
                        echo '<div class="d-flex align-items-center flex-nowrap">';
                        echo '<div class="bg-secondary rounded">';
                        echo '<img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="Client">';
                        echo '</div>';
                        echo '<div class="ms-4 d-block">';
                        echo '<h4 class="text-dark">Client Name</h4>';
                        echo '<p class="m-0 pb-3">Profession</p>';
                        echo '<div class="d-flex pe-5">';
                        echo '<i class="fas fa-star text-primary"></i>';
                        echo '<i class="fas fa-star text-primary"></i>';
                        echo '<i class="fas fa-star text-primary"></i>';
                        echo '<i class="fas fa-star text-primary"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
                </div>
            </div>
        </div>
        <!-- Tastimonial End -->


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
