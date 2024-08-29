<?php
session_start();

// Check if admin is not logged in
if (!isset($_SESSION['username'])) {
    header("location: adminlogin.php");
    exit;
}

include("db.php");

if(isset($_POST['editUserId'])) {
    $id = $_POST['editUserId'];
    $fullName = $_POST['editFullName'];
    $mobileNumber = $_POST['editMobileNumber'];
    $acre = $_POST['editAcre'];
    $village = $_POST['editVillage'];
    $taluka = $_POST['editTaluka'];
    $district = $_POST['editDistrict'];
    $state = $_POST['editState'];
    $pinCode = $_POST['editPinCode'];
    $userId = $_POST['editUserID'];
    $password = $_POST['editPassword'];


    // Update user details in the database
    $query = "UPDATE users SET full_name='$fullName', mobile_no='$mobileNumber', acre='$acre', village='$village', taluka='$taluka', district='$district', state='$state', pin_code='$pinCode', user_id='$userId', password='$password' WHERE id=$id";
    $result = mysqli_query($con, $query);

    if($result) {
        $_SESSION['message'] = "User details updated successfully";
        header("location: admin_dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = "Failed to update user details";
        header("location: admin_dashboard.php");
        exit;
    }
}
?>
