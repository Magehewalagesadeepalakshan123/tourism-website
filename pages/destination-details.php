<?php

require_once "../php/auth_check.php";

$destinationID = $_GET["destination"] ?? "";

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
        Travel Lanka | Destination Details
    </title>

    <link
        rel="stylesheet"
        href="../css/style.css"
    >

</head>

<body>


<!-- =========================
     NAVBAR
========================= -->

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


<!-- =========================
     DETAILS HERO
========================= -->

<section class="details-hero">

    <img
        id="destinationMainImage"
        src=""
        alt="Destination"
    >


    <div class="details-hero-overlay">

        <p id="destinationCategory">
            Destination
        </p>

        <h1 id="destinationTitle">
            Destination Name
        </h1>

        <span id="destinationLocation">
            Location
        </span>

    </div>

</section>


<!-- =========================
     DETAILS SECTION
========================= -->

<section class="details-section">

    <div class="details-main">


        <!-- LEFT SIDE -->

        <div class="details-left">

            <span class="details-small-title">
                Discover
            </span>


            <h2 id="destinationHeading">
                About Destination
            </h2>


            <p
                id="destinationDescription"
                class="details-description"
            >
            </p>


            <!-- INFORMATION BOXES -->

            <div class="destination-info-boxes">


                <!-- RATING -->

                <div class="info-box">

                    <span>
                        ⭐
                    </span>

                    <div>

                        <small>
                            Rating
                        </small>

                        <strong id="destinationRating">
                            4.8
                        </strong>

                    </div>

                </div>


                <!-- BEST TIME -->

                <div class="info-box">

                    <span>
                        📅
                    </span>

                    <div>

                        <small>
                            Best Time
                        </small>

                        <strong id="bestTime">
                            January
                        </strong>

                    </div>

                </div>


                <!-- PROVINCE -->

                <div class="info-box">

                    <span>
                        📍
                    </span>

                    <div>

                        <small>
                            Province
                        </small>

                        <strong id="province">
                            Sri Lanka
                        </strong>

                    </div>

                </div>

            </div>


            <!-- ATTRACTIONS -->

            <div class="attractions-section">

                <h2>
                    Top Attractions
                </h2>

                <div
                    class="attractions-list"
                    id="attractionsList"
                >
                </div>

            </div>

        </div>


        <!-- RIGHT SIDE -->

        <div class="booking-summary">

            <p class="booking-label">
                Starting From
            </p>


            <h2 id="destinationPrice">
                LKR 25,000
            </h2>


            <p>
                Per person
            </p>


            <hr>


            <div class="booking-summary-item">

                <span>
                    Destination
                </span>

                <strong id="bookingDestination">
                    Ella
                </strong>

            </div>


            <div class="booking-summary-item">

                <span>
                    Duration
                </span>

                <strong id="tourDuration">
                    3 Days
                </strong>

            </div>


            <div class="booking-summary-item">

                <span>
                    Rating
                </span>

                <strong id="bookingRating">
                    4.8 ⭐
                </strong>

            </div>


            <!-- BOOK NOW -->

           <a
    href="booking.php?destination=<?php
        echo urlencode($destinationID);
    ?>"
    class="book-now-btn"
>
    Book Now
</a>


            <!-- BACK -->

            <a
                href="destinations.php"
                class="back-destination"
            >
                ← Back to Destinations
            </a>

        </div>

    </div>

</section>


<!-- =========================
     FOOTER
========================= -->

<footer>

    <div class="copyright">

        © 2026 Travel Lanka.
        All Rights Reserved.

    </div>

</footer>


<script src="../js/destination-details.js?v=101"></script>


</body>

</html>