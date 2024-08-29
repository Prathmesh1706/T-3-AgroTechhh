<?php
    session_start();

    if(!isset($_SESSION['user_id'])) {
        header("location: login.php");
        exit;
    }
    if(isset($_POST['logout'])) {
        session_destroy();
        header("location: login.php");
        exit;
    }


    include("db.php");

    // Fetch current user's information
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $full_name = $row['full_name'];
        $mobile_no = $row['mobile_no'];
        $acre = $row['acre'];
        $village = $row['village'];
        $taluka = $row['taluka'];
        $district = $row['district'];
        $state = $row['state'];
        $pin_code = $row['pin_code'];
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        // Get updated information from the form
        $full_name_new = $_POST['full_name'];
        $mobile_no_new = $_POST['mobile_no'];
        $acre_new = $_POST['acre'];
        $village_new = $_POST['village'];
        $taluka_new = $_POST['taluka'];
        $district_new = $_POST['district'];
        $state_new = $_POST['state'];
        $pin_code_new = $_POST['pin_code'];
        $password_new = $_POST['password'];

        // Update the user's information in the database
        $query = "UPDATE users SET full_name='$full_name_new', mobile_no='$mobile_no_new', acre='$acre_new', village='$village_new', taluka='$taluka_new', district='$district_new', state='$state_new', pin_code='$pin_code_new', password='$password_new' WHERE user_id='$user_id'";
        $result = mysqli_query($con, $query);

        if($result) {
            header("location: dashboard.php?msg=Profile updated successfully");
            exit;
        } else {
            echo "<script type='text/javascript'> alert('Failed to update profile')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Edit - T-3 AgroTech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">

    <script>
        function updateTalukas() {
            var district = document.getElementById('district').value;
            var talukaSelect = document.getElementById('taluka');
            var talukas = {
                Parbhani: ['Ausa', 'Deoni', 'Gangakhed', 'Jintur', 'Manwath', 'Palam', 'Parbhani', 'Pathri', 'Purna', 'Selu', 'Sonpeth'],
                Latur: ['Ahemadpur', 'Ausa', 'Chakur', 'Deoni', 'Jalkot', 'Latur', 'Nilanga', 'Renapur', 'Shirur Anantpal', 'Udgir']
            };

            talukaSelect.innerHTML = '';
            talukas[district].forEach(function(taluka) {
                var option = document.createElement('option');
                option.text = taluka;
                option.value = taluka;
                talukaSelect.add(option);
            });
        }
    </script>
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
    <div class="container">
    <h1>प्रोफाइल एडिट</h1>
    <form class="form-all" method="POST">
        <div class="mb-3">
            <label for="full_name" class="form-label"><i class="fas fa-user"></i> पूर्ण नाव</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $full_name; ?>" required>
        </div>
        <div class="mb-3">
            <label for="mobile_no" class="form-label"><i class="fas fa-phone"></i> मोबाईल क्रमांक</label>
            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo $mobile_no; ?>" pattern="[0-9]{10}" title="कृपया 10-अंकी मोबाइल नंबर प्रविष्ट करा" required>
        </div>
        <div class="mb-3">
            <label for="acre" class="form-label"><i class="fas fa-map-marker-alt"></i> एकूण शेती(एकर मध्ये)</label>
            <input type="text" class="form-control" id="acre" name="acre" value="<?php echo $acre; ?>" required>
        </div>
        <div class="mb-3">
            <label for="state" class="form-label"><i class="fas fa-map"></i> राज्य</label>
            <select type="text" class="form-control" id="state" name="state" value="<?php echo $state; ?>" required>
                <option>Maharashtra</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="district" class="form-label"><i class="fas fa-city"></i> जिल्हा</label>
            <select type="text" class="form-control" id="district" name="district" onchange="updateTalukas()" value="<?php echo $district; ?>" required>
                <option value="Parbhani">Parbhani</option>
                <option value="Latur">Latur</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="taluka" class="form-label"><i class="fas fa-map-marked"></i> तालुका</label>
            <select type="text" class="form-control" id="taluka" name="taluka" value="<?php echo $taluka; ?>" required>
                <option value="">Select Taluka</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="village" class="form-label"><i class="fas fa-building"></i> गाव</label>
            <input type="text" class="form-control" id="village" name="village" value="<?php echo $village; ?>" required>
        </div>
        <div class="mb-3">
            <label for="pin_code" class="form-label"><i class="fas fa-thumbtack"></i> पिन कोड</label>
            <input type="text" class="form-control" id="pin_code" name="pin_code" value="<?php echo $pin_code; ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i> पासवर्ड बदला</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">बदल जतन करा</button>
    </form>
</div>

</body>
</html>
