<?php

require_once "../php/admin_auth.php";
require_once "../php/db.php";


// ==========================================
// GET ALL PAYMENTS
// ==========================================

$stmt = $pdo->prepare(
    "SELECT
        payments.id,
        payments.booking_id,
        payments.amount,
        payments.payment_method,
        payments.payment_status,
        payments.paid_at,

        bookings.destination,
        bookings.customer_name,
        bookings.customer_email,
        bookings.travellers

     FROM payments

     INNER JOIN bookings
     ON payments.booking_id = bookings.id

     ORDER BY payments.paid_at DESC"
);

$stmt->execute();

$payments =
    $stmt->fetchAll(PDO::FETCH_ASSOC);


// ==========================================
// TOTAL PAYMENT AMOUNT
// ==========================================

$totalStmt = $pdo->query(
    "SELECT COALESCE(SUM(amount), 0)
     FROM payments
     WHERE payment_status = 'Paid'"
);

$totalRevenue =
    $totalStmt->fetchColumn();

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
        Travel Lanka | Admin Payments
    </title>

    <link
        rel="stylesheet"
        href="../css/style.css?v=400"
    >

</head>

<body>


<!-- =========================================
     ADMIN NAVBAR
========================================= -->

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



<!-- =========================================
     HEADER
========================================= -->

<section class="booking-header">

    <div>

        <p>
            Administration
        </p>

        <h1>
            Payments
        </h1>

        <span>
            View customer payment information.
        </span>

    </div>

</section>



<!-- =========================================
     PAYMENTS SECTION
========================================= -->

<section class="admin-payments-section">

    <div class="admin-payments-container">


        <!-- TOTAL REVENUE -->

        <div class="payment-total-card">

            <small>
                Total Payments
            </small>

            <h2>

                LKR

                <?php
                echo number_format(
                    $totalRevenue,
                    2
                );
                ?>

            </h2>

        </div>


        <?php if (count($payments) > 0): ?>


            <div class="admin-payment-table-wrapper">

                <table class="admin-payment-table">


                    <thead>

                        <tr>

                            <th>
                                Payment ID
                            </th>

                            <th>
                                Booking
                            </th>

                            <th>
                                Customer
                            </th>

                            <th>
                                Destination
                            </th>

                            <th>
                                Travellers
                            </th>

                            <th>
                                Amount
                            </th>

                            <th>
                                Method
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Date
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php foreach ($payments as $payment): ?>

                            <tr>

                                <td>

                                    #<?php
                                    echo $payment["id"];
                                    ?>

                                </td>


                                <td>

                                    #<?php
                                    echo $payment["booking_id"];
                                    ?>

                                </td>


                                <td>

                                    <strong>

                                        <?php
                                        echo htmlspecialchars(
                                            $payment["customer_name"]
                                        );
                                        ?>

                                    </strong>

                                    <small>

                                        <?php
                                        echo htmlspecialchars(
                                            $payment["customer_email"]
                                        );
                                        ?>

                                    </small>

                                </td>


                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $payment["destination"]
                                    );
                                    ?>

                                </td>


                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $payment["travellers"]
                                    );
                                    ?>

                                </td>


                                <td>

                                    <strong>

                                        LKR
                                        <?php
                                        echo number_format(
                                            $payment["amount"],
                                            2
                                        );
                                        ?>

                                    </strong>

                                </td>


                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $payment["payment_method"]
                                    );
                                    ?>

                                </td>


                                <td>

                                    <span class="admin-paid-status">

                                        <?php
                                        echo htmlspecialchars(
                                            $payment["payment_status"]
                                        );
                                        ?>

                                    </span>

                                </td>


                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $payment["paid_at"]
                                    );
                                    ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>


                    </tbody>

                </table>

            </div>


        <?php else: ?>


            <div class="no-payments">

                <h2>
                    No payments yet
                </h2>

                <p>
                    Customer payments will appear here
                    after bookings are completed.
                </p>

            </div>


        <?php endif; ?>


    </div>

</section>


</body>

</html>