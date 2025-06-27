<?php include("config.php") ?>

<h2>Register</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required> <br>
    <input type="email" name="email" placeholder="Email" required> <br>
    <input type="password" name="password" placeholder="Password" required> <br>
    <button type="submit" name="register">Register</button>
</form>

<?php
    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $check = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
        if (mysqli_num_rows($check) > 1 ) {
            echo "Email alraedy exists!";
        } else {
            mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
            echo "Registered successfully . <a href='login.php'>Lgin here</a>";
        }
    }

?>



