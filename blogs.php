<?php

require_once "connection.php";

$sql = "SELECT * FROM blogs ORDER BY id DESC";

$result = mysqli_query($link, $sql);

$blog_count = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs - Simple Blogging Platform</title>
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="blogs-page">
    <div class="container blogs-container">
        <nav class="navbar-custom d-flex flex-wrap align-items-center justify-content-between">
            <a href="home.php" class="brand">
                <i class="bi bi-journal-richtext me-2"></i>
                Simple Blogging Platform
            </a>
            <div class="d-flex align-items-center">
                <a href="home.php" class="nav-link-custom">
                    Home
                </a>
                <a href="domains.php" class="nav-link-custom">
                    Domains
                </a>
                <a href="blogs.php" class="nav-link-custom active">
                    Blogs
                </a>
                <img src="assets/img/logo/blog1.png" alt="Blogging" class="profile-image">
            </div>
        </nav>
        <div class="page-heading">
            <div>
                <h1 class="page-title">
                    Blog Management
                </h1>
                <p class="page-subtitle">
                    Create, view, edit, and manage your blog posts.
                </p>
            </div>
            <a href="create.php" class="btn btn-create">
                <i class="bi bi-plus-lg me-1"></i>
                Create Blog
            </a>
        </div>
        <div class="posts-card">
            <div class="posts-header">
                <h2 class="posts-title">
                    Latest Posts
                </h2>
                <span class="posts-count">
                    <?php echo $blog_count; ?>
                    <?php echo $blog_count == 1 ? "Blog" : "Blogs"; ?>
                </span>
            </div>
            <?php if ($blog_count > 0) { ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Blog Name</th>
                                <th>Date Added</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <a href="view.php?id=<?php echo $row["id"]; ?>" class="blog-title-link">
                                            <?php echo htmlspecialchars($row["blog_name"]); ?>
                                        </a>
                                    </td>
                                    <td class="blog-date">
                                        <?php echo date("d M, Y", strtotime($row["blog_added_on"])); ?>
                                    </td>
                                    <td>
                                        <div class="action-icons">
                                            <a href="edit.php?id=<?php echo $row["id"]; ?>" class="action-icon text-primary"
                                                title="Edit">

                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="delete.php?id=<?php echo $row["id"]; ?>" class="action-icon text-danger"
                                                title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-journal-plus"></i>
                    </div>
                    <h3 class="empty-title">
                        No Blogs Yet
                    </h3>
                    <p class="empty-text">
                        You haven't created any blog posts yet.
                        Start by creating your first blog.
                    </p>
                    <a href="create.php" class="btn btn-create">
                        <i class="bi bi-plus-lg me-1"></i>
                        Create Your First Blog
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="footer">
            Simple Blogging Platform
        </div>
    </div>
</body>

</html>