const destinationPrices = {

    ella: {
        name: "Ella",
        price: 25000
    },

    sigiriya: {
        name: "Sigiriya",
        price: 20000
    },

    kandy: {
        name: "Kandy",
        price: 22000
    },

    "nuwara-eliya": {
        name: "Nuwara Eliya",
        price: 28000
    },

    galle: {
        name: "Galle",
        price: 24000
    },

    mirissa: {
        name: "Mirissa",
        price: 30000
    }

};


/* GET DESTINATION FROM URL */

const urlParameters =
    new URLSearchParams(
        window.location.search
    );

const destinationID =
    urlParameters.get("destination");


const destination =
    destinationPrices[destinationID];


const destinationInput =
    document.getElementById(
        "bookingDestinationInput"
    );

const summaryDestination =
    document.getElementById(
        "summaryDestination"
    );

const summaryPrice =
    document.getElementById(
        "summaryPrice"
    );

const summaryTravellers =
    document.getElementById(
        "summaryTravellers"
    );

const travellersInput =
    document.getElementById(
        "travellers"
    );

const totalPrice =
    document.getElementById(
        "totalPrice"
    );


/* DISPLAY DESTINATION */

if (destination) {

    destinationInput.value =
        destination.name;

    summaryDestination.innerText =
        destination.name;

    summaryPrice.innerText =
        "LKR " +
        destination.price.toLocaleString();

}


/* CALCULATE TOTAL */

function calculateTotal() {

    if (!destination) {
        return;
    }


    const travellers =
        parseInt(
            travellersInput.value
        ) || 1;


    const total =
        destination.price *
        travellers;


    summaryTravellers.innerText =
        travellers;


    totalPrice.innerText =
        "LKR " +
        total.toLocaleString();

}


/* RUN INITIAL CALCULATION */

calculateTotal();


/* UPDATE TOTAL */

travellersInput.addEventListener(
    "input",
    calculateTotal
);


/* BOOKING FORM */

const bookingForm =
    document.getElementById(
        "bookingForm"
    );


bookingForm.addEventListener(
    "submit",
    function(event) {

        event.preventDefault();


        const name =
            document
                .getElementById(
                    "customerName"
                )
                .value
                .trim();


        const email =
            document
                .getElementById(
                    "customerEmail"
                )
                .value
                .trim();


        const phone =
            document
                .getElementById(
                    "customerPhone"
                )
                .value
                .trim();


        const date =
            document
                .getElementById(
                    "travelDate"
                )
                .value;


        const message =
            document.getElementById(
                "bookingMessage"
            );


        if (
            name === "" ||
            email === "" ||
            phone === "" ||
            date === ""
        ) {

            message.style.color =
                "red";

            message.innerText =
                "Please complete all required fields.";

            return;
        }


        message.style.color =
            "green";


        message.innerText =
            "Booking confirmed successfully!";

    }
);


const travelDate =
    document.getElementById(
        "travelDate"
    );


const today =
    new Date()
        .toISOString()
        .split("T")[0];


travelDate.setAttribute(
    "min",
    today
);