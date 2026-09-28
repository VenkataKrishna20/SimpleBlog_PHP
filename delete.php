<?php

require_once "connection.php";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    $id = trim($_GET["id"]);

    $sql = "DELETE FROM blogs WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $id);

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


