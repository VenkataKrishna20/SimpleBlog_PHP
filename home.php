<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blogging Platform</title>
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="home-page">
    <div class="container home-container">
        <nav class="navbar-custom d-flex flex-wrap align-items-center justify-content-between">
            <a href="home.php" class="brand">
                <i class="bi bi-journal-richtext me-2"></i>
                Simple Blogging Platform
            </a>
            <div class="d-flex align-items-center">
                <a href="home.php" class="nav-link-custom active">
                    Home
                </a>
                <a href="domains.php" class="nav-link-custom">
                    Domains
                </a>
                <a href="blogs.php" class="nav-link-custom">
                    Blogs
                </a>
                <img
                    src="assets/img/logo/blog.png"
                    alt="Blogging"
                    class="profile-image">
            </div>
        </nav>
        <section class="hero-section">
            <div class="hero-badge">
                <i class="bi bi-stars me-1"></i>
                Welcome to Simple Blogging Platform
            </div>
            <h1 class="hero-title">
                Share Your Ideas.<br>
                <span>Explore Great Blogs.</span>
            </h1>
            <p class="hero-text">
                A simple platform to discover ideas, explore different
                domains, and create your own blog posts.
            </p>
            <a href="blogs.php" class="btn hero-button">
                Explore Blogs
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </section>
        <section>
            <div class="section-heading">
                <h2 class="section-title">
                    Featured Blogs
                </h2>
                <p class="section-subtitle">
                    Explore a few popular topics and ideas.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="blog-icon">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <div class="blog-domain">
                            Technology
                        </div>
                        <h3 class="blog-title">
                            The Future of Artificial Intelligence
                        </h3>
                        <p class="blog-description">
                            Discover how artificial intelligence is
                            changing the way we work, learn, and build
                            technology.
                        </p>
                        <a href="domains.php" class="read-link">
                            Explore Domain
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="blog-icon">
                            <i class="bi bi-airplane"></i>
                        </div>
                        <div class="blog-domain">
                            Travel
                        </div>
                        <h3 class="blog-title">
                            Exploring the World Through Travel
                        </h3>
                        <p class="blog-description">
                            Travel introduces us to new cultures,
                            experiences, places, and perspectives from
                            around the world.
                        </p>
                        <a href="domains.php" class="read-link">
                            Explore Domain
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="blog-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <div class="blog-domain">
                            Education
                        </div>
                        <h3 class="blog-title">
                            Learning in the Digital Age
                        </h3>
                        <p class="blog-description">
                            Modern education provides new ways to learn,
                            develop skills, and access knowledge from
                            anywhere.
                        </p>
                        <a href="domains.php" class="read-link">
                            Explore Domain
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <div class="footer">
            Simple Blogging Platform
        </div>
    </div>
</body>
</html>