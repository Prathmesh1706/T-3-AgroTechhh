<?php
session_start();

// Check if admin is not logged in
if (!isset($_SESSION['username'])) {
    header("location: adminlogin.php");
    exit;
}

include("db.php");

// Handle logout
if(isset($_POST['logout'])) {
    session_destroy();
    header("location: adminlogin.php");
    exit;
}

// Read data from users table
$query_users = "SELECT * FROM users";
$result_users = mysqli_query($con, $query_users);

// Read data from tractor_booking table
$query_tractor_booking = "SELECT * FROM tractor_booking";
$result_tractor_booking = mysqli_query($con, $query_tractor_booking);

$query_warehouse_booking = "SELECT * FROM warehouse_booking";
$result_warehouse_booking = mysqli_query($con, $query_warehouse_booking);

$query_doorsteppurchase_booking = "SELECT * FROM doorsteppurchase_booking";
$result_doorsteppurchase_booking = mysqli_query($con, $query_doorsteppurchase_booking);

// Edit user
if(isset($_POST['editUserId']) && isset($_POST['editFullName']) && isset($_POST['editMobileNumber'])) {
    $editUserId = $_POST['editUserId'];
    $editFullName = $_POST['editFullName'];
    $editMobileNumber = $_POST['editMobileNumber'];
    $editAcre = $_POST['editAcre'];
    $editTaluka = $_POST['editTaluka'];
    $editDistrict = $_POST['editDistrict'];
    $editState = $_POST['editState'];
    $editPinCode = $_POST['editPinCode'];
    $editVillage = $_POST['editVillage'];
    $editPassword = $_POST['editPassword'];

    // Update the user's details
    $query_edit_user = "UPDATE users SET full_name = '$editFullName', mobile_no = '$editMobileNumber', acre = '$editAcre', village = '$editVillage', taluka = '$editTaluka', district = '$editDistrict', state = '$editState', pin_code = '$editPinCode', password = '$editPassword' WHERE id = $editUserId";
    mysqli_query($con, $query_edit_user);
    // Redirect back to admin page
    header("Location: admin_dashboard.php");
    exit();
}

// Delete user
if(isset($_POST['deleteUserId'])) {
    $deleteUserId = $_POST['deleteUserId'];
    // Delete the user from the database
    $query_delete_user = "DELETE FROM users WHERE id = $deleteUserId";
    mysqli_query($con, $query_delete_user);
    // Redirect back to admin page
    header("Location: admin_dashboard.php");
    exit();
}

// Edit tractor booking
if(isset($_POST['editBookingId']) && isset($_POST['editUserId']) && isset($_POST['editDate']) && isset($_POST['editNumberofAcres']) && isset($_POST['editTotalPrice']) && isset($_POST['editMobileNumber']) && isset($_POST['editStatus']) && isset($_POST['editServiceType'])) {
    $editBookingId = $_POST['editBookingId'];
    $editUserId = $_POST['editUserId'];
    $editDate = $_POST['editDate'];
    $editNumberofAcres = $_POST['editNumberofAcres'];
    $editTotalPrice = $_POST['editTotalPrice'];
    $editMobileNumber = $_POST['editMobileNumber'];
    $editStatus = $_POST['editStatus'];
    $editServiceType = $_POST['editServiceType'];
    // Update the tractor booking details
    $query_edit_booking = "UPDATE tractor_booking SET user_id = '$editUserId', date = '$editDate', number_of_acres = '$editNumberofAcres', total_price = '$editTotalPrice', mobile_no = '$editMobileNumber', status = '$editStatus', service_type = '$editServiceType' WHERE book_id = $editBookingId";
    mysqli_query($con, $query_edit_booking);
    // Redirect back to admin page
    header("Location: admin_dashboard.php");
    exit();
}

// Delete tractor booking
if(isset($_POST['deleteBookingId'])) {
    $deleteBookingId = $_POST['deleteBookingId'];
    // Delete the tractor booking from the database
    $query_delete_booking = "DELETE FROM tractor_booking WHERE book_id = $deleteBookingId";
    mysqli_query($con, $query_delete_booking);
    // Redirect back to admin page
    header("Location: admin_dashboard.php");
    exit();
}

