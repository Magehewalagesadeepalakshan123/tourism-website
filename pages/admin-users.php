<?php

require_once "../php/admin_auth.php";
require_once "../php/db.php";


$stmt = $pdo->prepare(
    "SELECT id, full_name, email, role, created_at
     FROM users
     ORDER BY created_at DESC"
);

$stmt->execute();

$users =
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
        Travel Lanka | Users
    </title>

    <link
        rel="stylesheet"
        href="../css/style.css?v=200"
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

<section class="admin-users-section">

    <div class="admin-users-container">

        <h1>
            Registered Users
        </h1>


        <div class="admin-users-table-wrapper">

            <table class="admin-users-table">

                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Registered
                        </th>

                    </tr>

                </thead>


                <tbody>


                    <?php foreach ($users as $user): ?>

                        <tr>

                            <td>
                                <?php echo $user["id"]; ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $user["full_name"]
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $user["email"]
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $user["role"]
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $user["created_at"]
                                );
                                ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>


                </tbody>

            </table>

        </div>

    </div>

</section>


</body>

</html>