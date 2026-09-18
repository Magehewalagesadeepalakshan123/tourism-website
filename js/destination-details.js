// ============================================
// DESTINATION DATA
// ============================================

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


// ============================================
// GET DESTINATION FROM URL
// Example:
// destination-details.php?destination=sigiriya
// ============================================

const urlParameters =
    new URLSearchParams(
        window.location.search
    );

const destinationID =
    urlParameters.get("destination");

const destination =
    destinations[destinationID];


// ============================================
// GET HTML ELEMENTS
// ============================================

const destinationMainImage =
    document.getElementById(
        "destinationMainImage"
    );

const destinationCategory =
    document.getElementById(
        "destinationCategory"
    );

const destinationTitle =
    document.getElementById(
        "destinationTitle"
    );

const destinationHeading =
    document.getElementById(
        "destinationHeading"
    );

const destinationLocation =
    document.getElementById(
        "destinationLocation"
    );

const destinationDescription =
    document.getElementById(
        "destinationDescription"
    );

const destinationRating =
    document.getElementById(
        "destinationRating"
    );

const bestTime =
    document.getElementById(
        "bestTime"
    );

const province =
    document.getElementById(
        "province"
    );

const destinationPrice =
    document.getElementById(
        "destinationPrice"
    );

const bookingDestination =
    document.getElementById(
        "bookingDestination"
    );

const tourDuration =
    document.getElementById(
        "tourDuration"
    );

const bookingRating =
    document.getElementById(
        "bookingRating"
    );

const attractionsList =
    document.getElementById(
        "attractionsList"
    );


// ============================================
// DISPLAY DESTINATION
// ============================================

if (destination) {

    if (destinationMainImage) {

        destinationMainImage.src =
            destination.image;

        destinationMainImage.alt =
            destination.title;
    }


    if (destinationCategory) {

        destinationCategory.innerText =
            destination.category;
    }


    if (destinationTitle) {

        destinationTitle.innerText =
            destination.title;
    }


    if (destinationHeading) {

        destinationHeading.innerText =
            "Discover " +
            destination.title;
    }


    if (destinationLocation) {

        destinationLocation.innerText =
            "📍 " +
            destination.location;
    }


    if (destinationDescription) {

        destinationDescription.innerText =
            destination.description;
    }


    if (destinationRating) {

        destinationRating.innerText =
            destination.rating;
    }


    if (bestTime) {

        bestTime.innerText =
            destination.bestTime;
    }


    if (province) {

        province.innerText =
            destination.province;
    }


    if (destinationPrice) {

        destinationPrice.innerText =
            destination.price;
    }


    if (bookingDestination) {

        bookingDestination.innerText =
            destination.title;
    }


    if (tourDuration) {

        tourDuration.innerText =
            destination.duration;
    }


    if (bookingRating) {

        bookingRating.innerText =
            destination.rating +
            " ⭐";
    }


    // ========================================
    // DISPLAY ATTRACTIONS
    // ========================================

    if (attractionsList) {

        attractionsList.innerHTML = "";

        destination.attractions.forEach(
            function (attraction) {

                const item =
                    document.createElement(
                        "div"
                    );

                item.className =
                    "attraction-item";

                item.textContent =
                    "✓ " +
                    attraction;

                attractionsList.appendChild(
                    item
                );

            }
        );

    }

}


// ============================================
// DESTINATION NOT FOUND
// ============================================

else {

    const detailsSection =
        document.querySelector(
            ".details-section"
        );

    if (detailsSection) {

        detailsSection.innerHTML = `

            <div class="destination-error">

                <h2>
                    Destination not found
                </h2>

                <a href="destinations.php">
                    Back to Destinations
                </a>

            </div>

        `;

    }

}




