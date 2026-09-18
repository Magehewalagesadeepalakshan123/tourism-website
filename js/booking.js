// ============================================
// DESTINATION PRICES
// ============================================

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


// ============================================
// GET DESTINATION FROM URL
// Example:
// booking.php?destination=ella
// ============================================

const urlParameters =
    new URLSearchParams(
        window.location.search
    );


const destinationID =
    urlParameters.get("destination");


const destination =
    destinationPrices[destinationID];



// ============================================
// GET PAGE ELEMENTS
// ============================================

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


const travelDate =
    document.getElementById(
        "travelDate"
    );


const bookingForm =
    document.getElementById(
        "bookingForm"
    );


const bookingMessage =
    document.getElementById(
        "bookingMessage"
    );



// ============================================
// DISPLAY DESTINATION INFORMATION
// ============================================

if (destination) {

    destinationInput.value =
        destination.name;


    summaryDestination.innerText =
        destination.name;


    summaryPrice.innerText =
        "LKR " +
        destination.price.toLocaleString();

}
else {

    destinationInput.value = "";

    summaryDestination.innerText =
        "Destination not selected";

    summaryPrice.innerText =
        "LKR 0";

}



// ============================================
// CALCULATE TOTAL PRICE
// ============================================

function calculateTotal() {

    if (!destination) {

        totalPrice.innerText =
            "LKR 0";

        return;
    }


    let travellers =
        parseInt(
            travellersInput.value
        );


    if (
        isNaN(travellers) ||
        travellers < 1
    ) {

        travellers = 1;
    }


    const total =
        destination.price *
        travellers;


    summaryTravellers.innerText =
        travellers;


    totalPrice.innerText =
        "LKR " +
        total.toLocaleString();

}



// ============================================
// INITIAL TOTAL
// ============================================

calculateTotal();



// ============================================
// UPDATE TOTAL WHEN TRAVELLERS CHANGE
// ============================================

travellersInput.addEventListener(
    "input",
    calculateTotal
);



// ============================================
// PREVENT PAST TRAVEL DATES
// ============================================

const currentDate =
    new Date();


const year =
    currentDate.getFullYear();


const month =
    String(
        currentDate.getMonth() + 1
    ).padStart(2, "0");


const day =
    String(
        currentDate.getDate()
    ).padStart(2, "0");


const today =
    `${year}-${month}-${day}`;


travelDate.setAttribute(
    "min",
    today
);



// ============================================
// BOOKING FORM VALIDATION
// ============================================

bookingForm.addEventListener(
    "submit",
    function (event) {


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
            travelDate.value;


        const travellers =
            parseInt(
                travellersInput.value
            );


        // ====================================
        // CHECK DESTINATION
        // ====================================

        if (!destination) {

            event.preventDefault();

            bookingMessage.style.color =
                "red";

            bookingMessage.innerText =
                "Please select a destination first.";

            return;
        }


        // ====================================
        // CHECK REQUIRED FIELDS
        // ====================================

        if (
            name === "" ||
            email === "" ||
            phone === "" ||
            date === ""
        ) {

            event.preventDefault();

            bookingMessage.style.color =
                "red";

            bookingMessage.innerText =
                "Please complete all required fields.";

            return;
        }


        // ====================================
        // CHECK TRAVELLERS
        // ====================================

        if (
            isNaN(travellers) ||
            travellers < 1
        ) {

            event.preventDefault();

            bookingMessage.style.color =
                "red";

            bookingMessage.innerText =
                "Please enter a valid number of travellers.";

            return;
        }


        // ====================================
        // CHECK TRAVEL DATE
        // ====================================

        if (date < today) {

            event.preventDefault();

            bookingMessage.style.color =
                "red";

            bookingMessage.innerText =
                "Travel date cannot be in the past.";

            return;
        }


        // ====================================
        // VALID FORM
        // IMPORTANT:
        // DO NOT use event.preventDefault() here.
        // The form will now submit to PHP.
        // ====================================

        bookingMessage.style.color =
            "green";

        bookingMessage.innerText =
            "Processing your booking...";

    }
);