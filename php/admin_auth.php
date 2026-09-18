<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// NOT LOGGED IN

if (!isset($_SESSION["user_id"])) {

    header("Location: ../index.php");
    exit();
}


// LOGGED IN BUT NOT ADMIN

if (
    !isset($_SESSION["user_role"]) ||
    $_SESSION["user_role"] !== "admin"
) {

    header("Location: ../pages/home.php");
    exit();
}

?>