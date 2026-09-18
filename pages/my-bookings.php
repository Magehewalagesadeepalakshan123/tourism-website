<?php

require_once "../php/auth_check.php";
require_once "../php/db.php";

$userId = $_SESSION["user_id"];

$stmt = $pdo->prepare(
    "SELECT *
     FROM bookings
     WHERE user_id = ?
     ORDER BY created_at DESC"
);

$stmt->execute([$userId]);

$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        Travel Lanka | My Bookings
    </title>

    <link
    rel="stylesheet"
    href="../css/style.css?v=50"
>

<style>

/* ===============================
   MY BOOKINGS
=============================== */

.my-bookings-section {
    background: #f4f8f7;
    padding: 60px 8%;
    min-height: 500px;
}

.my-bookings-container {
    max-width: 1150px;
    margin: 0 auto;
}


/* BOOKING CARD */

.my-booking-card {
    background: #ffffff;
    border-radius: 16px;

    padding: 28px 30px;
    margin-bottom: 25px;

    border-left: 5px solid #16967f;

    box-shadow:
        0 8px 25px
        rgba(0, 0, 0, 0.08);
}


/* TOP AREA */

.booking-card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;

    padding-bottom: 18px;
    margin-bottom: 20px;

    border-bottom: 1px solid #eeeeee;
}

.booking-small-title {
    display: block;

    font-size: 12px;
    color: #888;

    text-transform: uppercase;
    letter-spacing: 1px;

    margin-bottom: 5px;
}

.booking-card-top h2 {
    margin: 0;

    font-size: 27px;

    color: #153f3a;
}


/* STATUS */

.booking-status {
    background: #e3f7f1;
    color: #16846f;

    padding: 8px 18px;

    border-radius: 25px;

    font-size: 14px;
    font-weight: bold;
}


/* INFORMATION */

.booking-information {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 18px;

    margin-bottom: 20px;
}

.booking-information > div {
    background: #f7faf9;

    padding: 18px;

    border-radius: 10px;

    border: 1px solid #e5eeec;
}

.booking-information small {
    display: block;

    color: #888;

    font-size: 13px;

    margin-bottom: 7px;
}

.booking-information strong {
    display: block;

    color: #153f3a;

    font-size: 16px;
}


/* SPECIAL REQUEST */

.booking-request {
    background: #eef8f5;

    border-radius: 10px;

    padding: 16px 18px;

    margin-top: 15px;

    line-height: 1.5;

    color: #444;
}

.booking-request strong {
    color: #16846f;
}


/* BOOKING ID */

.booking-created {
    margin-top: 20px;

    padding-top: 15px;

    border-top: 1px solid #eeeeee;

    text-align: right;

    color: #888;

    font-size: 13px;
}


/* HOVER */

.my-booking-card {
    transition: 0.3s ease;
}

.my-booking-card:hover {
    transform: translateY(-3px);

    box-shadow:
        0 12px 32px
        rgba(0, 0, 0, 0.12);
}


/* MOBILE */

@media screen and (max-width: 750px) {

    .booking-information {
        grid-template-columns: 1fr;
    }

    .booking-card-top {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

}

</style>









</head>

<body>


<!-- NAVBAR -->

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


<!-- HEADER -->

<section class="booking-header">

    <div>

        <p>
            Travel Lanka
        </p>

        <h1>
            My Bookings
        </h1>

        <span>
            View your upcoming travel reservations.
        </span>

    </div>

</section>


<!-- BOOKINGS -->

<section class="my-bookings-section">

    <div class="my-bookings-container">

        <?php if (count($bookings) > 0): ?>


            <?php foreach ($bookings as $booking): ?>

                <div class="my-booking-card">


                    <div class="booking-card-top">

                        <div>

                            <span class="booking-small-title">
                                Destination
                            </span>

                            <h2>
                                <?php
                                echo htmlspecialchars(
                                    $booking["destination"]
                                );
                                ?>
                            </h2>

                        </div>


                        <span
    class="booking-status status-<?php
        echo strtolower(
            $booking["status"]
        );
    ?>"
>

    <?php
    echo htmlspecialchars(
        $booking["status"]
    );
    ?>

</span>

                    </div>


                    <div class="booking-information">


                        <div>

                            <small>
                                Travel Date
                            </small>

                            <strong>
                                <?php
                                echo htmlspecialchars(
                                    $booking["travel_date"]
                                );
                                ?>
                            </strong>

                        </div>


                        <div>

                            <small>
                                Travellers
                            </small>

                            <strong>
                                <?php
                                echo htmlspecialchars(
                                    $booking["travellers"]
                                );
                                ?>
                            </strong>

                        </div>


                        <div>

                            <small>
                                Phone
                            </small>

                            <strong>
                                <?php
                                echo htmlspecialchars(
                                    $booking["customer_phone"]
                                );
                                ?>
                            </strong>

                        </div>


                    </div>


                    <?php
                    if (
                        !empty(
                            $booking["special_requests"]
                        )
                    ):
                    ?>

                        <div class="booking-request">

                            <strong>
                                Special Request:
                            </strong>

                            <?php
                            echo htmlspecialchars(
                                $booking["special_requests"]
                            );
                            ?>

                        </div>

                    <?php endif; ?>


                    <div class="booking-created">

                        Booking ID:
                        #<?php
                        echo $booking["id"];
                        ?>

                    </div>


                </div>

            <?php endforeach; ?>


        <?php else: ?>


            <div class="no-bookings">

                <h2>
                    No bookings yet
                </h2>

                <p>
                    You have not made any travel
                    bookings yet.
                </p>

                <a
                    href="destinations.php"
                    class="view-details-btn"
                >
                    Explore Destinations
                </a>

            </div>


        <?php endif; ?>

    </div>

</section>


<footer>

    <div class="copyright">

        © 2026 Travel Lanka.
        All Rights Reserved.

    </div>

</footer>


</body>

</html>