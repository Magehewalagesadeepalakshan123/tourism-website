<?php

require_once "../php/admin_auth.php";
require_once "../php/db.php";

$stmt = $pdo->prepare(
    "SELECT bookings.*, users.full_name AS user_name
     FROM bookings
     INNER JOIN users
     ON bookings.user_id = users.id
     ORDER BY bookings.created_at DESC"
);

$stmt->execute();

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
        Travel Lanka | Manage Bookings
    </title>

    <link
        rel="stylesheet"
        href="../css/style.css?v=100"
    >

</head>

<body>


<nav class="navbar">

    <div class="logo">
        Travel Lanka Admin
    </div>

    <ul class="nav-links">

        <li>
            <a href="admin-dashboard.php">
                Dashboard
            </a>
        </li>

        <li>
            <a href="admin-bookings.php">
                Bookings
            </a>
        </li>

        <li>
            <a href="admin-users.php">
                Users
            </a>
        </li>

        <li>
            <a href="admin-payments.php">
                Payments
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

<section class="booking-header">

    <div>

        <p>
            Administration
        </p>

        <h1>
            Manage Bookings
        </h1>

        <span>
            Approve or decline customer bookings.
        </span>

    </div>

</section>


<section class="admin-bookings-section">

    <div class="admin-bookings-container">


        <?php foreach ($bookings as $booking): ?>


            <div class="admin-booking-card">


                <div class="admin-booking-top">

                    <div>

                        <small>
                            Booking ID
                        </small>

                        <h2>
                            #<?php echo $booking["id"]; ?>
                        </h2>

                    </div>


                    <span
                        class="status-badge status-<?php
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


                <div class="admin-booking-info">

                    <div>

                        <small>
                            Customer
                        </small>

                        <strong>
                            <?php
                            echo htmlspecialchars(
                                $booking["customer_name"]
                            );
                            ?>
                        </strong>

                    </div>


                    <div>

                        <small>
                            Destination
                        </small>

                        <strong>
                            <?php
                            echo htmlspecialchars(
                                $booking["destination"]
                            );
                            ?>
                        </strong>

                    </div>


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

                </div>


                <form
                    action="../php/update_booking_status.php"
                    method="POST"
                    class="status-form"
                >

                    <input
                        type="hidden"
                        name="booking_id"
                        value="<?php
                            echo $booking["id"];
                        ?>"
                    >


                    <label>
                        Booking Status
                    </label>


                    <select
                        name="status"
                        required
                    >

                        <option
                            value="Pending"
                            <?php
                            if (
                                $booking["status"] === "Pending"
                            ) {
                                echo "selected";
                            }
                            ?>
                        >
                            Pending
                        </option>


                        <option
                            value="Approved"
                            <?php
                            if (
                                $booking["status"] === "Approved"
                            ) {
                                echo "selected";
                            }
                            ?>
                        >
                            Approved
                        </option>


                        <option
                            value="Declined"
                            <?php
                            if (
                                $booking["status"] === "Declined"
                            ) {
                                echo "selected";
                            }
                            ?>
                        >
                            Declined
                        </option>

                    </select>


                    <button
                        type="submit"
                        class="update-status-btn"
                    >
                        Update Status
                    </button>

                </form>


            </div>


        <?php endforeach; ?>


    </div>

</section>


</body>

</html>