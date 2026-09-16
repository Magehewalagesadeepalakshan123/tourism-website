function searchDestination() {

    const searchValue =
        document
            .getElementById("destinationSearch")
            .value
            .toLowerCase()
            .trim();


    const cards =
        document.querySelectorAll(
            ".destination-card"
        );


    if (searchValue === "") {

        alert(
            "Please enter a destination."
        );

        return;
    }


    let found = false;


    cards.forEach(function(card) {

        const destinationName =
            card.getAttribute(
                "data-name"
            );


        if (
            destinationName.includes(
                searchValue
            )
        ) {

            card.style.display =
                "block";

            found = true;

        }
        else {

            card.style.display =
                "none";
        }

    });


    if (!found) {

        alert(
            "Sorry, destination not found."
        );


        cards.forEach(function(card) {

            card.style.display =
                "block";

        });

    }

}