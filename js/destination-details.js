const destinations = {

    ella: {

        title: "Ella",

        category: "Nature",

        location: "Badulla District, Sri Lanka",

        province: "Uva Province",

        image: "../images/ella.jpg",

        rating: "4.8",

        bestTime: "January - March",

        duration: "3 Days",

        price: "LKR 25,000",

        description:
            "Ella is one of Sri Lanka's most beautiful mountain destinations. It is surrounded by green tea plantations, waterfalls, mountains and scenic hiking trails. Travellers can enjoy peaceful views, local food and some of the country's most famous attractions.",

        attractions: [
            "Nine Arch Bridge",
            "Ella Rock",
            "Little Adam's Peak",
            "Ravana Falls"
        ]

    },


    sigiriya: {

        title: "Sigiriya",

        category: "Culture",

        location: "Matale District, Sri Lanka",

        province: "Central Province",

        image: "../images/sigiriya.jpg",

        rating: "4.9",

        bestTime: "January - April",

        duration: "2 Days",

        price: "LKR 20,000",

        description:
            "Sigiriya is one of Sri Lanka's most famous historical attractions. The ancient rock fortress offers impressive architecture, historic ruins, beautiful gardens and panoramic views from the top.",

        attractions: [
            "Sigiriya Rock Fortress",
            "Lion Gate",
            "Water Gardens",
            "Sigiriya Museum"
        ]

    },


    kandy: {

        title: "Kandy",

        category: "Culture",

        location: "Kandy, Sri Lanka",

        province: "Central Province",

        image: "../images/kandy.jpg",

        rating: "4.7",

        bestTime: "December - April",

        duration: "2 Days",

        price: "LKR 22,000",

        description:
            "Kandy is a historic city surrounded by mountains and rich Sri Lankan culture. Visitors can explore religious sites, scenic locations, gardens and traditional cultural attractions.",

        attractions: [
            "Temple of the Tooth",
            "Kandy Lake",
            "Royal Botanical Gardens",
            "Kandy View Point"
        ]

    },


    "nuwara-eliya": {

        title: "Nuwara Eliya",

        category: "Nature",

        location: "Nuwara Eliya, Sri Lanka",

        province: "Central Province",

        image: "../images/nuwara-eliya.jpg",

        rating: "4.8",

        bestTime: "February - April",

        duration: "3 Days",

        price: "LKR 28,000",

        description:
            "Nuwara Eliya is famous for its cool climate, green mountains and beautiful tea plantations. It is an excellent destination for travellers who enjoy nature and peaceful surroundings.",

        attractions: [
            "Gregory Lake",
            "Horton Plains",
            "Tea Plantations",
            "Victoria Park"
        ]

    },


    galle: {

        title: "Galle",

        category: "Beach",

        location: "Galle, Sri Lanka",

        province: "Southern Province",

        image: "../images/galle.jpg",

        rating: "4.7",

        bestTime: "December - April",

        duration: "2 Days",

        price: "LKR 24,000",

        description:
            "Galle combines beautiful coastal scenery with fascinating history. Visitors can walk through the historic Galle Fort, explore colonial architecture and enjoy nearby beaches.",

        attractions: [
            "Galle Fort",
            "Galle Lighthouse",
            "Dutch Hospital",
            "Unawatuna Beach"
        ]

    },


    mirissa: {

        title: "Mirissa",

        category: "Beach",

        location: "Matara District, Sri Lanka",

        province: "Southern Province",

        image: "../images/mirissa.jpg",

        rating: "4.9",

        bestTime: "November - April",

        duration: "3 Days",

        price: "LKR 30,000",

        description:
            "Mirissa is a popular tropical beach destination with beautiful ocean views, sandy beaches and relaxing coastal surroundings.",

        attractions: [
            "Mirissa Beach",
            "Coconut Tree Hill",
            "Secret Beach",
            "Parrot Rock"
        ]

    }

};



/* =====================================
   GET DESTINATION FROM URL
===================================== */

const urlParameters =
    new URLSearchParams(
        window.location.search
    );


const destinationID =
    urlParameters.get("destination");


const destination =
    destinations[destinationID];



/* =====================================
   DISPLAY DESTINATION
===================================== */

if (destination) {

    document.getElementById(
        "destinationMainImage"
    ).src =
        destination.image;


    document.getElementById(
        "destinationCategory"
    ).innerText =
        destination.category;


    document.getElementById(
        "destinationTitle"
    ).innerText =
        destination.title;


    document.getElementById(
        "destinationHeading"
    ).innerText =
        "Discover " +
        destination.title;


    document.getElementById(
        "destinationLocation"
    ).innerText =
        "📍 " +
        destination.location;


    document.getElementById(
        "destinationDescription"
    ).innerText =
        destination.description;


    document.getElementById(
        "destinationRating"
    ).innerText =
        destination.rating;


    document.getElementById(
        "bestTime"
    ).innerText =
        destination.bestTime;


    document.getElementById(
        "province"
    ).innerText =
        destination.province;


    document.getElementById(
        "destinationPrice"
    ).innerText =
        destination.price;


    document.getElementById(
        "bookingDestination"
    ).innerText =
        destination.title;


    document.getElementById(
        "tourDuration"
    ).innerText =
        destination.duration;


    document.getElementById(
        "bookingRating"
    ).innerText =
        destination.rating + " ⭐";


    /* Attractions */

    const attractionsList =
        document.getElementById(
            "attractionsList"
        );


    destination.attractions.forEach(
        function(attraction) {

            const item =
                document.createElement(
                    "div"
                );


            item.className =
                "attraction-item";


            item.innerHTML =
                "✓ " + attraction;


            attractionsList.appendChild(
                item
            );

        }
    );

}
else {

    document.querySelector(
        ".details-section"
    ).innerHTML = `

        <div class="destination-error">

            <h2>
                Destination not found
            </h2>

            <a href="destinations.html">
                Back to Destinations
            </a>

        </div>

    `;

}
const bookNowButton =
    document.getElementById(
        "bookNowButton"
    );


if (
    bookNowButton &&
    destinationID
) {

    bookNowButton.addEventListener(
        "click",
        function() {

            window.location.href =
                "booking.html?destination=" +
                destinationID;

        }
    );

}