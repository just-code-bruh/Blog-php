<?php require_once("include/session.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/db.php"); ?>
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
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="addNewPost.php">Add new post</a></li>
                    <li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Log out</a></li>
                </ul>
            </div>
            <!-- ending of side section -->
            <div class="col-sm-10">
                <h1>Dashboard</h1>
                <div>
                    <?php
                    echo Message();
                    echo SuccessMessage();
                    ?>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Date & Time</th>
                                <th>Post title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>image</th>
                                <th>Comments</th>
                                <th>Action</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody class="table-striped">
                            <?php
                                $connection;
                                $viewquery = "SELECT * FROM admin_panel ORDER BY DateTime DESC";
                                $execute = mysqli_query($connection, $viewquery);
                                $noo = 0;
                                while($datarows = mysqli_fetch_array($execute)){
                                    $id = $datarows['id'];
                                    $datetime = $datarows['DateTime'];
                                    $title = $datarows['title'];
                                    $category = $datarows['category'];
                                    $author = $datarows['author'];
                                    $post = $datarows['post'];
                                    $image = $datarows['image'];
                                    $noo ++;
                                
                            ?>
                            <tr>
                                <td><?php echo $noo ?></td>
                                <td><?php echo $datetime ?></td>
                                <td><?php echo $title ?></td>
                                <td><?php echo $category ?></td>
                                <td><?php echo $author ?></td>
                                <td><img style="width:60px;" src="./uploads/<?php echo $image ?>"></td>
                                <td>Processing</td>
                                <td>
                                    <a href="editpost.php?edit=<?php echo $id ?>"><span class="btn btn-info">Edit</span></a> /
                                    <a href="deletepost.php?delete=<?php echo $id ?>"><span class="btn btn-danger">delete</span></a>
                                </td>
                                <td>
                                    <a href="fullpost.php?id=<?php echo $id ?>" target="_blank"><span class="btn btn-primary">Live preview</span></a>
                                </td>
                            </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ending of main area -->
        </div>
    </div>

</body>

</html>