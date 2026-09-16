const loginForm =
    document.getElementById("loginForm");


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


        const message =
            document
                .getElementById("message");


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


        message.style.color =
            "green";


        message.innerText =
            "Login successful!";


        setTimeout(function() {

            window.location.href =
                "pages/home.html";

        }, 800);

    }
);