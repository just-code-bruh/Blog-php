<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
if (isset($_POST["submit"])) {
    $category = mysqli_real_escape_string($connection, $_POST["category"]);
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%y %H:%M:%S", $CurrentTime);
    $DateTime;
    $Admin = "hamza";
    if (empty($category)) {
        echo $_SESSION["ErrorMessage"] = "All field must be filled";
        Redirect_to("categories.php");
    } else {
        global $connection;
        $query = "Insert into category(DateTime, name, authorName)VALUES('$DateTime','$category','$Admin')";
        $execute = mysqli_query($connection, $query);
        if ($execute) {
            echo $_SESSION["SuccessMessage"] = "Category added successfully";
            Redirect_to("categories.php");
        } else {
            echo $_SESSION["ErrorMessage"] = "Operation failed";
            Redirect_to("categories.php");
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
                    <li class="nav-item"><a class="nav-link" href="addNewPost.php">Add new post</a></li>
                    <li class="nav-item"><a class="nav-link active" href="categories.php">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage.php">Manage admins</a></li>
                    <li class="nav-item"><a class="nav-link" href="comments.php">Comments</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Log out</a></li>
                </ul>
            </div>
            <!-- ending of side section -->
            <div class="col-sm-10">
                <h2>Managing categories</h2>
                <?php
                echo Message();
                echo SuccessMessage();
                ?>
                <div>
                    <form action="categories.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="categoryName">Name</label>
                                <input class="form-control" type="text" name="category" id="categoryName" placeholder="name">
                            </div>
                            <input class="btn btn-secondary" type="submit" name="submit" value="Add new category">
                        </fieldset>
                    </form>
                </div>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">Category name</th>
                                <th scope="col">Author name</th>
                            </tr>
                        </thead>
                        <?php
                        global $connection;
                        $Viewquery = "SELECT * FROM category ORDER BY DateTime DESC";
                        $execute = mysqli_query($connection, $Viewquery);
                        if (!$execute) {
                            printf("Error: %s\n", mysqli_error($connection));
                            exit();
                        }
                        $No = 0;
                        while ($DataRows = mysqli_fetch_array($execute)) {
                            $id = $DataRows["id"];
                            $DateTime = $DataRows["DateTime"];
                            $categoryName = $DataRows["name"];
                            $authorName = $DataRows["authorName"];
                            $No++;
                            ?>
                            <tbody class="table-striped">
                                <tr>
                                    <th scope="col"><?php echo $No ?></th>
                                    <th scope="col"><?php echo $DateTime ?></th>
                                    <th scope="col"><?php echo $categoryName ?></th>
                                    <th scope="col"><?php echo $authorName ?></th>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <!-- ending of main area -->
        </div>
    </div>

</body>

</html>