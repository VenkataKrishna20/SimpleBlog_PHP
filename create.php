<?php

require_once "connection.php";

$blog_name = $blog_content = $blog_url = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blog_name = $_POST["blog_name"];
    $blog_content = $_POST["blog_content"];

    $sql = "INSERT INTO blogs (blog_name, blog_content, blog_url) VALUES (?, ?, ?)";

    $param_blog_name = $blog_name;
    $param_blog_content = $blog_content;
    $param_blog_url = str_replace(" ", "-", $blog_name);

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $param_blog_name,
            $param_blog_content,
            $param_blog_url
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: blogs.php");
            exit;
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Blog</title>

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="container py-5">

        <div class="mx-auto create-container">

            <a href="blogs.php" class="back-link text-decoration-none">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Blog Overview
            </a>

            <div class="create-heading">

                <h2 class="create-title">
                    Create New Blog
                </h2>

                <p class="create-subtitle">
                    Write and publish a new blog post.
                </p>

            </div>

            <div class="form-card">

                <div class="form-header">

                    <div class="d-flex align-items-center gap-3">

                        <div class="form-icon bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center">

                            <i class="bi bi-pencil-square fs-5"></i>

                        </div>

                        <div>

                            <h5 class="form-header-title">
                                Blog Details
                            </h5>

                            <p class="form-header-text">
                                Add the title and content for your new blog.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="form-body">

                    <form
                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                        method="POST">

                        <div class="form-section">

                            <label class="form-label-custom">
                                Blog Name
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control form-control-custom"
                                name="blog_name"
                                placeholder="Enter your blog title"
                                value="<?php echo htmlspecialchars($blog_name); ?>"
                                required>

                        </div>

                        <div class="form-section">

                            <label class="form-label-custom">
                                Blog Content
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                class="form-control form-control-custom"
                                name="blog_content"
                                placeholder="Write your blog content here..."
                                rows="12"><?php echo htmlspecialchars($blog_content); ?></textarea>

                        </div>

                        <div class="button-section d-flex justify-content-end gap-2">

                            <a
                                href="blogs.php"
                                class="btn btn-cancel">

                                <i class="bi bi-x-lg me-1"></i>
                                Cancel

                            </a>

                            <input
                                type="submit"
                                class="btn btn-create"
                                value="Create Blog">

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="assets/vendors/popper/popper.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="assets/vendors/ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace("blog_content");
    </script>

</body>

</html>