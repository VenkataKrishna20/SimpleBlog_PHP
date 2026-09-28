<?php

require_once "connection.php";

$sql = "SELECT * FROM blogs";

$result = mysqli_query($link, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blog Management System</title>

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="assets/img/logo/blog.png" class="img-fluid" alt="logo" width="50">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar"
                width="100px">
                <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <div class="navbar-nav ms-auto">
                    Blogs
                </div>
            </div>
        </div>
    </nav>
    <div class="container p-5">
        <div class="mb-3">
            <a href="create.php" type="button" class="btn btn-outline-primary">Add Blogs</a>
        </div>
        <div class="d-flex justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th>Serial No.</th>
                                    <th>Title</th>
                                    <th>URL</th>
                                    <th>Added on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">

                                <?php
                                $count = 1;

                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>

                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row["blog_name"]; ?></td>
                                        <td><?php echo $row["blog_url"]; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row["blog_added_on"])); ?></td>
                                        <td>
                                            <a href="#" class="text-primary me-2">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <a href="#" class="text-primary">
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
        </div>

    </div>

    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="assets/vendors/popper/popper.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="assets/vendors/ckeditor/ckeditor.js"></script>

</body>

</html>