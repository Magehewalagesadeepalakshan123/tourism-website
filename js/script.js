const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", function(event) {

    event.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    const message = document.getElementById("message");


    if (email === "" || password === "") {

        message.style.color = "red";

        message.innerText =
            "Please enter your email and password.";

        return;
    }


    message.style.color = "green";

    message.innerText =
        "Login form submitted successfully!";

});