<?php
require_once "connection.php";

$blog_name = $blog_content = "";
$id = "";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);
    $sql = "SELECT * FROM blogs WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $blog_name = $row["blog_name"];
                $blog_content = $row["blog_content"];
            } else {
                exit;
            }
        }

        mysqli_stmt_close($stmt);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST["id"]);
    $blog_name = $_POST["blog_name"];
    $blog_content = $_POST["blog_content"];

    $sql = "UPDATE blogs SET blog_name = ?, blog_content = ? WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssi", $blog_name, $blog_content, $id);

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
    <title>Edit Blog</title>
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container py-5">
        <div class="mx-auto edit-container">
            <a href="blogs.php" class="back-link text-decoration-none">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Blog Overview
            </a>
            <div class="edit-heading">
                <h2 class="edit-title">Edit Blog</h2>
                <p class="edit-subtitle">
                    Update the title and content of your blog post.
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
                                Make changes to your existing blog post.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="form-body">
                    <form
                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>"
                        method="POST">
                        <input
                            type="hidden"
                            name="id"
                            value="<?php echo htmlspecialchars($id); ?>">
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
                            <a href="blogs.php" class="btn btn-cancel">
                                <i class="bi bi-x-lg me-1"></i>
                                Cancel
                            </a>
                            <input
                                type="submit"
                                class="btn btn-update"
                                value="Update Blog">
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