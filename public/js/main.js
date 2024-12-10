function openProductModal(image, name, price, description) {
    document.getElementById('productImage').src = image;
    document.getElementById('productModalLabel').textContent = name;
    document.getElementById('productPrice').innerHTML = `<strong>Price:</strong> $${price}`;
    document.getElementById('productDescription').textContent = description;
}


function initializeContactForm() {
    const contactForm = document.getElementById("contactForm");
    if (contactForm) {
        contactForm.addEventListener("submit", function (event) {
            event.preventDefault();
            alert("Thank you for contacting us!");
            location.reload();
        });
    }
}

// Initialize Pages
document.addEventListener("DOMContentLoaded", () => {
    initializeContactForm();
});

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const recipeContainer = document.getElementById('recipeContainer');

    searchInput.addEventListener('input', filterRecipes);
    categoryFilter.addEventListener('change', filterRecipes);

    function filterRecipes() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value;

        // Send an AJAX request to the server
        fetch('/filter-recipes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                searchTerm: searchTerm,
                category: selectedCategory,
            }),
        })
            .then(response => response.json())
            .then(data => {
                // Clear the current recipe cards
                recipeContainer.innerHTML = '';

                // Loop through the filtered data and render recipe cards
                data.forEach(item => {
                    const card = `
                        <div class="col-md-4 mb-4 recipe-card" data-category="${item.category_id}">
                            <div class="card">
                                <img src="${item.image}" class="card-img-top" alt="${item.name}">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>${item.name}</strong></h5>
                                    <p class="card-text"><strong>Price:</strong> RS ${item.price}/-</p>
                                </div>
                            </div>
                        </div>
                    `;
                    recipeContainer.insertAdjacentHTML('beforeend', card);
                });
            })
            .catch(error => console.error('Error:', error));
    }
});