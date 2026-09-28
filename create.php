
<?php 
// if time permits we will use them
// $blog_name_err = $blog_content_err = $blog_slug_err = $blog_added_on_err = "";
    require_once "connection.php";

    $blog_name = $blog_content = $blog_url = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $blog_name = $_POST["blog_name"];
        $blog_content = $_POST["blog_content"];
 
        $sql = "INSERT INTO blogs (blog_name,blog_content,blog_url) VALUES(?,?,?)";

        $param_blog_name = $blog_name;
        $param_blog_content = $blog_content;
        $param_blog_url = str_replace(" ","-",$blog_name);

        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param(
                $stmt,
                "sss",
                $param_blog_name,
                $param_blog_content,
                $param_blog_url
            );

            if(mysqli_stmt_execute($stmt)){
                header("Location: index.php");
                exit;
            }else{
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
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" width="100px">
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
            <h5>Create Blogs</h5>
        </div>
        <div class="d-flex justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="mb-2">
                                <label class="form-label">Blog Name</label>
                                <input type="text" class="form-control" name="blog_name" 
                                placeholder="Enter Blog Name" value="<?php echo $blog_name; ?>" >
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Blog Content</label>
                                <textarea type="text" class="form-control" name="blog_content"
                                placeholder="Description"><?php echo $blog_content; ?></textarea>
                            </div>
                            <div class="mb-2">
                                <a href="index.php" class="btn btn-danger">Cancel</a>
                                <input type="submit" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
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