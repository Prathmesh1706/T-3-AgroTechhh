<?php
session_start();

include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to select admin with matching username and password
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        header("location: admin_dashboard.php");
        exit;
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-3 AgroTech Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>
    <div class="login">
        <img src="logo1.png" class="img-fluid" alt="Responsive image"><br><br>
        
        <form method="post" action="adminlogin.php">
            <div class="mb-3">
                <label for="username"><i class="fas fa-user"></i> Admin Username</label>
                <input type="text" id="username" class="form-control" name="username" required><br>
            </div>
            <div class="mb-3">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" class="form-control" name="password" required><br>
            </div>
            <input type="submit" class="btn btn-primary" value="Login">
        </form>
    </div>
</body>

</html>
