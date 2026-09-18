<?php

require_once "../php/auth_check.php";

$bookingMessage = "";

if (isset($_SESSION["booking_success"])) {

    $bookingMessage =
        $_SESSION["booking_success"];

    unset(
        $_SESSION["booking_success"]
    );
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Travel Lanka | Booking</title>

    <link
        rel="stylesheet"
        href="../css/style.css"
    >

</head>

<body>

<?php if ($bookingMessage !== ""): ?>

    <div
        class="booking-success-popup"
        id="bookingSuccessPopup"
    >

        <span>
            ✓
        </span>

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


    <div>

        <div>

    <a
        href="../php/logout.php"
        class="logout-btn"
    >
        Logout
    </a>

</div>


        <a
            href="../php/logout.php"
            class="logout-btn"
        >
            Logout
        </a>

    </div>

</nav>



<!-- =========================================
     BOOKING HEADER
========================================= -->

<section class="booking-header">

    <div>

        <p>
            Plan Your Journey
        </p>

        <h1>
            Book Your Trip
        </h1>

        <span>
            Complete the form below to reserve your
            Travel Lanka experience.
        </span>

    </div>

</section>



<!-- =========================================
     BOOKING SECTION
========================================= -->

<section class="booking-page">

    <div class="booking-layout">


        <!-- =====================================
             BOOKING FORM
        ====================================== -->

        <form
    class="booking-form"
    id="bookingForm"
    action="../php/booking_process.php"
    method="POST"
>

            <h2>
                Traveller Information
            </h2>

            <p class="booking-form-subtitle">

                Enter your details to continue
                with your booking.

            </p>



            <!-- FULL NAME -->

            <div class="booking-input-group">

                <label>
                    Full Name
                </label>

                <input
                    type="text"
                    id="customerName"
                    name="customer_name"
                    value="<?php
                        echo htmlspecialchars(
                            $_SESSION["user_name"]
                        );
                    ?>"
                    required
                >

            </div>



            <!-- EMAIL -->

            <div class="booking-input-group">

                <label>
                    Email Address
                </label>

                <input
                    type="email"
                    id="customerEmail"
                    name="customer_email"
                    value="<?php
                        echo htmlspecialchars(
                            $_SESSION["user_email"]
                        );
                    ?>"
                    required
                >

            </div>



            <!-- PHONE -->

            <div class="booking-input-group">

                <label>
                    Phone Number
                </label>

                <input
                    type="tel"
                    id="customerPhone"
                    name="customer_phone"
                    placeholder="+94 77 123 4567"
                    required
                >

            </div>



            <!-- DESTINATION -->

            <div class="booking-input-group">

                <label>
                    Destination
                </label>

                <input
                    type="text"
                    id="bookingDestinationInput"
                    name="destination"
                    readonly
                >

            </div>



            <!-- TRAVEL DATE -->

            <div class="booking-input-group">

                <label>
                    Travel Date
                </label>

                <input
                    type="date"
                    id="travelDate"
                    name="travel_date"
                    required
                >

            </div>



            <!-- NUMBER OF TRAVELLERS -->

            <div class="booking-input-group">

                <label>
                    Number of Travellers
                </label>

                <input
                    type="number"
                    id="travellers"
                    name="travellers"
                    min="1"
                    value="1"
                    required
                >

            </div>



            <!-- SPECIAL REQUESTS -->

            <div class="booking-input-group">

                <label>
                    Special Requests
                </label>

                <textarea
                    id="specialRequests"
                    name="special_requests"
                    rows="4"
                    placeholder="Optional requests..."
                ></textarea>

            </div>



            <!-- CONFIRM BUTTON -->

            <button
                type="submit"
                class="confirm-booking-btn"
            >
                Confirm Booking
            </button>


            <p id="bookingMessage"></p>

        </form>



        <!-- =====================================
             BOOKING SUMMARY
        ====================================== -->

        <div class="booking-price-card">

            <h2>
                Booking Summary
            </h2>


            <div class="booking-price-row">

                <span>
                    Destination
                </span>

                <strong id="summaryDestination">
                    -
                </strong>

            </div>


            <div class="booking-price-row">

                <span>
                    Price Per Person
                </span>

                <strong id="summaryPrice">
                    LKR 0
                </strong>

            </div>


            <div class="booking-price-row">

                <span>
                    Travellers
                </span>

                <strong id="summaryTravellers">
                    1
                </strong>

            </div>


            <hr>


            <div class="booking-total">

                <span>
                    Total
                </span>

                <strong id="totalPrice">
                    LKR 0
                </strong>

            </div>


            <a
                href="destinations.php"
                class="back-destination"
            >
                ← Back to Destinations
            </a>

        </div>

    </div>

</section>



<script src="../js/booking.js"></script>


<script>

const bookingPopup =
    document.getElementById(
        "bookingSuccessPopup"
    );

if (bookingPopup) {

    setTimeout(function () {

        bookingPopup.classList.add("hide");

        setTimeout(function () {

            bookingPopup.remove();

        }, 500);

    }, 3000);
}

</script>


</body>

</html>