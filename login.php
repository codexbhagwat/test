<?php include("config.php") ?>

<h2>Login</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required> <br>
    <input type="password" name="password" placeholder="Password" required> <br>
    <button type="submit" name="login"> Login</button>
</form>

<?php
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];


        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        $user = mysqli_fetch_assoc($result);


    if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
        } else {
            echo "Invalid email or password!";
        }
    }
?>