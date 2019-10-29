<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($connection, $_POST["name"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $comment = mysqli_real_escape_string($connection, $_POST["comment"]);
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%y %H:%M:%S", $CurrentTime);
    $DateTime;
    $postid = $_GET["id"];
    if (empty($name) || empty($email) || empty($comment)) {
        echo $_SESSION["ErrorMessage"] = "All fields are required !";
    } else {
        global $connection;
        $postIdUrl = $_GET['id'];
        $query = "INSERT into comments (datetime, name, email, comment, status, admin_panel_id) VALUES ('$DateTime', '$name', '$email', '$comment', 'OFF', '$postIdUrl')";
        $execute = mysqli_query($connection, $query);
        if ($execute) {
            echo $_SESSION["SuccessMessage"] = "Comment submitted successfully";
            Redirect_to("fullpost.php?id={$postid}");
        } else {
            echo $_SESSION["ErrorMessage"] = "Operation failed";
            Redirect_to("fullpost.php?id={$postid}");
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
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- <script src="./js/jquery-3.2.1.min.js"></script> -->
    <!-- <script src="./js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="./js/jaliswall.js"></script>
    <script type="text/javascript">
        $('.wall').jaliswall({
            item: '.wall-item',
            columnClass: '.wall-column'
        });
    </script>
    <link rel="stylesheet" href="./css/publicstyle.css">
    <title>Document</title>
</head>

<body style="background: #0f0f0f; color:#505050">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#3d3d3d">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a style="color:beige;" class="nav-link" href="blog.php">Blog<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a style="color:beige;" class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
            </ul>
        </div>
        <!-- <form class="form-inline" action="blog.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="color:white; border-color:white;" name="searchbutton">Search</button>
        </form> -->
    </nav>

    <div class="container">
        <!-- <div class="blog-header"> -->
        <h1 style="text-align:center; color:#fff; margin:60px auto; font-size:40px; font-weight:400;">Complete CMS blog</h1>
        <!-- <div class="row"> -->
        <div class="wall">
            <!--Main area -->
            <?php echo message();
            echo SuccessMessage();
            ?>
            <?php
            global $connection;
            if (isset($_GET["Search"])) {
                $search = $_GET["searchbutton"];
                $viewquery = "SELECT * FROM admin_panel WHERE DateTime LIKE '%$search%' OR title LIKE '%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'";
            } else {
                $postIdUrl = $_GET["id"];
                $viewquery = "SELECT * FROM admin_panel WHERE id='$postIdUrl'";
            }
            $execute = mysqli_query($connection, $viewquery);
            if (!$execute) {
                printf("Error: %s\n", mysqli_error($connection));
                exit();
            }
            while ($datarows = mysqli_fetch_array($execute)) {
                $postid = $datarows['id'];
                $datetime = $datarows['DateTime'];
                $title = $datarows['title'];
                $category = $datarows['category'];
                $admin = $datarows['author'];
                $post = $datarows['post'];
                $image = $datarows['image'];
                ?>
                <div class="wall-item" style="display:block; margin:0 0 24px 0; padding:12px; background:#1e1e1e; transition:all 200ms;">
                    <img style="display:block; width:100%; margin:0 0 30px 0;" src="uploads/<?php echo $image; ?>" alt="">
                    <div class="caption">
                        <h3 style="text-align:center; color:#fff; fint-size:14px; text-transform:uppercase; margin-bottom:0; padding-bottom:0;"><?php echo htmlentities($title); ?></h3>
                        <p style="text-align:center; color:grey; font-weight:300; margin-top:10px;">Category: <?php echo htmlentities($category); ?> published on : <?php echo htmlentities($datetime); ?></p>
                        <p style="text-align:center; color:grey; font-weight:300; margin-top:10px;">
                            <?php
                                echo $post;
                                ?>
                        </p>
                    </div>
                    <!-- <a href="fullpost.php?id=<?php echo $postid; ?>"><span class="btn btn-info">Read more &rsaquo;</span></a> -->
                </div>
            <?php } ?>
            <div>
                <h3 style="color:#fff; fint-size:14px;">Comments</h3>
                <?php
                $connection;
                $postidComments = $_GET["id"];
                $queryComments = "SELECT * FROM comments WHERE admin_panel_id='$postidComments'";
                $execute = mysqli_query($connection, $queryComments);
                while ($datarows = mysqli_fetch_array($execute)) {
                    $commentDate = $datarows['datetime'];
                    $commentName = $datarows['name'];
                    $comments = $datarows['comment'];

                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="img-circle img-responsive">
                                <img style="margin-right:10px;" src="uploads/unknown-profile-1.jpg" width="70px" alt="">
                            </div>
                            <div>
                                <div class="mic-info">
                                    By :<a href="#"><?php echo $commentName; ?></a> On : <?php echo $commentDate; ?>
                                </div>
                                <div class="comment-text">
                                    <?php echo $comments; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div>
                <h3 style="color:#fff; fint-size:14px;">Add comment :</h3>
            </div>
            <div>
                <form action="fullpost.php?id=<?php echo $postid; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="name"><span class="FieldInfo">Name</span></label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="email"><span class="FieldInfo">Email</span></label>
                            <input class="form-control" type="text" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="commentarea"><span class="FieldInfo">Comment</span></label>
                            <textarea class="form-control" type="file" name="comment" id="post"></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>