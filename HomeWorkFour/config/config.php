<?php
    $connection = mysqli_connect("localhost", "root", "", "books");
    if (!$connection)
    {
        die("DB Error!");
    }
?>
