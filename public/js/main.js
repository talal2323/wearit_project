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
