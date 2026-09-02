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






// ===============================
// CATEGORIES TOGGLE
// ===============================

const categoriesBtn = document.getElementById("categoriesBtn");
const categoriesList = document.getElementById("categoriesList");

categoriesBtn.addEventListener("click", function () {

    categoriesList.classList.toggle("show");

    if (categoriesList.classList.contains("show")) {

        categoriesBtn.innerHTML =
            '<i class="bi bi-x-lg"></i> Hide Categories';

    } else {

        categoriesBtn.innerHTML =
            '<i class="bi bi-grid-3x3-gap"></i> View Categories';

    }

});