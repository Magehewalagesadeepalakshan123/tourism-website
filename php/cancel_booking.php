<?php

session_start();

require_once "db.php";


// CHECK LOGIN
if (!isset($_SESSION["user_id"])) {

    header("Location: ../index.php");
    exit();
}


// ONLY ACCEPT POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../pages/my-bookings.php");
    exit();
}


// GET DATA
$bookingId =
    (int)($_POST["booking_id"] ?? 0);

$userId =
    (int)$_SESSION["user_id"];


if ($bookingId < 1) {

    header("Location: ../pages/my-bookings.php");
    exit();
}


// CANCEL ONLY THIS USER'S PENDING BOOKING
$stmt = $pdo->prepare(
    "UPDATE bookings
     SET status = 'Cancelled'
     WHERE id = ?
     AND user_id = ?
     AND status = 'Pending'"
);

$stmt->execute([
    $bookingId,
    $userId
]);


if ($stmt->rowCount() > 0) {

    $_SESSION["booking_message"] =
        "Booking cancelled successfully.";

} else {

    $_SESSION["booking_message"] =
        "Booking could not be cancelled.";
}


header(
    "Location: ../pages/my-bookings.php"
);

exit();

?>