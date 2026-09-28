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

    <title>Blog Overview</title>

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #e9dff7;
            color: #172033;
        }

        .page-wrapper {
            max-width: 1200px;
            margin: auto;
            padding: 28px 24px 40px;
        }

        .page-title {
            color: #111827;
            font-weight: 600;
            font-size: 26px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .hero-card,
        .posts-card {
            background-color: #ffffff;
            border: 1px solid #e3e8f0;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .hero-card {
            padding: 48px 30px;
            text-align: center;
            margin-bottom: 24px;
        }

        .hero-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background-color: #e7efff;
            color: #1769ff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 30px;
        }

        .hero-card h2 {
            color: #111827;
            font-weight: 600;
        }

        .hero-card p {
            color: #718096 !important;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #1769ff;
            border-color: #1769ff;
        }

        .btn-primary:hover {
            background-color: #0f5de0;
            border-color: #0f5de0;
        }

        .posts-card {
            overflow: hidden;
        }

        .posts-card .border-bottom,
        .posts-card .border-top {
            border-color: #e5e9f0 !important;
        }

        .posts-card h5 {
            color: #172033;
            font-weight: 600;
        }

        .posts-card small {
            color: #718096 !important;
        }

        .badge {
            color: #64748b !important;
            background-color: #ffffff !important;
            border: 1px solid #dce4f0;
            font-weight: 400;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .table {
            color: #172033;
        }

        .table thead {
            background-color: #fafbfc;
        }

        .table thead th {
            color: #172033;
            font-size: 13px;
            font-weight: 600;
            border-bottom: 1px solid #e3e8f0;
            padding-top: 14px;
            padding-bottom: 14px;
        }

        .blog-title-link {
            color: #172033;
            text-decoration: none;
            font-weight: 600;
        }

        .blog-title-link:hover {
            color: #1769ff;
        }

        .table tbody td {
            color: #4b5563;
            border-color: #e8ecf2;
            padding-top: 14px;
            padding-bottom: 14px;
        }

        .table tbody strong {
            color: #172033;
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: #f8faff;
        }

        .action-icon {
            text-decoration: none;
            font-size: 17px;
        }

        .action-icon.text-primary {
            color: #1769ff !important;
        }

        .action-icon.text-danger {
            color: #ef4444 !important;
        }

        .action-icon.text-primary:hover {
            color: #0f5de0 !important;
        }

        .action-icon.text-danger:hover {
            color: #dc2626 !important;
        }
    </style>

</head>

<body>

    <div class="page-wrapper">

        <!-- Header -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="page-title mb-1">
                    Blog Overview
                </h3>

                <p class="page-subtitle mb-0">
                    Manage your posts and organize your blog.
                </p>

            </div>

            <a href="create.php" class="btn btn-primary">

                <i class="bi bi-plus-lg me-1"></i>

                Create New Post

            </a>

        </div>


        <!-- Show this ONLY when there are no blogs -->

        <?php if ($blog_count == 0) { ?>

            <div class="hero-card shadow-sm">

                <div class="hero-icon">

                    <i class="bi bi-journal-text text-primary"></i>

                </div>

                <h2 class="mb-3">
                    Welcome to your Blog
                </h2>

                <p class="text-secondary mb-4">
                    Create, manage and organize your blog posts in one place.
                </p>

                <a href="create.php" class="btn btn-primary px-4">

                    <i class="bi bi-plus-lg me-1"></i>

                    Create Your First Post

                </a>

            </div>

        <?php } ?>


        <!-- Latest Posts -->

        <div class="posts-card shadow-sm">

            <div class="p-4 border-bottom">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="mb-1">
                            Latest Posts
                        </h5>

                        <small class="text-secondary">
                            Your recently created blog posts
                        </small>

                    </div>

                    <span class="badge text-bg-light">
                        Published
                    </span>

                </div>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th class="px-4">
                                Serial No.
                            </th>

                            <th>
                                Title
                            </th>

                            <th>
                                URL
                            </th>

                            <th>
                                Added On
                            </th>

                            <th class="text-center">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $count = 1;

                        while ($row = mysqli_fetch_assoc($result)) {

                            ?>

                            <tr>

                                <td class="px-4">
                                    <?php echo $count; ?>
                                </td>

                                <td>
                                    <a href="view.php?id=<?php echo $row["id"]; ?>" class="blog-title-link">
                                        <?php echo htmlspecialchars($row["blog_name"]); ?>
                                    </a>
                                </td>

                                <td>
                                    <span class="text-secondary">
                                        <?php echo htmlspecialchars($row["blog_url"]); ?>
                                    </span>
                                </td>

                                <td>
                                    <?php echo date("d-m-Y", strtotime($row["blog_added_on"])); ?>
                                </td>

                                <td class="text-center">

                                    <a href="edit.php?id=<?php echo $row["id"]; ?>" class="action-icon text-primary me-3"
                                        title="Edit">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <a href="delete.php?id=<?php echo $row["id"]; ?>" class="action-icon text-danger"
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this blog?');">

                                        <i class="bi bi-trash"></i>

                                    </a>

                                </td>

                            </tr>

                            <?php

                            $count++;

                        }

                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="assets/vendors/popper/popper.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="assets/vendors/ckeditor/ckeditor.js"></script>

</body>

</html>


<?php

mysqli_close($link);

?>