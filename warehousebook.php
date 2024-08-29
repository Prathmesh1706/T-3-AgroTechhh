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

    $permonth50kg = 5; // Assuming the per-50kg price

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_id = $_SESSION['user_id'];
        $mobile_no = $_POST['mobile_no'];
        $grain_type = $_POST['grain_type'];
        $katta_50kg = $_POST['katta_50kg'];   
        $service_type = "वेअरहाउस"; // Assuming this is for warehouse services
        $location = $_POST['location'];

        $totalPrice = $katta_50kg * $permonth50kg;

        $query = "INSERT INTO warehouse_booking (user_id, mobile_no, grain_type, no_of_katta_50kg, total_price, service_type, location) VALUES ('$user_id', '$mobile_no', '$grain_type', '$katta_50kg', '$totalPrice', '$service_type', '$location')";
        $result = mysqli_query($con, $query);

        if ($result) {
            $message = "वेअरहाउस यशस्वीरित्या बुक झाले आहे : चेक माझे ऑर्डर्स";
            $alertClass = "success";
        } else {
            $message = "वेअरहाउस बुक करण्यात अयशस्वी : पुन्हा प्रयत्न करा";
            $alertClass = "danger";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="logo2.png">
    <link rel="shortcut icon" type="x-icon" href="logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-3 AgroTech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styletrac.css">
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

    <form method="POST" action="warehousebook.php" id="bookingForm">
        <label for="mobile_no">मोबाईल क्रमांक</label>
        <input type="text" id="mobile_no" class="form-control" name="mobile_no" pattern="[0-9]{10}" title="कृपया 10-अंकी मोबाइल नंबर प्रविष्ट करा" required><br>
        <label for="location">ठिकाण</label>
        <select type="location" class="form-control" id="location" name="location" required>
            <option>1</option>
            <option>2</option>
            </select><br>
        <label for="grain_type">धान्य प्रकार</label>
        <select type="grain_type" class="form-control" id="grain_type" name="grain_type" required>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option></select><br>
        <label for="katta_50kg">एकूण धान्य ( कट्टा मध्ये )</label>
        <input type="number" class="form-control" id="katta_50kg" name="katta_50kg" required><br>
        <label for="permonth50kg">प्रति कट्टा शुल्क ( दर महिन्याला ) : </label>
        <span id="permonth50kg"><?php echo 'Rs. ' . $permonth50kg; ?></span><br><br>
        <label for="totalPrice">एकूण शुल्क:</label>
        <span id="totalPrice"><?php if(isset($totalPrice)) { echo 'Rs. ' . $totalPrice; } ?></span><br><br>
        <input type="submit" value="वेअरहाउस बुक करा">
    </form>
    <div class="container mt-4">
        <?php if (isset($message)) : ?>
            <div class="alert alert-<?php echo $alertClass; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <a href="dashboard.php" class="btn btn-primary">डॅशबोर्डवर परत जा</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
    document.getElementById('katta_50kg').addEventListener('input', function() {
        var katta_50kg = this.value;
        var permonth50kg = 5; // Example price, you can change this
        var totalPrice = katta_50kg * permonth50kg;
        document.getElementById('permonth50kg').innerText = 'Rs. ' + permonth50kg;
        document.getElementById('totalPrice').innerText = 'Rs. ' + totalPrice;
    });
    </script>

</body>
</html>
