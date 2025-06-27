<?php
    $conn = mysqli_connect("localhost", "root" ,"", "login_system");

    if (!$conn) {
        die("connection failed: ".mysql_connect_error());
    }
    session_start();

?>