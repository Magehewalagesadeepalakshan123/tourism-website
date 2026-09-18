<?php

session_start();

require_once "db.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../index.php");
    exit();
}


$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";


// Empty fields

if ($email === "" || $password === "") {

    header(
        "Location: ../index.php?login_error=empty"
    );

    exit();
}


// Find account

$stmt = $pdo->prepare(
    "SELECT id, full_name, email, password
     FROM users
     WHERE email = ?"
);

$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);


// Email does not exist

if (!$user) {

    header(
        "Location: ../index.php?login_error=email"
    );

    exit();
}


// Check password

if (
    !password_verify(
        $password,
        $user["password"]
    )
) {

    header(
        "Location: ../index.php?login_error=password"
    );

    exit();
}


// LOGIN SUCCESS

$_SESSION["user_id"] =
    $user["id"];

$_SESSION["user_name"] =
    $user["full_name"];

$_SESSION["user_email"] =
    $user["email"];


// GO TO HOME PAGE

header(
    "Location: ../pages/home.php"
);

exit();

?>