// ======================================================
// LOGIN FORM
// ======================================================

const loginForm =
    document.getElementById("loginForm");

const message =
    document.getElementById("message");


// ======================================================
// CHECK IF USER JUST REGISTERED
// ======================================================

const urlParameters =
    new URLSearchParams(
        window.location.search
    );


if (
    urlParameters.get("registered") === "1"
) {

    message.style.color = "green";

    message.innerText =
        "Account created successfully. Please login.";

}


// ======================================================
// LOGIN FORM SUBMIT
// ======================================================

loginForm.addEventListener(
    "submit",
    function(event) {

        event.preventDefault();


        const email =
            document
                .getElementById("email")
                .value
                .trim();


        const password =
            document
                .getElementById("password")
                .value;


        // Check empty fields

        if (
            email === "" ||
            password === ""
        ) {

            message.style.color =
                "red";

            message.innerText =
                "Please enter your email and password.";

            return;
        }


        // Temporary login success
        // We will replace this with PHP/MySQL login next

        message.style.color =
            "green";


        message.innerText =
            "Login successful!";


        setTimeout(
            function() {

                window.location.href =
                    "pages/home.php";

            },
            800
        );

    }
);