<?php

require_once "connection.php";

$blog = null;

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);

    $sql = "SELECT * FROM blogs WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $blog = mysqli_fetch_assoc($result);
            } else {
                exit("Blog not found.");
            }
        }

        mysqli_stmt_close($stmt);
    }
} else {
    exit("Invalid blog ID.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST["id"]);

    $sql = "DELETE FROM blogs WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);

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

    <title>Delete Blog</title>

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="container py-5">

        <div class="mx-auto delete-container">

            <div class="delete-card">

                <div class="delete-header text-center">

                    <div class="delete-icon">

                        <i class="bi bi-trash"></i>

                    </div>

                    <h1 class="delete-title">
                        Delete Blog
                    </h1>

                    <p class="delete-subtitle">
                        Are you sure you want to delete this blog post?
                    </p>

                </div>

                <div class="blog-info">

                    <h2 class="blog-name">
                        <?php echo htmlspecialchars($blog["blog_name"]); ?>
                    </h2>

                    <div class="blog-date">

                        <i class="bi bi-calendar3 me-1"></i>

                        <?php echo date("F d, Y", strtotime($blog["blog_added_on"])); ?>

                    </div>

                    <div class="blog-preview">
                        <?php echo strip_tags($blog["blog_content"]); ?>
                    </div>

                </div>

                <div class="button-section d-flex justify-content-end align-items-center gap-2">

                    <a
                        href="blogs.php"
                        class="btn btn-cancel">

                        Cancel

                    </a>

                    <form method="POST">

                        <input
                            type="hidden"
                            name="id"
                            value="<?php echo $blog["id"]; ?>">

                        <button
                            type="submit"
                            class="btn btn-delete">

                            <i class="bi bi-trash me-1"></i>
                            Delete Blog

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>