// Edit warehouse booking
if(isset($_POST['editWarehouseBookingId']) && isset($_POST['editUserId']) && isset($_POST['editGrainType']) && isset($_POST['editNoOfKatta50kg']) && isset($_POST['editTotalPrice']) && isset($_POST['editMobileNumber']) && isset($_POST['editStatus']) && isset($_POST['editServiceType']) && isset($_POST['editLocation'])) {
    $editWarehouseBookingId = $_POST['editWarehouseBookingId'];
    $editUserId = $_POST['editUserId'];
    $editGrainType = $_POST['editGrainType'];
    $editNoOfKatta50kg = $_POST['editNoOfKatta50kg'];
    $editTotalPrice = $_POST['editTotalPrice'];
    $editMobileNumber = $_POST['editMobileNumber'];
    $editStatus = $_POST['editStatus'];
    $editServiceType = $_POST['editServiceType'];
    $editLocation = $_POST['editLocation'];
    
    // Update the warehouse booking details
    $query_edit_booking = "UPDATE warehouse_booking SET user_id = '$editUserId', grain_type = '$editGrainType', no_of_katta_50kg = '$editNoOfKatta50kg', total_price = '$editTotalPrice', mobile_no = '$editMobileNumber', status = '$editStatus', service_type = '$editServiceType', location = '$editLocation' WHERE book_id = $editWarehouseBookingId";
    mysqli_query($con, $query_edit_booking);
    
    // Redirect back to admin page
    header("Location: admin_dashboard.php");
    exit();
}


// Delete warehouse booking
if(isset($_POST['deleteWarehouseBookingId'])) {
    $deleteWarehouseBookingId = $_POST['deleteWarehouseBookingId'];
    // Delete the warehouse booking from the database
    $query_delete_booking = "DELETE FROM warehouse_booking WHERE book_id = $deleteWarehouseBookingId";
    mysqli_query($con, $query_delete_booking);
    // Redirect back to admin page
    header("Location: admin_dashboard.php");
    exit();
}

// Edit doorstep purchase booking
if(isset($_POST['editDoorstepBookingId']) && isset($_POST['editUserId']) && isset($_POST['editGrainType']) && isset($_POST['editTotalGrainQuintal']) && isset($_POST['editMobileNumber']) && isset($_POST['editStatus']) && isset($_POST['editServiceType'])) {
    $editDoorstepBookingId = $_POST['editDoorstepBookingId'];
    $editUserId = $_POST['editUserId'];
    $editGrainType = $_POST['editGrainType'];
    $editTotalGrainQuintal = $_POST['editTotalGrainQuintal'];
    $editMobileNumber = $_POST['editMobileNumber'];
    $editStatus = $_POST['editStatus'];
    $editServiceType = $_POST['editServiceType'];
    // Update the doorstep purchase booking details
    $query_edit_booking = "UPDATE doorsteppurchase_booking SET user_id = '$editUserId', grain_type = '$editGrainType', totalgrain_quintal = '$editTotalGrainQuintal', mobile_no = '$editMobileNumber', status = '$editStatus', service_type = '$editServiceType' WHERE book_id = $editDoorstepBookingId";
    mysqli_query($con, $query_edit_booking);
    // Redirect back to admin page
    header("Location: admin_dashboard.php");
    exit();
}

