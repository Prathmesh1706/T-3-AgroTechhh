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


    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM tractor_booking WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);

    $queryWarehouse = "SELECT * FROM warehouse_booking WHERE user_id = '$user_id'";
    $resultWarehouse = mysqli_query($con, $queryWarehouse);

    $queryDoorstep = "SELECT * FROM doorsteppurchase_booking WHERE user_id = '$user_id'";
    $resultDoorstep = mysqli_query($con, $queryDoorstep);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="logo2.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - T-3 AgroTech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style1.css">
    <style>
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            min-width: 100%;
        }
    </style>
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

<div class="container mt-5">
    <h1>My Orders</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <button class="btn btn-link border border-primary rounded-3 px-3" style="color: blue; font-weight: bold; text-decoration: underline;" data-bs-toggle="collapse" data-bs-target="#tractorBookingCollapse" aria-expanded="false" aria-controls="tractorBookingCollapse">
                          ट्रॅक्टर बुकिंग्स 
                        </button>
                    </h5>
                </div>
                <div id="tractorBookingCollapse" class="collapse">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">तारीख</th>
                                        <th scope="col">बुकिंग तारीख</th>
                                        <th scope="col">सर्विस प्रकार</th>
                                        <th scope="col">एकूण एकर</th>
                                        <th scope="col">एकूण शुल्क</th>
                                        <th scope="col">मोबाईल क्रमांक</th>
                                        <th scope="col">स्टेटस</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>".$row['created_at']."</td>";
                                            echo "<td>".$row['date']."</td>";
                                            echo "<td>".$row['service_type']."</td>";
                                            echo "<td>".$row['number_of_acres']."</td>";
                                            echo "<td>Rs. ".$row['total_price']."</td>";
                                            echo "<td>".$row['mobile_no']."</td>";
                                            echo "<td>".$row['status']."</td>";
                                            echo "<td><a href='invoice.php?booking_id=".$row['book_id']."&type=tractor' target='_blank'>View Invoice</a></td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br></br>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <button class="btn btn-link border border-primary rounded-3 px-3" style="color: blue; font-weight: bold; text-decoration: underline;" data-bs-toggle="collapse" data-bs-target="#warehouseBookingCollapse" aria-expanded="false" aria-controls="warehouseBookingCollapse">
                         वेअरहाउस बुकिंग्स 
                        </button>
                    </h5>
                </div>
                <div id="warehouseBookingCollapse" class="collapse">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">तारीख</th>
                                        <th scope="col">सर्विस प्रकार</th>
                                        <th scope="col">ठिकाण</th>
                                        <th scope="col">धान्य प्रकार</th>
                                        <th scope="col">एकूण कट्टा (50kg मध्ये)</th>
                                        <th scope="col">एकूण शुल्क</th>
                                        <th scope="col">मोबाईल क्रमांक</th>
                                        <th scope="col">स्टेटस</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($rowWarehouse = mysqli_fetch_assoc($resultWarehouse)) {
                                            echo "<tr>";
                                            echo "<td>".$rowWarehouse['created_at']."</td>";
                                            echo "<td>".$rowWarehouse['service_type']."</td>";
                                            echo "<td>".$rowWarehouse['location']."</td>";
                                            echo "<td>".$rowWarehouse['grain_type']."</td>";
                                            echo "<td>".$rowWarehouse['no_of_katta_50kg']."</td>";
                                            echo "<td>Rs. ".$rowWarehouse['total_price']."</td>";
                                            echo "<td>".$rowWarehouse['mobile_no']."</td>";
                                            echo "<td>".$rowWarehouse['status']."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br></br>
        <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <button class="btn btn-link border border-primary rounded-3 px-3" style="color: blue; font-weight: bold; text-decoration: underline;" data-bs-toggle="collapse" data-bs-target="#doorstepBookingCollapse" aria-expanded="false" aria-controls="doorstepBookingCollapse">
                    डोअरस्टेप विक्री बुकिंग्स
                </button>
            </h5>
        </div>
        <div id="doorstepBookingCollapse" class="collapse">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">तारीख</th>
                                <th scope="col">मोबाईल क्रमांक</th>
                                <th scope="col">धान्य प्रकार</th>
                                <th scope="col">एकूण धान्य (क्विंटल मध्ये)</th>
                                <th scope="col">सर्विस प्रकार</th>
                                <th scope="col">स्टेटस</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($rowDoorstep = mysqli_fetch_assoc($resultDoorstep)) {
                                    echo "<tr>";
                                    echo "<td>".$rowDoorstep['created_at']."</td>";
                                    echo "<td>".$rowDoorstep['mobile_no']."</td>";
                                    echo "<td>".$rowDoorstep['grain_type']."</td>";
                                    echo "<td>".$rowDoorstep['totalgrain_quintal']."</td>";
                                    echo "<td>".$rowDoorstep['service_type']."</td>";
                                    echo "<td>".$rowDoorstep['status']."</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

</body>
</html>
