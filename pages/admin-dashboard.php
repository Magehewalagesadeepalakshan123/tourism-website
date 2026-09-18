<?php

require_once "../php/admin_auth.php";
require_once "../php/db.php";


// ==========================================
// TOTAL USERS
// ==========================================

$userStmt = $pdo->query(
    "SELECT COUNT(*)
     FROM users
     WHERE role = 'user'"
);

$totalUsers =
    $userStmt->fetchColumn();


// ==========================================
// TOTAL BOOKINGS
// ==========================================

$bookingStmt = $pdo->query(
    "SELECT COUNT(*)
     FROM bookings"
);

$totalBookings =
    $bookingStmt->fetchColumn();


// ==========================================
// PENDING BOOKINGS
// ==========================================

$pendingStmt = $pdo->query(
    "SELECT COUNT(*)
     FROM bookings
     WHERE status = 'Pending'"
);

$pendingBookings =
    $pendingStmt->fetchColumn();


// ==========================================
// APPROVED BOOKINGS
// ==========================================

$approvedStmt = $pdo->query(
    "SELECT COUNT(*)
     FROM bookings
     WHERE status = 'Approved'"
);

$approvedBookings =
    $approvedStmt->fetchColumn();


// ==========================================
// COMPLETED BOOKINGS
// ==========================================

$completedStmt = $pdo->query(
    "SELECT COUNT(*)
     FROM bookings
     WHERE status = 'Completed'"
);

$completedBookings =
    $completedStmt->fetchColumn();


// ==========================================
// DECLINED BOOKINGS
// ==========================================

$declinedStmt = $pdo->query(
    "SELECT COUNT(*)
     FROM bookings
     WHERE status = 'Declined'"
);

$declinedBookings =
    $declinedStmt->fetchColumn();


// ==========================================
// CANCELLED BOOKINGS
// ==========================================

$cancelledStmt = $pdo->query(
    "SELECT COUNT(*)
     FROM bookings
     WHERE status = 'Cancelled'"
);

$cancelledBookings =
    $cancelledStmt->fetchColumn();


// ==========================================
// TOTAL REVENUE
// ==========================================

$revenueStmt = $pdo->query(
    "SELECT COALESCE(SUM(amount), 0)
     FROM payments
     WHERE payment_status = 'Paid'"
);

$totalRevenue =
    $revenueStmt->fetchColumn();

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
        Travel Lanka | Admin Dashboard
    </title>

    <link
        rel="stylesheet"
        href="../css/style.css?v=300"
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
            Admin Dashboard
        </h1>

        <span>
            Manage Travel Lanka website activities.
        </span>

    </div>

</section>



<!-- =========================================
     DASHBOARD STATISTICS
========================================= -->

<section class="admin-dashboard-section">

    <div class="admin-dashboard-container">


        <!-- REGISTERED USERS -->

        <div class="admin-stat-card">

            <span>
                👥
            </span>

            <div>

                <small>
                    Registered Users
                </small>

                <h2>
                    <?php echo $totalUsers; ?>
                </h2>

            </div>

        </div>



        <!-- TOTAL BOOKINGS -->

        <div class="admin-stat-card">

            <span>
                📋
            </span>

            <div>

                <small>
                    Total Bookings
                </small>

                <h2>
                    <?php echo $totalBookings; ?>
                </h2>

            </div>

        </div>



        <!-- PENDING -->

        <div class="admin-stat-card">

            <span>
                ⏳
            </span>

            <div>

                <small>
                    Pending Bookings
                </small>

                <h2>
                    <?php echo $pendingBookings; ?>
                </h2>

            </div>

        </div>



        <!-- APPROVED -->

        <div class="admin-stat-card">

            <span>
                ✓
            </span>

            <div>

                <small>
                    Approved Bookings
                </small>

                <h2>
                    <?php echo $approvedBookings; ?>
                </h2>

            </div>

        </div>



        <!-- COMPLETED -->

        <div class="admin-stat-card">

            <span>
                ✅
            </span>

            <div>

                <small>
                    Completed Bookings
                </small>

                <h2>
                    <?php echo $completedBookings; ?>
                </h2>

            </div>

        </div>



        <!-- DECLINED -->

        <div class="admin-stat-card">

            <span>
                ❌
            </span>

            <div>

                <small>
                    Declined Bookings
                </small>

                <h2>
                    <?php echo $declinedBookings; ?>
                </h2>

            </div>

        </div>



        <!-- CANCELLED -->

        <div class="admin-stat-card">

            <span>
                🚫
            </span>

            <div>

                <small>
                    Cancelled Bookings
                </small>

                <h2>
                    <?php echo $cancelledBookings; ?>
                </h2>

            </div>

        </div>



        <!-- TOTAL REVENUE -->

        <div class="admin-stat-card">

            <span>
                💰
            </span>

            <div>

                <small>
                    Total Revenue
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

        </div>


    </div>



    <!-- =====================================
         ADMIN ACTIONS
    ====================================== -->

    <div class="admin-actions">


        <!-- MANAGE BOOKINGS -->

        <a
            href="admin-bookings.php"
            class="admin-action-card"
        >

            <h3>
                Manage Bookings
            </h3>

            <p>
                Approve or decline customer bookings.
            </p>

        </a>



        <!-- MANAGE USERS -->

        <a
            href="admin-users.php"
            class="admin-action-card"
        >

            <h3>
                Manage Users
            </h3>

            <p>
                View registered customer accounts.
            </p>

        </a>



        <!-- VIEW PAYMENTS -->

        <a
            href="admin-payments.php"
            class="admin-action-card"
        >

            <h3>
                View Payments
            </h3>

            <p>
                View customer payments and completed transactions.
            </p>

        </a>


    </div>

</section>


</body>

</html>