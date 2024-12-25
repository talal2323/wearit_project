@extends('layouts.web')

@section('content')
<!-- Products Section -->
<section class="container my-5" style="margin-top: 80px;">
    <br>

    <div class="search-bar-container" style="position: relative;">
    <input type="text" id="search-bar" class="form-control" placeholder="Search by Name" autocomplete="off">
    <ul id="search-results" class="dropdown-menu" style="position: absolute; width: 100%; z-index: 1000; display: none;">
        <!-- Search results will appear here -->
    </ul>
</div>

<br>

    <!-- Tabs for Men and Women Sections -->
    <ul class="nav nav-tabs" id="productTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="men-tab" data-bs-toggle="tab" data-bs-target="#men-section" type="button" role="tab" aria-controls="men-section" aria-selected="true">Men</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="women-tab" data-bs-toggle="tab" data-bs-target="#women-section" type="button" role="tab" aria-controls="women-section" aria-selected="false">Women</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="productTabsContent">
        <!-- Men Products -->
        <div class="tab-pane fade show active" id="men-section" role="tabpanel" aria-labelledby="men-tab">
            <div class="row mt-4">
                @foreach($menProducts as $product)
                    <div class="col-md-4 mt-3">
                        <div class="card">
                            <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">${{ $product->price }}</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#productModal"
                                        onclick="openProductModal('{{ asset('images/' . $product->image) }}', '{{ $product->name }}', '{{ $product->price }}', '{{ $product->description }}')">
                                    View Product
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Women Products -->
        <div class="tab-pane fade" id="women-section" role="tabpanel" aria-labelledby="women-tab">
            <div class="row mt-4">
                @foreach($womenProducts as $product)
                    <div class="col-md-4 mt-3">
                        <div class="card">
                            <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">${{ $product->price }}</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#productModal"
                                        onclick="openProductModal('{{ asset('images/' . $product->image) }}', '{{ $product->name }}', '{{ $product->price }}', '{{ $product->description }}')">
                                    View Product
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Product Modal Template -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="productImage" src="" class="img-fluid" alt="Product Image">
                <p id="productDescription" class="mt-3"></p>
                <p id="productPrice"><strong>Price:</strong></p>

                <!-- Size Options -->
                <div class="mb-3">
                    <label for="sizeSelect" class="form-label"><strong>Select Size:</strong></label>
                    <select class="form-select" id="sizeSelect">
                        <option value="S">Small (S)</option>
                        <option value="M">Medium (M)</option>
                        <option value="L">Large (L)</option>
                    </select>
                </div>

                <!-- Quantity Selector -->
                <div class="mb-3">
                    <label for="quantityInput" class="form-label"><strong>Quantity:</strong></label>
                    <input type="number" class="form-control" id="quantityInput" value="1" min="1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-bar');
    const menSection = document.getElementById('men-section');
    const womenSection = document.getElementById('women-section');

    // Listen for input in the search bar
    searchInput.addEventListener('input', filterProducts);

    // Function to filter products based on search term
    function filterProducts() {
        const searchTerm = searchInput.value.toLowerCase();

        // Filter Men Products
        const menProducts = menSection.querySelectorAll('.card');
        menProducts.forEach(function (product) {
            const productName = product.querySelector('.card-title').textContent.toLowerCase();
            const productCategory = product.dataset.category ? product.dataset.category.toLowerCase() : ''; // If you have categories
            if (productName.includes(searchTerm) || productCategory.includes(searchTerm)) {
                product.style.display = 'block'; // Show product if it matches search term
            } else {
                product.style.display = 'none'; // Hide product if it does not match
            }
        });

        // Filter Women Products
        const womenProducts = womenSection.querySelectorAll('.card');
        womenProducts.forEach(function (product) {
            const productName = product.querySelector('.card-title').textContent.toLowerCase();
            const productCategory = product.dataset.category ? product.dataset.category.toLowerCase() : ''; // If you have categories
            if (productName.includes(searchTerm) || productCategory.includes(searchTerm)) {
                product.style.display = 'block'; // Show product if it matches search term
            } else {
                product.style.display = 'none'; // Hide product if it does not match
            }
        });
    }
});
</script>


@endsection
