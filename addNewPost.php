<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
if (isset($_POST["submit"])) {
    $title = mysqli_real_escape_string($connection, $_POST["title"]);
    $category = mysqli_real_escape_string($connection, $_POST["category"]);
    $post = mysqli_real_escape_string($connection, $_POST["post"]);
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%y %H:%M:%S", $CurrentTime);
    $DateTime;
    $Admin = "hamza";
    $image = $_FILES["image"]["name"];
    $target = "uploads/".basename($_FILES["image"]["name"]);
    if (empty($title)) {
        echo $_SESSION["ErrorMessage"] = "Title must be filled";
        Redirect_to("addNewPost.php");
    } else {
        global $connection;
        $query = "Insert into admin_panel(DateTime, title, category, author, image, post)VALUES('$DateTime', '$title', '$category','$Admin', '$image', '$post')";
        $execute = mysqli_query($connection, $query);
        move_uploaded_file($_FILES["image"]["tmp_name"],$target);
        if ($execute) {
            echo $_SESSION["SuccessMessage"] = "Post added successfully";
            Redirect_to("addNewPost.php");
        } else {
            echo $_SESSION["ErrorMessage"] = "Operation failed";
            Redirect_to("addNewPost.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <script src="./js/bootstrap.min"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="./css/adminstyles.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <h2 style="color:#070347">Blog</h2>
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="addNewPost.php">Add new post</a></li>
                    <li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage.php">Manage admins</a></li>
                    <li class="nav-item"><a class="nav-link" href="comments.php">Comments</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Log out</a></li>
                </ul>
            </div>
            <!-- ending of side section -->
            <div class="col-sm-10">
                <h2>Add new post</h2>
                <?php
                echo Message();
                echo SuccessMessage();
                ?>
                <div>
                    <form action="addNewPost.php" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Title</span></label>
                                <input class="form-control" type="text" name="title" id="title" placeholder="title">
                            </div>
                            <div class="form-group">
                                <label for="categorySelect"><span class="FieldInfo">Category</span></label>
                                <select name="category" class="form-control" id="categorySelect">
                                    <?php
                                        global $connection;
                                        $Viewquery = "SELECT * FROM category ORDER BY DateTime DESC";
                                        $execute = mysqli_query($connection, $Viewquery);
                                        if (!$execute) {
                                            printf("Error: %s\n", mysqli_error($connection));
                                            exit();
                                        }
                                        while ($DataRows = mysqli_fetch_array($execute)) {
                                            $id = $DataRows["id"];
                                            $categoryName = $DataRows["name"];
                                    ?>
                                    <option><?php echo $categoryName; ?></option>
                                        <?php } ?>
                                </select>
                                <div class="form-group">
                                    <label for="imageSelect"><span class="FieldInfo">Select image</span></label>
                                    <input class="form-control" type="file" name="image" id="imageSelect">
                                </div>
                                <div class="form-group">
                                    <label for="post"><span class="FieldInfo">Post</span></label>
                                    <textarea class="form-control" type="file" name="post" id="post"></textarea>
                                </div>
                            </div>
                            <input class="btn btn-secondary" type="submit" name="submit" value="Add new post">
                        </fieldset>
                    </form>
                </div>
                <br>
                <br>
                <div class="table-responsive">

                </div>
            </div>
            <!-- ending of main area -->
        </div>
    </div>

</body>

</html>