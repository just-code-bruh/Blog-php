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
                    if(isset($_GET["Search"])){
                        $search = $_GET["searchbutton"];
                        $viewquery = "SELECT * FROM admin_panel WHERE DateTime LIKE '%$search%' OR title LIKE '%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'";
                    }else{
                        $postIdUrl = $_GET["id"];
                        $viewquery = "SELECT * FROM admin_panel WHERE id='$postIdUrl'";
                    }
                    $execute = mysqli_query($connection, $viewquery);
                    if (!$execute) {
                        printf("Error: %s\n", mysqli_error($connection));
                        exit();
                    }
                    while($datarows=mysqli_fetch_array($execute)){
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
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis aliquid nobis impedit voluptatem? Quis dolorum atque dolorem veritatis laudantium veniam amet ipsam. Iure ea molestiae eveniet fugit suscipit? Amet, culpa?</p>
                </div>
                <div class="col-sm-3">
                    <!--Side area -->
                    <h2>Test</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. A sunt consequatur dolorum mollitia libero dolorem veniam omnis hic rem molestias, ex accusamus repudiandae, tempora ad. Laboriosam atque a voluptatem non!</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>