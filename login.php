<?php
    session_start();

    // Check if user is already logged in, redirect to dashboard
    if(isset($_SESSION['user_id'])) {
        header("location: dashboard.php");
        exit;
    }

    include("db.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_id_or_mobile = $_POST['user_id_or_mobile'];
        $password = $_POST['password'];

        if(!empty($user_id_or_mobile) && !empty($password)) {
            $query = "SELECT * FROM users WHERE (user_id = '$user_id_or_mobile' OR mobile_no = '$user_id_or_mobile') LIMIT 1";
            $result = mysqli_query($con, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if($user_data['password'] == $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("location: dashboard.php");
                    exit;
                }
            }
        }
        echo "<script type='text/javascript'> alert('वैध माहिती प्रविष्ट करा')</script>";
    }
?> 

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-3 AgroTech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login">
        <img src="logo1.png" class="img-fluid" alt="Responsive image"> 
        <br>
        <br>
        <form class="form-all" method="POST">
            <label><i class="fas fa-user"></i> यूजर आयडी / मोबाईल क्रमांक</label>
            <input type="text" class="form-control" name="user_id_or_mobile" required>
            <br>
            <label><i class="fas fa-lock"></i> पासवर्ड</label>
            <input type="password" class="form-control" name="password" required>
            <input type="submit" class="btn btn-primary" name="" value="लॉगिन करा">     
        </form>
        <p>नोंदणी करण्यासाठी येथे क्लिक करा <a href="signup.php">नोंदणी करा</a></p>

        <footer class="bg-body-tertiary text-center text-lg-start">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                All rights Reserved © T-3 AgroTech PVT LTD , 2024
                <a class="text-body" href="https://www.t3agro.com/">T-3 <br> AgroTech</a>
            </div>
        </footer>
    </div>
</body>

</html>