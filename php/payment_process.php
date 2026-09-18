<?php

session_start();

require_once "db.php";


// ==========================================
// CHECK USER LOGIN
// ==========================================

if (!isset($_SESSION["user_id"])) {

    header("Location: ../index.php");
    exit();
}


// ==========================================
// ALLOW POST REQUEST ONLY
// ==========================================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header(
        "Location: ../pages/my-bookings.php"
    );

    exit();
}


// ==========================================
// GET DATA
// ==========================================

$userId =
    (int)$_SESSION["user_id"];

$bookingId =
    (int)($_POST["booking_id"] ?? 0);

$paymentMethod =
    trim(
        $_POST["payment_method"] ?? ""
    );


// ==========================================
// VALID PAYMENT METHODS
// ==========================================

$allowedMethods = [

    "Demo Card",
    "Bank Transfer",
    "Cash"

];


// ==========================================
// VALIDATE INPUT
// ==========================================

if (
    $bookingId < 1 ||
    !in_array(
        $paymentMethod,
        $allowedMethods,
        true
    )
) {

    $_SESSION["payment_error"] =
        "Payment not done. Invalid payment information.";

    header(
        "Location: ../pages/payment.php?booking_id=" .
        $bookingId
    );

    exit();
}


// ==========================================
// GET APPROVED BOOKING
// ==========================================

$stmt = $pdo->prepare(
    "SELECT *
     FROM bookings
     WHERE id = ?
     AND user_id = ?
     AND status = 'Approved'"
);

$stmt->execute([

    $bookingId,
    $userId

]);

$booking =
    $stmt->fetch(PDO::FETCH_ASSOC);


// ==========================================
// CHECK BOOKING
// ==========================================

if (!$booking) {

    $_SESSION["payment_error"] =
        "Payment not done. This booking is not available for payment.";

    header(
        "Location: ../pages/my-bookings.php"
    );

    exit();
}


// ==========================================
// DESTINATION PRICES
// ==========================================

$prices = [

    "Ella" => 25000,

    "Sigiriya" => 20000,

    "Kandy" => 22000,

    "Nuwara Eliya" => 28000,

    "Galle" => 24000,

    "Mirissa" => 30000

];


// ==========================================
// GET PRICE
// ==========================================

$pricePerPerson =
    $prices[$booking["destination"]] ?? 0;


if ($pricePerPerson <= 0) {

    $_SESSION["payment_error"] =
        "Payment not done. Destination price was not found.";

    header(
        "Location: ../pages/payment.php?booking_id=" .
        $bookingId
    );

    exit();
}


// ==========================================
// CALCULATE TOTAL
// ==========================================

$travellers =
    (int)$booking["travellers"];

$amount =
    $pricePerPerson *
    $travellers;


// ==========================================
// PROCESS PAYMENT
// ==========================================

try {

    $pdo->beginTransaction();


    // ======================================
    // CHECK DUPLICATE PAYMENT
    // ======================================

    $checkPayment =
        $pdo->prepare(
            "SELECT id
             FROM payments
             WHERE booking_id = ?
             AND payment_status = 'Paid'"
        );

    $checkPayment->execute([
        $bookingId
    ]);


    if ($checkPayment->fetch()) {

        $pdo->rollBack();


        $_SESSION["payment_error"] =
            "Payment has already been completed for this booking.";


        header(
            "Location: ../pages/my-bookings.php"
        );

        exit();
    }


    // ======================================
    // INSERT PAYMENT
    // ======================================

    $paymentStmt =
        $pdo->prepare(
            "INSERT INTO payments
            (
                booking_id,
                user_id,
                amount,
                payment_method,
                payment_status
            )
            VALUES
            (
                ?, ?, ?, ?, 'Paid'
            )"
        );


    $paymentStmt->execute([

        $bookingId,

        $userId,

        $amount,

        $paymentMethod

    ]);


    // ======================================
    // UPDATE BOOKING STATUS
    // ======================================

    $bookingStmt =
        $pdo->prepare(
            "UPDATE bookings
             SET status = 'Completed'
             WHERE id = ?
             AND user_id = ?
             AND status = 'Approved'"
        );


    $bookingStmt->execute([

        $bookingId,

        $userId

    ]);


    // ======================================
    // COMMIT DATABASE CHANGES
    // ======================================

    $pdo->commit();


    // ======================================
    // SUCCESS MESSAGE
    // ======================================

    $_SESSION["payment_success"] =
        "Payment done successfully.";


    header(
        "Location: ../pages/my-bookings.php"
    );

    exit();


} catch (Throwable $e) {


    // ======================================
    // ROLLBACK IF ERROR
    // ======================================

    if ($pdo->inTransaction()) {

        $pdo->rollBack();
    }


    // ======================================
    // ERROR MESSAGE
    // ======================================

    $_SESSION["payment_error"] =
        "Payment not done. Please try again.";


    header(
        "Location: ../pages/payment.php?booking_id=" .
        $bookingId
    );

    exit();
}

?>