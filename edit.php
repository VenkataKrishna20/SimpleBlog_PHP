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
        mysqli_stmt_bind_param(
            $stmt,
            "ssi",
            $blog_name,
            $blog_content,
            $id
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
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

    <style>
        body {
            background-color: #eef2f7;
            color: #172033;
        }

        .page-wrapper {
            max-width: 950px;
            margin: auto;
            padding: 35px 24px 50px;
        }

        .back-link {
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: #1769ff;
        }

        .page-heading {
            margin-top: 22px;
            margin-bottom: 25px;
        }

        .page-title {
            color: #111827;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 0;
        }

        .form-card {
            background-color: #ffffff;
            border: 1px solid #e3e8f0;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.05);
            overflow: hidden;
        }

        .form-header {
            padding: 22px 28px;
            border-bottom: 1px solid #e5e9f0;
            background-color: #fbfcfe;
        }

        .form-header-content {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .form-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background-color: #e7efff;
            color: #1769ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .form-header h5 {
            color: #172033;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .form-header p {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 0;
        }

        .form-body {
            padding: 30px 28px;
        }

        .form-label {
            color: #172033;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid #d8dee8;
            border-radius: 7px;
            padding: 11px 13px;
            color: #172033;
            font-size: 14px;
        }

        .form-control::placeholder {
            color: #9aa4b2;
        }

        .form-control:focus {
            border-color: #1769ff;
            box-shadow: 0 0 0 3px rgba(23, 105, 255, 0.10);
        }

        .name-section {
            margin-bottom: 25px;
        }

        .content-section {
            margin-bottom: 25px;
        }

        .button-section {
            padding-top: 5px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel {
            color: #475569;
            background-color: #ffffff;
            border: 1px solid #d8dee8;
            padding: 10px 20px;
            border-radius: 7px;
        }

        .btn-cancel:hover {
            background-color: #f8fafc;
            color: #172033;
        }

        .btn-update {
            background-color: #1769ff;
            border-color: #1769ff;
            color: #ffffff;
            padding: 10px 22px;
            border-radius: 7px;
        }

        .btn-update:hover {
            background-color: #0f5de0;
            border-color: #0f5de0;
            color: #ffffff;
        }

        .required {
            color: #ef4444;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">

        <a href="index.php" class="back-link">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Blog Overview
        </a>

        <div class="page-heading">
            <h2 class="page-title">Edit Blog</h2>
            <p class="page-subtitle">
                Update the title and content of your blog post.
            </p>
        </div>

        <div class="form-card">

            <div class="form-header">
                <div class="form-header-content">

                    <div class="form-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <div>
                        <h5>Blog Details</h5>
                        <p>Make changes to your existing blog post.</p>
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

                    <div class="name-section">

                        <label class="form-label">
                            Blog Name
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="blog_name"
                            placeholder="Enter your blog title"
                            value="<?php echo htmlspecialchars($blog_name); ?>"
                            required>

                    </div>

                    <div class="content-section">

                        <label class="form-label">
                            Blog Content
                            <span class="required">*</span>
                        </label>

                        <textarea
                            class="form-control"
                            name="blog_content"
                            placeholder="Write your blog content here..."
                            rows="12"><?php echo htmlspecialchars($blog_content); ?></textarea>

                    </div>

                    <div class="button-section">

                        <a href="index.php" class="btn btn-cancel">
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

    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="assets/vendors/popper/popper.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="assets/vendors/ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace("blog_content");
    </script>
</body>

</html>