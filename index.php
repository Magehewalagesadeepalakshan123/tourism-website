<?php

session_start();

require_once "php/db.php";

$message = "";
$messageColor = "red";


// ============================================
// REGISTRATION SUCCESS MESSAGE
// ============================================

if (
    isset($_GET["registered"]) &&
    $_GET["registered"] === "1"
) {

    $message =
        "Account created successfully. Please login.";

    $messageColor = "green";
}


// ============================================
// LOGIN PROCESS
// ============================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email =
        trim($_POST["email"] ?? "");

    $password =
        $_POST["password"] ?? "";


    // Empty fields
    if ($email === "" || $password === "") {

        $message =
            "Please enter your email and password.";

    }

    else {

        // Find user
        $stmt = $pdo->prepare(
    "SELECT id, full_name, email, password, role
     FROM users
     WHERE email = ?"
);

        $stmt->execute([$email]);

        $user =
            $stmt->fetch(PDO::FETCH_ASSOC);


        // Email not found
        if (!$user) {

            $message =
                "Email address was not found.";

        }

        // Check password
        elseif (
            !password_verify(
                $password,
                $user["password"]
            )
        ) {

            $message =
                "Incorrect password.";

        }

        // LOGIN SUCCESS
        else {

    $_SESSION["user_id"] =
        $user["id"];

    $_SESSION["user_name"] =
        $user["full_name"];

    $_SESSION["user_email"] =
        $user["email"];

    $_SESSION["user_role"] =
        $user["role"];


    // ADMIN LOGIN
    if ($user["role"] === "admin") {

        $_SESSION["login_success"] =
            "Admin login successful!";

        header(
            "Location: pages/admin-dashboard.php"
        );

        exit();
    }


    // NORMAL USER LOGIN
    $_SESSION["login_success"] =
        "Login successful!";

    header(
        "Location: pages/home.php"
    );

    exit();
}
    }
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

    <title>
        Travel Lanka | Login
    </title>

    <link
        rel="stylesheet"
        href="css/style.css"
    >

</head>


<body>


<div class="login-container">


    <!-- LEFT SIDE -->

    <div class="login-left">


        <div class="brand">

            <h2>
                Travel Lanka
            </h2>

        </div>


        <div class="welcome-text">

            <h1>

                Discover Your

                <span>
                    Next Adventure
                </span>

            </h1>


            <p>
                Explore beautiful destinations,
                unforgettable experiences and amazing
                adventures around Sri Lanka.
            </p>

        </div>


    </div>



    <!-- RIGHT SIDE -->

    <div class="login-right">


       <form
    class="login-card"
    method="POST"
    action="index.php"
>


            <h2>
                Welcome Back
            </h2>


            <p class="subtitle">
                Login to continue your journey
            </p>


            <!-- EMAIL -->

            <div class="input-group">

                <label>
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <!-- PASSWORD -->

            <div class="input-group">

                <label>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >

            </div>


            <!-- OPTIONS -->

            <div class="login-options">


                <label>

                    <input
                        type="checkbox"
                    >

                    Remember me

                </label>


                <a href="#">
                    Forgot Password?
                </a>


            </div>


            <!-- LOGIN BUTTON -->

            <button
                type="submit"
                class="login-btn"
            >

                Login

            </button>


            <!-- MESSAGE -->

            <?php if ($message !== "") { ?>

                <p
                    style="
                        color:
                        <?php echo $messageColor; ?>;

                        text-align: center;

                        margin-top: 15px;

                        font-weight: bold;
                    "
                >

                    <?php

                    echo htmlspecialchars(
                        $message
                    );

                    ?>

                </p>

            <?php } ?>


            <!-- REGISTER -->

            <div class="register">

                Don't have an account?

                <a href="pages/register.html">

                    Create Account

                </a>

            </div>


        </form>


    </div>


</div>


</body>

</html>