// ================= SEARCH =================

const searchBtn = document.getElementById("searchBtn");
const searchInput = document.getElementById("searchInput");

searchBtn.addEventListener("click", function () {

    const searchValue = searchInput.value.trim();

    if (searchValue === "") {
        alert("Please enter something to search.");
        return;
    }

    alert("Searching for: " + searchValue);

});


// Search with Enter

searchInput.addEventListener("keypress", function (event) {

    if (event.key === "Enter") {
        searchBtn.click();
    }

});


// ================= CART =================

let cartCount = 3;

const cartElement = document.getElementById("cartCount");

function updateCart() {
    cartElement.textContent = cartCount;
}

updateCart();