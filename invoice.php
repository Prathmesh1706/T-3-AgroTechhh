<?php
// Include necessary files and start session
session_start();
include("db.php");
require_once('C:/xampp/htdocs/T-3 AgroTechhh/fpdf186/fpdf.php'); // Include FPDF library

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit;
}

// Get booking ID and type from the URL
$booking_id = $_GET['booking_id'];
$type = $_GET['type'];

// Fetch the booking details based on type and booking ID
if ($type == 'tractor') {
    $query = "SELECT * FROM tractor_booking WHERE book_id = '$booking_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // Fetch user details based on user_id
    $user_id = $row['user_id'];
    $user_query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $user_result = mysqli_query($con, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);

    // Create new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();

// Add a company logo
$pdf->Image('logo1.png', 10, 10, 40);

$pdf->SetFont('Arial', '', 10);

// Set position for the company name under the logo
$pdf->SetXY(10, 20);
$pdf->Cell(0, 5, 'T-3 AgroTech PVT LTD', 0, 1);

// Set position for the address
$pdf->SetXY(10, 25);
$pdf->Cell(0, 5, 'Fl No C-601, Lotus Laxmi-2, Pune, Haveli, Maharashtra, India, 412101', 0, 1);

// Set position for the contact information
$pdf->SetXY(10, 30);
$pdf->Cell(0, 5, 'Mobile Number: +91-9022334224, Email: t3agro@gmail.com', 0, 1);

// Set position for the subsequent lines to align with the left side
$pdf->SetXY(10, 40); // Set the position for the next content
$pdf->Ln(10); // Add some space




    // Add invoice details
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, 'Invoice Number: ' . $booking_id, 0, 1);
    $pdf->Cell(0, 5, 'Date: ' . $row['created_at'], 0, 1);
    $pdf->Cell(0, 5, 'Date of Booking: ' . $row['date'], 0, 1);
    $pdf->Ln(5);

    // Add customer details
    $pdf->Cell(0, 5, 'Bill To:', 0, 1);
    $pdf->Cell(0, 5, 'Customer Name: ' . $user_row['full_name'], 0, 1);
    $pdf->Cell(0, 5, 'Address: ' . $user_row['village'] . ', ' . $user_row['taluka'] . ', ' . $user_row['district'] . ', ' . $user_row['state'] . ', ' . $user_row['pin_code'], 0, 1);
    $pdf->Cell(0, 5, 'Mobile Number: ' . $row['mobile_no'], 0, 1);
    $pdf->Ln(5);

    // Add itemized list
    $pdf->Cell(70, 10, 'Description', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Number of Acres', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Total Price', 1, 1, 'C');

    $pdf->Cell(70, 10, 'Tractor Service Booking', 1, 0, 'L');
    $pdf->Cell(40, 10, $row['number_of_acres'], 1, 0, 'C');
    $pdf->Cell(50, 10, 'Rs. ' . $row['total_price'], 1, 1, 'R');

    $pdf->Cell(0, 10, 'Total Amount: Rs. ' . $row['total_price'], 0, 1, 'R');
    $pdf->Ln(5);

    // Add additional information
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->MultiCell(0, 5, 'Thank you for choosing us.', 0, 'C');
    $pdf->Ln(5);

    // Output the PDF as a file (force download)
    $pdf->Output('tractor_invoice.pdf', 'D');
} elseif($type == 'warehouse') {
    // Repeat similar logic as above for warehouse booking
} elseif($type == 'doorstep') {
    // Repeat similar logic as above for doorstep booking
}
?>
