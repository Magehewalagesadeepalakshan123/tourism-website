<?php

require_once "../php/auth_check.php";
require_once "../php/db.php";

$userId =
    (int)$_SESSION["user_id"];

$bookingId =
    (int)($_GET["booking_id"] ?? 0);


if ($bookingId < 1) {

    header("Location: my-bookings.php");
    exit();
}


// GET APPROVED BOOKING BELONGING TO USER

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


if (!$booking) {

    header("Location: my-bookings.php");
    exit();
}


// DEMO PRICES

$prices = [

    "Ella" => 25000,
    "Sigiriya" => 20000,
    "Kandy" => 22000,
    "Nuwara Eliya" => 28000,
    "Galle" => 24000,
    "Mirissa" => 30000

];


$pricePerPerson =
    $prices[$booking["destination"]] ?? 0;


$total =
    $pricePerPerson *
    (int)$booking["travellers"];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Travel Lanka | Payment
    </title>

    <link
        rel="stylesheet"
        href="../css/style.css?v=300"
    >

</head>

<body>


<nav class="navbar">

    <div class="logo">
        Travel Lanka
    </div>

    <ul class="nav-links">

        <li>
            <a href="home.php">
                Home
            </a>
        </li>

        <li>
            <a href="destinations.php">
                Destinations
            </a>
        </li>

        <li>
            <a href="my-bookings.php">
                My Bookings
            </a>
        </li>

        <li>
            <a href="home.php#packages">
                Packages
            </a>
        </li>

        <li>
            <a href="home.php#about">
                About
            </a>
        </li>

        <li>
            <a href="home.php#contact">
                Contact
            </a>
        </li>

    </ul>

    <a
        href="../php/logout.php"
        class="logout-btn"
    >
        Logout
    </a>

</nav>


<section class="payment-section">

    <div class="payment-card">

        <h1>
            Complete Payment
        </h1>


        <div class="payment-summary">

            <p>
                <span>Booking ID</span>

                <strong>
                    #<?php echo $booking["id"]; ?>
                </strong>
            </p>


            <p>
                <span>Destination</span>

                <strong>
                    <?php
                    echo htmlspecialchars(
                        $booking["destination"]
                    );
                    ?>
                </strong>
            </p>


            <p>
                <span>Travellers</span>

                <strong>
                    <?php
                    echo $booking["travellers"];
                    ?>
                </strong>
            </p>


            <p>
                <span>Price Per Person</span>

                <strong>
                    LKR
                    <?php
                    echo number_format(
                        $pricePerPerson
                    );
                    ?>
                </strong>
            </p>


            <hr>


            <p class="payment-total">

                <span>
                    Total
                </span>

                <strong>
                    LKR
                    <?php
                    echo number_format(
                        $total
                    );
                    ?>
                </strong>

            </p>

        </div>


        <form
            action="../php/payment_process.php"
            method="POST"
        >

            <input
                type="hidden"
                name="booking_id"
                value="<?php echo $bookingId; ?>"
            >

            <input
                type="hidden"
                name="amount"
                value="<?php echo $total; ?>"
            >


            <label>
                Payment Method
            </label>

            <select
                name="payment_method"
                required
            >

                <option value="">
                    Select Payment Method
                </option>

                <option value="Demo Card">
                    Demo Card
                </option>

                <option value="Bank Transfer">
                    Bank Transfer
                </option>

                <option value="Cash">
                    Cash
                </option>

            </select>


            <button
                type="submit"
                class="pay-now-btn"
            >
                Confirm Demo Payment
            </button>

        </form>


        <p class="demo-payment-note">
            This is a demonstration payment
            for the project. Do not enter real
            bank or card information.
        </p>


        <a
            href="my-bookings.php"
            class="back-destination"
        >
            ← Back to My Bookings
        </a>

    </div>

</section>


</body>

</html>