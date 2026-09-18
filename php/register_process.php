<?php

require_once "db.php";


// Allow only POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../pages/register.html");
    exit();

}


// Get form values
$fullName =
    trim($_POST["full_name"] ?? "");

$email =
    trim($_POST["email"] ?? "");

$password =
    $_POST["password"] ?? "";

$confirmPassword =
    $_POST["confirm_password"] ?? "";


// Check empty fields
if (
    empty($fullName) ||
    empty($email) ||
    empty($password) ||
    empty($confirmPassword)
) {

    die("Please complete all fields.");

}


// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    die("Please enter a valid email address.");

}


// Check password length
if (strlen($password) < 6) {

    die("Password must contain at least 6 characters.");

}


// Check passwords match
if ($password !== $confirmPassword) {

    die("Passwords do not match.");

}


// Check whether email already exists
$checkUser = $pdo->prepare(
    "SELECT id FROM users WHERE email = ?"
);

$checkUser->execute([$email]);


if ($checkUser->fetch()) {

    die("An account with this email already exists.");

}


// Hash password securely
$hashedPassword =
    password_hash(
        $password,
        PASSWORD_DEFAULT
    );


// Insert user into database
$insertUser = $pdo->prepare(

    "INSERT INTO users
        (full_name, email, password)
     VALUES
        (?, ?, ?)"

);


$insertUser->execute([

    $fullName,
    $email,
    $hashedPassword

]);


// Redirect back to login page
header(
    "Location: ../index.php?registered=1"
);

exit();

?>