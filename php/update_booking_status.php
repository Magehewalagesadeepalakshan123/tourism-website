<?php

session_start();

require_once "db.php";


if (
    !isset($_SESSION["user_id"]) ||
    !isset($_SESSION["user_role"]) ||
    $_SESSION["user_role"] !== "admin"
) {

    header("Location: ../index.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header(
        "Location: ../pages/admin-bookings.php"
    );

    exit();
}


$bookingId =
    (int)($_POST["booking_id"] ?? 0);

$status =
    $_POST["status"] ?? "";


$allowedStatuses = [
    "Pending",
    "Approved",
    "Declined"
];


if (
    $bookingId < 1 ||
    !in_array(
        $status,
        $allowedStatuses,
        true
    )
) {

    die("Invalid booking status.");
}


$stmt = $pdo->prepare(
    "UPDATE bookings
     SET status = ?
     WHERE id = ?"
);


$stmt->execute([
    $status,
    $bookingId
]);


header(
    "Location: ../pages/admin-bookings.php?updated=1"
);

exit();

?>