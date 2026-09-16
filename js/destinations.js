const searchInput =
    document.getElementById("destinationFilter");

const destinationCards =
    document.querySelectorAll(
        ".travel-destination-card"
    );

const noDestination =
    document.getElementById("noDestination");


let currentCategory = "all";


searchInput.addEventListener(
    "input",
    function() {

        filterDestinations();

    }
);


function filterCategory(category, button) {

    currentCategory = category;


    const buttons =
        document.querySelectorAll(
            ".filter-btn"
        );


    buttons.forEach(function(btn) {

        btn.classList.remove("active");

    });


    button.classList.add("active");


    filterDestinations();

}


function filterDestinations() {

    const searchText =
        searchInput
            .value
            .toLowerCase()
            .trim();


    let found = false;


    destinationCards.forEach(
        function(card) {

            const name =
                card.dataset.name;

            const category =
                card.dataset.category;


            const matchSearch =
                name.includes(searchText);


            const matchCategory =
                currentCategory === "all" ||
                category === currentCategory;


            if (
                matchSearch &&
                matchCategory
            ) {

                card.style.display =
                    "block";

                found = true;

            }
            else {

                card.style.display =
                    "none";

            }

        }
    );


    if (found) {

        noDestination.style.display =
            "none";

    }
    else {

        noDestination.style.display =
            "block";

    }

}