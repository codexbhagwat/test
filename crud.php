<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "test_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    mysqli_query($conn, "INSERT INTO users (name, email) VALUES ('$name', '$email')");
    header("Location: crud.php");
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    header("Location: crud.php");
}

// Fetch data for update
$name = "";
$email = "";
$update = false;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $email = $row['email'];
    $update = true;
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE id=$id");
    header("Location: crud.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD - Single File</title>
</head>
<body>
    <h2><?= $update ? 'Edit User' : 'Add User' ?>&nbsp;&nbsp;<a href="logout.php">Logout</a></h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $_GET['edit'] ?? '' ?>">
        <input type="text" name="name" placeholder="Enter Name" value="<?= $name ?>" required>
        <input type="email" name="email" placeholder="Enter Email" value="<?= $email ?>" required>
        <?php if ($update): ?>
            <button type="submit" name="update">Update</button>
        <?php else: ?>
            <button type="submit" name="submit">Save</button>
        <?php endif; ?>
    </form>

    <h2>User List</h2>
    <table border="1" cellpadding="5">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM users");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='crud.php?edit={$row['id']}'>Edit</a> |
                        <a href='crud.php?delete={$row['id']}' onclick=\"return confirm('Delete this record?');\">Delete</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
<br>
<br>

