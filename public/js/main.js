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
    const searchBar = document.getElementById('search-bar');
    const searchResultsContainer = document.getElementById('search-results-container');
    const searchResults = document.getElementById('search-results');

    // Event listener for search bar input
    searchBar.addEventListener('input', function () {
        const query = searchBar.value.trim();

        if (query.length > 0) {
            // AJAX request to fetch search results
            fetch(`/search-products?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    // Clear previous results
                    searchResults.innerHTML = '';

                    // Check if there are results
                    if (data.products.length > 0) {
                        data.products.forEach(product => {
                            const productCard = document.createElement('div');
                            productCard.className = 'col-md-4 mt-3';

                            productCard.innerHTML = `
                                <div class="card">
                                    <img src="/images/${product.image}" class="card-img-top" alt="${product.name}">
                                    <div class="card-body">
                                        <h5 class="card-title">${product.name}</h5>
                                        <p class="card-text">$${product.price}</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#productModal"
                                                onclick="openProductModal('/images/${product.image}', '${product.name}', '${product.price}', '${product.description}')">
                                            View Product
                                        </button>
                                    </div>
                                </div>
                            `;
                            searchResults.appendChild(productCard);
                        });

                        searchResultsContainer.style.display = 'block';
                    } else {
                        searchResults.innerHTML = '<p>No products found.</p>';
                        searchResultsContainer.style.display = 'block';
                    }
                })
                .catch(error => console.error('Error fetching search results:', error));
        } else {
            searchResultsContainer.style.display = 'none';
        }
    });
});