// Delete doorstep purchase booking
if(isset($_POST['deleteDoorstepBookingId'])) {
    $deleteDoorstepBookingId = $_POST['deleteDoorstepBookingId'];
    // Delete the doorstep purchase booking from the database
    $query_delete_booking = "DELETE FROM doorsteppurchase_booking WHERE book_id = $deleteDoorstepBookingId";
    mysqli_query($con, $query_delete_booking);
    // Redirect back to admin page
    header("Location: admin_dashboard.php");
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-3 AgroTech Admin</title>
    <link rel="shortcut icon" type="x-icon" href="logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>
<!-- Navigation bar -->
<div class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="logo1.png" alt="Logo" height="60">
        </a>
        <a class="navbar-brand" href="#"><h2>Admin Panel</h2></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <form method="post">
                        <button type="submit" name="logout" class="btn btn-link nav-link"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Admin Dashboard content -->
<div class="container-fluid mt-5">
    <h2>Admin Dashboard</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="cursor: pointer;" onclick="showUsersTable()">
                    <h5 class="card-title">Users</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="cursor: pointer;" onclick="showTractorBookingsTable()">
                    <h5 class="card-title">Tractor Bookings</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="cursor: pointer;" onclick="showWarehouseBookingsTable()">
                    <h5 class="card-title">Warehouse Bookings</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="cursor: pointer;" onclick="showDoorPurchaseBookingsTable()">
                    <h5 class="card-title">Door Step Purchase Bookings</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="usersTable" class="container-fluid mt-5" style="display: none;">
<div class="container-fluid mt-5">
    <h2>Users</h2>
    <div class="table-responsive overflow-x-auto">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Mobile Number</th>
                    <th>Acre</th>
                    <th>Village</th>
                    <th>Taluka</th>
                    <th>District</th>
                    <th>State</th>
                    <th>Pin Code</th>
                    <th>User ID</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while ($row = mysqli_fetch_assoc($result_users)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['full_name']}</td>";
                    echo "<td>{$row['mobile_no']}</td>";
                    echo "<td>{$row['acre']}</td>";
                    echo "<td>{$row['village']}</td>";
                    echo "<td>{$row['taluka']}</td>";
                    echo "<td>{$row['district']}</td>";
                    echo "<td>{$row['state']}</td>";
                    echo "<td>{$row['pin_code']}</td>";
                    echo "<td>{$row['user_id']}</td>";
                    echo "<td>{$row['password']}</td>";
                    echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editUserModal{$row['id']}'>Edit</button> <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteUserModal{$row['id']}'>Delete</button></td>";
                    echo "</tr>";

                    // Edit User Modal
                    // Edit User Modal
// Edit User Modal
echo "<div class='modal fade' id='editUserModal{$row['id']}' tabindex='-1' aria-labelledby='editUserModalLabel{$row['id']}' aria-hidden='true'>";
echo "<div class='modal-dialog'>";
echo "<div class='modal-content'>";
echo "<div class='modal-header'>";
echo "<h5 class='modal-title' id='editUserModalLabel{$row['id']}'>Edit User</h5>";
echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
echo "</div>";
echo "<div class='modal-body'>";
echo "<form method='post'>";
echo "<input type='hidden' name='editUserId' value='{$row['id']}'>";
echo "<div class='mb-3'>";
echo "<label for='editFullName' class='form-label'>Full Name</label>";
echo "<input type='text' class='form-control' id='editFullName' name='editFullName' value='{$row['full_name']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editMobileNumber' class='form-label'>Mobile Number</label>";
echo "<input type='text' class='form-control' id='editMobileNumber' name='editMobileNumber' value='{$row['mobile_no']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editAcre' class='form-label'>Acre</label>";
echo "<input type='text' class='form-control' id='editAcre' name='editAcre' value='{$row['acre']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editVillage' class='form-label'>Village</label>";
echo "<input type='text' class='form-control' id='editVillage' name='editVillage' value='{$row['village']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editTaluka' class='form-label'>Taluka</label>";
echo "<input type='text' class='form-control' id='editTaluka' name='editTaluka' value='{$row['taluka']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editDistrict' class='form-label'>District</label>";
echo "<input type='text' class='form-control' id='editDistrict' name='editDistrict' value='{$row['district']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editState' class='form-label'>State</label>";
echo "<input type='text' class='form-control' id='editState' name='editState' value='{$row['state']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editPinCode' class='form-label'>Pin Code</label>";
echo "<input type='text' class='form-control' id='editPinCode' name='editPinCode' value='{$row['pin_code']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editUserID' class='form-label'>User ID</label>";
echo "<input type='text' class='form-control' id='editUserID' name='editUserID' value='{$row['user_id']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editPassword' class='form-label'>Password</label>";
echo "<input type='text' class='form-control' id='editPassword' name='editPassword' value='{$row['password']}'>";
echo "</div>";
echo "<button type='submit' class='btn btn-primary'>Save Changes</button>";
echo "</form>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";


                    // Delete User Modal
                    echo "<div class='modal fade' id='deleteUserModal{$row['id']}' tabindex='-1' aria-labelledby='deleteUserModalLabel{$row['id']}' aria-hidden='true'>";
                    echo "<div class='modal-dialog'>";
                    echo "<div class='modal-content'>";
                    echo "<div class='modal-header'>";
                    echo "<h5 class='modal-title' id='deleteUserModalLabel{$row['id']}'>Delete User</h5>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                    echo "</div>";
                    echo "<div class='modal-body'>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='deleteUserId' value='{$row['id']}'>";
                    echo "<p>Are you sure you want to delete this user?</p>";
                    echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<div id="tractorBookingsTable" class="container-fluid mt-5" style="display: none;">
<div class="container-fluid mt-5">
    <h2>Tractor Bookings</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User ID</th>
                    <th>Date</th>
                    <th>Number of Acres</th>
                    <th>Total Price</th>
                    <th>Created At</th>
                    <th>Mobile Number</th>
                    <th>Status</th>
                    <th>Service Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result_tractor_booking)) {
                    // Determine the status class
                    $statusClass = '';
                    switch ($row['status']) {
                        case 'Booked':
                            $statusClass = 'status-booked';
                            break;
                        case 'In Progress':
                            $statusClass = 'status-in-progress';
                            break;
                        case 'Success':
                            $statusClass = 'status-success';
                            break;
                        default:
                            $statusClass = '';
                            break;
                    }
                
                    echo "<tr>";
                    echo "<td>{$row['book_id']}</td>";
                    echo "<td>{$row['user_id']}</td>";
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['number_of_acres']}</td>";
                    echo "<td>{$row['total_price']}</td>";
                    echo "<td>{$row['created_at']}</td>";
                    echo "<td>{$row['mobile_no']}</td>";
                    echo "<td><span class='{$statusClass}'>{$row['status']}</span></td>";
                    echo "<td>{$row['service_type']}</td>";
                    echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editBookingModal{$row['book_id']}'>Edit</button> <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteBookingModal{$row['book_id']}'>Delete</button></td>";
                    echo "</tr>";
                

                    // Edit Tractor Booking Modal
                    // Edit Tractor Booking Modal
