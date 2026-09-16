const registerForm =
    document.getElementById("registerForm");

registerForm.addEventListener(
    "submit",
    function(event) {

        event.preventDefault();


        const fullName =
            document.getElementById("fullName").value.trim();

        const email =
            document.getElementById("registerEmail").value.trim();

        const password =
            document.getElementById("registerPassword").value;

        const confirmPassword =
            document.getElementById("confirmPassword").value;

        const message =
            document.getElementById("registerMessage");


        // Check empty fields

        if (
            fullName === "" ||
            email === "" ||
            password === "" ||
            confirmPassword === ""
        ) {

            message.style.color = "red";

            message.innerText =
                "Please complete all fields.";

            return;
        }


        // Password length check

        if (password.length < 6) {

            message.style.color = "red";

            message.innerText =
                "Password must contain at least 6 characters.";

            return;
        }


        // Password match check

        if (password !== confirmPassword) {

            message.style.color = "red";

            message.innerText =
                "Passwords do not match.";

            return;
        }


        // Successful registration

        message.style.color = "green";

        message.innerText =
            "Account created successfully!";


        // Redirect to login page after 1 second

        setTimeout(function() {

            window.location.href =
                "../index.html";

        }, 1000);

    }
);