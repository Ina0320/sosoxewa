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
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
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
                            <a href="shop.php" class="nav-item nav-link active">Catalog</a>
                            <a href="blog.php" class="nav-item nav-link">Blog</a>
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


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Catalog</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Catalog</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <h1 class="mb-4">Toko Bibit Buah Sosoxewa</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <form method="GET" action="">
                                    <div class="input-group w-100 mx-auto d-flex">
                                        <input type="search" name="search" class="form-control p-3" placeholder="keywords" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" aria-describedby="search-icon-1">
                                        <button type="submit" class="input-group-text p-3" id="search-icon-1"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6"></div>
                        </div>
                         <br>
                         <br>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12 mt-4">
                                        <div class="mb-3">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <?php
                                                $category_sql = "SELECT category, COUNT(*) as count FROM products GROUP BY category ORDER BY category";
                                                $category_result = $conn->query($category_sql);
                                                if ($category_result->num_rows > 0) {
                                                    // Add "All Categories" option
                                                    $active_class = (!isset($_GET['category']) || empty($_GET['category'])) ? 'text-primary fw-bold' : '';
                                                    echo '<li>';
                                                    echo '<div class="d-flex justify-content-between fruite-name">';
                                                    echo '<a href="shop.php" class="' . $active_class . '"><i class="fas fa-th-list me-2"></i>All Categories</a>';
                                                    echo '<span>(' . array_sum(array_column($category_result->fetch_all(MYSQLI_ASSOC), 'count')) . ')</span>';
                                                    echo '</div>';
                                                    echo '</li>';

                                                    // Reset result pointer
                                                    $category_result->data_seek(0);

                                                    while($category_row = $category_result->fetch_assoc()) {
                                                        $category_name = htmlspecialchars($category_row["category"]);
                                                        $category_count = $category_row["count"];
                                                        $active_class = (isset($_GET['category']) && $_GET['category'] === $category_name) ? 'text-primary fw-bold' : '';
                                                        echo '<li>';
                                                        echo '<div class="d-flex justify-content-between fruite-name">';
                                                        echo '<a href="shop.php?category=' . urlencode($category_name) . '" class="' . $active_class . '"><i class="fas fa-apple-alt me-2"></i>' . $category_name . '</a>';
                                                        echo '<span>(' . $category_count . ')</span>';
                                                        echo '</div>';
                                                        echo '</li>';
                                                    }
                                                } else {
                                                    echo '<li>';
                                                    echo '<div class="d-flex justify-content-between fruite-name">';
                                                    echo '<a href="#"><i class="fas fa-apple-alt me-2"></i>No categories found</a>';
                                                    echo '<span>(0)</span>';
                                                    echo '</div>';
                                                    echo '</li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <h4 class="mb-3">Featured products</h4>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="img/featur-1.jpg" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">Big Banana</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="img/featur-2.jpg" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">Big Banana</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="img/featur-3.jpg" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">Big Banana</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center my-4">
                                            <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="position-relative">
                                            <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                                <h3 class="text-secondary fw-bold">Bibit <br> Buah <br> Sosoxewa</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">
                            <?php
                            // Build the where clauses and params
                            $where_clauses = array();
                            $params = array();
                            $types = '';

                            // Add search filter
                            if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
                                $search_term = trim($_GET['search']);
                                $where_clauses[] = "(name LIKE ? OR description LIKE ? OR category LIKE ?)";
                                $search_param = "%" . $search_term . "%";
                                $params[] = $search_param;
                                $params[] = $search_param;
                                $params[] = $search_param;
                                $types .= 'sss';
                            }

                            // Add category filter
                            if (isset($_GET['category']) && !empty(trim($_GET['category']))) {
                                $category = trim($_GET['category']);
                                $where_clauses[] = "category = ?";
                                $params[] = $category;
                                $types .= 's';
                            }

                            $where_sql = !empty($where_clauses) ? ' WHERE ' . implode(' AND ', $where_clauses) : '';

                            // Get total count for pagination
                            $total_sql = "SELECT COUNT(*) as total FROM products" . $where_sql;
                            $total_stmt = $conn->prepare($total_sql);
                            if (!empty($params)) {
                                $total_stmt->bind_param($types, ...$params);
                            }
                            $total_stmt->execute();
                            $total_result = $total_stmt->get_result();
                            $total_row = $total_result->fetch_assoc();
                            $total_products = $total_row['total'];

                            $limit = 9;
                            $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
                            $total_pages = ceil($total_products / $limit);
                            $offset = ($page - 1) * $limit;

                            // Build the SQL query with filters and pagination
                            $sql = "SELECT * FROM products" . $where_sql . " ORDER BY created_at DESC LIMIT ? OFFSET ?";
                            $params[] = $limit;
                            $params[] = $offset;
                            $types .= 'ii';

                            // Prepare and execute the query
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param($types, ...$params);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<div class="col-md-6 col-lg-6 col-xl-4">';
                                    echo '<div class="rounded position-relative fruite-item">';
                                    echo '<div class="fruite-img">';
                                    echo '<img src="' . htmlspecialchars($row["image"]) . '" class="img-fluid w-100 rounded-top" alt="' . htmlspecialchars($row["name"]) . '">';
                                    echo '</div>';
                                    echo '<div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">' . htmlspecialchars($row["category"]) . '</div>';
                                    echo '<div class="p-4 border border-secondary border-top-0 rounded-bottom">';
                                    echo '<h4>' . htmlspecialchars($row["name"]) . '</h4>';
                                    echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
                                    echo '<div>';
                                    echo '<p class="text-dark fs-5 fw-bold mb-2">Mulai dari Rp ' . number_format($row["price"], 0, ',', '.') . '</p>';
                                    echo '<div class="text-center">';
                                    $whatsapp_number = '+6285657429602';
                                    $product_name = htmlspecialchars($row["name"]);
                                    $message = "Halo Sosoxewa Bibit Buah Makassar, saya tertarik dengan produk Bibit " . rawurlencode($product_name) . ", apakah masih tersedia? Mohon info lebih lanjut.";
                                    $whatsapp_url = "https://wa.me/" . $whatsapp_number . "?text=" . $message;
                                    echo '<a href="' . $whatsapp_url . '" target="_blank" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fab fa-whatsapp me-2 text-primary"></i> Tertarik? Chat Yuk!</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<div class="col-12">';
                                echo '<div class="text-center py-5">';
                                echo '<h4>No products found</h4>';
                                if (isset($_GET['search']) || isset($_GET['category'])) {
                                    echo '<p>Try adjusting your search or category filter.</p>';
                                    echo '<a href="shop.php" class="btn btn-primary">View All Products</a>';
                                }
                                echo '</div>';
                                echo '</div>';
                            }

                            // Pagination
                            if ($total_pages > 1) {
                                echo '<div class="col-12">';
                                echo '<div class="pagination d-flex justify-content-center mt-5">';
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    $active = ($i == $page) ? 'active' : '';
                                    $url_params = $_GET;
                                    $url_params['page'] = $i;
                                    $url = 'shop.php?' . http_build_query($url_params);
                                    echo '<a href="' . htmlspecialchars($url) . '" class="rounded ' . $active . '">' . $i . '</a>';
                                }
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->


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
                        <div class="col-lg-6">
                            <div class="position-relative mx-auto">
                                <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                                <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Why People Like us!</h4>
                            <p class="mb-4">typesetting, remaining essentially unchanged. It was 
                                popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                            <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Shop Info</h4>
                            <a class="btn-link" href="">About Us</a>
                            <a class="btn-link" href="">Contact Us</a>
                            <a class="btn-link" href="">Privacy Policy</a>
                            <a class="btn-link" href="">Terms & Condition</a>
                            <a class="btn-link" href="">Return Policy</a>
                            <a class="btn-link" href="">FAQs & Help</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Account</h4>
                            <a class="btn-link" href="">My Account</a>
                            <a class="btn-link" href="">Shop details</a>
                            <a class="btn-link" href="">Shopping Cart</a>
                            <a class="btn-link" href="">Wishlist</a>
                            <a class="btn-link" href="">Order History</a>
                            <a class="btn-link" href="">International Orders</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Contact</h4>
                            <p>Address: 1429 Netus Rd, NY 48247</p>
                            <p>Email: Example@gmail.com</p>
                            <p>Phone: +0123 4567 8910</p>
                            <p>Payment Accepted</p>
                            <img src="img/payment.png" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



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