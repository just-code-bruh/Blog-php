<?php
    $connection = mysqli_connect('localhost', 'root', '');
    // $connectingDB = mysqli_select_db('php-cms', $connection);
    $db_selected = mysqli_select_db($connection, 'php-cms');
?>