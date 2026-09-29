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

mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($blog["blog_name"]); ?></title>
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="view-page">
    <div class="container py-5">
        <div class="mx-auto view-container">
            <a href="blogs.php" class="back-link text-decoration-none">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Blog Overview
            </a>
            <div class="view-card">
                <div class="view-header">
                    <h1 class="view-title">
                        <?php echo htmlspecialchars($blog["blog_name"]); ?>
                    </h1>
                    <div class="view-date">
                        <i class="bi bi-calendar3 me-1"></i>
                        <?php echo date("F d, Y", strtotime($blog["blog_added_on"])); ?>
                    </div>
                </div>
                <div class="view-content">
                    <?php echo $blog["blog_content"]; ?>
                </div>
                <div class="view-actions d-flex justify-content-end gap-2">
                    <a href="blogs.php" class="btn btn-back">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back
                    </a>
                    <a href="edit.php?id=<?php echo $blog["id"]; ?>" class="btn btn-edit">
                        <i class="bi bi-pencil me-1"></i>
                        Edit
                    </a>
                    <a
                        href="delete.php?id=<?php echo $blog["id"]; ?>"
                        class="btn btn-delete"
                        onclick="return confirm('Are you sure you want to delete this blog?');">
                        <i class="bi bi-trash me-1"></i>
                        Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>