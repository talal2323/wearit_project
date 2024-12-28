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
                            const li = document.createElement('li');
                            li.className = 'dropdown-item';
                            li.innerHTML = `
                                <img src="/images/${product.image}" alt="${product.name}" style="width: 40px; height: 40px; margin-right: 10px;">
                                <span>${product.name}</span> - $${product.price}
                            `;
                            searchResults.appendChild(li);
                        });

                        searchResults.style.display = 'block';
                    } else {
                        searchResults.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching search results:', error));
        } else {
            searchResults.style.display = 'none';
        }
    });
});
