<?php
include("config.php");

    if(!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
    $user = $_SESSION['user'];
?>

<h2>Welcome, <?= htmlspecialchars($user['username']) ?>!</h2> 
<p>Email: <?= htmlspecialchars($user['email'])?></p>
<h3><a href="crud.php" style="u">Let Perform the Crud operation</a></h3>