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

        .blog-card {
            background-color: #ffffff;
            border: 1px solid #e3e8f0;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.05);
            margin-top: 25px;
            overflow: hidden;
        }

        .blog-header {
            padding: 32px 35px 25px;
            border-bottom: 1px solid #e5e9f0;
            background-color: #fbfcfe;
        }

        .blog-title {
            color: #111827;
            font-size: 30px;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .blog-date {
            color: #64748b;
            font-size: 13px;
        }

        .blog-content {
            padding: 35px;
            color: #374151;
            font-size: 15px;
            line-height: 1.8;
            min-height: 250px;
        }

        .blog-actions {
            padding: 20px 35px;
            border-top: 1px solid #e5e9f0;
            background-color: #fbfcfe;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-back {
            color: #475569;
            background-color: #ffffff;
            border: 1px solid #d8dee8;
            padding: 9px 18px;
            border-radius: 7px;
        }

        .btn-back:hover {
            background-color: #f8fafc;
            color: #172033;
        }

        .btn-edit {
            color: #ffffff;
            background-color: #1769ff;
            border: 1px solid #1769ff;
            padding: 9px 18px;
            border-radius: 7px;
        }

        .btn-edit:hover {
            color: #ffffff;
            background-color: #0f5de0;
            border-color: #0f5de0;
        }

        .btn-delete {
            color: #ef4444;
            background-color: #ffffff;
            border: 1px solid #fecaca;
            padding: 9px 18px;
            border-radius: 7px;
        }

        .btn-delete:hover {
            color: #dc2626;
            background-color: #fef2f2;
        }
    </style>
</head>

<body>

    <div class="page-wrapper">

        <a href="index.php" class="back-link">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Blog Overview
        </a>

        <div class="blog-card">

            <div class="blog-header">

                <h1 class="blog-title">
                    <?php echo htmlspecialchars($blog["blog_name"]); ?>
                </h1>

                <div class="blog-date">
                    <i class="bi bi-calendar3 me-1"></i>
                    <?php echo date("F d, Y", strtotime($blog["blog_added_on"])); ?>
                </div>

            </div>

            <div class="blog-content">
                <?php echo $blog["blog_content"]; ?>
            </div>

            <div class="blog-actions">

                <a href="index.php" class="btn btn-back">
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

</body>

</html>