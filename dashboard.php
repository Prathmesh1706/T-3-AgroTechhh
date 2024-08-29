<?php
    session_start();

    include("db.php");

    if(!isset($_SESSION['user_id'])) {
        header("location: login.php");
        exit;
    }

    if(isset($_POST['logout'])) {
        session_destroy();
        header("location: login.php");
        exit;
    }

    
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - T-3 AgroTech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style1.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-very-light-green">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="logo1.png" alt="Logo" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-dark" aria-current="page" href="dashboard.php"><i class="fas fa-home"></i> होम</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="profile_edit.php"><i class="fas fa-user-edit"></i> प्रोफाइल एडिट करा</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="myorders.php"><i class="fas fa-clipboard-list"></i> माझे ऑर्डर्स</a>
                </li>
            </ul>
            <form method="post">
                <button type="submit" name="logout" class="btn btn-link nav-link text-dark"><i class="fas fa-sign-out-alt"></i> लॉग आऊट</button>
            </form>
        </div>
    </div>
</nav>



<br>
<div class="container">
    <h1>तुमच्या डॅशबोर्डवर स्वागत आहे</h1>
    <p>येथे तुम्ही तुमचे प्रोफाइल आणि इतर सेवा व्यवस्थापित करू शकता</p>
    <hr>
    <div class="row ">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body bg-dashboard-box">
                    <h4 class="card-title">ट्रॅक्टर रेंटल</h4>
                    <img src="3.jpg" class="img-fluid" alt="Tractor Image">
                    <p class="card-text">तुमच्या शेतीच्या गरजांसाठी ट्रॅक्टर रेंट करा</p>
                    <a href="tractorbook.php" class="btn btn-primary">रेंट ट्रॅक्टर</a>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body bg-dashboard-box">
                    <h4 class="card-title">फूड ग्रेन स्टोरेज (वेअरहाउस)</h4>
                    <img src="warehouse.jpg" class="img-fluid" alt="Warehouse Image">
                    <p class="card-text">तुमचे अन्नधान्य आमच्या गोदामात साठवा</p>
                    <a href="warehousebook.php" class="btn btn-primary">धान्य साठवा</a>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body bg-dashboard-box">
                    <h4 class="card-title">डोअरस्टेप विक्री</h4>
                    <img src="purchase.jpg" class="img-fluid" alt="Purchase Image">
                    <p class="card-text">तुमच्या दारात कृषी उत्पादने विक्री करा</p>
                    <a href="doorstepbook.php" class="btn btn-primary">उत्पादने विक्री करा</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <footer class="bg-body-tertiary text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    All rights Reserved © T-3 AgroTech PVT LTD , 2024
    
    </div>
    </footer>
</body>
</html>
