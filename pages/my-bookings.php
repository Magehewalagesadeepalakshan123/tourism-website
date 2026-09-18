<?php

require_once "../php/auth_check.php";
require_once "../php/db.php";


// ============================================
// CURRENT USER
// ============================================

$userId = $_SESSION["user_id"];


// ============================================
// POPUP MESSAGE
// ============================================

$bookingMessage = "";

if (isset($_SESSION["booking_message"])) {

    $bookingMessage =
        $_SESSION["booking_message"];

    unset($_SESSION["booking_message"]);
}


// ============================================
// GET USER BOOKINGS
// ============================================

$stmt = $pdo->prepare(
    "SELECT *
     FROM bookings
     WHERE user_id = ?
     ORDER BY created_at DESC"
);

$stmt->execute([$userId]);

$bookings =
    $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        href="../css/style.css?v=100"
    >


    <style>

        /* =====================================
           MY BOOKINGS
        ===================================== */

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

            transition: 0.3s ease;
        }

        .my-booking-card:hover {
            transform: translateY(-3px);

            box-shadow:
                0 12px 32px
                rgba(0, 0, 0, 0.12);
        }


        /* TOP */

        .booking-card-top {
            display: flex;

            justify-content: space-between;

            align-items: center;

            padding-bottom: 18px;

            margin-bottom: 20px;

            border-bottom:
                1px solid #eeeeee;
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
            padding: 8px 18px;

            border-radius: 25px;

            font-size: 14px;

            font-weight: bold;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .status-declined {
            background: #f8d7da;
            color: #721c24;
        }

        .status-cancelled {
            background: #eeeeee;
            color: #666666;
        }

        .status-completed {
            background: #d1ecf1;
            color: #0c5460;
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

            border:
                1px solid #e5eeec;
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


        /* CANCEL BUTTON */

        .cancel-booking-form {
            margin-top: 20px;
        }

        .cancel-booking-btn {
            background: #e63446;

            color: white;

            border: none;

            padding: 12px 24px;

            border-radius: 8px;

            font-weight: 600;

            cursor: pointer;
        }

        .cancel-booking-btn:hover {
            background: #bd2635;
        }

        .booking-cancelled-text {
            margin-top: 20px;

            color: #dc3545;

            font-weight: 600;
        }


        /* PAYMENT */

        .payment-btn {
            display: inline-block;

            margin-top: 20px;

            padding: 12px 24px;

            background: #16967f;

            color: white;

            text-decoration: none;

            border-radius: 8px;

            font-weight: 600;
        }

        .payment-btn:hover {
            background: #11725f;
        }

        .payment-completed-text {
            margin-top: 20px;

            color: #16846f;

            font-weight: 700;
        }


        /* BOOKING ID */

        .booking-created {
            margin-top: 20px;

            padding-top: 15px;

            border-top:
                1px solid #eeeeee;

            text-align: right;

            color: #888;

            font-size: 13px;
        }


        /* POPUP */

        .booking-message-popup {
            position: fixed;

            top: 90px;

            right: 30px;

            background: #16967f;

            color: white;

            padding: 15px 22px;

            border-radius: 10px;

            z-index: 9999;

            box-shadow:
                0 6px 20px
                rgba(0, 0, 0, 0.2);

            transition: 0.5s;
        }

        .booking-message-popup.hide {
            opacity: 0;

            transform:
                translateX(50px);
        }


        /* NO BOOKINGS */

        .no-bookings {
            background: white;

            padding: 60px 40px;

            text-align: center;

            border-radius: 16px;

            box-shadow:
                0 8px 25px
                rgba(0, 0, 0, 0.08);
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


<!-- =========================================
     MESSAGE POPUP
========================================= -->

<?php if ($bookingMessage !== ""): ?>

    <div
        class="booking-message-popup"
        id="bookingMessagePopup"
    >

        ✓

        <?php
        echo htmlspecialchars(
            $bookingMessage
        );
        ?>

    </div>

<?php endif; ?>



<!-- =========================================
     NAVBAR
========================================= -->

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


<!-- =========================================
     HEADER
========================================= -->

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



<!-- =========================================
     BOOKINGS
========================================= -->

<section class="my-bookings-section">

    <div class="my-bookings-container">


        <?php if (count($bookings) > 0): ?>


            <?php foreach ($bookings as $booking): ?>


                <div class="my-booking-card">


                    <!-- =========================
                         CARD TOP
                    ========================== -->

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



                    <!-- =========================
                         INFORMATION
                    ========================== -->

                    <div class="booking-information">


                        <!-- DATE -->

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


                        <!-- TRAVELLERS -->

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


                        <!-- PHONE -->

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



                    <!-- =========================
                         SPECIAL REQUEST
                    ========================== -->

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



                    <!-- =========================
                         CANCEL BOOKING
                    ========================== -->

                    <?php if ($booking["status"] === "Pending"): ?>

                        <form
                            action="../php/cancel_booking.php"
                            method="POST"
                            class="cancel-booking-form"
                            onsubmit="
                                return confirm(
                                    'Are you sure you want to cancel this booking?'
                                );
                            "
                        >

                            <input
                                type="hidden"
                                name="booking_id"
                                value="<?php
                                    echo $booking["id"];
                                ?>"
                            >

                            <button
                                type="submit"
                                class="cancel-booking-btn"
                            >
                                Cancel Booking
                            </button>

                        </form>


                    <?php elseif ($booking["status"] === "Cancelled"): ?>

                        <p class="booking-cancelled-text">
                            This booking has been cancelled.
                        </p>

                    <?php endif; ?>



                    <!-- =========================
                         PAYMENT
                    ========================== -->

                    <?php if ($booking["status"] === "Approved"): ?>

                        <a
                            href="payment.php?booking_id=<?php
                                echo $booking["id"];
                            ?>"
                            class="payment-btn"
                        >
                            Proceed to Payment
                        </a>


                    <?php elseif ($booking["status"] === "Completed"): ?>

                        <p class="payment-completed-text">
                            ✓ Payment Completed
                        </p>

                    <?php endif; ?>



                    <!-- =========================
                         BOOKING ID
                    ========================== -->

                    <div class="booking-created">

                        Booking ID:

                        #<?php
                        echo $booking["id"];
                        ?>

                    </div>


                </div>


            <?php endforeach; ?>


        <?php else: ?>


            <!-- NO BOOKINGS -->

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



<!-- =========================================
     FOOTER
========================================= -->

<footer>

    <div class="copyright">

        © 2026 Travel Lanka.
        All Rights Reserved.

    </div>

</footer>



<!-- =========================================
     POPUP JAVASCRIPT
========================================= -->

<script>

const bookingMessagePopup =
    document.getElementById(
        "bookingMessagePopup"
    );


if (bookingMessagePopup) {

    setTimeout(function () {

        bookingMessagePopup.classList.add(
            "hide"
        );


        setTimeout(function () {

            bookingMessagePopup.remove();

        }, 500);


    }, 3000);

}

</script>


</body>

</html>