echo "<div class='modal fade' id='editBookingModal{$row['book_id']}' tabindex='-1' aria-labelledby='editBookingModalLabel{$row['book_id']}' aria-hidden='true'>";
echo "<div class='modal-dialog'>";
echo "<div class='modal-content'>";
echo "<div class='modal-header'>";
echo "<h5 class='modal-title' id='editBookingModalLabel{$row['book_id']}'>Edit Tractor Booking</h5>";
echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
echo "</div>";
echo "<div class='modal-body'>";
echo "<form method='post'>";
echo "<input type='hidden' name='editBookingId' value='{$row['book_id']}'>";
echo "<div class='mb-3'>";
echo "<label for='editUserId' class='form-label'>User ID</label>";
echo "<input type='text' class='form-control' id='editUserId' name='editUserId' value='{$row['user_id']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editDate' class='form-label'>Date</label>";
echo "<input type='date' class='form-control' id='editDate' name='editDate' value='{$row['date']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editNumberofAcres' class='form-label'>Number of Acres</label>";
echo "<input type='text' class='form-control' id='editNumberofAcres' name='editNumberofAcres' value='{$row['number_of_acres']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editTotalPrice' class='form-label'>Total Price</label>";
echo "<input type='text' class='form-control' id='editTotalPrice' name='editTotalPrice' value='{$row['total_price']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editMobileNumber' class='form-label'>Mobile Number</label>";
echo "<input type='text' class='form-control' id='editMobileNumber' name='editMobileNumber' value='{$row['mobile_no']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editStatus' class='form-label'>Status</label>";
echo "<label for='editServiceType' class='form-label'>Service Type</label>";
echo "<select class='form-control' id='editStatus' name='editStatus'>";
echo "<option value='Booked' style='color: red;' " . ($status == 'Booked' ? 'selected' : '') . ">Booked</option>";
echo "<option value='In Progress' style='color: orange;' " . ($status == 'In Progress' ? 'selected' : '') . ">In Progress</option>";
echo "<option value='Success' style='color: green;' " . ($status == 'Success' ? 'selected' : '') . ">Success</option>";
echo "</select>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editServiceType' class='form-label'>Service Type</label>";
echo "<input type='text' class='form-control' id='editServiceType' name='editServiceType' value='{$row['service_type']}'>";
echo "</div>";
echo "<button type='submit' class='btn btn-primary'>Save Changes</button>";
echo "</form>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";


                    // Delete Tractor Booking Modal
                    echo "<div class='modal fade' id='deleteBookingModal{$row['book_id']}' tabindex='-1' aria-labelledby='deleteBookingModalLabel{$row['book_id']}' aria-hidden='true'>";
                    echo "<div class='modal-dialog'>";
                    echo "<div class='modal-content'>";
                    echo "<div class='modal-header'>";
                    echo "<h5 class='modal-title' id='deleteBookingModalLabel{$row['book_id']}'>Delete Tractor Booking</h5>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                    echo "</div>";
                    echo "<div class='modal-body'>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='deleteBookingId' value='{$row['book_id']}'>";
                    echo "<p>Are you sure you want to delete this booking?</p>";
                    echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<div id="warehouseBookingsTable" class="container-fluid mt-5" style="display: none;">
