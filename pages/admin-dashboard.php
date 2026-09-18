<?php

require_once "../php/admin_auth.php";
require_once "../php/db.php";


// TOTAL USERS

$userStmt = $pdo->query(
    "SELECT COUNT(*) FROM users
     WHERE role = 'user'"
);

$totalUsers =
    $userStmt->fetchColumn();


// TOTAL BOOKINGS

$bookingStmt = $pdo->query(
    "SELECT COUNT(*) FROM bookings"
);

$totalBookings =
    $bookingStmt->fetchColumn();


// PENDING BOOKINGS

$pendingStmt = $pdo->query(
    "SELECT COUNT(*) FROM bookings
     WHERE status = 'Pending'"
);

$pendingBookings =
    $pendingStmt->fetchColumn();


// APPROVED BOOKINGS

$approvedStmt = $pdo->query(
    "SELECT COUNT(*) FROM bookings
     WHERE status = 'Approved'"
);

$approvedBookings =
    $approvedStmt->fetchColumn();

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
        href="../css/style.css?v=200"
    >

</head>

<body>


<!-- ADMIN NAVBAR -->

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


<!-- DASHBOARD -->

<section class="admin-dashboard-section">

    <div class="admin-dashboard-container">


        <!-- USERS -->

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


        <!-- BOOKINGS -->

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

    </div>


    <!-- ADMIN ACTIONS -->

    <div class="admin-actions">

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

    </div>

</section>


</body>

</html>