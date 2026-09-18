<?php

session_start();

require_once "db.php";


// =========================================
// CHECK LOGIN
// =========================================

if (!isset($_SESSION["user_id"])) {

    header("Location: ../index.php");
    exit();
}


// =========================================
// ONLY ALLOW POST REQUEST
// =========================================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../pages/booking.php");
    exit();
}


// =========================================
// GET FORM DATA
// =========================================

$userId = $_SESSION["user_id"];

$customerName =
    trim($_POST["customer_name"] ?? "");

$customerEmail =
    trim($_POST["customer_email"] ?? "");

$customerPhone =
    trim($_POST["customer_phone"] ?? "");

$destination =
    trim($_POST["destination"] ?? "");

$travelDate =
    $_POST["travel_date"] ?? "";

$travellers =
    (int)($_POST["travellers"] ?? 0);

$specialRequests =
    trim($_POST["special_requests"] ?? "");


// =========================================
// VALIDATION
// =========================================

if (
    $customerName === "" ||
    $customerEmail === "" ||
    $customerPhone === "" ||
    $destination === "" ||
    $travelDate === "" ||
    $travellers < 1
) {

    die("Please complete all required booking fields.");
}


// EMAIL VALIDATION

if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {

    die("Invalid email address.");
}


// =========================================
// PREVENT PAST DATE BOOKING
// =========================================

$today = date("Y-m-d");

if ($travelDate < $today) {

    die("Travel date cannot be in the past.");
}


// =========================================
// SAVE BOOKING
// =========================================

try {

    $stmt = $pdo->prepare(
        "INSERT INTO bookings
        (
            user_id,
            customer_name,
            customer_email,
            customer_phone,
            destination,
            travel_date,
            travellers,
            special_requests
        )
        VALUES
        (
            ?, ?, ?, ?, ?, ?, ?, ?
        )"
    );


    $stmt->execute([
        $userId,
        $customerName,
        $customerEmail,
        $customerPhone,
        $destination,
        $travelDate,
        $travellers,
        $specialRequests
    ]);


    // =====================================
    // SAVE SUCCESS MESSAGE
    // =====================================

    $_SESSION["booking_success"] =
        "Your booking has been confirmed successfully!";


    // =====================================
    // RETURN TO BOOKING PAGE
    // =====================================

    header(
        "Location: ../pages/booking.php?success=1"
    );

    exit();


} catch (PDOException $e) {

    die(
        "Booking failed: " .
        $e->getMessage()
    );
}

?>