<div class="container-fluid mt-5">
    <h2>Warehouse Bookings</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User ID</th>
                    <th>Location</th>
                    <th>Grain Type</th>
                    <th>No. of Katta (50kg)</th>
                    <th>Total Price</th>
                    <th>Created At</th>
                    <th>Mobile Number</th>
                    <th>Status</th>
                    <th>Service Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result_warehouse_booking)) {
                    // Determine the status class
                    $statusClass = '';
                    switch ($row['status']) {
                        case 'Booked':
                            $statusClass = 'status-booked';
                            break;
                        case 'In Progress':
                            $statusClass = 'status-in-progress';
                            break;
                        case 'Success':
                            $statusClass = 'status-success';
                            break;
                        default:
                            $statusClass = '';
                            break;
                    }
                
                    echo "<tr>";
                    echo "<td>{$row['book_id']}</td>";
                    echo "<td>{$row['user_id']}</td>";
                    echo "<td>{$row['location']}</td>";
                    echo "<td>{$row['grain_type']}</td>";
                    echo "<td>{$row['no_of_katta_50kg']}</td>";
                    echo "<td>{$row['total_price']}</td>";
                    echo "<td>{$row['created_at']}</td>";
                    echo "<td>{$row['mobile_no']}</td>";
                    echo "<td><span class='{$statusClass}'>{$row['status']}</span></td>";
                    echo "<td>{$row['service_type']}</td>";
                    echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editWarehouseBookingModal{$row['book_id']}'>Edit</button> <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteWarehouseBookingModal{$row['book_id']}'>Delete</button></td>";
                    echo "</tr>";
                

// Edit Warehouse Booking Modal
echo "<div class='modal fade' id='editWarehouseBookingModal{$row['book_id']}' tabindex='-1' aria-labelledby='editWarehouseBookingModalLabel{$row['book_id']}' aria-hidden='true'>";
echo "<div class='modal-dialog'>";
echo "<div class='modal-content'>";
echo "<div class='modal-header'>";
echo "<h5 class='modal-title' id='editWarehouseBookingModalLabel{$row['book_id']}'>Edit Warehouse Booking</h5>";
echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
echo "</div>";
echo "<div class='modal-body'>";
echo "<form method='post'>";
echo "<input type='hidden' name='editWarehouseBookingId' value='{$row['book_id']}'>";
echo "<div class='mb-3'>";
echo "<label for='editUserId' class='form-label'>User ID</label>";
echo "<input type='text' class='form-control' id='editUserId' name='editUserId' value='{$row['user_id']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editGrainType' class='form-label'>Grain Type</label>";
echo "<input type='text' class='form-control' id='editGrainType' name='editGrainType' value='{$row['grain_type']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editNoOfKatta50kg' class='form-label'>No. of Katta (50kg)</label>";
echo "<input type='text' class='form-control' id='editNoOfKatta50kg' name='editNoOfKatta50kg' value='{$row['no_of_katta_50kg']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editTotalPrice' class='form-label'>Total Price</label>";
echo "<input type='text' class='form-control' id='editTotalPrice' name='editTotalPrice' value='{$row['total_price']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editMobileNumber' class='form-label'>Mobile Number</label>";
echo "<input type='text' class='form-control' id='editMobileNumber' name='editMobileNumber' value='{$row['mobile_no']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editLocation' class='form-label'>Location</label>";
echo "<input type='text' class='form-control' id='editLocation' name='editLocation' value='{$row['location']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editStatus' class='form-label'>Status</label>";
echo "<label for='editServiceType' class='form-label'>Service Type</label>";
echo "<select class='form-control' id='editStatus' name='editStatus'>";
echo "<option value='Booked' style='color: red;' " . ($status == 'Booked' ? 'selected' : '') . ">Booked</option>";
echo "<option value='In Progress' style='color: orange;' " . ($status == 'In Progress' ? 'selected' : '') . ">In Progress</option>";
echo "<option value='Success' style='color: green;' " . ($status == 'Success' ? 'selected' : '') . ">Success</option>";
echo "</select>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editServiceType' class='form-label'>Service Type</label>";
echo "<input type='text' class='form-control' id='editServiceType' name='editServiceType' value='{$row['service_type']}'>";
echo "</div>";
echo "<button type='submit' class='btn btn-primary'>Save Changes</button>";
echo "</form>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";


                    // Delete Warehouse Booking Modal
                    echo "<div class='modal fade' id='deleteWarehouseBookingModal{$row['book_id']}' tabindex='-1' aria-labelledby='deleteWarehouseBookingModalLabel{$row['book_id']}' aria-hidden='true'>";
                    echo "<div class='modal-dialog'>";
                    echo "<div class='modal-content'>";
                    echo "<div class='modal-header'>";
                    echo "<h5 class='modal-title' id='deleteWarehouseBookingModalLabel{$row['book_id']}'>Delete Warehouse Booking</h5>";
                    echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                    echo "</div>";
                    echo "<div class='modal-body'>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='deleteWarehouseBookingId' value='{$row['book_id']}'>";
                    echo "<p>Are you sure you want to delete this booking?</p>";
                    echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>



<div id="doorPurchaseBookingsTable" class="container-fluid mt-5" style="display: none;">
    <div class="container-fluid mt-5">
        <h2>Doorstep Purchase Bookings</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>User ID</th>
                        <th>Grain Type</th>
                        <th>Total Grain Quintal</th>
                        <th>Created At</th>
                        <th>Mobile Number</th>
                        <th>Status</th>
                        <th>Service Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result_doorsteppurchase_booking)) {
                        // Determine the status class
                        $statusClass = '';
                        switch ($row['status']) {
                            case 'Booked':
                                $statusClass = 'status-booked';
                                break;
                            case 'In Progress':
                                $statusClass = 'status-in-progress';
                                break;
                            case 'Success':
                                $statusClass = 'status-success';
                                break;
                            default:
                                $statusClass = '';
                                break;
                        }
                    
                        echo "<tr>";
                        echo "<td>{$row['book_id']}</td>";
                        echo "<td>{$row['user_id']}</td>";
                        echo "<td>{$row['grain_type']}</td>";
                        echo "<td>{$row['totalgrain_quintal']}</td>";
                        echo "<td>{$row['created_at']}</td>";
                        echo "<td>{$row['mobile_no']}</td>";
                        echo "<td><span class='{$statusClass}'>{$row['status']}</span></td>";
                        echo "<td>{$row['service_type']}</td>";
                        echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editDoorstepBookingModal{$row['book_id']}'>Edit</button> <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteDoorstepBookingModal{$row['book_id']}'>Delete</button></td>";
                        echo "</tr>";
                    
                        // Edit Doorstep Purchase Booking Modal
echo "<div class='modal fade' id='editDoorstepBookingModal{$row['book_id']}' tabindex='-1' aria-labelledby='editDoorstepBookingModalLabel{$row['book_id']}' aria-hidden='true'>";
echo "<div class='modal-dialog'>";
echo "<div class='modal-content'>";
echo "<div class='modal-header'>";
echo "<h5 class='modal-title' id='editDoorstepBookingModalLabel{$row['book_id']}'>Edit Doorstep Purchase Booking</h5>";
echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
echo "</div>";
echo "<div class='modal-body'>";
echo "<form method='post'>";
echo "<input type='hidden' name='editDoorstepBookingId' value='{$row['book_id']}'>";
echo "<div class='mb-3'>";
echo "<label for='editUserId' class='form-label'>User ID</label>";
echo "<input type='text' class='form-control' id='editUserId' name='editUserId' value='{$row['user_id']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editGrainType' class='form-label'>Grain Type</label>";
echo "<input type='text' class='form-control' id='editGrainType' name='editGrainType' value='{$row['grain_type']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editTotalGrainQuintal' class='form-label'>Total Grain Quintal</label>";
echo "<input type='text' class='form-control' id='editTotalGrainQuintal' name='editTotalGrainQuintal' value='{$row['totalgrain_quintal']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editMobileNumber' class='form-label'>Mobile Number</label>";
echo "<input type='text' class='form-control' id='editMobileNumber' name='editMobileNumber' value='{$row['mobile_no']}'>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editStatus' class='form-label'>Status</label>";
echo "<select class='form-control' id='editStatus' name='editStatus'>";
echo "<option value='Booked' style='color: red;' " . ($row['status'] == 'Booked' ? 'selected' : '') . ">Booked</option>";
echo "<option value='In Progress' style='color: orange;' " . ($row['status'] == 'In Progress' ? 'selected' : '') . ">In Progress</option>";
echo "<option value='Success' style='color: green;' " . ($row['status'] == 'Success' ? 'selected' : '') . ">Success</option>";
echo "</select>";
echo "</div>";
echo "<div class='mb-3'>";
echo "<label for='editServiceType' class='form-label'>Service Type</label>";
echo "<input type='text' class='form-control' id='editServiceType' name='editServiceType' value='{$row['service_type']}'>";
echo "</div>";
echo "<button type='submit' class='btn btn-primary'>Save Changes</button>";
echo "</form>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";

                    
                        // Delete Doorstep Purchase Booking Modal
                        echo "<div class='modal fade' id='deleteDoorstepBookingModal{$row['book_id']}' tabindex='-1' aria-labelledby='deleteDoorstepBookingModalLabel{$row['book_id']}' aria-hidden='true'>";
                        echo "<div class='modal-dialog'>";
                        echo "<div class='modal-content'>";
                        echo "<div class='modal-header'>";
                        echo "<h5 class='modal-title' id='deleteDoorstepBookingModalLabel{$row['book_id']}'>Delete Doorstep Purchase Booking</h5>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                        echo "</div>";
                        echo "<div class='modal-body'>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='deleteDoorstepBookingId' value='{$row['book_id']}'>";
                        echo "<p>Are you sure you want to delete this booking?</p>";
                        echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
</div>

</div>


<script>
    function showUsersTable() {
    document.getElementById("usersTable").style.display = "block";
    document.getElementById("tractorBookingsTable").style.display = "none";
    document.getElementById("warehouseBookingsTable").style.display = "none";
    document.getElementById("doorPurchaseBookingsTable").style.display = "none";
}

function showTractorBookingsTable() {
    document.getElementById("usersTable").style.display = "none";
    document.getElementById("tractorBookingsTable").style.display = "block";
    document.getElementById("warehouseBookingsTable").style.display = "none";
    document.getElementById("doorPurchaseBookingsTable").style.display = "none";
}

function showWarehouseBookingsTable() {
    document.getElementById("usersTable").style.display = "none";
    document.getElementById("tractorBookingsTable").style.display = "none";
    document.getElementById("warehouseBookingsTable").style.display = "block";
    document.getElementById("doorPurchaseBookingsTable").style.display = "none";
}

function showDoorPurchaseBookingsTable() {
    document.getElementById("usersTable").style.display = "none";
    document.getElementById("tractorBookingsTable").style.display = "none";
    document.getElementById("warehouseBookingsTable").style.display = "none";
    document.getElementById("doorPurchaseBookingsTable").style.display = "block";
}

</script>

</body>
</html>
