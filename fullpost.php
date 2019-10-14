<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/Functions.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/publicstyle.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-light" style="background:#8D82B4;">
        <a class="navbar-brand">Navbar</a>
        <form class="form-inline" action="blog.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="color:white; border-color:white;" name="searchbutton">Search</button>
        </form>
    </nav>

    <div class="container">
        <div class="blog-header">
            <h1>Complete CMS blog</h1>
            <div class="row">
                <div class="col-sm-8">
                    <!--Main area -->
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
                        <div class="img-thumbnail" style="margin-top:15px; margin-bottom:15px;">
                            <img class="responsive" src="./upload/<?php echo $image; ?>" alt="">
                            <div class="caption">
                                <h3><?php echo htmlentities($title); ?></h3>
                                <p>Category: <?php echo htmlentities($category); ?> published on : <?php echo htmlentities($datetime); ?></p>
                                <p>
                                    <?php
                                        echo $post;
                                        ?>
                                </p>
                            </div>
                            <!-- <a href="fullpost.php?id=<?php echo $postid; ?>"><span class="btn btn-info">Read more &rsaquo;</span></a> -->
                        </div>
                    <?php } ?>
                    <div>
                        <form action="addNewPost.php" method="post" enctype="multipart/form-data">
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
                                <input class="btn btn-secondary" type="submit" name="submit" value="Add new post">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>